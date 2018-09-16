<?php

namespace Qui\core;

use Qui\interfaces\IRouter;
use Qui\core\facades\View;
use Qui\core\App;
use Qui\core\Request;
use Qui\core\Response;


/* A simple 'router'
 * Iterate over routes when serve() is called and depending if the path/requestType matches the route show the correct controller/method.
 * Since the value of controller is namespaced, make an instance of said controller and call the get() / post() function on it.
 * This can be done since every controller must implement the IController interface
 *
 * The middleware is nothing more than a method getting called and having to return true or false if it meets the test
 * given by the middleware.
 * */

class Router implements IRouter
{
    private $routes = [];

    private function return404()
    {
        http_response_code(404);
        echo View::render('404');
    }

    public function serve(): void
    {
        $routeMatches = false;
        foreach ($this->routes as $route) {
            $routeMatches = $this->determineIfRouteMatches($route);

            if ($routeMatches) {
                $this->runController($route['controller']);
                break;
            }
        }
        // If we're here, we've 404'ed because otherwise we would've returned.
        if (!$routeMatches) {
            $this->return404();
        }
    }

    /*
     * First check if path matches, then if yes, run middleware, then if middleware passes, add it to the routes array to be served
     * If the middleware returns false then it's never added to the array of routes to serve, if the user is on said route and the middleware
     * fails, we return a 401 unauthorized page
     * */
    public function middleware($middlewares = [], array $routes): void
    {
        $routeMatches = false;
        foreach ($routes as $route) {
            $routeMatches = $this->determineIfRouteMatches(['path' => $route[1]]);
        }
        if (!$routeMatches) {
            return;
        }

        foreach ($middlewares as $middleware) {
            $value = explode('@', $middleware);
            $middlewareName = $value[0];
            $middlewareMethod = $value[1] ?? 'next';
            $middlewareNameSpaced = "Qui" . '\\' . 'middleware' . '\\' . $middlewareName;
            $middlewareInstance = new $middlewareNameSpaced;

            $req = new Request();
            $res = new Response();
            $pass = $middlewareInstance->$middlewareMethod($req, $res);
            if ($pass) {
                // for every route given in array add it to the routes array (to serve up, since the middleware passed)
                foreach ($routes as $route) {
                    switch ($route[0]) {
                        case App::GET:
                            $this->get($route[1], $route[2]);
                            break;
                        case App::POST:
                            $this->post($route[1], $route[2]);
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

    private function determineIfRouteMatches($route)
    {
        $path = $_SERVER['REQUEST_URI'];
        if ($path == $route['path']) {
            return true;
        }
        return false;
    }

    private function runController($controllerNameSpaced)
    {
        $value = explode('@', $controllerNameSpaced);
        $controllerName = $value[0];
        $controllerMethod = $value[1] ?? 'show';

        $controllerNameSpaced = "Qui" . '\\' . 'controllers' . '\\' . $controllerName;
        $controllerInstance = new $controllerNameSpaced;
        $req = new Request();
        $res = new Response();
        echo $controllerInstance->$controllerMethod($req, $res);
        return true;

    }

    public function get($path, $controller)
    {
        $this->routes[] = [
            'path' => $path,
            'controller' => $controller,
            'httpRequestType' => App::GET
        ];
    }

    public function post($path, $controller)
    {
        $this->routes[] = [
            'path' => $path,
            'controller' => $controller,
            'httpRequestType' => App::POST
        ];
    }
}