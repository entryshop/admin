<?php

namespace Entryshop\Admin\Crud\Traits;

use Entryshop\Admin\Crud\CrudFilter;

trait HasFilters
{
    protected $_filters = [];

    public function filter(...$args)
    {
        $cell = CrudFilter::make(...$args);
        $cell->crud($this);
        $this->_filters[$cell->name()] = $cell;
        return $cell;
    }

    public function filters($value = null)
    {
        if (empty($value)) {
            return $this->_filters;
        }

        if (is_array($value)) {
            foreach ($value as $cell) {
                $this->filter($cell);
            }
        }

        return $this;
    }

    public function applyFilters()
    {
        foreach ($this->filters() as $filter) {
            $name  = $filter->name();
            $value = request($name);
            if (empty($value)) {
                continue;
            }
            switch ($filter->operator()) {
                case 'like':
                    $this->entities()->where($name, 'like', '%' . request($name) . '%');
                    break;
                case 'search':
                    $this->entities()->search(request($name));
                    break;
                default:
                    $this->entities()->where($name, request($name));
                    break;
            }
        }
    }
}
