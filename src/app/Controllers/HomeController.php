<?php

namespace App\Controllers;


class HomeController
{

    protected $container;

    public function __construct($container = null)
    {
        $this->container = $container;
    }

    public function index()
    {
       echo  $this->container->render('home.php');
    }
}