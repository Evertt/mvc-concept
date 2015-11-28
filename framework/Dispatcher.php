<?php namespace Framework;

use ReflectionClass;
use ReflectionMethod;
use Illuminate\Contracts\Container\Container;

/**
* Dispatcher
*/
class Dispatcher
{
    private $ioc;

    public function __construct(Container $ioc)
    {
        $this->ioc = $ioc;
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
            $data = $this->getData($route['view']);
            $this->render($route['template'], $data);
        }
    }

    private function bind($dependencies)
    {
        foreach($dependencies as $interface => $binding) {
            $binding = addNamespace($binding);
            $interface = addNamespace($interface);
            $this->ioc->singleton($binding);
            $this->ioc->bind($interface, $binding);
        }
    }

    private function invoke($action, $param)
    {
        list($controller, $method) = explode('@', $action);
        $controller = addNamespace($controller);
        $controller = $this->ioc->make($controller);
        call_user_func([$controller, $method], $param);
    }

    private function getData($view)
    {
        $view = addNamespace($view);
        $view = $this->ioc->make($view);
        $methods = $this->getBindingMethods($view);
        $data = [];

        foreach ($methods as $method) {
            $key = lcfirst(substr($method, 3));
            $data[$key] = $view->{$method}();
        }

        return $data;
    }

    private function getBindingMethods($view)
    {
        $class = new ReflectionClass($view);
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        $methodNames = array_pluck($methods, 'name');
        $filter = [$this, 'filterGetMethods'];

        return array_filter($methodNames, $filter);
    }

    public function filterGetMethods($method)
    {
        return starts_with($method, 'get');
    }

    private function render($template, $data)
    {
        extract($data);
        include "templates/$template.php";
    }
}