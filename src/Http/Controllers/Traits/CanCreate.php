<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanCreate
{
    public function create()
    {
        $this->data['action'] = 'create';
        $this->_before('form');
        $this->_before();

        admin()->title(__('admin::crud.create') . ' ' . $this->crud()->label())->back($this->crud()->url());
        $this->crud()->action($this->crud()->url());
        $this->crud()->method('post');
        $this->crud()->form();
        admin()->child($this->crud());

        $this->_after();
        return admin()->render();
    }

    public function store()
    {
        $this->data['action'] = 'store';
        $this->_before('form');
        $this->_before('create');
        $this->_before();

        $this->crud()->validate();
        $this->crud()->store();

        $this->_after();
        return redirect($this->crud()->url());
    }
}
