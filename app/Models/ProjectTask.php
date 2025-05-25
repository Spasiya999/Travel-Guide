<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'project_phase_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'duration_days',
        'status',
        'priority',
        'deliverables',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function phase()
    {
        return $this->belongsTo(ProjectPhase::class, 'project_phase_id');
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->status !== 'completed' && $this->end_date < now();
    }

    public function getDaysRemainingAttribute(): int
    {
        return now()->diffInDays($this->end_date, false);
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', '!=', 'completed')
            ->where('end_date', '<', now());
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high');
    }
}
