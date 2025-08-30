<?php

namespace AreiaLab\LaravelSeoSolution;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use AreiaLab\LaravelSeoSolution\View\Components\Layout;

class SeoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/seo-solution.php', 'seo-solution');

        $this->app->singleton('seo', function () {
            return new SeoManager;
        });
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'seo-solution');

        $this->publishes([
            __DIR__ . '/../config/seo-solution.php' => config_path('seo-solution.php'),
        ], 'seo-solution-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/seo-solution'),
        ], 'seo-solution-views');

        $this->publishes([
            __DIR__ . '/Database/migrations' => database_path('migrations'),
        ], 'seo-solution-migrations');

        // Publish seeders
        $this->publishes([
            __DIR__ . '/Database/seeders' => database_path('seeders'),
        ], 'seo-solution-seeders');

        Blade::component(Layout::class, 'seo-layout');

        Blade::directive('seoGlobal', function () {
            return "<?php echo app('seo')->global()->render(); ?>";
        });
        Blade::directive('seoPage', function ($expression) {
            return "<?php echo app('seo')->forPage({$expression})->render(); ?>";
        });
        Blade::directive('seoModel', function ($expression) {
            return "<?php echo app('seo')->forModel({$expression})->render(); ?>";
        });
    }
}
