<?php

namespace Ed9\LaravelDateDirective;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelDateDirectiveServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/date-time-directive.php', 'date-time-directive');

        $this->publishes([
            __DIR__ . '/../config/date-time-directive.php' => config_path('date-time-directive.php'),
        ]);
    }

    public function register()
    {
        app()->singleton(Handler::class, function () {
            return new Handler;
        });

        Blade::directive('date', function ($expression) {
            return "<?php echo app(\Ed9\LaravelDateDirective\Handler::class)->date($expression); ?>";
        });

        Blade::directive('time', function ($expression) {
            return "<?php echo app(\Ed9\LaravelDateDirective\Handler::class)->time($expression); ?>";
        });

        Blade::directive('dateTime', function ($expression) {
            return "<?php echo app(\Ed9\LaravelDateDirective\Handler::class)->dateTime($expression); ?>";
        });
    }

}