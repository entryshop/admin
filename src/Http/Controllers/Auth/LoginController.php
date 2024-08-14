<?php

namespace Entryshop\Admin\Http\Controllers\Auth;

use Entryshop\Admin\Admin\AdminPage;

class LoginController
{
    public function showLoginForm()
    {
        admin()->guest()->child(AdminPage::make()->type('auth.login'));
        return admin()->render();
    }

    public function submitLoginForm()
    {
        $loginWith   = admin()->get('loginWith', 'email');
        $credentials = [
            $loginWith => request('username'),
            'password' => request('password'),
        ];

        if ($this->auth()->attempt($credentials)) {
            return redirect()->intended(admin()->homeUrl());
        }

        return back()->withInput(request()->all())->withErrors([$loginWith => __('admin::auth.invalid_credentials')]);
    }

    public function logout()
    {
        $this->auth()->logout();
        return redirect(admin()->loginUrl());
    }

    protected function auth()
    {
        return admin()->auth();
    }
}
