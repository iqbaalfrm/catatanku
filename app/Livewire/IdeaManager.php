<?php

namespace App\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Livewire\Attributes\Validate;

class IdeaManager extends Component
{
    #[Validate('required|string|max:255')]
    public string $newIdeaTitle = '';

    #[Validate('required|string|max:1000')]
    public string $newIdeaDescription = '';

    public function addIdea()
    {
        $this->validate();

        Idea::create([
            'title' => $this->newIdeaTitle,
            'description' => $this->newIdeaDescription,
            'status' => 'active'
        ]);

        $this->reset(['newIdeaTitle', 'newIdeaDescription']);
        $this->dispatch('idea-added');
    }

    public function deleteIdea(Idea $idea)
    {
        $idea->delete();
        $this->dispatch('idea-deleted');
    }

    public function toggleIdeaStatus(Idea $idea)
    {
        $idea->update([
            'status' => $idea->status === 'active' ? 'archived' : 'active'
        ]);
        $this->dispatch('idea-updated');
    }

    public function render()
    {
        return view('livewire.idea-manager', [
            'ideas' => Idea::where('status', 'active')->orderByDesc('created_at')->get()
        ])->layout('layouts.main');
    }
}
