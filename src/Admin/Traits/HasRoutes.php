<?php

namespace Entryshop\Admin\Admin\Traits;

use Illuminate\Support\Facades\Route;

/**
 * @method string|self loginUrl($value = null)
 * @method string|self logoutUrl($value = null)
 */
trait HasRoutes
{

    public function auth()
    {
        return auth(config('admin.auth.guard'));
    }

    public function url($path, $params = [])
    {
        if (str_contains($path, '://')) {
            return $path;
        }

        $path = ltrim($path, '/');

        return url(config('admin.route.prefix') . '/' . $path, $params);
    }

    public function path($path, $params = [])
    {
        if (str_contains($path, '://')) {
            return $path;
        }

        $path = ltrim($path, '/');

        $path = '/' . config('admin.route.prefix') . '/' . $path;

        if (!empty($params)) {
            if (str_contains($path, '?')) {
                $path .= '&' . http_build_query($params);
            } else {
                $path .= '?' . http_build_query($params);
            }
        }

        return $path;
    }

    public function registerAuthRoutes()
    {
        admin()->loginUrl(admin()->url('login'));
        admin()->set('homeUrl', admin()->url('/'));
        admin()->logoutUrl(admin()->url('logout'));

        $this->routeGroup(__DIR__ . '/../../../routes/auth.php');
        return $this;
    }

    public function routeGroup($value)
    {
        Route::group([
            'prefix'     => config('admin.route.prefix'),
            'middleware' => config('admin.route.middleware'),
        ], $value);
        return $this;
    }
}
