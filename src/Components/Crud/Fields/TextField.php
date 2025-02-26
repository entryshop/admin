<?php

namespace Entryshop\Admin\Components\Crud\Fields;

use Entryshop\Admin\Components\Crud\CrudField;
use Entryshop\Admin\Components\Crud\Traits\HasPrefixAndSuffix;

class TextField extends CrudField
{
    use HasPrefixAndSuffix;

    protected $default_type = 'text';
}
