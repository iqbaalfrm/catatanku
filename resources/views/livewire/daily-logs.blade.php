<div class="space-y-8">
    <!-- Header -->
    <div>
        <h2 class="text-4xl font-bold text-white mb-2">📝 Catatan Harian</h2>
        <p class="text-slate-400">Perjalanan Anda melalui tugas yang selesai dan pencapaian</p>
    </div>

    @if(empty($logs))
        <div class="text-center py-12">
            <p class="text-slate-400 text-lg">Belum ada tugas yang selesai. Mulai selesaikan tugas untuk membangun log Anda!</p>
        </div>
    @else
        <div class="space-y-8">
            @foreach($logs as $date => $items)
                <div class="border-l-4 border-blue-500 pl-6 pb-8">
                    <!-- Date Header -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-white">
                            {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                        </h3>
                        <p class="text-slate-400">
                            {{ count($items['tasks']) + count($items['ideaTasks']) }} item selesai
                        </p>
                    </div>

                    <!-- Completed Tasks -->
                    @if($items['tasks']->count() > 0)
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-green-300 mb-3 flex items-center gap-2">
                                <span>✅</span> Tugas ({{ $items['tasks']->count() }})
                            </h4>
                            <div class="space-y-3">
                                @foreach($items['tasks'] as $task)
                                    <div class="bg-slate-800 rounded-lg p-4 border border-green-700 border-opacity-30">
                                        <div class="flex items-start gap-3">
                            <span class="text-2xl">✓</span>
                            <div class="flex-1">
                                <h5 class="font-semibold text-white line-through">{{ $task->title }}</h5>
                                @if($task->description)
                                    <p class="text-slate-400 text-sm mt-1">{{ $task->description }}</p>
                                @endif
                                <div class="flex gap-2 mt-2 text-xs">
                                    <span class="px-2 py-1 bg-slate-700 rounded text-slate-300">
                                        Prioritas: {{ $task->getPriorityLabel() }}
                                    </span>
                                    @if($task->due_date)
                                        <span class="px-2 py-1 bg-slate-700 rounded text-slate-300">
                                            📅 Jatuh Tempo: {{ $task->due_date->translatedFormat('d M Y') }}
                                        </span>
                                    @endif
                                    <span class="px-2 py-1 bg-green-900 rounded text-green-300">
                                        Selesai pada {{ $task->completed_at->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Completed Idea Tasks -->
                    @if($items['ideaTasks']->count() > 0)
                        <div>
                            <h4 class="text-lg font-semibold text-purple-300 mb-3 flex items-center gap-2">
                                <span>💡</span> Tugas Ide ({{ $items['ideaTasks']->count() }})
                            </h4>
                            <div class="space-y-3">
                                @foreach($items['ideaTasks'] as $ideaTask)
                                    <div class="bg-slate-800 rounded-lg p-4 border border-purple-700 border-opacity-30">
                                        <div class="flex items-start gap-3">
                            <span class="text-2xl">✓</span>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <h5 class="font-semibold text-white line-through">{{ $ideaTask->title }}</h5>
                                    <span class="text-xs px-2 py-1 bg-purple-900 rounded text-purple-300">
                                        Dari: <span class="font-bold">{{ $ideaTask->idea->title }}</span>
                                    </span>
                                </div>
                                @if($ideaTask->description)
                                    <p class="text-slate-400 text-sm mt-1">{{ $ideaTask->description }}</p>
                                @endif
                                <div class="flex gap-2 mt-2 text-xs">
                                    <span class="px-2 py-1 bg-purple-900 rounded text-purple-300">
                                        Status: {{ $ideaTask->getStatusLabel() }}
                                    </span>
                                    <span class="px-2 py-1 bg-purple-900 rounded text-purple-300">
                                        Selesai pada {{ $ideaTask->completed_at->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
