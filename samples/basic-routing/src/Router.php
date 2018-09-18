<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 18/09/18
 * Time: 19:53
 */

namespace BasicRouting;


use BasicRouting\controllers\NotFound;

class Router
{

    public $routes;

    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function checkWhichControllerToRun()
    {
        // check the path and if one of the routes matches the current route of the request, run that controller
        $rendered = false;
        foreach ($this->routes as $route) {
            $path = $_SERVER['REQUEST_URI'];
            if ($path == $route['path']) {
                $controllerAndMethod = explode('@', $route['controller']);

                // all controllers should be in src/controllers
                $controller = 'BasicRouting' . '\\' . 'controllers' . '\\' . $controllerAndMethod[0];
                $method = $controllerAndMethod[1];

                $instance = new $controller;
                echo $instance->$method();
                $rendered = true;
                break;
            }
        }
        // render 404
        if ($rendered == false) {
            $instance = new NotFound();
            $instance->showNotFound();
        }
    }
}
