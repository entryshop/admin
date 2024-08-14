<?php

namespace Entryshop\Admin\Components;

class Flex extends Container
{
    protected $default_view = 'admin::flex';
    protected $_classes = ['d-flex'];

    public function setGap($value)
    {
        $this->class('gap-' . $value);
    }

    public function column()
    {
        $this->set('direction', 'column');
        return $this->class('flex-column');
    }

    public function alignItems($value)
    {
        $this->set('alignItems', $value);
        return $this->class('align-items-' . $value);
    }

    public function justifyContent($value)
    {
        $this->set('justifyContent', $value);
        return $this->class('justify-content-' . $value);
    }
}
