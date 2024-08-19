<?php

namespace Entryshop\Admin\Components;

class Tab extends Container
{
    protected $default_view = 'admin::components.tabs';
    protected $_classes = [];

    public function tab(...$args)
    {
        if (!empty($args[0]) && $args[0] instanceof \Closure) {
            $tab = renderable();
            $args[0]($tab, $this);
            return $tab;
        }
        $tab = renderable(...$args);
        $this->child($tab);
        return $tab;
    }
}
