<?php

namespace AreiaLab\LaravelSeoSolution\Observers;

use AreiaLab\LaravelSeoSolution\Models\SeoMeta;
use Illuminate\Support\Facades\Cache;

class SeoMetaObserver
{
    /**
     * Handle the SeoMeta "created" event.
     */
    public function created(SeoMeta $seoMeta): void
    {
        $this->clearCache();
    }

    /**
     * Handle the SeoMeta "updated" event.
     */
    public function updated(SeoMeta $seoMeta): void
    {
        $this->clearCache();
    }

    /**
     * Handle the SeoMeta "deleted" event.
     */
    public function deleted(SeoMeta $seoMeta): void
    {
        $this->clearCache();
    }

    /**
     * Clear cached counts if enabled.
     */
    protected function clearCache(): void
    {
        if (config('seo-solution.cache', false)) {
            Cache::forget('seo_meta_counts');
        }
    }
}
