<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="/ideas" class="text-blue-400 hover:text-blue-300 mb-2 inline-block">← Kembali ke Ide</a>
            <h2 class="text-4xl font-bold text-white mb-2">📊 {{ $idea->title }}</h2>
            <p class="text-slate-400">{{ $idea->description }}</p>
        </div>
    </div>

    <!-- Add Task Form -->
    <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
        <h3 class="text-lg font-semibold text-white mb-4">Tambah Tugas ke Kanban</h3>
        
        <form wire:submit.prevent="addTask" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Judul Tugas *</label>
                <input 
                    type="text" 
                    wire:model="newTaskTitle" 
                    placeholder="Masukkan judul tugas..."
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none"
                />
                @error('newTaskTitle') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi</label>
                <textarea 
                    wire:model="newTaskDescription" 
                    placeholder="Masukkan deskripsi tugas..."
                    rows="3"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:border-blue-500 focus:outline-none"
                ></textarea>
            </div>

            <button 
                type="submit"
                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition"
            >
                + Tambah Tugas
            </button>
        </form>
    </div>

    <!-- Kanban Board -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- To Do Column -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 p-4">
            <h3 class="text-lg font-semibold text-slate-300 mb-4 flex items-center gap-2">
                <span class="w-3 h-3 bg-slate-600 rounded-full"></span>
                Akan Dikerjakan ({{ count($todoTasks) }})
            </h3>
            
            <div class="space-y-3">
                @forelse($todoTasks as $task)
                    <div class="bg-slate-700 rounded-lg p-4 border border-slate-600 hover:border-slate-500 transition group">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-medium text-white flex-1">{{ $task->title }}</h4>
                            <button 
                                wire:click="deleteTask({{ $task->id }})"
                                class="text-slate-400 hover:text-red-400 transition opacity-0 group-hover:opacity-100"
                            >
                                ✕
                            </button>
                        </div>

                        @if($task->description)
                            <p class="text-slate-400 text-sm mb-3">{{ $task->description }}</p>
                        @endif

                        <div class="flex gap-2">
                            <button 
                                wire:click="updateTaskStatus({{ $task->id }}, 'in_progress')"
                                class="flex-1 px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded transition"
                            >
                                → Sedang Dikerjakan
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm py-4 text-center">No tasks</p>
                @endforelse
            </div>
        </div>

        <!-- In Progress Column -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 p-4">
            <h3 class="text-lg font-semibold text-blue-300 mb-4 flex items-center gap-2">
                <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                Sedang Dikerjakan ({{ count($inProgressTasks) }})
            </h3>
            
            <div class="space-y-3">
                @forelse($inProgressTasks as $task)
                    <div class="bg-slate-700 rounded-lg p-4 border border-blue-500 hover:border-blue-400 transition group bg-opacity-20">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-medium text-white flex-1">{{ $task->title }}</h4>
                            <button 
                                wire:click="deleteTask({{ $task->id }})"
                                class="text-slate-400 hover:text-red-400 transition opacity-0 group-hover:opacity-100"
                            >
                                ✕
                            </button>
                        </div>

                        @if($task->description)
                            <p class="text-slate-400 text-sm mb-3">{{ $task->description }}</p>
                        @endif

                        <div class="flex gap-2">
                            <button 
                                wire:click="updateTaskStatus({{ $task->id }}, 'todo')"
                                class="flex-1 px-2 py-1 bg-slate-600 hover:bg-slate-700 text-white text-sm rounded transition"
                            >
                                ← Kembalikan
                            </button>
                            <button 
                                wire:click="updateTaskStatus({{ $task->id }}, 'done')"
                                class="flex-1 px-2 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded transition"
                            >
                                ✓ Selesai
                            </button>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm py-4 text-center">No tasks</p>
                @endforelse
            </div>
        </div>

        <!-- Done Column -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 p-4">
            <h3 class="text-lg font-semibold text-green-300 mb-4 flex items-center gap-2">
                <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                Selesai ({{ count($doneTasks) }})
            </h3>
            
            <div class="space-y-3">
                @forelse($doneTasks as $task)
                    <div class="bg-slate-700 rounded-lg p-4 border border-green-500 hover:border-green-400 transition group bg-opacity-20 opacity-75">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="font-medium text-white flex-1 line-through">{{ $task->title }}</h4>
                            <button 
                                wire:click="deleteTask({{ $task->id }})"
                                class="text-slate-400 hover:text-red-400 transition opacity-0 group-hover:opacity-100"
                            >
                                ✕
                            </button>
                        </div>

                        @if($task->description)
                            <p class="text-slate-400 text-sm mb-3">{{ $task->description }}</p>
                        @endif

                        @if($task->completed_at)
                            <p class="text-green-400 text-xs">
                                ✓ Selesai {{ $task->completed_at->diffForHumans() }}
                            </p>
                        @endif

                        <button 
                            wire:click="updateTaskStatus({{ $task->id }}, 'in_progress')"
                            class="w-full mt-2 px-2 py-1 bg-slate-600 hover:bg-slate-700 text-white text-sm rounded transition"
                        >
                            ↶ Kembalikan
                        </button>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm py-4 text-center">No tasks</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
