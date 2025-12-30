<div class="space-y-8">
    <!-- Header -->
    <div>
        <h2 class="text-4xl font-bold text-white mb-2">💡 Lab Ide</h2>
        <p class="text-slate-400">Kelola dan atur ide kreatif Anda dengan papan Kanban</p>
    </div>

    <!-- Add Idea Form -->
    <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
        <h3 class="text-lg font-semibold text-white mb-4">Buat Ide Baru</h3>
        
        <form wire:submit.prevent="addIdea" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Judul Ide *</label>
                <input 
                    type="text" 
                    wire:model="newIdeaTitle" 
                    placeholder="Apa ide brilian Anda?"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:border-purple-500 focus:outline-none"
                />
                @error('newIdeaTitle') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Deskripsi *</label>
                <textarea 
                    wire:model="newIdeaDescription" 
                    placeholder="Jelaskan ide Anda secara detail..."
                    rows="4"
                    class="w-full px-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:border-purple-500 focus:outline-none"
                ></textarea>
                @error('newIdeaDescription') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <button 
                type="submit"
                class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition"
            >
                + Buat Ide
            </button>
        </form>
    </div>

    <!-- Ideas Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($ideas as $idea)
            <div class="bg-slate-800 rounded-lg p-6 border border-slate-700 hover:border-purple-500 transition group">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-semibold text-white group-hover:text-purple-300 transition">
                        {{ $idea->title }}
                    </h3>
                    <button 
                        wire:click="deleteIdea({{ $idea->id }})"
                        class="text-slate-400 hover:text-red-400 transition"
                    >
                        ✕
                    </button>
                </div>

                <p class="text-slate-400 text-sm mb-4 line-clamp-2">{{ $idea->description }}</p>

                <!-- Task Counts -->
                <div class="grid grid-cols-3 gap-2 mb-4 text-center text-xs">
                    <div class="bg-slate-700 rounded p-2">
                        <p class="text-slate-300 font-bold">{{ $idea->getTodoCount() }}</p>
                        <p class="text-slate-500">Akan Dikerjakan</p>
                    </div>
                    <div class="bg-slate-700 rounded p-2">
                        <p class="text-slate-300 font-bold">{{ $idea->getInProgressCount() }}</p>
                        <p class="text-slate-500">Sedang Dikerjakan</p>
                    </div>
                    <div class="bg-slate-700 rounded p-2">
                        <p class="text-slate-300 font-bold">{{ $idea->getDoneCount() }}</p>
                        <p class="text-slate-500">Selesai</p>
                    </div>
                </div>

                <!-- Open Kanban Button -->
                <a 
                    href="/ideas/{{ $idea->id }}/kanban"
                    class="block w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition text-center"
                >
                    📊 Buka Kanban
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-slate-400 text-lg">Belum ada ide. Buat ide pertama Anda di atas!</p>
            </div>
        @endforelse
    </div>
</div>
