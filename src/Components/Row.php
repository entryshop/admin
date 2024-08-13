<?php

namespace Entryshop\Admin\Components;

class Row extends Container
{
    protected $_classes = ['row'];

    public function gx($value)
    {
        return $this->class('gx-' . $value);
    }
}
