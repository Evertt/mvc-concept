<?php

use App\Views;
use App\Model\Repositories;

return [
    'get' => '/users',
    'view' => Views\ListView::class,
    'repository' => Repositories\UserRepository::class,
    'template' => 'list'
];