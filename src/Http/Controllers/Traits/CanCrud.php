<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait CanCrud
{
    use CanList, CanCreate, CanEdit, CanShow, CanDelete, CanBulkDelete;
}
