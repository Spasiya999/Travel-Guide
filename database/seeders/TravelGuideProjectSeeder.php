<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectPhase;
use App\Models\ProjectTask;

class TravelGuideProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the main project
        $project = Project::create([
            'name' => 'Travel Guide Website Development',
            'description' => 'Project Timeline & Progress Tracker',
            'client' => 'Travel Guide Professional',
            'technology' => 'Laravel + MySQL',
            'start_date' => '2025-05-17',
            'expected_completion' => '2025-07-05',
            'total_duration_weeks' => 7,
            'status' => 'in_progress'
        ]);

        // Create phases
        $phases = [
            [
                'name' => 'Requirement Gathering',
                'description' => 'Gathering and analyzing project requirements',
                'icon' => '📋',
                'phase_number' => 1,
                'status' => 'in_progress'
            ],
            [
                'name' => 'Design & Prototyping',
                'description' => 'Creating UI/UX designs and prototypes',
                'icon' => '🎨',
                'phase_number' => 2,
                'status' => 'not_started'
            ],
            [
                'name' => 'Development',
                'description' => 'Backend and frontend development',
                'icon' => '💻',
                'phase_number' => 3,
                'status' => 'not_started'
            ],
            [
                'name' => 'Testing & Quality Assurance',
                'description' => 'Testing and quality assurance processes',
                'icon' => '🧪',
                'phase_number' => 4,
                'status' => 'not_started'
            ],
            [
                'name' => 'Deployment',
                'description' => 'Server setup and deployment',
                'icon' => '🚀',
                'phase_number' => 5,
                'status' => 'not_started'
            ]
        ];

        foreach ($phases as $phaseData) {
            $phase = ProjectPhase::create([
                'project_id' => $project->id,
                ...$phaseData
            ]);
        }

        // Get created phases
        $phase1 = ProjectPhase::where(['project_id' => $project->id, 'phase_number' => 1])->first();
        $phase2 = ProjectPhase::where(['project_id' => $project->id, 'phase_number' => 2])->first();
        $phase3 = ProjectPhase::where(['project_id' => $project->id, 'phase_number' => 3])->first();
        $phase4 = ProjectPhase::where(['project_id' => $project->id, 'phase_number' => 4])->first();
        $phase5 = ProjectPhase::where(['project_id' => $project->id, 'phase_number' => 5])->first();

        // Create tasks
        $tasks = [
            // Phase 1: Requirement Gathering
            [
                'project_phase_id' => $phase1->id,
                'name' => 'Client Requirements Analysis',
                'start_date' => '2025-05-17',
                'end_date' => '2025-05-19',
                'duration_days' => 3,
                'status' => 'completed',
                'priority' => 'high',
                'deliverables' => 'Requirements Document',
                'notes' => 'Initial client meeting conducted'
            ],
            [
                'project_phase_id' => $phase1->id,
                'name' => 'Technical Specifications',
                'start_date' => '2025-05-20',
                'end_date' => '2025-05-21',
                'duration_days' => 2,
                'status' => 'in_progress',
                'priority' => 'high',
                'deliverables' => 'Technical Architecture',
                'notes' => 'Laravel & MySQL setup planned'
            ],
            [
                'project_phase_id' => $phase1->id,
                'name' => 'Content & Feature Planning',
                'start_date' => '2025-05-22',
                'end_date' => '2025-05-23',
                'duration_days' => 2,
                'status' => 'pending',
                'priority' => 'medium',
                'deliverables' => 'Content Strategy',
                'notes' => 'Sri Lanka destinations content'
            ],

            // Phase 2: Design & Prototyping
            [
                'project_phase_id' => $phase2->id,
                'name' => 'UI/UX Design Mockups',
                'start_date' => '2025-05-24',
                'end_date' => '2025-05-28',
                'duration_days' => 5,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Design Mockups',
                'notes' => 'Home, packages, reviews pages'
            ],
            [
                'project_phase_id' => $phase2->id,
                'name' => 'Responsive Design Planning',
                'start_date' => '2025-05-29',
                'end_date' => '2025-05-30',
                'duration_days' => 2,
                'status' => 'not_started',
                'priority' => 'medium',
                'deliverables' => 'Mobile Design',
                'notes' => 'Bootstrap implementation'
            ],
            [
                'project_phase_id' => $phase2->id,
                'name' => 'Client Design Approval',
                'start_date' => '2025-05-31',
                'end_date' => '2025-06-02',
                'duration_days' => 2,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Approved Designs',
                'notes' => 'Client feedback & revisions'
            ],

            // Phase 3: Development
            [
                'project_phase_id' => $phase3->id,
                'name' => 'Backend Development (Laravel)',
                'start_date' => '2025-06-03',
                'end_date' => '2025-06-06',
                'duration_days' => 4,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Backend APIs',
                'notes' => 'Database, models, controllers'
            ],
            [
                'project_phase_id' => $phase3->id,
                'name' => 'Frontend Development',
                'start_date' => '2025-06-07',
                'end_date' => '2025-06-10',
                'duration_days' => 4,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Web Pages',
                'notes' => 'HTML, CSS, JS, Blade templates'
            ],
            [
                'project_phase_id' => $phase3->id,
                'name' => 'Admin Panel Development',
                'start_date' => '2025-06-11',
                'end_date' => '2025-06-13',
                'duration_days' => 3,
                'status' => 'not_started',
                'priority' => 'medium',
                'deliverables' => 'Admin Dashboard',
                'notes' => 'Package & review management'
            ],
            [
                'project_phase_id' => $phase3->id,
                'name' => 'Integration (WhatsApp, Email)',
                'start_date' => '2025-06-14',
                'end_date' => '2025-06-16',
                'duration_days' => 3,
                'status' => 'not_started',
                'priority' => 'medium',
                'deliverables' => 'Communication Features',
                'notes' => 'Contact forms & messaging'
            ],

            // Phase 4: Testing & QA
            [
                'project_phase_id' => $phase4->id,
                'name' => 'Functionality Testing',
                'start_date' => '2025-06-17',
                'end_date' => '2025-06-19',
                'duration_days' => 3,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Test Reports',
                'notes' => 'All features & pages'
            ],
            [
                'project_phase_id' => $phase4->id,
                'name' => 'Responsive Testing',
                'start_date' => '2025-06-20',
                'end_date' => '2025-06-21',
                'duration_days' => 2,
                'status' => 'not_started',
                'priority' => 'medium',
                'deliverables' => 'Device Compatibility',
                'notes' => 'Mobile, tablet, desktop'
            ],
            [
                'project_phase_id' => $phase4->id,
                'name' => 'Performance Optimization',
                'start_date' => '2025-06-22',
                'end_date' => '2025-06-23',
                'duration_days' => 2,
                'status' => 'not_started',
                'priority' => 'low',
                'deliverables' => 'Optimized Site',
                'notes' => 'Speed & SEO improvements'
            ],

            // Phase 5: Deployment
            [
                'project_phase_id' => $phase5->id,
                'name' => 'Server Setup & Configuration',
                'start_date' => '2025-06-24',
                'end_date' => '2025-06-25',
                'duration_days' => 2,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Live Server',
                'notes' => 'Hosting setup (client responsibility)'
            ],
            [
                'project_phase_id' => $phase5->id,
                'name' => 'Website Deployment',
                'start_date' => '2025-06-26',
                'end_date' => '2025-06-28',
                'duration_days' => 3,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Live Website',
                'notes' => 'Database migration & testing'
            ],
            [
                'project_phase_id' => $phase5->id,
                'name' => 'Client Training & Handover',
                'start_date' => '2025-06-29',
                'end_date' => '2025-07-01',
                'duration_days' => 3,
                'status' => 'not_started',
                'priority' => 'medium',
                'deliverables' => 'Training Materials',
                'notes' => 'Admin panel usage training'
            ],
            [
                'project_phase_id' => $phase5->id,
                'name' => 'Final Testing & Go-Live',
                'start_date' => '2025-07-02',
                'end_date' => '2025-07-05',
                'duration_days' => 4,
                'status' => 'not_started',
                'priority' => 'high',
                'deliverables' => 'Live Website',
                'notes' => 'Final checks & project completion'
            ]
        ];

        foreach ($tasks as $taskData) {
            ProjectTask::create([
                'project_id' => $project->id,
                ...$taskData
            ]);
        }
    }
}
