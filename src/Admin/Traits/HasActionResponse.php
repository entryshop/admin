<?php


namespace Entryshop\Admin\Admin\Traits;

use Entryshop\Admin\Admin\ActionResponse;

trait HasActionResponse
{
    public function response()
    {
        return new ActionResponse();
    }
}
