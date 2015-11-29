<?php namespace Framework;

/**
* Route
*/
class Route
{
    private $verb;
    private $path;
    private $controller;
    private $controllerMethod;
    private $controllerDependencies = [];
    private $view;
    private $template;
    private $viewDependencies = [];
    private $dependencies = [];
    private $controllerParameters = [];

    public function __construct($verb, $path)
    {
        $this->verb = $verb;
        $this->path = preg_replace('/:\w+/', '(\d+)', $path);
    }

    public function action($controller, $method = '__invoke', $dependencies = [])
    {
        if (is_array($method)) {
            list($method, $dependencies) = ['__invoke', $method];
        }

        $this->controller             = $controller;
        $this->controllerMethod       = $method;
        $this->controllerDependencies = $dependencies;

        return $this;
    }

    public function view($view, $template = null, $dependencies = [])
    {
        if (is_array($template) || is_null($template)) {
            $dependencies = (array) $template;
            $template = class_basename($view);
            $template = substr($template, 0, -4);
            $template = snake_case($template);
        }

        $this->view             = $view;
        $this->template         = $template;
        $this->viewDependencies = $dependencies;

        return $this;
    }

    public function bind(array $dependencies)
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    public function match($verb, $path)
    {
        if ($verb !== $this->verb) return false;

        $result = preg_match("(^{$this->path}$)", $path, $params);

        $this->controllerParameters = array_slice($params, 1);

        return $result;
    }

    public function __get($var)
    {
        return $this->$var;
    }
}