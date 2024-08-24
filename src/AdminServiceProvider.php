<?php

namespace Entryshop\Admin;

use Entryshop\Admin\Admin\AdminPanel;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        include_once __DIR__ . '/macros.php';
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'admin');
        config(Arr::dot(config('admin.auth', []), 'auth.'));
        $this->app->scoped('admin_panel', function ($app) {
            return $app->make(AdminPanel::class);
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/dist/' => public_path('vendor/admin'),
            ], 'admin-assets');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'admin');
    }

}
