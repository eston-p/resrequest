<?php

namespace App\Controllers;


class HomeController
{

    /**
     * @var null
     */
    protected $container;

    /**
     * HomeController constructor.
     * @param null $container
     */
    public function __construct($container = null)
    {
        $this->container = $container;
    }

    /**
     * Display the index route
     */
    public function index()
    {
       echo  $this->container->render('home.php');
    }
}