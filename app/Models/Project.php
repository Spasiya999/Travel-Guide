<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'client',
        'technology',
        'start_date',
        'expected_completion',
        'total_duration_weeks',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'expected_completion' => 'date',
    ];

    public function phases(): HasMany
    {
        return $this->hasMany(ProjectPhase::class)->orderBy('phase_number');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(ProjectTask::class)->orderBy('start_date');
    }

    public function getProgressPercentageAttribute(): float
    {
        $totalTasks = $this->tasks()->count();
        if ($totalTasks === 0) return 0;

        $completedTasks = $this->tasks()->where('status', 'completed')->count();
        return round(($completedTasks / $totalTasks) * 100, 2);
    }

    public function getOverdueTasksAttribute()
    {
        return $this->tasks()
            ->where('status', '!=', 'completed')
            ->where('end_date', '<', now())
            ->get();
    }
}
