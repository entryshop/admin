<?php


namespace Entryshop\Admin\Admin\Traits;

use Entryshop\Admin\Admin\ActionResponse;

trait HasActionResponse
{
    public function response()
    {
        return new ActionResponse();
    }

    public function redirect($url, $status = 302, $headers = [], $secure = null)
    {
        if (request()->ajax()) {
            return $this->response()->redirect($url)->send();
        }

        return redirect($url, $status, $headers, $secure);
    }
}
