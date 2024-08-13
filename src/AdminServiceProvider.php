<?php

namespace Entryshop\Admin;

use Entryshop\Admin\Admin\AdminPanel;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->scoped('admin_panel', function () {
            return AdminPanel::make();
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/assets/dist/' => public_path('vendor/admin'),
            ], 'admin-assets');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'admin');
    }
}
