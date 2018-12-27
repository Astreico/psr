<?php
use Component\Container\Container;

return [
    'db' => [
        'driver' => 'mysql',
        'user' => 'root',
        'password' => '',
        'name' => 'mvc',
        'host' => '127.0.0.1',
    ],
    'pdo' => function (Container $container) {
        $format = "%s:dbname=%s;host=%s";
        $connection = sprintf(
            $format,
            $container->get('db_driver'),
            $container->get('db_name'),
            $container->get('db_host')
        );
        return new PDO($connection, $container->get('db_user'), $container->get('db_password'));
    },
    'auth' => [
        'users' => [
            'admin' => 'admin'
        ]
    ]
];
