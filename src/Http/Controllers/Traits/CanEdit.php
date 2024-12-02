<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanEdit
{
    public function edit(...$args)
    {
        $id = array_pop($args);

        $this->data['action']   = 'edit';
        $this->data['id']       = $id;
        $this->data['back_url'] = $this->crud()->url();

        $this->crud()->form();

        $this->_before('form');
        $this->_before();

        $back_url = $this->data['back_url'] ?? null;
        admin()->title(__('admin::crud.edit') . ' ' . $this->crud()->label())->back($back_url);
        $this->crud()->findOrFail($id);
        $this->crud()->action($this->crud()->url($id));
        $this->crud()->method('put');


        $this->_after('form');
        admin()->child($this->crud());
        $this->_after();

        if (request()->ajax()) {
            return admin()->response()->redirect($this->crud()->url($id . '/edit'))->send();
        }

        return admin()->render();
    }

    public function update(...$args)
    {
        $id = array_pop($args);

        $this->data['action'] = 'update';
        $this->data['id']     = $id;

        $this->crud()->form()->findOrFail($id);

        $this->_before('form');
        $this->_before('edit');
        $this->_before();

        $this->crud()->validate();
        $this->crud()->save();

        $back_url = $this->crud()->url();

        $this->_after();

        return redirect($back_url);
    }
}
