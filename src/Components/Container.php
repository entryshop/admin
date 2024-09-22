<?php

namespace Entryshop\Admin\Components;

use Entryshop\Admin\Support\Renderable;

class Container extends Renderable
{
    protected $default_view = 'admin::container';

    public function flex()
    {
        $this->default_view = 'admin::flex';
        return $this;
    }

    public function row($default_child_class = 'col')
    {
        return $this->class('row')->set('$default_child_class', $default_child_class);
    }
}
