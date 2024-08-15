<?php

namespace Entryshop\Admin\Crud;

use Entryshop\Admin\Crud\Traits\CanGuessLabel;

/**
 * @method string|self style($value = null)
 * @method string|self yes_text($value = null) Yes content for bool column
 * @method string|self no_text($value = null) No content for bool column
 * @method string|self yes_color($value = null) Yes color for bool column
 * @method string|self no_color($value = null) No color for bool column
 */
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
