<?php
return [
    'route'           => [
        'prefix' => 'admin',
        'as'     => 'admin.',
    ],
    'default_guard'   => 'admin',
    'middleware'      => ['web'],
    'auth_middleware' => ['web', \Entryshop\Admin\Http\Middleware\AdminAuthenticate::class],
    'auth'            => [
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'users',
            ],
        ],
    ],
];
