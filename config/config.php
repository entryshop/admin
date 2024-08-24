<?php
return [
    'route'              => [
        'prefix' => 'admin',
        'as'     => 'admin.',
    ],
    'default_guard'      => 'admin',
    'default_can_access' => true,
    'middleware'         => ['web'],
    'auth_middleware'    => ['web', \Entryshop\Admin\Http\Middleware\AdminAuthenticate::class],
    'auth'               => [
        'guards' => [
            'admin' => [
                'driver'   => 'session',
                'provider' => 'users',
            ],
        ],
    ],
];
