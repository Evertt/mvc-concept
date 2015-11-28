<?php

use Framework\Router;
use Framework\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerInterface;

require_once('vendor/autoload.php');

$method = 'get'; $path = 'users/2';

$ioc = new Container;
$getContainer = function() use ($ioc) {return $ioc;};
$ioc->bind(ContainerInterface::class, $getContainer);
$ioc->singleton(Container::class, $getContainer);

$router = $ioc[Router::class];
$dispatcher = $ioc[Dispatcher::class];

$route = $router->route($method, $path);
$dispatcher->dispatch($route);