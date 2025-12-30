<div class="bg-slate-800 rounded-lg p-6 border border-slate-700 hover:border-slate-600 transition">
    @if($title)
        <h3 class="text-lg font-semibold text-white mb-2">{{ $title }}</h3>
    @endif
    
    @if($description)
        <p class="text-slate-400 text-sm mb-4">{{ $description }}</p>
    @endif

    {{ $slot }}
</div>
