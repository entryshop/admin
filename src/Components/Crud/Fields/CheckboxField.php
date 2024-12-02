<?php

namespace Entryshop\Admin\Components\Crud\Fields;

use Entryshop\Admin\Components\Crud\CrudField;

class CheckboxField extends CrudField
{
    protected $default_type = 'checkbox';

    public function inline($value = true)
    {
        return $this->set('inline', $value);
    }
}
