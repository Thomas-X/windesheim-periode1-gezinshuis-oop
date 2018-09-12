<?php

namespace Qui;

use Qui\interfaces\IRouter;

/* A simple 'router'
 * Iterate over routes and depending if the path matches the route show the correct controller/method.
 * Since the value of controller is namespaced, make an instance of said controller and call the show() function on it.
 * This can be done since every controller must implement the IController interface
 * TODO add method type checking
 * TODO change API for Controllers so there's a better name for a get / post request (and handle all post values)
 * */


class Router implements IRouter {
    private static $routes = [];

    private static function return404 () {
        http_response_code(404);
        echo view('404');
    }

    public static function serve(): void {
        $rendered = false;
        foreach (Router::$routes as $route) {
            $path = $_SERVER['REQUEST_URI'];
            $httpRequestType = $_SERVER['REQUEST_METHOD'];

            if ($path == $route['path']) {
                // TODO add middleware?
                $controllerInstance = new $route['controller'];

                switch ($httpRequestType) {
                    case 'GET':
                        echo $controllerInstance->show();
                        $rendered = true;
                        return;
                    case 'POST':
                        echo $controllerInstance->post();
                        $rendered = true;
                        return;
                }
            }
        }
        // If we're here, we've 404'ed because otherwise we would've returned.
        if ($rendered) {
            Router::return404();
        }

    }

    public static function get ($path, $controller) {
        Router::$routes[] = [
            'path' => $path,
            'controller' => $controller,
            'httpRequestType' => 'GET'
        ];
    }

    public static function post ($path, $controller) {
        Router::$routes[] = [
            'path' => $path,
            'controller' => $controller,
            'httpRequestType' => 'POST'
        ];
    }
}