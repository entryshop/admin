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

    public function runAction($action)
    {
        $this->data['action'] = $action;

        $this->_before();

        if (method_exists($this, 'action' . $action)) {
            $result = $this->{'action' . $action}();
            $this->_after($action, $result);
            return $result;
        }

        abort(404);
    }
}
