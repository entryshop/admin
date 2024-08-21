<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanCreate
{
    public function create()
    {
        $this->data['action']   = 'create';
        $this->data['back_url'] = $this->crud()->url();
        $this->_before('form');
        $this->_before();
        $back_url = $this->data['back_url'] ?? null;
        admin()->title(__('admin::crud.create') . ' ' . $this->crud()->label())->back($back_url);
        $this->crud()->action($this->crud()->url());
        $this->crud()->method('post');
        $this->crud()->form();
        $this->_after('form');
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
        $this->crud()->save();
        $this->_after();
        return redirect($this->crud()->url());
    }
}
