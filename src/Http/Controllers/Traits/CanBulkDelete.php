<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

use Entryshop\Admin\Attributes\Post as RoutePost;

trait CanBulkDelete
{
    public function beforeCanBulkDeleteIndex()
    {
        $this->crud()->button('bulk_delete')->bulk()->type('bulk_delete');
    }

    #[RoutePost('batch-delete', name: "batch-delete")]
    public function batchDelete()
    {
        $ids = request('ids');
        $this->crud()->entities()->whereIn('id', $ids)->delete();
        return admin()->response()->refresh()->send();
    }
}
