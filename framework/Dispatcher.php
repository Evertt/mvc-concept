<?php namespace Framework;

use Illuminate\Contracts\Container\Container;

/**
* Dispatcher
*/
class Dispatcher
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispatch($route)
    {
        $dependencies = array_except($route, ['get','repository','action','view','template',0,1]);

        if ($dependencies) {
            $this->bind($dependencies);
        }

        if (isset($route['action'])) {
            $this->invoke($route['action'], array_get($route,1));
        }

        if (isset($route['view'])) {
            $view = $this->makeView($route['view'], $route['template']);
            $view->render();
        }
    }

    private function bind($dependencies)
    {
        foreach($dependencies as $interface => $binding) {
            $binding = addNamespace($binding);
            $interface = addNamespace($interface);
            $this->container->singleton($binding);
            $this->container->bind($interface, $binding);
        }
    }

    private function invoke($action, $param)
    {
        list($controller, $method) = explode('@', $action);
        $controller = addNamespace($controller);
        $controller = $this->container->make($controller);
        call_user_func([$controller, $method], $param);
    }

    private function makeView($view, $template)
    {
        $view = addNamespace($view);
        $view = $this->container->make($view);

        return new View($view, $template);
    }
}