<div class="space-y-8">
    <!-- Header -->
    <div>
        <h2 class="text-4xl font-bold text-white mb-2">Dasbor</h2>
        <p class="text-slate-400">Selamat datang di hub produktivitas Anda</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Active Tasks -->
        <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-lg p-6 border border-blue-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-300 text-sm font-medium">Tugas Aktif</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $activeTasks }}</p>
                </div>
                <span class="text-4xl">✅</span>
            </div>
        </div>

        <!-- Completed Today -->
        <div class="bg-gradient-to-br from-green-900 to-green-800 rounded-lg p-6 border border-green-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-300 text-sm font-medium">Selesai Hari Ini</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $completedToday }}</p>
                </div>
                <span class="text-4xl">🎯</span>
            </div>
        </div>

        <!-- Completion Rate -->
        <div class="bg-gradient-to-br from-purple-900 to-purple-800 rounded-lg p-6 border border-purple-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-300 text-sm font-medium">Tingkat Penyelesaian</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $completionRate }}%</p>
                </div>
                <span class="text-4xl">📊</span>
            </div>
        </div>

        <!-- Total Tasks -->
        <div class="bg-gradient-to-br from-orange-900 to-orange-800 rounded-lg p-6 border border-orange-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-300 text-sm font-medium">Total Tugas</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $totalTasks }}</p>
                </div>
                <span class="text-4xl">📋</span>
            </div>
        </div>
    </div>

    <!-- Activity Chart -->
    <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
        <h3 class="text-lg font-semibold text-white mb-4">📈 Aktivitas (7 Hari Terakhir)</h3>
        
        <div class="flex items-end justify-between gap-4 h-48">
            @foreach($last7Days as $day => $count)
                <div class="flex flex-col items-center flex-1">
                    <div class="w-full bg-slate-700 rounded-t-lg flex items-end justify-center" 
                         style="height: {{ max($count * 30, 20) }}px;"
                         title="Count: {{ $count }}">
                        @if($count > 0)
                            <span class="text-white font-bold text-sm pb-2">{{ $count }}</span>
                        @endif
                    </div>
                    <p class="text-slate-400 text-sm mt-2">{{ $day }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
            <h4 class="text-white font-semibold mb-4">Ringkasan Tugas</h4>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Selesai</span>
                    <span class="text-green-400 font-bold">{{ $totalCompleted }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Menunggu</span>
                    <span class="text-blue-400 font-bold">{{ $activeTasks }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Total</span>
                    <span class="text-white font-bold">{{ $totalTasks }}</span>
                </div>
            </div>
        </div>

        <div class="bg-slate-800 rounded-lg p-6 border border-slate-700">
            <h4 class="text-white font-semibold mb-4">Motivasi & Tips</h4>
            <p class="text-slate-300 text-sm">
                @if($completionRate >= 80)
                    🌟 Luar biasa! Anda sedang mencapai tujuan!
                @elseif($completionRate >= 60)
                    💪 Kemajuan bagus! Lanjutkan momentum!
                @elseif($completionRate >= 40)
                    🚀 Anda sedang dalam perjalanan! Terus maju!
                @else
                    🎯 Mulai dari kecil, bermimpi besar!
                @endif
            </p>
        </div>
    </div>
</div>
