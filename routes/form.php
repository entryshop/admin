<?php

use Entryshop\Admin\Http\Controllers\FormController;

Route::get('form', [FormController::class, 'render']);
Route::post('form', [FormController::class, 'submit']);
