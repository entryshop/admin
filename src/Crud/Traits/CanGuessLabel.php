<?php

namespace Entryshop\Admin\Crud\Traits;

trait CanGuessLabel
{
    public function buildCanGuessLabel()
    {
        if ($this->get('label')) {
            return;
        }

        if (empty($this->crud()->get('lang'))) {
            return;
        }

        $this->set('label', $this->crud()->trans($this->name()));
    }

    public function label($value = null)
    {
        if (empty($value)) {
            return $this->getLabel();
        }

        return parent::label($value);
    }

    public function getLabel()
    {
        $this->buildCanGuessLabel();
        return $this->get('label');
    }
}
