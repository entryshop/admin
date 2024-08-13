<?php

namespace Entryshop\Admin\Http\Controllers\Traits;

trait HasApiResponse
{
    public function success($data = null, $code = 200)
    {
        return response()->json($data, $code);
    }

    public function error($message = null, $data = null, $code = 400)
    {
        return response()->json([
            'msg'  => $message,
            'data' => $data,
        ], $code);
    }

}
