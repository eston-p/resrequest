<?php

require '../vendor/autoload.php';
use App\Config\Config;
$app = new \App\App();

$container = $app->getContainer();

$container['errorHandler'] = function () {

};

$baseUrl = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']. '';

$container['twig'] = function () {
  $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/app/Views');
  $twig = new Twig_Environment($loader);
  return $twig;
};


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
$container['db'] = function ($c) {
  return new PDO(
      "mysql:host={$c->config['host']};dbname={$c->config['db']}", $c->config['user'], $c->config['pass']
    );
};

$app->get('/', [new App\Controllers\HomeController($container->twig), 'index']);

$app->post('/reservation', [new App\Controllers\ReservationController($container->db), 'store']);

$app->get('/view/reservation', [new App\Controllers\ReservationController($container->db), 'index']);

$app->map('/users', function () {
    echo 'Users';
}, ['GET', 'POST']);


$app->run();