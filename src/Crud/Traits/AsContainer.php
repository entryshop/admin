<?php

namespace Entryshop\Admin\Crud\Traits;

trait AsContainer
{
    public function asRow($col_width = 'col-md-6 col-lg-4 col-xl-3')
    {
        return $this->class('row g-3')->set('default-item-wrapper', 'class="' . $col_width . '"');
    }
}
