<?php

namespace Entryshop\Admin\Crud\Traits;

use Entryshop\Admin\Crud\CrudButton;

trait HasButtons
{
    const BUTTON_POSITION_TOP    = 'top';
    const BUTTON_POSITION_INLINE = 'inline';
    const BUTTON_POSITION_BULK   = 'bulk';

    protected $_buttons = [];

    public function button(...$args)
    {
        $cell = CrudButton::make(...$args);
        $cell->crud($this);
        $this->_buttons[$cell->name()] = $cell;
        return $cell;
    }

    public function buttons($position = null)
    {
        if (empty($position)) {
            return $this->_buttons;
        }

        return array_filter($this->_buttons, function ($cell) use ($position) {
            return $cell->get('position') === $position;
        });
    }
}
