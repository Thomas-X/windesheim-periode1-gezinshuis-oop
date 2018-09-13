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
    public const GET = 'GET';
    public const POST = 'POST';

    private static function return404 () {
        http_response_code(404);
        echo view('404');
    }

    public static function serve(): void {
        $routeMatches = false;
        foreach (Router::$routes as $route) {
            $routeMatches = Router::determineIfRouteMatches($route);

            if ($routeMatches) {
                Router::runController($route['controller']);
            }
        }
        // If we're here, we've 404'ed because otherwise we would've returned.
        if (!$routeMatches) {
            Router::return404();
        }
    }

    /*
     * First check if path matches, then if yes, run middleware, then if middleware passes, add it to the routes array to be served
     * If the middleware returns false then it's never added to the array of routes to serve, if the user is on said route and the middleware
     * fails, we return a 401 unauthorized page
     * */
    public static function middleware($middlewares=[], array $routes): void
    {
        $routeMatches = false;
        foreach ($routes as $route) {
            $routeMatches = Router::determineIfRouteMatches(['path' => $route[1]]);
        }
        if (!$routeMatches) {
            return;
        }

        foreach ($middlewares as $middleware) {
            $middlewareInstance = new $middleware();
            $pass = $middlewareInstance->next();
            if ($pass) {
                // for every route given in array add it to the routes array (to serve up, since the middleware passed)
                foreach ($routes as $route) {
                    switch ($route[0]) {
                        case static::GET:
                            Router::get($route[1], $route[2]);
                            break;
                        case static::POST:
                            Router::post($route[1], $route[2]);
                            break;
                    }
                }
                // I know it's verbose to say continue here, but I find it more readable
                continue;
            } else if (!$pass) {
                // If middleware fails, then return 401 and exit to avoid request bubbling up to the 404 page
                header("HTTP/1.0 401 Unauthorized");
                exit;
            }
        }
    }

    private static function determineIfRouteMatches ($route) {
        $path = $_SERVER['REQUEST_URI'];
        if ($path == $route['path']) {
            return true;
        }
        return false;
    }

    private static function runController ($controllerNameSpaced) {
        $controllerInstance = new $controllerNameSpaced;
        $httpRequestType = $_SERVER['REQUEST_METHOD'];

        switch ($httpRequestType) {
            case 'GET':
                echo $controllerInstance->get();
                return true;
            case 'POST':
                echo $controllerInstance->post();
                return true;
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