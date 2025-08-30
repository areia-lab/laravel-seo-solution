<?php

namespace AreiaLab\LaravelSeoSolution;

use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

class SeoManager
{
    protected ?SeoMeta $meta = null;

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

    public function global(): static
    {
        $this->meta = SeoMeta::query()->where('type', 'global')->first();
        return $this;
    }

    public function render(): string
    {
        $meta = $this->meta ?? SeoMeta::query()->where('type', 'global')->first();
        if (!$meta) return '';

        return view('seo-solution::components.meta', [
            'meta' => $meta,
        ])->render();
    }
}
