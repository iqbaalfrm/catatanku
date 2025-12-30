<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'completed_at',
        'due_date',
        'priority'
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'due_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function markAsCompleted()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);
    }

    public function markAsIncomplete()
    {
        $this->update([
            'status' => 'pending',
            'completed_at' => null
        ]);
    }

    public function getPriorityLabel(): string
    {
        return match($this->priority) {
            1 => 'Rendah',
            2 => 'Sedang',
            3 => 'Tinggi',
            default => 'Tidak Diketahui'
        };
    }

    public function getPriorityColor(): string
    {
        return match($this->priority) {
            1 => 'green',
            2 => 'yellow',
            3 => 'red',
            default => 'gray'
        };
    }
}
