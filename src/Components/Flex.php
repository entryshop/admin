<?php

namespace Entryshop\Admin\Components;

class Flex extends Container
{
    protected $_classes = ['d-flex'];

    public function gap($value)
    {
        return $this->class('gap-' . $value);
    }

    public function column()
    {
        return $this->class('flex-column');
    }

    public function alignItems($value)
    {
        return $this->class('align-items-' . $value);
    }

    public function justifyContent($value)
    {
        return $this->class('justify-content-' . $value);
    }
}
