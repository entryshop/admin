<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanBulkDelete
{
    public function beforeCanBulkDeleteIndex()
    {
        $this->crud()->button('bulk_delete')->bulk()->type('bulk_delete');
    }

    public function batchDelete()
    {
        $ids = request('ids');
        $this->crud()->entries()->whereIn('id', $ids)->delete();
        return admin()->response()->refresh()->send();
    }
}
