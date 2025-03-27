<?php

namespace KiranoDev\LaravelApply\Providers;

use Illuminate\Support\ServiceProvider;

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
    }
}