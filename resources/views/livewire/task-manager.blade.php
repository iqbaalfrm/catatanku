<div class="space-y-8">
    <!-- Header -->
    <div>
        <h2 class="text-4xl font-bold text-white mb-2">✅ Manajemen Tugas</h2>
        <p class="text-slate-400">Atur dan lacak tugas harian Anda</p>
    </div>

    <!-- Add Task Form -->
    <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
        <h3 class="text-lg font-semibold text-white mb-4">Tambah Tugas Baru</h3>
        
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

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Tanggal Jatuh Tempo</label>
                    <input 
                        type="date" 
                        wire:model="newTaskDueDate"
                        class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:outline-none"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Prioritas</label>
                    <select 
                        wire:model="newTaskPriority"
                        class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:outline-none"
                    >
                        <option value="1">🟢 Rendah</option>
                        <option value="2">🟡 Sedang</option>
                        <option value="3">🔴 Tinggi</option>
                    </select>
                </div>
            </div>

            <button 
                type="submit"
                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition"
            >
                + Tambah Tugas
            </button>
        </form>
    </div>

    <!-- Filters & Sorting -->
    <div class="flex gap-4">
        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Filter</label>
            <select 
                wire:model.live="filterStatus"
                class="px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:outline-none"
            >
                <option value="all">Semua Tugas</option>
                <option value="pending">Menunggu</option>
                <option value="completed">Selesai</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Urutkan Berdasarkan</label>
            <select 
                wire:model.live="sortBy"
                class="px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white focus:border-blue-500 focus:outline-none"
            >
                <option value="created_at">Terbaru Pertama</option>
                <option value="priority">Prioritas</option>
                <option value="due_date">Tanggal Jatuh Tempo</option>
            </select>
        </div>
    </div>

    <!-- Tasks List -->
    <div class="space-y-4">
        @forelse($tasks as $task)
            <div class="bg-slate-800 rounded-lg p-4 border border-slate-700 hover:border-slate-600 transition">
                <div class="flex items-start gap-4">
                    <input 
                        type="checkbox" 
                        {{ $task->status === 'completed' ? 'checked' : '' }}
                        wire:click="toggleTaskStatus({{ $task->id }})"
                        class="w-5 h-5 mt-1 cursor-pointer rounded border-slate-600 bg-slate-700 text-blue-600 focus:ring-blue-500"
                    />
                    
                    <div class="flex-1">
                        <h4 class="font-semibold text-white {{ $task->status === 'completed' ? 'line-through text-slate-500' : '' }}">
                            {{ $task->title }}
                        </h4>
                        
                        @if($task->description)
                            <p class="text-slate-400 text-sm mt-1">{{ $task->description }}</p>
                        @endif

                        <div class="flex gap-3 mt-3 flex-wrap text-xs">
                            <span class="px-2 py-1 bg-slate-700 rounded text-slate-300">
                                Prioritas: <span class="font-bold">{{ $task->getPriorityLabel() }}</span>
                            </span>
                            
                            @if($task->due_date)
                                <span class="px-2 py-1 bg-slate-700 rounded text-slate-300">
                                    📅 {{ $task->due_date->format('d M, Y') }}
                                </span>
                            @endif

                            @if($task->status === 'completed' && $task->completed_at)
                                <span class="px-2 py-1 bg-green-900 rounded text-green-300">
                                    ✓ Selesai {{ $task->completed_at->diffForHumans() }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <button 
                        wire:click="deleteTask({{ $task->id }})"
                        class="px-3 py-1 bg-red-900 hover:bg-red-800 text-red-200 rounded text-sm transition"
                    >
                        🗑️
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-slate-400 text-lg">Belum ada tugas. Buat tugas pertama Anda di atas!</p>
            </div>
        @endforelse
    </div>
</div>
