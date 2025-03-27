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
            __DIR__.'/../config/payment.php' => config_path('payment.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/../config/payment.php', 'payment'
        );

        if ( ! defined('CURL_SSLVERSION_TLSv1_2')) { define('CURL_SSLVERSION_TLSv1_2', 6); }
    }
}