<?php

use Entryshop\Admin\Http\Controllers\FormController;

Route::get('__form', [FormController::class, 'render'])->name('form.render');
Route::post('__form', [FormController::class, 'submit'])->name('form.submit');
