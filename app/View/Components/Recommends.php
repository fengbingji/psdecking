<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class Recommends extends Component
{
    public $format;

    public $limit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($format = 1, $limit = 4)
    {
        $this->format = $format;
        $this->limit = $limit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $recommends = Product::query()
            ->where('is_publish', 1)
            ->where('marketing_prop', 1)
            ->limit($this->limit)
            ->orderByDesc('id')
            ->get();

        return view('components.recommends', compact('recommends'));
    }
}
