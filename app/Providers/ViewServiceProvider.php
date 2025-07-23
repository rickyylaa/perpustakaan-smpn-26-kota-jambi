<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('active', function ($expression) {
            if (strpos($expression, '/') !== false) {
                return "<?php echo request()->is($expression) ? 'active' : ''; ?>";
            }
            return "<?php echo \Route::is($expression) ? 'active' : ''; ?>";
        });

        Blade::directive('open', function ($expression) {
            if (strpos($expression, '/') !== false) {
                return "<?php echo request()->is($expression) ? 'menu-open' : ''; ?>";
            }
            return "<?php echo \Route::is($expression) ? 'menu-open' : ''; ?>";
        });
    }
}
