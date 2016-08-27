<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('test', new Route('/test', array(
    '_controller' => 'ExampleController::test'
)));
$routes->add('home', new Route('/{year}', array(
    'year' => null,
    '_controller' => 'ExampleController::index'
), array(
    'year' => '\d+'
)));

return $routes;
