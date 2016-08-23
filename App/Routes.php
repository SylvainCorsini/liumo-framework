<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/08/2016
 * Time: 20:38
 */

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('leap_year', new Routing\Route('/{year}', array(
    'year' => null,
    '_controller' => 'App\\Controller\\ExampleController::index',
)));

return $routes;
