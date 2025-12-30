<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\IdeaTask;
use Livewire\Component;

class DailyLogs extends Component
{
    public function render()
    {
        // Get all completed tasks grouped by date
        $completedTasks = Task::where('status', 'completed')
            ->whereNotNull('completed_at')
            ->orderByDesc('completed_at')
            ->get()
            ->groupBy(function ($task) {
                return $task->completed_at->format('Y-m-d');
            });

        // Get all completed idea tasks grouped by date
        $completedIdeaTasks = IdeaTask::where('status', 'done')
            ->whereNotNull('completed_at')
            ->orderByDesc('completed_at')
            ->get()
            ->groupBy(function ($task) {
                return $task->completed_at->format('Y-m-d');
            });

        // Combine and sort by date
        $allDates = array_merge(
            array_keys($completedTasks->toArray()),
            array_keys($completedIdeaTasks->toArray())
        );
        $allDates = array_unique($allDates);
        rsort($allDates);

        $logs = [];
        foreach ($allDates as $date) {
            $logs[$date] = [
                'tasks' => $completedTasks->get($date, collect()),
                'ideaTasks' => $completedIdeaTasks->get($date, collect()),
            ];
        }

        return view('livewire.daily-logs', [
            'logs' => $logs
        ])->layout('layouts.main');
    }
}
