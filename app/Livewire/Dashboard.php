<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $activeTasks = Task::where('status', 'pending')->count();
        $completedToday = Task::where('status', 'completed')
            ->whereDate('completed_at', today())
            ->count();
        
        $completionRate = Task::count() > 0 
            ? round((Task::where('status', 'completed')->count() / Task::count()) * 100)
            : 0;

        // Get activity data for last 7 days
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $count = Task::where('status', 'completed')
                ->whereDate('completed_at', $date)
                ->count();
            $last7Days[$date->format('D')] = $count;
        }

        return view('livewire.dashboard', [
            'activeTasks' => $activeTasks,
            'completedToday' => $completedToday,
            'completionRate' => $completionRate,
            'last7Days' => $last7Days,
            'totalTasks' => Task::count(),
            'totalCompleted' => Task::where('status', 'completed')->count(),
        ])->layout('layouts.main');
    }
}
