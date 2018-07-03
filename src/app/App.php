<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{

    /**
     * @var Container
     */
    protected $container;

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->container = new Container([
            'router' => function () {
                return new Router();
            }
        ]);
    }

    /**
     * Getter for container
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Get Method
     *
     * @param $uri
     * @param $handler
     */
    public function get($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['GET']);
    }

    /**
     * Post Method
     *
     * @param $uri
     * @param $handler
     */
    public function post($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['POST']);
    }

    /**
     * Sets up the route and returns a response
     *
     * @return mixed
     */
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

    /**
     * Takes in a callable method eg get(uri, function(){}, method)
     *
     * @param $callable
     * @return mixed
     */
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