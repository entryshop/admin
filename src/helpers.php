<?php

use Entryshop\Admin\Admin\AdminPanel;
use Entryshop\Admin\Components\Container;
use Entryshop\Admin\Components\Crud\CrudField;
use Entryshop\Admin\Components\Crud\CrudPanel;
use Entryshop\Admin\Support\Renderable;

if (!function_exists('admin')) {
    /**
     * @return AdminPanel
     */
    function admin()
    {
        return app('admin_panel');
    }
}

if (!function_exists('crud')) {
    function crud(...$args)
    {
        return CrudPanel::make(...$args);
    }
}

if (!function_exists('renderable')) {
    function renderable(...$args)
    {
        return Renderable::make(...$args);
    }
}

if (!function_exists('container')) {
    function container(...$args)
    {
        return Container::make(...$args);
    }
}

if (!function_exists('field')) {
    function field(...$args)
    {
        return CrudField::make(...$args);
    }
}
