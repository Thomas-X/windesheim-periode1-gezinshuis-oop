<?php

namespace Qui\lib;

use Qui\lib\facades\Util;
use Qui\lib\facades\View;
use Qui\lib\App;
use Qui\lib\Request;
use Qui\lib\Response;


/*
 * A simple 'router'
 * Uses middleware to check if certain routes should be added to the routes array or not (so they can be served if they're in the routes array)
 *
 * */

/**
 * Class Router
 * @package Qui\core
 */
class CRouter
{
    private $routes = [];
    private $routeMatches = false;

    /*
     * Returns the 404 page if no path can be matched
     * */
    private function return404()
    {
        http_response_code(404);
        echo View::render('pages.404');
    }

    /*
     * Loops through the routes array and checks if a route matches, if yes, it runs the controller associated with the matched route
     * */
    public function serve(): void
    {
        $routeMatches = false;
        foreach ($this->routes as $route) {
            $routeMatches = $this->determineIfRouteMatches($route);
            $requestedMethod = $_SERVER['REQUEST_METHOD'];
            $routeMethod = $route['httpRequestType'];

            if ($routeMatches && $routeMethod == $requestedMethod) {
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
    /**
     * @param array $middlewares
     * @param array $routes
     */
    public function middleware($middlewares = [], array $routes, $onlyForThisMethod = null): void
    {
        $this->routeMatches = false;
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        $arr = [];
        foreach ($routes as $route) {
            $arr[] = [
                '1' => $route[1],
                '2' => $path,
            ];
            $this->routeMatches = $this->determineIfRouteMatches(['path' => $route[1]]);
            if ($this->routeMatches == true) {
                break;
            }
        }
        if ($this->routeMatches == false) {
            return;
        }
        foreach ($middlewares as $middleware) {
            $value = explode('@', $middleware);
            $middlewareName = $value[0];
            $middlewareMethod = $value[1] ?? 'next';
            $middlewareNameSpaced = "Qui" . '\\' . 'app' . '\\' . 'http' . '\\' . 'middleware' . '\\' . $middlewareName;
            $middlewareInstance = new $middlewareNameSpaced;

            $req = new Request();
            $res = new Response();
            $pass = $middlewareInstance->$middlewareMethod($req, $res);
            if (isset($onlyForThisMethod)) {
                if ($_SERVER['REQUEST_METHOD'] == $onlyForThisMethod) {
                    $pass = $middlewareInstance->$middlewareMethod($req, $res);
                }
            } else {
                $pass = $middlewareInstance->$middlewareMethod($req, $res);
            }
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
                // header("HTTP/1.0 401 Unauthorized");
                // exit;
                // instead of 401 just redirect to home
                header('Location: /');
                exit;

            }
        }
    }

    /*
     * checks the path and checks if it corresponds with the requested path
     * */
    /**
     * @param $route
     * @return bool
     */
    private function determineIfRouteMatches($route)
    {
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        if ($path == $route['path']) {
            return true;
        }
        return false;
    }

    /*
     * explodes the 'ExampleController@showHome' string and defaults to 'show' if no method was given
     * checks the project root \ controllers for the controller name given
     * */
    /**
     * @param $controllerNameSpaced
     */
    private function runController($controllerNameSpaced)
    {
        $value = explode('@', $controllerNameSpaced);
        $controllerName = $value[0];
        $controllerMethod = $value[1] ?? 'show';

        $controllerNameSpaced = "Qui" . '\\' . 'app' . '\\' . 'http' . '\\' . 'controllers' . '\\' . $controllerName;
        $controllerInstance = new $controllerNameSpaced;
        $req = new Request();
        $res = new Response();
        // dont echo because we're using requires and not a templating engine
        // unless we're returning something else than false (which the View::render method returns)
        // which means we're returning JSON or something else
        $rval = $controllerInstance->$controllerMethod($req, $res);
        if ($rval != false) {
            echo $rval;
        }
    }

    /*
     * adds a GET route to the routes array, binding the path and controller to an assoc array
     * */
    /**
     * @param $path
     * @param $controller
     */
    public function get($path, $controller)
    {
        $this->routes[] = [
            'path' => $path,
            'controller' => $controller,
            'httpRequestType' => App::GET
        ];
    }

    /*
     * adds a POST route to the routes array, binding the path and controller to an assoc array
     * */
    /**
     * @param $path
     * @param $controller
     */
    public function post($path, $controller)
    {
        $this->routes[] = [
            'path' => $path,
            'controller' => $controller,
            'httpRequestType' => App::POST
        ];
    }
}