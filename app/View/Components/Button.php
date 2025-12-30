<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $variant = 'primary', // primary, secondary, danger, success
        public bool $fullWidth = false,
        public ?string $type = 'button',
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.button');
    }

    public function getClasses(): string
    {
        $baseClasses = 'px-4 py-2 rounded-lg font-medium transition';
        $widthClass = $this->fullWidth ? 'w-full' : '';
        
        $variantClasses = match($this->variant) {
            'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
            'secondary' => 'bg-slate-700 hover:bg-slate-600 text-white',
            'danger' => 'bg-red-600 hover:bg-red-700 text-white',
            'success' => 'bg-green-600 hover:bg-green-700 text-white',
            default => 'bg-blue-600 hover:bg-blue-700 text-white'
        };

        return "$baseClasses $variantClasses $widthClass";
    }
}
