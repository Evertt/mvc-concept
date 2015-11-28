<?php

// This file is currently not being used.
// It is a draft, a possible alternative for routes.yaml.
// One benefit of using a php-file is that you don't 
// need an extra config file for defining namespaces.

use App\Views\ListView;
use App\Contracts\Listable;
use App\Contracts\Paginatable;
use App\Controllers\PageController;
use App\Model\Repositories\UserRepository;

return [
    [
        'get'              => 'users',
        'view'             => ListView::class,
        'template'         => 'list',
        Listable::class    => UserRepository::class,
    ],
    [
        'get'              => 'users/:id',
        'action'           => [PageController::class, 'index'],
        'view'             => ListView::class,
        'template'         => 'list',
        Listable::class    => UserRepository::class,
        Paginatable::class => UserRepository::class,
    ]
];

// Another possibility using a router object:

$router
    ->get('users/:id')
    ->action(PageController::class, 'index')
    ->view(ListView::class, 'list')
    ->bind([
        Listable::class    => UserRepository::class,
        Paginatable::class => UserRepository::class
    ]);