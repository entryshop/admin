<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanDelete
{
    public function destroy($id)
    {
        $this->data['action'] = 'delete';
        $this->_before();

        $this->crud()->findOrFail($id);
        $this->crud()->entry()->delete();

        $this->_after();
        if (request()->ajax()) {
            return admin()->response()->refresh()->send();
        }

        return redirect($this->crud()->url());
    }
}
