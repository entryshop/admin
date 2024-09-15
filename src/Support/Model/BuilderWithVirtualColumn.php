<?php

namespace Entryshop\Admin\Support\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BuilderWithVirtualColumn extends Builder
{
    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        $column = $this->getColumnForQuery($column);
        return parent::where($column, $operator, $value, $boolean);
    }

    public function whereIn($column, $values, $boolean = 'and', $not = false)
    {
        $column = $this->getColumnForQuery($column);
        return parent::whereIn($column, $values, $boolean, $not);
    }

    public function orderBy($column, $direction = 'asc')
    {
        $column = $this->getColumnForQuery($column);
        return parent::orderBy($column, $direction);
    }

    protected function getColumnForQuery($column)
    {
        if (is_string($column) && !Str::contains($column, ' ') && !Str::contains($column, '.')) {
            $column = $this->model->getColumnForQuery($column);
        }
        return $column;
    }
}
