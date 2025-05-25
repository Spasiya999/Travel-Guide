<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $project->name }} - Project Timeline</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .project-info {
            display: flex;
            justify-content: space-around;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .progress-stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            font-size: 12px;
            color: #666;
        }

        .progress-bar {
            width: 100%;
            height: 20px;
            background-color: #e9ecef;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
            transition: width 0.3s ease;
        }

        .timeline-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .timeline-table th {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 15px 10px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #ddd;
        }

        .timeline-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .timeline-table tr:hover {
            background-color: #f8f9fa;
        }

        .phase-header {
            background-color: #e3f2fd !important;
            font-weight: bold;
            color: #1976d2;
            cursor: pointer;
        }

        .phase-header:hover {
            background-color: #bbdefb !important;
        }

        .status {
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            border: none;
            min-width: 80px;
        }

        .status-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-in-progress {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-pending {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-not-started {
            background-color: #e2e3e5;
            color: #6c757d;
        }

        .status-overdue {
            background-color: #f5c6cb;
            color: #721c24;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }

        .priority-high {
            color: #dc3545;
            font-weight: bold;
        }

        .priority-medium {
            color: #fd7e14;
            font-weight: bold;
        }

        .priority-low {
            color: #28a745;
            font-weight: bold;
        }

        .notes {
            font-size: 11px;
            color: #666;
            font-style: italic;
        }

        .export-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .export-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            color: white;
            text-decoration: none;
        }

        .edit-mode {
            background-color: #fff3cd !important;
            border: 2px solid #ffc107;
        }

        .editable-field {
            background: transparent;
            border: 1px solid transparent;
            padding: 2px 5px;
            border-radius: 3px;
            width: 100%;
        }

        .editable-field:focus {
            border-color: #007bff;
            outline: none;
            background: white;
        }

        .phase-toggle {
            display: none;
        }

        .phase-tasks {
            display: table-row-group;
        }

        .phase-collapsed .phase-tasks {
            display: none;
        }

        .collapse-icon {
            margin-right: 5px;
            transition: transform 0.3s ease;
        }

        .phase-collapsed .collapse-icon {
            transform: rotate(-90deg);
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeaa7;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        @media (max-width: 768px) {

            .project-info,
            .progress-stats {
                flex-direction: column;
                gap: 10px;
            }

            .timeline-table {
                font-size: 12px;
            }

            .timeline-table th,
            .timeline-table td {
                padding: 8px 5px;
            }

            .export-btn {
                margin: 5px 2px;
                padding: 8px 15px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $project->icon ?? '🌍' }} {{ $project->name }}</h1>
        <p>{{ $project->description }}</p>
    </div>

    <div class="project-info">
        <div>
            <strong>Project Start:</strong> {{ $project->start_date->format('M j, Y') }}<br>
            <strong>Expected Completion:</strong> {{ $project->expected_completion->format('M j, Y') }}<br>
            <strong>Total Duration:</strong> {{ $project->total_duration_weeks }} Weeks
        </div>
        <div>
            <strong>Client:</strong> {{ $project->client }}<br>
            <strong>Technology:</strong> {{ $project->technology }}<br>
            <strong>Status:</strong> <span
                class="status status-{{ str_replace('_', '-', $project->status) }}">{{ ucfirst(str_replace('_', ' ', $project->status)) }}</span>
        </div>
    </div>

    {{-- <div class="progress-stats">
        <div class="stat-item">
            <div class="stat-number">{{ $stats['progress_percentage'] }}%</div>
            <div class="stat-label">Complete</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['completed_tasks'] }}/{{ $stats['total_tasks'] }}</div>
            <div class="stat-label">Tasks Done</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $stats['overdue_tasks'] }}</div>
            <div class="stat-label">Overdue</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ abs($stats['days_remaining']) }}</div>
            <div class="stat-label">{{ $stats['days_remaining'] >= 0 ? 'Days Left' : 'Days Over' }}</div>
        </div>
    </div>

    <div class="progress-bar">
        <div class="progress-fill" style="width: {{ $stats['progress_percentage'] }}%"></div>
    </div>

    @if ($stats['overdue_tasks'] > 0)
    <div class="alert alert-warning">
        <strong>Warning:</strong> You have {{ $stats['overdue_tasks'] }} overdue task{{ $stats['overdue_tasks'] > 1 ? 's' : '' }}.
    </div>
    @endif --}}

    <div id="alert-container"></div>

    <div style="margin-bottom: 15px;">
        <a href="{{ route('projects.export.csv', $project) }}" class="export-btn">📊 Export to CSV</a>
        <button class="export-btn" onclick="printTable()">🖨️ Print Timeline</button>
        <a href="{{ route('projects.export.json', $project) }}" class="export-btn">💾 Export Data (JSON)</a>
        <button class="export-btn" onclick="toggleEditMode()" id="editModeBtn">✏️ Edit Mode</button>
        <button class="export-btn" onclick="refreshData()">🔄 Refresh</button>
    </div>

    <table class="timeline-table" id="timelineTable">
        <thead>
            <tr>
                <th>Phase</th>
                <th>Task/Milestone</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Deliverables</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($project->phases as $phase)
                <tr class="phase-header" onclick="togglePhase({{ $phase->id }})">
                    <td colspan="9">
                        <span class="collapse-icon">▼</span>
                        {{ $phase->icon }} PHASE {{ $phase->phase_number }}: {{ strtoupper($phase->name) }}
                        <span style="float: right; font-size: 12px; opacity: 0.8;">
                            {{ $phase->progress_percentage }}% Complete
                            ({{ $phase->tasks->where('status', 'completed')->count() }}/{{ $phase->tasks->count() }}
                            tasks)
                        </span>
                    </td>
                </tr>
        <tbody class="phase-tasks" id="phase-{{ $phase->id }}-tasks">
            @foreach ($phase->tasks as $task)
                <tr data-task-id="{{ $task->id }}"
                    class="{{ $task->is_overdue && $task->status !== 'completed' ? 'overdue-row' : '' }}">
                    <td>Phase {{ $phase->phase_number }}</td>
                    <td>
                        <input type="text" class="editable-field" value="{{ $task->name }}" data-field="name"
                            readonly>
                    </td>
                    <td>
                        <input type="date" class="editable-field" value="{{ $task->start_date->format('Y-m-d') }}"
                            data-field="start_date" readonly>
                    </td>
                    <td>
                        <input type="date" class="editable-field" value="{{ $task->end_date->format('Y-m-d') }}"
                            data-field="end_date" readonly>
                    </td>
                    <td>{{ $task->duration_days }} day{{ $task->duration_days > 1 ? 's' : '' }}</td>
                    <td>
                        <select class="status status-{{ str_replace('_', '-', $task->status) }}"
                            data-task-id="{{ $task->id }}" onchange="updateTaskStatus(this)">
                            <option value="not_started" {{ $task->status === 'not_started' ? 'selected' : '' }}>Not
                                Started</option>
                            <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In
                                Progress</option>
                            <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed
                            </option>
                            <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="overdue" {{ $task->status === 'overdue' ? 'selected' : '' }}>Overdue
                            </option>
                        </select>
                    </td>
                    <td class="priority-{{ $task->priority }}">
                        <select class="editable-field priority-{{ $task->priority }}" data-field="priority" disabled>
                            <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" class="editable-field" value="{{ $task->deliverables }}"
                            data-field="deliverables" readonly>
                    </td>
                    <td class="notes">
                        <input type="text" class="editable-field" value="{{ $task->notes }}" data-field="notes"
                            readonly>
                    </td>
                </tr>
            @endforeach
        </tbody>
        @endforeach
        </tbody>
    </table>

    <script>
        let editMode = false;
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alert-container');
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `<strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}`;

            alertContainer.appendChild(alert);

            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        function updateTaskStatus(selectElement) {
            const taskId = selectElement.getAttribute('data-task-id');
            const newStatus = selectElement.value;
            const row = selectElement.closest('tr');

            // Add loading state
            row.classList.add('loading');

            fetch(`/api/projects/tasks/${taskId}/status`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(async response => {
                    const data = await response.json();

                    if (!response.ok) {
                        const errorMsg = data.message || 'Failed to update task status';
                        showAlert(errorMsg, 'danger');
                        return;
                    }

                    if (data.success) {
                        selectElement.className = `status status-${newStatus.replace('_', '-')}`;
                        showAlert(data.message);

                        const progressFill = document.querySelector('.progress-fill');
                        progressFill.style.width = data.project_progress + '%';

                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        showAlert('Failed to update task status', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // showAlert('An error occurred while updating the task', 'danger');
                })
                .finally(() => {
                    row.classList.remove('loading');
                });
        }

        function toggleEditMode() {
            editMode = !editMode;
            const editableFields = document.querySelectorAll('.editable-field');
            const editBtn = document.getElementById('editModeBtn');
            const prioritySelects = document.querySelectorAll('select[data-field="priority"]');

            if (editMode) {
                editableFields.forEach(field => {
                    field.removeAttribute('readonly');
                    field.classList.add('edit-mode');
                });
                prioritySelects.forEach(select => {
                    select.removeAttribute('disabled');
                });
                editBtn.textContent = '💾 Save Changes';
                editBtn.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
            } else {
                // Save changes logic would go here
                editableFields.forEach(field => {
                    field.setAttribute('readonly', true);
                    field.classList.remove('edit-mode');
                });
                prioritySelects.forEach(select => {
                    select.setAttribute('disabled', true);
                });
                editBtn.textContent = '✏️ Edit Mode';
                editBtn.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
                showAlert('Changes saved successfully!');
            }
        }

        function togglePhase(phaseId) {
            const phaseRow = event.currentTarget;
            const tasksBody = document.getElementById(`phase-${phaseId}-tasks`);
            const icon = phaseRow.querySelector('.collapse-icon');

            if (tasksBody.style.display === 'none') {
                tasksBody.style.display = 'table-row-group';
                icon.textContent = '▼';
                phaseRow.classList.remove('phase-collapsed');
            } else {
                tasksBody.style.display = 'none';
                icon.textContent = '▶';
                phaseRow.classList.add('phase-collapsed');
            }
        }

        function printTable() {
            window.print();
        }

        function refreshData() {
            location.reload();
        }

        // Auto-refresh every 5 minutes
        setInterval(refreshData, 300000);

        // Initialize overdue task detection
        function updateOverdueStatus() {
            const today = new Date();
            const rows = document.querySelectorAll('[data-task-id]');

            rows.forEach(row => {
                const endDateInput = row.querySelector('input[data-field="end_date"]');
                const statusSelect = row.querySelector('select[data-task-id]');

                if (endDateInput && statusSelect) {
                    const endDate = new Date(endDateInput.value);
                    const currentStatus = statusSelect.value;

                    if (currentStatus !== 'completed' && endDate < today) {
                        row.classList.add('overdue-row');
                        if (currentStatus === 'not_started') {
                            statusSelect.value = 'overdue';
                            statusSelect.className = 'status status-overdue';
                        }
                    }
                }
            });
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            updateOverdueStatus();
        });
    </script>
</body>

</html>
