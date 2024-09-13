<?php

namespace Entryshop\Admin\Crud;

/**
 * @method string|static icon($value = null)
 * @method string|static href($value = null)
 * @method string|static confirm($value = null)
 * @method string|static action($value = null)
 * @method string|static method($value = null)
 * @method string|static color($value = null)
 * @method string|static size($value = null)
 */
class CrudButton extends CrudCell
{
    protected $view_namespace = 'admin::crud.buttons.';
    protected $default_type = 'button';

    /**
     * 上方按钮
     *
     * @param  string  $type  button type, can be top_create, inline_delete, and ...
     */
    public function top($type = null)
    {
        return $this->setPositionAndType(CrudPanel::BUTTON_POSITION_TOP, $type);
    }

    public function inline($type = null)
    {
        if (empty($type)) {
            $this->set('size', 'xs');
            $this->set('color', 'ghost-primary');
        }
        return $this->setPositionAndType(CrudPanel::BUTTON_POSITION_INLINE, $type);
    }

    public function bulk($type = null)
    {
        $this->attr('data-bulk', 'crud_' . $this->crud()->name());
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

    public function dialogForm($form, $context = [])
    {
        return $this->set('iframe', route('admin.form.render', array_merge(['form' => $form], $context)));
    }
}
