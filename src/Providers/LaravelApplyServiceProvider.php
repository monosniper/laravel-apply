<?php

namespace KiranoDev\LaravelApply\Providers;

use Illuminate\Support\ServiceProvider;
use KiranoDev\laravelApply\Base\Appliable;
use KiranoDev\LaravelApply\Observers\ApplyObserver;

class LaravelApplyServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'apply');

        $this->publishes([
            __DIR__.'/../config/apply.php' => config_path('apply.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../config/apply.php', 'apply'
        );

        if ( ! defined('CURL_SSLVERSION_TLSv1_2')) { define('CURL_SSLVERSION_TLSv1_2', 6); }

        Appliable::observe(ApplyObserver::class);
    }
}