<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use App\Models\Idea;
use App\Models\IdeaTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample tasks
        Task::create([
            'title' => 'Complete project documentation',
            'description' => 'Write comprehensive documentation for the productivity hub',
            'status' => 'pending',
            'priority' => 3,
            'due_date' => now()->addDays(5)->toDateString(),
        ]);

        Task::create([
            'title' => 'Review code changes',
            'description' => 'Review pull requests from team members',
            'status' => 'pending',
            'priority' => 2,
            'due_date' => now()->addDays(2)->toDateString(),
        ]);

        Task::create([
            'title' => 'Test database migrations',
            'description' => '',
            'status' => 'completed',
            'priority' => 1,
            'completed_at' => now()->subDays(1),
        ]);

        Task::create([
            'title' => 'Setup authentication',
            'description' => 'Implement user authentication system',
            'status' => 'completed',
            'priority' => 3,
            'completed_at' => now()->subDays(2),
        ]);

        // Create sample ideas
        $idea1 = Idea::create([
            'title' => 'Mobile App for Productivity',
            'description' => 'Create a mobile version of the productivity hub with offline support',
            'status' => 'active',
        ]);

        $idea2 = Idea::create([
            'title' => 'Team Collaboration Features',
            'description' => 'Add features for team members to collaborate on tasks and ideas',
            'status' => 'active',
        ]);

        // Create idea tasks for idea1
        IdeaTask::create([
            'idea_id' => $idea1->id,
            'title' => 'Design mockups',
            'description' => 'Create UI mockups for mobile app',
            'status' => 'todo',
            'position' => 0,
        ]);

        IdeaTask::create([
            'idea_id' => $idea1->id,
            'title' => 'Setup React Native project',
            'description' => '',
            'status' => 'in_progress',
            'position' => 1,
        ]);

        IdeaTask::create([
            'idea_id' => $idea1->id,
            'title' => 'Implement offline sync',
            'description' => 'Implement SQLite sync with backend',
            'status' => 'done',
            'position' => 2,
            'completed_at' => now()->subDays(3),
        ]);

        // Create idea tasks for idea2
        IdeaTask::create([
            'idea_id' => $idea2->id,
            'title' => 'Design user roles',
            'description' => 'Define admin, manager, and user roles',
            'status' => 'done',
            'position' => 0,
            'completed_at' => now()->subDays(1),
        ]);

        IdeaTask::create([
            'idea_id' => $idea2->id,
            'title' => 'Implement real-time notifications',
            'description' => '',
            'status' => 'in_progress',
            'position' => 1,
        ]);

        IdeaTask::create([
            'idea_id' => $idea2->id,
            'title' => 'Add commenting system',
            'description' => 'Allow users to comment on tasks',
            'status' => 'todo',
            'position' => 2,
        ]);
    }
}
