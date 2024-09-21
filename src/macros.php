<?php

use Illuminate\Support\Facades\Route;

if (!Route::hasMacro('auto')) {
    Route::macro('auto', function ($name, $controller, array $options = []) {
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
                        $attributeClass = $attribute->newInstance();
                        $route_method   = $attributeClass->method;
                        $route_name     = $attribute->getArguments()['name'] ?? Str::kebab($method->getName());
                        if (\Illuminate\Support\Str::startsWith($route_uri, '/')) {
                            $full_route = Str::replaceStart('/', '', $route_uri);
                        } else {
                            $full_route = $name . '/' . $route_uri;
                        }
                        Route::$route_method($full_route, [$controller, $method->getName()])->name($name . '.' . $route_name);
                    }
                }
            }
        }
    });
}

if (!Route::hasMacro('crud')) {
    Route::macro('crud', function ($name, $controller, array $options = []) {
        Route::resource($name, $controller, $options);
        Route::auto($name, $controller, $options);
    });
}


