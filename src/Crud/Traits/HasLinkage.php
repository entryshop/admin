<?php

namespace Entryshop\Admin\Crud\Traits;

trait HasLinkage
{
    protected $_linkages = [];

    public function when($value, $rules = [])
    {
        $this->_linkages[$value] = $rules;
        return $this;
    }

    public function linkages()
    {
        return $this->_linkages;
    }
}
