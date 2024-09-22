<?php

namespace Entryshop\Admin\Components\Crud;

use Entryshop\Admin\Components\Crud\Traits\CanGuessLabel;

/**
 * @method string|static operator($value = null)
 * @method string|static options($value = null)
 * @method string|static placeholder($value = null)
 * @method string|static multiple($value = null)
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

    public function search()
    {
        return $this->set('operator', 'search');
    }
}
