<?php

namespace AreiaLab\LaravelSeoSolution\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Cache;
use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

class Layout extends Component
{
    public int $totalCount;
    public int $globalCount;
    public int $pageCount;
    public int $modelCount;

    public function __construct()
    {
        if (config('seo.cache', false)) {
            // Cached default (5 minutes)
            $counts = Cache::remember('seo_meta_counts', now()->addMinutes(5), function () {
                return $this->getCountsFromDatabase();
            });
        } else {
            // Direct query without caching
            $counts = $this->getCountsFromDatabase();
        }

        $this->totalCount  = $counts->sum();
        $this->globalCount = $counts['global'] ?? 0;
        $this->pageCount   = $counts['page']   ?? 0;
        $this->modelCount  = $counts['model']  ?? 0;
    }

    /**
     * Fetch counts grouped by type.
     */
    protected function getCountsFromDatabase()
    {
        return SeoMeta::selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type');
    }

    public function render()
    {
        return view('areia.seo.layouts.app', [
            'totalCount'  => $this->totalCount,
            'globalCount' => $this->globalCount,
            'pageCount'   => $this->pageCount,
            'modelCount'  => $this->modelCount,
        ]);
    }
}
