<?php

namespace Entryshop\Admin\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class AdminAuthenticate extends Authenticate
{

    protected function authenticate($request, array $guards)
    {
        $guards = [config('admin.default_guard')];
        parent::authenticate($request, $guards);
    }

    protected function redirectTo(Request $request)
    {
        return admin()->loginUrl();
    }
}
