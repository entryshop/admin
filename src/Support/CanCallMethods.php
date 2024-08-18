<?php


namespace Entryshop\Admin\Support;

use Illuminate\Support\Str;

trait CanCallMethods
{
    protected function __callMethods($startWith, ...$args)
    {
        $self = static::class;

        $methods = array_filter(get_class_methods($self), function ($method) use ($startWith) {
            return Str::startsWith($method, $startWith);
        });

        foreach ($methods as $method) {
            $this->$method(...$args);
        }
    }
}
