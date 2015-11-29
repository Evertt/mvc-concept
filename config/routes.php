<?php

use App\Views\ListView;
use App\Contracts\Listable;
use App\Contracts\Paginatable;
use App\Controllers\PageController;
use App\Model\Repositories\UserRepository;

$router
    ->get('users')
    ->view(ListView::class, [Listable::class => UserRepository::class]);

$router
    ->get('users/:id')
    ->action(PageController::class, 'index', [Paginatable::class => UserRepository::class])
    ->view(ListView::class, [Listable::class => UserRepository::class]);