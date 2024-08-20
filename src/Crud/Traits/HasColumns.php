<?php

namespace Entryshop\Admin\Crud\Traits;

use Entryshop\Admin\Crud\CrudColumn;

/**
 * @method string|static action($value = null)
 * @method string|static method($value = null)
 * @method string|static label_class($value = null)
 */
trait HasColumns
{
    protected $_columns = [];

    const CHILD_POSITION_BEFORE_TABLE = 'before_table';
    const CHILD_POSITION_AFTER_TABLE  = 'after_table';

    public function column(...$args)
    {
        $cell = CrudColumn::make(...$args);
        if (isset($this->_columns[$cell->name()])) {
            return $this->_columns[$cell->name()];
        }
        $cell->crud($this);
        $this->_columns[$cell->name()] = $cell;
        return $cell;
    }

    public function columns($value = null)
    {
        if (empty($value)) {
            return $this->_columns;
        }

        if (is_array($value)) {
            foreach ($value as $cell) {
                $this->column($cell);
            }
        }

        return $this;
    }

    public function row_link($value = null)
    {
        return $this->row_attrs('data-method="get" data-action="' . $value . '"');
    }
}
