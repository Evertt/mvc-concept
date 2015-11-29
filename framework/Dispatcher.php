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
        $this->bind($route->dependencies);

        if ($route->controller) {
            $this->dispatchController($route);
        }

        if ($route->view) {
            $this->dispatchView($route);
        }
    }

    private function dispatchController($route)
    {
        $controller = $route->controller;
        $method = $route->controllerMethod;
        $params = $route->controllerParameters;
        $dependencies = $route->controllerDependencies;

        $this->bindTo($dependencies, $controller);
        $this->invoke($controller, $method, $params);
    }

    private function dispatchView($route)
    {
        $view = $route->view;
        $template = $route->template;
        $dependencies = $route->viewDependencies;

        $this->bindTo($dependencies, $view);
        $this->makeView($view, $template)->render();
    }

    private function bind($dependencies)
    {
        foreach($dependencies as $interface => $binding) {
            $this->container->bindIf($binding, $binding, true);
            $this->container->bindIf($interface, $binding, true);
        }
    }

    private function bindTo($dependencies, $to)
    {
        foreach($dependencies as $interface => $binding) {
            $this->container->bindIf($binding, $binding, true);
            $this->container->when($to)->needs($interface)->give($binding);
        }
    }

    private function invoke($controller, $method, $params)
    {
        $controller = $this->container->make($controller);

        call_user_func_array([$controller, $method], $params);
    }

    private function makeView($view, $template)
    {
        $view = $this->container->make($view);

        return new View($view, $template);
    }
}