<?php namespace Framework;

use ReflectionClass;
use ReflectionMethod;

/**
* View
*/
class View
{
    private $view;
    private $template;

    function __construct($view, $template)
    {
        $this->view     = $view;
        $this->template = $template;
    }

    function getData()
    {
        $view = $this->view;
        $methods = $this->getBindingMethods($view);
        $data = [];

        foreach ($methods as $method) {
            $key = lcfirst(substr($method, 3));
            $data[$key] = $view->{$method}();
        }

        return $data;
    }

    function getBindingMethods($view)
    {
        $class = new ReflectionClass($view);
        $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
        $methodNames = array_pluck($methods, 'name');
        $filter = [$this, 'filterGetMethods'];

        return array_filter($methodNames, $filter);
    }

    function filterGetMethods($method)
    {
        return starts_with($method, 'get');
    }

    function render()
    {
        $template = $this->template;
        $data     = $this->getData();

        extract($data);
        include "templates/$template.php";
    }
}