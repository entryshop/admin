<?php

namespace Entryshop\Admin\Crud\Traits;

trait CanGuessLabel
{
    public function bootCanGuessLabel()
    {
        if ($this->builder->get('label')) {
            return;
        }

        if (empty($this->crud()->get('lang'))) {
            return;
        }

        $this->builder->set('label', __($this->crud()->get('lang') . '.' . $this->name()));
    }

    public function getLabel()
    {
        $this->bootCanGuessLabel();
        return $this->get('label');
    }
}
