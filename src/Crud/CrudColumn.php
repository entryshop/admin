<?php

namespace Entryshop\Admin\Crud;

use Entryshop\Admin\Crud\Traits\CanGuessLabel;

class CrudColumn extends CrudCell
{
    use CanGuessLabel;

    protected $view_namespace = 'admin::crud.columns.';
    protected $default_type = 'text';

    public function render(...$args)
    {
        if (!empty($args[0]['row'])) {
            $row = $args[0]['row'];
            $this->builder->set('value', data_get($row, $this->builder->get('name')));
        }

        return parent::render(...$args);
    }
}
