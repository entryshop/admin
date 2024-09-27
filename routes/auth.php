<?php

use Entryshop\Admin\Http\Controllers\Auth\LoginController;
use Entryshop\Admin\Http\Controllers\HomeController;
use Entryshop\Admin\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'submitLoginForm'])->name('login.submit');
Route::any('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => config('admin.auth_middleware')], function () {
    Route::get('/', HomeController::class)->name('home');
    Route::post('upload', UploadController::class)->name('upload');
});
