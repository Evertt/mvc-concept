<?php

use Symfony\Component\Yaml\Yaml;

function config($key)
{
    $namespaces  = Yaml::parse(file_get_contents('config/namespaces.yaml'));
    $routes      = Yaml::parse(file_get_contents('config/routes.yaml'));
    $config      = compact('namespaces', 'routes');

    return array_get($config, $key);
}

function addNamespace($class)
{
    $map = ['' => 'entity', 'able' => 'contract'];
    preg_match('/repository|controller|view|able/i', $class, $kind);
    $kind = array_get($kind, 0, '');
    $kind = array_get($map, $kind, $kind);
    $kind = str_plural(lcfirst($kind));
    return config("namespaces.$kind") . "\\$class";
}