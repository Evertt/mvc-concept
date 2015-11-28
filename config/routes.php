<?php

// This file is currently not being used.
// It is a draft, a possible alternative for routes.yaml.
// One benefit of using a php-file is that you don't 
// need an extra config file for defining namespaces.

use App\Views;
use App\Contracts;
use App\Controllers;
use App\Model\Repositories;

return [
    [
        'get'                        => 'users',
        'view'                       => Views\ListView::class,
        'template'                   => 'list',
        Contracts\Listable::class    => Repositories\UserRepository::class,
    ],
    [
        'get'                        => 'users/:id',
        'action'                     => [Controllers\PageController::class, 'index'],
        'view'                       => Views\ListView::class,
        'template'                   => 'list',
        Contracts\Listable::class    => UserRepository::class,
        Contracts\Paginatable::class => UserRepository::class,
    ]
];

// Another possibility using a router object:

$router
    ->get('users/:id')
    ->action(Controllers\UserController::class, 'index')
    ->view(Views\ListView::class, 'list')
    ->bind([
        Contracts\Listable::class    => UserRepository::class,
        Contracts\Paginatable::class => UserRepository::class
    ]);