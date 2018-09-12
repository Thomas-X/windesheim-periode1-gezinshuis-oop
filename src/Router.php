<?php

namespace Qui;

use Qui\interfaces\IRouter;

/* A simple 'router'
 * Iterate over routes when serve() is called and depending if the path/requestType matches the route show the correct controller/method.
 * Since the value of controller is namespaced, make an instance of said controller and call the get() / post() function on it.
 * This can be done since every controller must implement the IController interface
 *
 * The middleware is nothing more than a method getting called and having to return true or false if it meets the test
 * given by the middleware.
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
                        echo $controllerInstance->get();
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
        if (!$rendered) {
            Router::return404();
        }

    }

    public static function middleware($middlewares=[], $funcToAddRoutes): void
    {
        foreach ($middlewares as $middleware) {
            $middlewareInstance = new $middleware();
            $pass = $middlewareInstance->next();
            if ($pass) {
                // I know it's verbose to say continue here, but I find it more readable
                $funcToAddRoutes();
                continue;
            } else if (!$pass) {
                // If middleware fails, then return 401 and exit to avoid request bubbling up to the 404 page
                header("HTTP/1.0 401 Unauthorized");
                exit;
            }
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