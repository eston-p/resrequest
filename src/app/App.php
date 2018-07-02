<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{
    protected $container;

    public function __construct()
    {
        $this->container = new Container([
            'router' => function () {
                return new Router();
            }
        ]);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function get($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['GET']);
    }

    public function post($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['POST']);
    }

    public function map($uri, $handler, array $methods = ['GET'])
    {
        $this->container->router->addRoute($uri, $handler, $methods);
    }

    public function run()
    {
        $router = $this->container->router;
        $router->setPath($_SERVER['REQUEST_URI'] ?? '/');
        try {
            $response = $router->getResponse();
        } catch (\Exception $e) {
            if ($this->container->has('errorHandler')) {
                $response = $this->container->errorHandler;
            } else {
                return;
            }
        }

        return $this->process($response);
    }

    protected function process($callable)
    {
        $response = $this->container->response;
        if (is_array($callable)) {

            if (!is_object($callable[0])) {
                $callable[0] = new $callable[0];
            }
            return call_user_func($callable, $response);
        }
        return $callable($response);
    }
}