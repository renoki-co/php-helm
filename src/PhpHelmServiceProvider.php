<?php

namespace RenokiCo\PhpHelm;

use Illuminate\Support\ServiceProvider;

class PhpHelmServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/helm.php' => config_path('helm.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/helm.php', 'helm'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
