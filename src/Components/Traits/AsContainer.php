<?php

namespace Entryshop\Admin\Components\Traits;

trait AsContainer
{
    public function asRow($col_width = 'col-md-6 col-lg-4 col-xl-3')
    {
        return $this->row('g-3', $col_width);
    }

    public function row($extra = '', $default_child_class = '')
    {
        return $this->class('row ' . $extra)->set('default-item-wrapper', 'class="' . $default_child_class . '"');
    }
}
