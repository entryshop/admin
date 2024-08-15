<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanShow
{
    public function show($id)
    {
        $this->data['action'] = 'show';
        $this->data['id']     = $id;

        $this->_before();

        admin()->title($this->crud()->label() . ' 详情')
            ->back($this->crud()->url());
        $this->crud()->findOrFail($id);
        $this->crud()->show();
        admin()->child($this->crud());

        $this->_after();

        return admin()->render();
    }
}
