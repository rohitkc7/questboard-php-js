<?php

declare(strict_types=1);

return [
    [
        'uri' => '/',
        'method' => 'GET',
        'controller_method' => 'index',
    ],

    [
        'uri' => '/',
        'method' => 'POST',
        'action' => __DIR__ . '/../app/views/home.php',
    ]
];