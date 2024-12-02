<?php

namespace Entryshop\Admin\Components\Crud\Traits;

use Entryshop\Admin\Components\Crud\Columns\ImageColumn;
use Entryshop\Admin\Components\Crud\Columns\SelectColumn;
use Entryshop\Admin\Components\Crud\Columns\TextColumn;
use Entryshop\Admin\Components\Crud\CrudColumn;

/**
 * @method string|static action($value = null)
 * @method string|static method($value = null)
 * @method string|static label_class($value = null)
 * @method TextColumn text(...$args)
 * @method SelectColumn select(...$args)
 */
trait HasColumns
{
    protected $_columns = [];

    const POSITION_BEFORE_TABLE = 'before_table';
    const POSITION_AFTER_TABLE  = 'after_table';

    protected $columns_map = [
        'text'   => TextColumn::class,
        'select' => SelectColumn::class,
        'image'  => ImageColumn::class,
    ];

    public function column(...$args)
    {
        if (!empty($args[0]) && $args[0] instanceof CrudColumn) {
            $cell = $args[0];
        } else {
            $cell = CrudColumn::make(...$args);
        }
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
