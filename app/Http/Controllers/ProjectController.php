<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects
     */
    public function index()
    {
        $project = Project::with(['phases', 'tasks'])->first();
        return view('project', compact('project'));
    }

    /**
     * Show project timeline
     */
    public function show(Project $project)
    {
        $project->load(['phases.tasks', 'tasks']);

        // Calculate project statistics
        $stats = [
            'total_tasks' => $project->tasks->count(),
            'completed_tasks' => $project->tasks->where('status', 'completed')->count(),
            'overdue_tasks' => $project->overdue_tasks->count(),
            'progress_percentage' => $project->progress_percentage,
            'days_remaining' => Carbon::now()->diffInDays($project->expected_completion, false)
        ];

        return view('projects.show', compact('project', 'stats'));
    }

    /**
     * Update task status
     */
    public function updateTaskStatus(Request $request, ProjectTask $task): JsonResponse
    {
        try {
            $request->validate([
                'status' => 'required|in:not_started,in_progress,completed,pending,overdue'
            ]);

            \Log::info('Updating task status', [
                'task_id' => $task->id,
                'status' => $request->status,
                'phase' => $task->phase,
                'project' => $task->project
            ]);

            $task->update(['status' => $request->status]);

            $this->updatePhaseStatus($task->phase);  // <-- could be null
            $this->updateProjectStatus($task->project); // <-- could be null

            return response()->json([
                'success' => true,
                'message' => 'Task status updated successfully',
                'task' => $task->fresh(),
                'project_progress' => $task->project->progress_percentage
            ]);
        } catch (\Exception $e) {
            \Log::error('Task update error', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500); // explicitly set HTTP status
        }
    }

    /**
     * Get project data as JSON for export
     */
    public function exportJson(Project $project): JsonResponse
    {
        $project->load(['phases.tasks']);

        return response()->json([
            'project' => $project,
            'export_date' => now()->toDateTimeString(),
            'stats' => [
                'total_tasks' => $project->tasks->count(),
                'completed_tasks' => $project->tasks->where('status', 'completed')->count(),
                'progress_percentage' => $project->progress_percentage
            ]
        ]);
    }

    /**
     * Export project timeline as CSV
     */
    public function exportCsv(Project $project)
    {
        $project->load(['phases.tasks']);

        $filename = 'project_timeline_' . $project->id . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($project) {
            $file = fopen('php://output', 'w');

            // Write CSV headers
            fputcsv($file, [
                'Phase',
                'Task/Milestone',
                'Start Date',
                'End Date',
                'Duration',
                'Status',
                'Priority',
                'Deliverables',
                'Notes'
            ]);

            foreach ($project->phases as $phase) {
                // Write phase header
                fputcsv($file, [
                    "PHASE {$phase->phase_number}: " . strtoupper($phase->name),
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    '',
                    ''
                ]);

                // Write phase tasks
                foreach ($phase->tasks as $task) {
                    fputcsv($file, [
                        "Phase {$phase->phase_number}",
                        $task->name,
                        $task->start_date->format('M j, Y'),
                        $task->end_date->format('M j, Y'),
                        $task->duration_days . ' days',
                        ucfirst(str_replace('_', ' ', $task->status)),
                        ucfirst($task->priority),
                        $task->deliverables,
                        $task->notes
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get overdue tasks
     */
    public function getOverdueTasks(Project $project): JsonResponse
    {
        $overdueTasks = $project->tasks()
            ->overdue()
            ->with('phase')
            ->get();

        return response()->json([
            'overdue_tasks' => $overdueTasks,
            'count' => $overdueTasks->count()
        ]);
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client' => 'required|string|max:255',
            'technology' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'expected_completion' => 'required|date|after:start_date',
            'status' => 'required|in:planning,in_progress,completed,cancelled'
        ]);

        $project->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'project' => $project->fresh()
        ]);
    }

    /**
     * Update task
     */
    public function updateTask(Request $request, ProjectTask $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:not_started,in_progress,completed,pending,overdue',
            'priority' => 'required|in:low,medium,high',
            'deliverables' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        // Calculate duration
        $validated['duration_days'] = Carbon::parse($validated['start_date'])
            ->diffInDays(Carbon::parse($validated['end_date']));

        $task->update($validated);

        // Update related phase and project status
        $this->updatePhaseStatus($task->phase);
        $this->updateProjectStatus($task->project);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'task' => $task->fresh()
        ]);
    }

    /**
     * Get project dashboard data
     */
    public function dashboard(Project $project): JsonResponse
    {
        $project->load(['phases.tasks', 'tasks']);

        $phaseProgress = $project->phases->map(function ($phase) {
            return [
                'name' => $phase->name,
                'progress' => $phase->progress_percentage,
                'status' => $phase->status,
                'task_count' => $phase->tasks->count()
            ];
        });

        $upcomingTasks = $project->tasks()
            ->where('status', '!=', 'completed')
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->limit(5)
            ->get();

        return response()->json([
            'project' => $project,
            'phase_progress' => $phaseProgress,
            'upcoming_tasks' => $upcomingTasks,
            'overdue_count' => $project->overdue_tasks->count(),
            'completion_percentage' => $project->progress_percentage
        ]);
    }

    /**
     * Update phase status based on tasks
     */
    private function updatePhaseStatus(ProjectPhase $phase)
    {
        $tasks = $phase->tasks;

        if ($tasks->isEmpty()) {
            return;
        }

        $completedCount = $tasks->where('status', 'completed')->count();
        $inProgressCount = $tasks->where('status', 'in_progress')->count();
        $totalCount = $tasks->count();

        if ($completedCount === $totalCount) {
            $phase->update(['status' => 'completed']);
        } elseif ($inProgressCount > 0 || $completedCount > 0) {
            $phase->update(['status' => 'in_progress']);
        } else {
            $phase->update(['status' => 'not_started']);
        }
    }

    /**
     * Update project status based on phases
     */
    private function updateProjectStatus(Project $project)
    {
        $phases = $project->phases;

        if ($phases->isEmpty()) {
            return;
        }

        $completedCount = $phases->where('status', 'completed')->count();
        $inProgressCount = $phases->where('status', 'in_progress')->count();
        $totalCount = $phases->count();

        if ($completedCount === $totalCount) {
            $project->update(['status' => 'completed']);
        } elseif ($inProgressCount > 0 || $completedCount > 0) {
            $project->update(['status' => 'in_progress']);
        } else {
            $project->update(['status' => 'planning']);
        }
    }
}
