<?php

use Entryshop\Admin\Http\Controllers\Auth\LoginController;
use Entryshop\Admin\Http\Controllers\HomeController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'submitLoginForm'])->name('login.submit');

Route::group(['middleware' => 'auth:' . config('admin.auth.guard')], function () {
    Route::any('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', HomeController::class)->name('home');
});
