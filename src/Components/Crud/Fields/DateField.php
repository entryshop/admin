<?php

namespace Entryshop\Admin\Components\Crud\Fields;

use Entryshop\Admin\Components\Crud\CrudField;
use Entryshop\Admin\Components\Crud\Traits\HasPrefixAndSuffix;

/**
 * @method self step($value) Set time step
 */
class DateField extends CrudField
{
    use HasPrefixAndSuffix;

    protected $default_type = 'datetime';

    public function hasTime($value = true)
    {
        return $this->set('has_time', $value);
    }

    public function timeOnly($value = true)
    {
        return $this->set('time_only', $value);
    }

    public function hasSeconds($value = true)
    {
        return $this->set('has_seconds', $value);
    }

    public function displayFormat($value)
    {
        return $this->set('display_format', $value);
    }
}
