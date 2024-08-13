<?php

namespace Entryshop\Admin\Support;

/**
 * @property string $view_namespace
 * @property string $default_type
 * @method string|self type($value = null)
 */
trait HasViewNamespace
{
    public function view($value = null)
    {
        if (empty($value)) {
            return $this->builder->get('view', $this->view_namespace . $this->builder->get('type', $this->default_type));
        }
        return $this->builder->set('view', $value);
    }
}
