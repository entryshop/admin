<?php

namespace Entryshop\Admin\Http\Controllers;

class FormController
{
    public function render()
    {
        $form = app(request('form'));
        return $form->show();
    }

    public function submit()
    {
        $form = app(request('form'));
        return $form->submit();
    }
}
