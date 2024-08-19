<?php

namespace Entryshop\Admin\Crud\Traits;

use Closure;
use Entryshop\Admin\Components\Tabs;

trait HasTabs
{
    public function tabs($callback = null)
    {
        $tabs = Tabs::make();
        if ($callback instanceof Closure) {
            $callback($tabs);
        }
        $this->child($tabs);
        return $tabs;
    }
}
