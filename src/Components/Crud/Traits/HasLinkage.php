<?php

namespace Entryshop\Admin\Components\Crud\Traits;

trait HasLinkage
{
    protected $_linkages = [];

    public function when($value, $rules = [])
    {
        if (!is_array($rules)) {
            $rules = [$rules];
        }
        $this->_linkages[$value] = $rules;
        return $this;
    }

    public function linkages()
    {
        return $this->_linkages;
    }
}
