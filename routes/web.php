<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\TaskManager;
use App\Livewire\IdeaManager;
use App\Livewire\IdeaKanban;
use App\Livewire\DailyLogs;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/tasks', TaskManager::class)->name('tasks');
Route::get('/ideas', IdeaManager::class)->name('ideas');
Route::get('/ideas/{idea}/kanban', IdeaKanban::class)->name('ideas.kanban');
Route::get('/logs', DailyLogs::class)->name('logs');

