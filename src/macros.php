<?php

use Illuminate\Support\Facades\Route;

if (!Route::hasMacro('crud')) {
    Route::macro('crud', function ($name, $controller) {
        Route::resource($name, $controller);
        $controllerReflection = new ReflectionClass($controller);
        foreach ($controllerReflection->getMethods() as $method) {
            if (!$method->isPublic()) {
                continue;
            }

            if ($attributes = $method->getAttributes()) {
                foreach ($attributes as $attribute) {
                    if (is_subclass_of($attribute->getName(), \Entryshop\Admin\Attributes\Route::class)) {
                        $route_uri = $attribute->getArguments()[0] ?? null;
                        if (empty($route_uri)) {
                            continue;
                        }
                        $route_method = $attribute->getArguments()['method'] ?? 'post';
                        $route_name   = $attribute->getArguments()['name'] ?? Str::kebab($method->getName());
                        Route::$route_method($name . '/' . $route_uri, [$controller, $method->getName()])->name($name . '.' . $route_name);
                    }
                }
            }
        }
    });
}
