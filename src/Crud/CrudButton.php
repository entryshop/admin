<?php

namespace Entryshop\Admin\Crud;

/**
 * @method string|self icon($value = null)
 * @method string|self href($value = null)
 * @method string|self confirm($value = null)
 * @method string|self action($value = null)
 * @method string|self method($value = null)
 * @method string|self color($value = null)
 * @method string|self size($value = null)
 */
class CrudButton extends CrudCell
{
    protected $view_namespace = 'admin::crud.buttons.';
    protected $default_type = 'button';

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
