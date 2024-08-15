<?php

use Illuminate\Support\Facades\Route;

if (!Route::hasMacro('crud')) {
    Route::macro('crud', function ($name, $controller) {
        Route::resource($name, $controller);
        Route::post($name . '/batch-delete', [$controller, 'batchDelete']);
        Route::post($name . '/action/{$action}', [$controller, 'runAction']);
    });
}
