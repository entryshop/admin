<?php

namespace Entryshop\Admin\Crud;

/**
 * @method string|self icon($value = null)
 */
class CrudButton extends CrudCell
{
    protected $view_namespace = 'admin::crud.buttons.';
    protected $default_type = 'button';

    public function action($value)
    {
        return $this->attr('data-action', $value);
    }

    public function color($value)
    {
        return $this->class('btn')->class('btn-' . $value);
    }

    public function confirm($title, $text = null)
    {
        return $this->attr('data-confirm', $title)->attr('data-confirm-text', $text);
    }

    public function top($type = null)
    {
        return $this->setPositionAndType(CrudPanel::BUTTON_POSITION_TOP, $type);
    }

    public function inline($type = null)
    {
        return $this->setPositionAndType(CrudPanel::BUTTON_POSITION_INLINE, $type);
    }

    public function bulk($type = null)
    {
        return $this->setPositionAndType(CrudPanel::BUTTON_POSITION_BULK, $type);
    }

    public function setPositionAndType($position, $type = null)
    {
        $this->set('position', $position);
        if ($type) {
            $this->set('type', $type);
        }
        return $this;
    }

}
