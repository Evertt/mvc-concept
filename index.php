<?php

use Framework\Router;
use Framework\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\Container as ContainerInterface;

require_once('laravel-helper-override.php');
require_once('vendor/autoload.php');

$httpMethod = 'get'; $defaultPath = '/users';

// Get the path from the arguments given
// in the CLI, or use the default path
$path = trim(array_get($argv, 1, $defaultPath), '/');

// Instantiate the DI container and
// make sure every time a class needs it,
// it gets this very instance of it.
$container = new Container;
$getContainer = function() use ($container) {return $container;};
$container->bind(ContainerInterface::class, $getContainer);
$container->singleton(Container::class, $getContainer);

// Get the framework-router and
// dispatcher from the container
$router = $container[Router::class];
$dispatcher = $container[Dispatcher::class];

// get route from the path and http-method
$route = $router->route($httpMethod, $path);
// dispatch the route
$dispatcher->dispatch($route);