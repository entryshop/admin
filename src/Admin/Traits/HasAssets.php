<?php

namespace Entryshop\Admin\Admin\Traits;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

/**
 * @method string|static favicon($value = null)
 * @method string|static title($value = null)
 * @method string|static csp($value = null)
 */
trait HasAssets
{
    protected $uploadCallback;
    protected $uploadUrl = '/admin/upload';

    protected $default_theme_var = [
        'data-layout'       => "vertical", // horizontal
        'data-topbar'       => "light",
        'data-sidebar-size' => 'lg',
        'data-sidebar'      => "dark",
        'data-theme'        => "default",
        'data-theme-colors' => "default",
    ];

    public function bootHasAssets()
    {
        $this->bootstrapFive();
        $this->loadAssets();
    }

    public function asset($path, $secure = null)
    {
        return url('/vendor/admin/' . $path, $secure);
    }

    public function loadAssets()
    {
        $this->css([
            $this->asset('css/bootstrap.min.css'),
            $this->asset('css/icons.min.css'),
            $this->asset('css/app.min.css'),
            $this->asset('css/custom.min.css'),
            $this->asset('libs/sweetalert2/sweetalert2.min.css'),
        ]);

        $this->js([
            $this->asset('js/layout.js'),
            $this->asset('libs/bootstrap/js/bootstrap.bundle.min.js'),
            $this->asset('libs/simplebar/simplebar.min.js'),
            $this->asset('libs/jquery/jquery.js'),
            $this->asset('libs/toastify-js/src/toastify.js'),
            $this->asset('libs/choices.js/public/assets/scripts/choices.min.js'),
            $this->asset('libs/sweetalert2/sweetalert2.min.js'),
        ]);

        return $this;
    }

    public function theme(...$args)
    {
        if (count($args) === 2) {
            $value = [$args[0] => $args[1]];
        } else {
            $value = $args[0] ?? null;
        }

        if (empty($args[0])) {
            return array_merge($this->default_theme_var, $this->get('theme', []));
        }

        return $this->push('theme', $value);
    }

    public function css($value = null)
    {
        return $this->getOrPush('css', $value);
    }

    public function js($value = null)
    {
        return $this->getOrPush('js', $value);
    }

    public function scripts($value = null)
    {
        return $this->getOrPush('scripts', $value);
    }

    public function styles($value = null)
    {
        return $this->getOrPush('styles', $value);
    }

    public function cssVar(...$args)
    {
        if (count($args) === 2) {
            $value = [$args[0] => $args[1]];
        } else {
            $value = $args[0] ?? null;
        }
        return $this->getOrPush('cssVar', $value);
    }

    public function menuWidth($value)
    {
        return $this->cssVar('--vz-vertical-menu-width', $value);
    }

    public function primaryColor($value)
    {
        $this->cssVar('--vz-primary', $value);
        $this->cssVar('--vz-primary-text-emphasis', $value . ' !important');
        return $this;
    }

    public function bootstrapFive()
    {
        Paginator::useBootstrapFive();
        return $this;
    }

    public function uploadUsing($callback)
    {
        $this->uploadCallback = $callback;
        return $this;
    }

    public function upload($file)
    {
        if (empty($this->uploadCallback)) {
            return Storage::url($file->store('uploads'));
        }

        $callback = $this->uploadCallback;
        return $callback($file);
    }

    public function uploadUrl($url)
    {
        $this->uploadUrl = $url;
        return $this;
    }

    public function getUploadUrl()
    {
        return evaluate($this->uploadUrl, $this);
    }
}
