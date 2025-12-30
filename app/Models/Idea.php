<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idea extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function ideaTasks(): HasMany
    {
        return $this->hasMany(IdeaTask::class)->orderBy('position');
    }

    public function getTaskCountByStatus(string $status): int
    {
        return $this->ideaTasks()
            ->where('status', $status)
            ->count();
    }

    public function getTodoCount(): int
    {
        return $this->getTaskCountByStatus('todo');
    }

    public function getInProgressCount(): int
    {
        return $this->getTaskCountByStatus('in_progress');
    }

    public function getDoneCount(): int
    {
        return $this->getTaskCountByStatus('done');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
