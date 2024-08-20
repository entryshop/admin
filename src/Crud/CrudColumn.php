<?php

namespace Entryshop\Admin\Crud;

use Entryshop\Admin\Crud\Traits\CanGuessLabel;

/**
 * @method string|static style($value = null)
 * @method string|static yes_text($value = null) Yes content for bool column
 * @method string|static no_text($value = null) No content for bool column
 * @method string|static yes_color($value = null) Yes color for bool column
 * @method string|static no_color($value = null) No color for bool column
 */
class CrudColumn extends CrudCell
{
    use CanGuessLabel;

    protected $view_namespace = 'admin::crud.columns.';
    protected $default_type = 'text';

    public function buildColumnValue(...$args)
    {
        if (!empty($args[0]['entity'])) {
            $value = data_get($args[0]['entity'], $this->name());
            $this->set('value', $value);
        }
    }
}
