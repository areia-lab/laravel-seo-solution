<?php

namespace AreiaLab\LaravelSeoSolution\Traits;

use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

trait HasSeoMeta
{
    /**
     * Define a polymorphic one-to-one relationship with SeoMeta.
     */
    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /**
     * Check if the model already has SEO metadata.
     */
    public function hasSeoMeta(): bool
    {
        return $this->seoMeta()->exists();
    }

    /**
     * Create or update SEO metadata for this model.
     */
    public function saveSeoMeta(array $data): SeoMeta
    {
        return $this->seoMeta()->updateOrCreate([], $data);
    }
}
