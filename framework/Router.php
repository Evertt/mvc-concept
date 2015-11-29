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
        $router = $this;
        include('config/routes.php');
    }

    function get($path)
    {
        $route = new Route('GET', $path);

        return $this->routes[] = $route;
    }

    function route($verb, $path)
    {
        $route = array_first(
            $this->routes,
            function($i, $route) use ($verb, $path) {
                return $route->match($verb, $path);
            }
        );

        if (is_null($route)) {
            die("No matching route found.\n");
        }

        return $route;
    }
}