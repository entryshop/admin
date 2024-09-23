<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

use Entryshop\Utils\Attributes\Get;

trait CanShow
{
    public function show(...$args)
    {
        $id = array_pop($args);

        $this->data['action']   = 'show';
        $this->data['id']       = $id;
        $this->data['back_url'] = $this->crud()->url();

        $this->_before();

        $back_url = $this->data['back_url'] ?? null;
        admin()->title($this->crud()->label() . ' ' . __('admin::crud.preview'))->back($back_url);
        $this->crud()->findOrFail($id);
        $this->crud()->show();
        admin()->child($this->crud());

        $this->_after();

        if (request()->ajax()) {
            return admin()->response()->redirect($this->crud()->url($id))->send();
        }

        return admin()->render();
    }

    #[Get('{id}/raw')]
    public function showRawData(...$args)
    {
        $id = array_pop($args);
        return $this->crud()->findOrFail($id);
    }
}
