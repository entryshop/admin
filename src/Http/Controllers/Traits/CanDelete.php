<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanDelete
{
    public function destroy(...$args)
    {
        $id = array_pop($args);

        $this->data['id']     = $id;
        $this->data['action'] = 'delete';
        $this->_before();

        $this->crud()->findOrFail($id);
        $this->crud()->entity()->delete();

        $this->_after();
        if (request()->ajax()) {
            return admin()->response()->refresh()->send();
        }

        return redirect($this->crud()->url());
    }
}
