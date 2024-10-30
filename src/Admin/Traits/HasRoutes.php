<?php

namespace Entryshop\Admin\Admin\Traits;

use Illuminate\Support\Facades\Route;

/**
 * @method string|static loginUrl($value = null)
 * @method string|static logoutUrl($value = null)
 * @method string|static homeUrl($value = null)
 */
trait HasRoutes
{
    /**
     * The callback that should be used to check if users can access the admin panel
     *
     * @var callable
     */
    protected static $canAccessUsing;

    public static function canAccessUsing(callable $canAccessUsing)
    {
        static::$canAccessUsing = $canAccessUsing;
    }

    public static function canAccess($user)
    {
        if (!static::$canAccessUsing) {
            return !app()->isProduction();
        }

        return call_user_func(static::$canAccessUsing, $user);
    }

    public function auth()
    {
        return auth(config('admin.default_guard'));
    }

    public function url($path, $params = [])
    {
        if (str_contains($path, '://')) {
            return $path;
        }

        $path = ltrim($path, '/');

        return url()->query(config('admin.route.prefix') . '/' . $path, $params);
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
        Route::group([
            'prefix'     => config('admin.route.prefix'),
            'as'         => config('admin.route.as'),
            'middleware' => config('admin.middleware'),
        ], __DIR__ . '/../../../routes/auth.php');

        admin()->menu('logout')
            ->user()
            ->label(__('admin::auth.logout'))
            ->order(100)
            ->url(admin()->logoutUrl())
            ->icon('mdi mdi-logout');

        admin()->loginUrl(admin()->url('login'));
        admin()->set('homeUrl', admin()->url('/'));
        admin()->logoutUrl(admin()->url('logout'));
        return $this;
    }

    public function registerFormRoutes()
    {
        Route::group([
            'as'         => config('admin.route.as'),
            'prefix'     => config('admin.route.prefix'),
            'middleware' => ['web'],
        ], __DIR__ . '/../../../routes/form.php');
        return $this;
    }

    public function routeGroup(...$args)
    {
        $params = [];
        $value  = null;

        if (count($args) === 1) {
            $value = $args[0];
        }

        if (count($args) >= 2) {
            $value  = $args[1];
            $params = $args[0];
        }

        $params = array_merge_recursive([
            'prefix'     => config('admin.route.prefix'),
            'middleware' => config('admin.auth_middleware'),
        ], $params);
        Route::group($params, $value);
        return $this;
    }
}
