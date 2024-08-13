<?php

use Entryshop\Admin\Admin\AdminPanel;
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

if (!function_exists('render')) {
    function render($value, ...$args)
    {
        if (is_string($value)) {
            return $value;
        }

        if (is_array($value)) {
            $result = '';
            foreach ($value as $item) {
                $result .= render($$item, ...$args);
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

if (!function_exists('evaluate')) {
    function evaluate($value, ...$context)
    {
        if ($value instanceof Closure) {
            return call_user_func($value, ...$context);
        } else {
            return $value;
        }
    }
}
