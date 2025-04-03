<?php

namespace Core;

use Exception;

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DESTROY' => []
    ];

    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * direct go to route by request uri
     *
     * @param  mixed $uri
     * @return void
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            return $this->callToAction(...explode('@', $this->routes[$requestType][$uri]));
        }

        throw new Exception('No route defined for this URI.');
    }

    protected function callToAction($controller, $action)
    {
        $controller = 'App\\Controllers\\'. $controller;
        $controller = new $controller;

        if(!method_exists($controller, $action)){
            throw new Exception('controller not found');
        }
        
        return $controller->$action();
    }

    public function get($uri, $controller)
    {
        $uri = Request::clearUri($uri);
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function patch($uri, $controller)
    {
        $uri = Request::clearUri($uri);
        $this->routes['PATCH'][$uri] = $controller;
    }

    public function delete($uri, $controller)
    {

        $uri = Request::clearUri($uri);
        $this->routes['DELETE'][$uri] = $controller;
    }

    /**
     * define routes
     *
     * @param  mixed $routes
     * @return void
     */
    public function define($routes)
    {
        $this->routes = $routes;
    }
}