<?php

use Entryshop\Admin\Admin\AdminPanel;
use Entryshop\Admin\Components\Container;
use Entryshop\Admin\Crud\CrudField;
use Entryshop\Admin\Crud\CrudPanel;
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

if (!function_exists('render')) {
    function render($value, ...$args)
    {
        if (empty($value)) {
            return '';
        }

        if (is_string($value)) {
            return $value;
        }

        if (is_array($value)) {
            $result = '';
            foreach ($value as $item) {
                $result .= render($item, ...$args);
            }

            return $result;
        }

        if ($value instanceof Closure) {
            $value = evaluate($value, ...$args);
            return render($value, ...$args);
        }

        if ($value instanceof Renderable) {
            return $value->render(...$args);
        }

        if (method_exists($value, 'render')) {
            return $value->render();
        }

        return (string)$value;
    }
}
