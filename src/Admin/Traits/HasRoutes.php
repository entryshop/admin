<?php

namespace Entryshop\Admin\Admin\Traits;

use Entryshop\Admin\Admin\AdminPanel;
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
        admin()->loginUrl(admin()->url('login'));
        admin()->set('homeUrl', admin()->url('/'));
        admin()->logoutUrl(admin()->url('logout'));
        Route::group(['prefix' => config('admin.route.prefix'), 'middleware' => ['web']], __DIR__ . '/../../../routes/auth.php');
        add_hook_action(AdminPanel::HOOK_ACTION_ADMIN_MENU, function () {
            admin()->menu('logout')
                ->user()
                ->label('退出登录')
                ->order(100)
                ->url(admin()->logoutUrl())
                ->icon('mdi mdi-logout');
        });
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
            'middleware' => ['web', 'auth:' . config('admin.auth.guard')],
        ], $params);
        Route::group($params, $value);
        return $this;
    }
}
