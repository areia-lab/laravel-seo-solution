<?php

namespace AreiaLab\LaravelSeoSolution\View\Components;

use Illuminate\View\Component;

class SeoTable extends Component
{
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function render()
    {
        return view('areia.seo.components.seo-table');
    }
}
