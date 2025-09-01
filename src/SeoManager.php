<?php

namespace AreiaLab\LaravelSeoSolution;

use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

class SeoManager
{
    protected ?SeoMeta $meta = null;

    /**
     * Undocumented function
     *
     * @param [type] $model
     * @return static
     */
    public function forModel($model): static
    {
        if ($model) {
            $this->meta = SeoMeta::query()
                ->where('seoable_type', get_class($model))
                ->where('seoable_id', $model->id)
                ->first();
        }
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param string|null $page
     * @return static
     */
    public function forPage(?string $page): static
    {
        if ($page) {
            $this->meta = SeoMeta::query()
                ->where('type', 'page')
                ->where('page', $page)
                ->first();
        }
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return static
     */
    public function global(): static
    {
        $this->meta = SeoMeta::query()->where('type', 'global')->first();
        return $this;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function render(): string
    {
        $meta = $this->meta ?? SeoMeta::query()->where('type', 'global')->first();
        if (!$meta) return '';

        return view('seo-solution::components.meta', [
            'meta' => $meta,
        ])->render();
    }
}
