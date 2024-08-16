<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanShow
{
    public function show($id)
    {
        $this->data['action']   = 'show';
        $this->data['id']       = $id;
        $this->data['back_url'] = $this->crud()->url();

        $this->_before();

        $back_url = $this->data['back_url'] ?? null;
        admin()->title($this->crud()->label() . ' 详情')->back($back_url);
        $this->crud()->findOrFail($id);
        $this->crud()->show();
        admin()->child($this->crud());

        $this->_after();

        return admin()->render();
    }
}
