<?php

namespace Entryshop\Admin\Crud\Traits;

trait CanGuessLabel
{
    public function bootCanGuessLabel()
    {
        if ($this->get('label')) {
            return;
        }

        if (empty($this->crud()->get('lang'))) {
            return;
        }

        $this->set('label', $this->crud()->trans($this->name()));
    }

    public function getLabel()
    {
        $this->bootCanGuessLabel();
        return $this->get('label');
    }
}
