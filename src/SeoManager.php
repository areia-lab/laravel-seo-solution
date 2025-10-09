<?php

namespace AreiaLab\LaravelSeoSolution;

use AreiaLab\LaravelSeoSolution\Models\SeoMeta;

class SeoManager
{
    protected ?SeoMeta $meta = null;

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
     * Set SEO meta for a page.
     *
     * Tries the given page key first, then falls back to the current URL path if no meta is found.
     *
     * Handles the home page '/' automatically.
     *
     * @param string|null $page
     * @return static
     */
    public function forPage(?string $page): static
    {
        // Determine the page key: use provided or current path
        $pageKey = $page ?? request()->path();

        // Normalize page key
        $normalizedPage = trim($pageKey, '/');

        // Treat home page as empty string
        if ($normalizedPage === '') {
            $normalizedPage = '/';
        }

        // Try exact page key first
        $this->meta = $this->findPageMeta($normalizedPage);

        // Fallback: try current request path if different
        if (!$this->meta) {
            $currentPath = trim(request()->path(), '/');
            if ($currentPath === '') {
                $currentPath = '/';
            }
            $this->meta = $this->findPageMeta($currentPath);
        }

        return $this;
    }

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
     * Render the SEO meta view.
     *
     * Falls back to global meta if no page/meta found.
     *
     * @return string
     */
    public function render(): string
    {
        $meta = $this->meta ?? SeoMeta::query()->where('type', 'global')->first();

        return $meta ? view('areia.seo.components.meta', ['meta' => $meta])->render() : '';
    }

    /**
     * Helper to find page meta by key.
     *
     * Treats '/' as home page.
     *
     * @param string $page
     * @return SeoMeta|null
     */
    protected function findPageMeta(string $page): ?SeoMeta
    {
        // Normalize home page
        $normalized = $page === '/' ? '/' : trim($page, '/');

        return SeoMeta::query()
            ->where('type', 'page')
            ->where('page', $normalized)
            ->first();
    }
}
