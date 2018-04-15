<?php

return [
    'app' => [
        'name' => 'PHP Framework',
        'url' => 'http://localhost:8000'
    ],

    'database' => [
        'name' => 'php_framework',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],

    'mail' => [
        'username' => '',
        'password' => '',
        'from' => '',
        'reply_to' => ''
    ]
];
