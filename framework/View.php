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

    public function __construct($view, $template)
    {
        $this->view     = $view;
        $this->template = $template;
    }

    private function getData()
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

    private function getBindingMethods($view)
    {
        $reflection = new ReflectionClass($view);
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $methodNames = array_pluck($methods, 'name');

        return array_filter($methodNames, function($method) {
            return starts_with($method, 'get');
        });
    }

    public function render()
    {
        $template = $this->template;
        $data     = $this->getData();

        extract($data);
        include "templates/$template.php";
    }
}