<?php

namespace XMLView\Laravel;

use Illuminate\Support\ServiceProvider;

class XMLViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require_once("XMLView.php");
        $this->commands([CleanCacheCommand::class]);
    }
}
