<?php

namespace Entryshop\Admin\Components\Crud\Fields;

use Entryshop\Admin\Components\Crud\CrudField;

/**
 * @method self options($value) Set the options of the select.
 */
class SelectField extends CrudField
{
    protected $default_type = 'select';
}
