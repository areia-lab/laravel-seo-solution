<?php

namespace AreiaLab\LaravelSeoSolution;

use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

class SeoManager
{
    protected ?SeoMeta $meta = null;

    /**
     * Set SEO meta for a given Eloquent model.
     *
     * @param mixed $model
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
     * Set SEO meta for a page.
     *
     * Tries the route name first, then falls back to the URL path if no meta is found.
     *
     * @param string|null $page
     * @return static
     */
    public function forPage(?string $page): static
    {
        if (!$page) {
            return $this;
        }

        $this->meta = $this->findPageMeta($page)
            ?? $this->findPageMeta(request()->path());

        return $this;
    }

    /**
     * Get global SEO meta.
     *
     * @return static
     */
    public function global(): static
    {
        $this->meta = SeoMeta::query()->where('type', 'global')->first();
        return $this;
    }

    /**
     * Render the SEO meta view.
     *
     * Falls back to global meta if no page/meta found.
     *
     * @return string
     */
    public function render(): string
    {
        $meta = $this->meta ?? SeoMeta::query()->where('type', 'global')->first();

        return $meta ? view('seo-solution::components.meta', ['meta' => $meta])->render() : '';
    }

    /**
     * Helper to find page meta by key.
     *
     * @param string $page
     * @return SeoMeta|null
     */
    protected function findPageMeta(string $page): ?SeoMeta
    {
        return SeoMeta::query()
            ->where('type', 'page')
            ->where('page', $page)
            ->first();
    }
}
