<?php
return [
    'route' => [
        'prefix'     => 'admin',
        'as'         => 'admin.',
        'middleware' => ['web'],
    ],
    'auth'  => [
        'guard' => 'web',
    ],
];
