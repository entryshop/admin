<?php

namespace Entryshop\Admin\Crud;

use Entryshop\Admin\Crud\Traits\CanGuessLabel;

/**
 * @method string|self operator($value = null)
 * @method string|self options($value = null)
 * @method string|self placeholder($value = null)
 * @method string|self multiple($value = null)
 */
class CrudFilter extends CrudCell
{
    use CanGuessLabel;

    protected $view_namespace = 'admin::crud.filters.';
    protected $default_type = 'text';

    public function like()
    {
        return $this->set('operator', 'like');
    }
}
