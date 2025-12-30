<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdeaTask extends Model
{
    protected $fillable = [
        'idea_id',
        'title',
        'description',
        'status',
        'position',
        'completed_at'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function idea(): BelongsTo
    {
        return $this->belongsTo(Idea::class);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'done';
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'done',
            'completed_at' => now()
        ]);
    }

    public function getStatusColor(): string
    {
        return match($this->status) {
            'todo' => 'slate',
            'in_progress' => 'blue',
            'done' => 'green',
            default => 'gray'
        };
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            'todo' => 'Akan Dikerjakan',
            'in_progress' => 'Sedang Dikerjakan',
            'done' => 'Selesai',
            default => 'Tidak Diketahui'
        };
    }
}
