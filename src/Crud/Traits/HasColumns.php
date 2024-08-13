<?php

namespace Entryshop\Admin\Crud\Traits;

use Entryshop\Admin\Crud\CrudColumn;

/**
 * @method string|self action($value = null)
 * @method string|self method($value = null)
 */
trait HasColumns
{
    protected $_columns = [];

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
}
