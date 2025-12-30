<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Validate;

class TaskManager extends Component
{
    #[Validate('required|string|max:255')]
    public string $newTaskTitle = '';

    #[Validate('nullable|string|max:1000')]
    public string $newTaskDescription = '';

    #[Validate('nullable')]
    public string $newTaskDueDate = '';

    #[Validate('required|numeric|in:1,2,3')]
    public int $newTaskPriority = 1;

    public string $sortBy = 'created_at';
    public string $filterStatus = 'all';

    public function addTask()
    {
        $this->validate();

        Task::create([
            'title' => $this->newTaskTitle,
            'description' => $this->newTaskDescription ?: null,
            'due_date' => $this->newTaskDueDate ?: null,
            'priority' => $this->newTaskPriority,
            'status' => 'pending'
        ]);

        $this->reset(['newTaskTitle', 'newTaskDescription', 'newTaskDueDate']);
        $this->newTaskPriority = 1;
        
        $this->dispatch('task-added');
    }

    public function toggleTaskStatus(Task $task)
    {
        if ($task->status === 'pending') {
            $task->markAsCompleted();
        } else {
            $task->markAsIncomplete();
        }

        $this->dispatch('task-updated');
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->dispatch('task-deleted');
    }

    public function render()
    {
        $query = Task::query();

        // Filter by status
        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        // Sort
        if ($this->sortBy === 'priority') {
            $query->orderByDesc('priority');
        } elseif ($this->sortBy === 'due_date') {
            $query->orderBy('due_date');
        } else {
            $query->orderByDesc('created_at');
        }

        return view('livewire.task-manager', [
            'tasks' => $query->get()
        ])->layout('layouts.main');
    }
}
