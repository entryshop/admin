<?php

namespace Entryshop\Admin\Support;

trait HasContext
{
    protected array $_context = [];

    public function setContext($key, $value)
    {
        $this->_context[$key] = $value;
        return $this;
    }

    public function getContext($key, $default = null)
    {
        return $this->_context[$key] ?? $default;
    }
}
