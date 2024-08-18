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

if (!function_exists('renderable')) {
    function renderable(...$args)
    {
        return Renderable::make(...$args);
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

if (!function_exists('to_json')) {
    function to_json($string)
    {
        if ('string' === gettype($string)) {
            return json_decode($string, true);
        }
        return $string;
    }
}

if (!function_exists('interpolate')) {
    function interpolate($template = null, $data = [])
    {
        if (empty($template)) {
            return '';
        }
        $allowedFunctions = ['mb_strtolower', 'time', 'add_one'];
        return preg_replace_callback('/\{([\w\.]+(?:\([\w\.\s,]*\))?)\}/', function ($matches) use ($data, $allowedFunctions) {
            $expression = $matches[1];

            // 匹配函数调用
            if (preg_match('/^(\w+)\(([\w\.\s,]*)\)$/', $expression, $funcMatches)) {
                $function = $funcMatches[1];


                // 检查函数是否在白名单中
                if (!in_array($function, $allowedFunctions)) {
                    return $matches[0]; // 如果函数不在白名单中，保留原始占位符
                }

                if (!empty($funcMatches[2])) {
                    $arguments = array_map('trim', explode(',', $funcMatches[2]));
                    foreach ($arguments as &$arg) {
                        $keys  = explode('.', $arg);
                        $value = $data;

                        foreach ($keys as $key) {
                            if (empty($key)) {
                                continue;
                            }
                            if (is_array($value) && isset($value[$key])) {
                                $value = $value[$key];
                            } elseif (is_object($value) && isset($value->{$key})) {
                                $value = $value->{$key};
                            } else {
                                $value = $key; // 如果找不到对应的值，则保留原始占位符
                            }
                        }
                        $arg = $value;
                    }
                } else {
                    $arguments = [];
                }

                // 执行白名单内的函数
                if (function_exists($function) || function_exists('App\\Helpers\\' . $function)) {
                    return call_user_func_array($function, $arguments);
                }

                echo $function . ' 不存在';

                return $matches[0]; // 如果函数不存在，则保留原始占位符
            }

            // 非函数调用的占位符处理
            $keys  = explode('.', $expression);
            $value = $data;

            foreach ($keys as $key) {
                if (is_array($value) && isset($value[$key])) {
                    $value = $value[$key];
                } elseif (is_object($value) && isset($value->{$key})) {
                    $value = $value->{$key};
                } else {
                    return $matches[0]; // 如果找不到对应的值，则保留原始占位符
                }
            }

            return $value;
        }, $template);
    }
}

