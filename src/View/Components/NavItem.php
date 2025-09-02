<?php

namespace AreiaLab\LaravelSeoSolution\View\Components;

use Illuminate\View\Component;

class NavItem extends Component
{

    public function __construct()
    {
        // 
    }

    public function render()
    {
        return view('seo-solution::components.nav-item');
    }
}
