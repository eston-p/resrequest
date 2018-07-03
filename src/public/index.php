<?php

require '../vendor/autoload.php';

use App\Config\Config;

$app = new \App\App();

// setting the container
$container = $app->getContainer();

// route not found
$container['errorHandler'] = function () {
    die(404);
};

// setting twig to the container
$container['twig'] = function () {
  $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/app/Views');
  $twig = new Twig_Environment($loader);
  return $twig;
};

// setting config to the container
$config = new Config();
$config->load(dirname(__DIR__) . '/config/database.php');
$container['config'] = function () use ($config) {
    return [
        'host' => $config->get('mysql.host'),
        'db' => $config->get('mysql.database'),
        'user' => $config->get('mysql.user'),
        'pass' => $config->get('mysql.password'),

    ];
};

// setting database to the container
$container['db'] = function ($c) {
  return new PDO(
      "mysql:host={$c->config['host']};dbname={$c->config['db']}", $c->config['user'], $c->config['pass']
    );
};

// routes
$app->get('/', [new App\Controllers\HomeController($container->twig), 'index']);

$app->post('/reservation', [new App\Controllers\ReservationController($container->db), 'store']);

$app->get('/search', [new App\Controllers\ReservationController($container->db, $container->twig), 'search']);

$app->post('/results', [new App\Controllers\ReservationController($container->db, $container->twig), 'show']);

// Bootstraping the application
$app->run();