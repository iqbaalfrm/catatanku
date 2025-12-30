<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Productivity Hub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-900 text-slate-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-800 shadow-lg flex flex-col">
            <div class="p-6 border-b border-slate-700">
                <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                    📊 Productivity Hub
                </h1>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="/" 
                   class="block px-4 py-2 rounded-lg transition {{ request()->is('/') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-2">
                        <span>📈</span> Dashboard
                    </span>
                </a>
                
                <a href="/tasks" 
                   class="block px-4 py-2 rounded-lg transition {{ request()->is('tasks') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-2">
                        <span>✅</span> Tasks
                    </span>
                </a>

                <a href="/ideas" 
                   class="block px-4 py-2 rounded-lg transition {{ request()->is('ideas*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-2">
                        <span>💡</span> Ideas
                    </span>
                </a>

                <a href="/logs" 
                   class="block px-4 py-2 rounded-lg transition {{ request()->is('logs') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-700' }}">
                    <span class="flex items-center gap-2">
                        <span>📝</span> Daily Logs
                    </span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-700 text-center text-xs text-slate-400">
                <p>v1.0</p>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
