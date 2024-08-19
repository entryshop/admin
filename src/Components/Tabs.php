<?php

namespace Entryshop\Admin\Components;

use Closure;

class Tabs extends Container
{
    protected $default_view = 'admin::widgets.tabs';
    protected $_classes = [];

    public function tab(...$args)
    {
        if (!empty($args[0]) && $args[0] instanceof Closure) {
            $tab = renderable();
            $args[0]($tab, $this);
            return $tab;
        }
        $tab = renderable(...$args);
        $this->child($tab);
        return $tab;
    }

    public function buildTabs()
    {
        foreach ($this->children() as $child) {
            if ($child->active()) {
                return;
            }
        }
        $this->children()[0]->active(true);
    }
}
