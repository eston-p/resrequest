<?php

namespace App;

use App\Exceptions\MethodNotAllowedException;
use App\Exceptions\RouteNotFoundException;

class Router
{

    /**
     * @var array
     */
    protected $routes = [];

    /**
     * @var
     */
    protected $path;

    /**
     * @var array
     */
    protected $methods = [];

    /**
     * Sets a path eg. /search
     *
     * @param string $path
     */
    public function setPath($path = '/')
    {
        $this->path = $path;
    }

    /**
     * Adds route e.g get(arg1, arg2, arg3)
     *
     * @param $uri
     * @param $handler
     * @param array $methods
     */
    public function addRoute($uri, $handler, array $methods = ['GET'])
    {
        $this->routes[$uri] = $handler;

        $this->methods[$uri] = $methods;
    }

    /**
     * Returns response
     *
     * @return mixed
     * @throws MethodNotAllowedException
     * @throws RouteNotFoundException
     */
    public function getResponse()
    {
        if (!isset($this->routes[$this->path])){
            throw new RouteNotFoundException('No Route Found');
        }

        if (!in_array($_SERVER['REQUEST_METHOD'], $this->methods[$this->path])) {
            throw new MethodNotAllowedException;
        }
        return $this->routes[$this->path];
    }
}