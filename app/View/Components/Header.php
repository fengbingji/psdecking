<?php

namespace App\View\Components;

use App\Models\Navigation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public int $index;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($index = 1)
    {
        $this->index = $index;
    }

    public function render(): View|Closure|string
    {
        $menus = Navigation::with(['translation'])
            ->where('show', 1)
            ->orderBy('order')
            ->get();
        $menus->each(function ($menu) {
            if ($menu->translation) {
                $menu->name = $menu->translation->name;
            }
        });
        return view('components.header', compact('menus'));
    }
}
