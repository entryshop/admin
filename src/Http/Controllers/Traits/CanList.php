<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanList
{
    public function index()
    {
        $this->data['action'] = 'index';

        $this->_before();

        admin()->title($this->crud()->labelPlural());
        $this->crud()->table()->applyFilters();
        admin()->child($this->crud());

        $this->_after();

        return admin()->render();
    }
}
