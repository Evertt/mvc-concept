<?php namespace Framework;

/**
* Router
*/
class Router
{
    private $path;
    private $method;
    private $routes;
    private $params;
 
    function __construct()
    {
        $this->routes = config('routes');
    }

    public function route($method, $path)
    {
        $this->method = $method;
        $this->path   = $path;
        $route = array_first($this->routes, [$this, 'match']);

        return $route + $this->params;
    }

    public function match($key, $value)
    {
        $route = $value[$this->method];
        $route = preg_replace('/:\w+/', '(\d+)', $route);
        return preg_match("(^$route$)", $this->path, $this->params);
    }
}