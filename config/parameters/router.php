<?php

return [
    'routes' => [
        ['test_route', '/blog/{id}', \App\Controller\BlogController::class, ['GET']],
    ]
];