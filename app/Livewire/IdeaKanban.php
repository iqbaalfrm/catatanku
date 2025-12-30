<?php

namespace App\Livewire;

use App\Models\Idea;
use App\Models\IdeaTask;
use Livewire\Component;
use Livewire\Attributes\Validate;

class IdeaKanban extends Component
{
    public Idea $idea;

    #[Validate('required|string|max:255')]
    public string $newTaskTitle = '';

    #[Validate('nullable|string|max:1000')]
    public string $newTaskDescription = '';

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function addTask()
    {
        $this->validate();

        IdeaTask::create([
            'idea_id' => $this->idea->id,
            'title' => $this->newTaskTitle,
            'description' => $this->newTaskDescription ?: null,
            'status' => 'todo',
            'position' => 0
        ]);

        $this->reset(['newTaskTitle', 'newTaskDescription']);
        $this->dispatch('task-added');
    }

    public function updateTaskStatus(IdeaTask $task, string $status)
    {
        $task->update(['status' => $status]);
        
        if ($status === 'done') {
            $task->update(['completed_at' => now()]);
        } else {
            $task->update(['completed_at' => null]);
        }

        $this->dispatch('task-updated');
    }

    public function deleteTask(IdeaTask $task)
    {
        $task->delete();
        $this->dispatch('task-deleted');
    }

    public function reorderTasks($itemIds)
    {
        foreach ($itemIds as $position => $id) {
            IdeaTask::find($id)->update(['position' => $position]);
        }
    }

    public function render()
    {
        return view('livewire.idea-kanban', [
            'todoTasks' => $this->idea->ideaTasks()->where('status', 'todo')->orderBy('position')->get(),
            'inProgressTasks' => $this->idea->ideaTasks()->where('status', 'in_progress')->orderBy('position')->get(),
            'doneTasks' => $this->idea->ideaTasks()->where('status', 'done')->orderBy('position')->get(),
        ])->layout('layouts.main');
    }
}
