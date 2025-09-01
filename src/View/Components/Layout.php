<?php

namespace AreiaLab\LaravelSeoSolution\View\Components;

use Illuminate\View\Component;
use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

class Layout extends Component
{
    public $totalCount;
    public $globalCount;
    public $pageCount;
    public $modelCount;

    public function __construct()
    {
        // Automatically fetch counts from the database
        $this->totalCount = SeoMeta::count();
        $this->globalCount = SeoMeta::where('type', 'global')->count();
        $this->pageCount   = SeoMeta::where('type', 'page')->count();
        $this->modelCount  = SeoMeta::where('type', 'model')->count();
    }

    public function render()
    {
        return view('seo-solution::layouts.app', [
            'totalCount' => $this->totalCount,
            'globalCount' => $this->globalCount,
            'pageCount' => $this->pageCount,
            'modelCount' => $this->modelCount,
        ]);
    }
}
