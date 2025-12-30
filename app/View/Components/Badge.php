<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    public function __construct(
        public string $type = 'default', // default, success, warning, danger, info
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.badge');
    }

    public function getClasses(): string
    {
        return match($this->type) {
            'success' => 'bg-green-900 text-green-300',
            'warning' => 'bg-yellow-900 text-yellow-300',
            'danger' => 'bg-red-900 text-red-300',
            'info' => 'bg-blue-900 text-blue-300',
            default => 'bg-slate-700 text-slate-300'
        };
    }
}
