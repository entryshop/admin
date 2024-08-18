<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

use Illuminate\Support\Str;

trait CanRunAction
{
    protected function _call($stag, $action, ...$args)
    {
        $action = Str::studly($action);
        foreach (get_class_methods($this) as $method) {
            if (Str::startsWith($method, $stag) && Str::endsWith($method, $action)) {
                $this->{$method}(...$args);
            }
        }
    }

    protected function _before($action = null, ...$args)
    {
        $this->_call('before', $action ?? $this->data['action'], ...$args);
    }

    protected function _after($action = null, ...$args)
    {
        $this->_call('after', $action ?? $this->data['action'], ...$args);
    }
}
