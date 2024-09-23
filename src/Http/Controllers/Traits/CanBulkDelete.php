<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

use Entryshop\Utils\Attributes\Post;

trait CanBulkDelete
{
    #[Post('batch-delete', name: "batch-delete")]
    public function batchDelete()
    {
        $ids = request('ids');
        $this->crud()->entities()->whereIn('id', $ids)->delete();
        return admin()->response()->refresh()->send();
    }
}
