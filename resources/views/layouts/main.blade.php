<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Daily Iqbal' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-900 text-slate-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-800 shadow-lg flex flex-col border-r border-slate-700">
            <div class="p-6 border-b border-slate-700">
                <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    📊 Daily Iqbal
                </h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="/" 
                   class="block px-4 py-3 rounded-lg transition {{ request()->is('/') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-3">
                        <span class="text-lg">📈</span> 
                        <span>Dasbor</span>
                    </span>
                </a>
                
                <a href="/tasks" 
                   class="block px-4 py-3 rounded-lg transition {{ request()->is('tasks') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-3">
                        <span class="text-lg">✅</span>
                        <span>Tugas</span>
                    </span>
                </a>

                <a href="/ideas" 
                   class="block px-4 py-3 rounded-lg transition {{ request()->is('ideas*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-3">
                        <span class="text-lg">💡</span>
                        <span>Ide</span>
                    </span>
                </a>

                <a href="/logs" 
                   class="block px-4 py-3 rounded-lg transition {{ request()->is('logs') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-3">
                        <span class="text-lg">📝</span>
                        <span>Catatan Harian</span>
                    </span>
                </a>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-slate-700 text-center text-xs text-slate-500 space-y-1">
                <p class="font-semibold">Daily Iqbal</p>
                <p>v1.0</p>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto bg-gradient-to-br from-slate-900 to-slate-800">
            <div class="p-8 max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
