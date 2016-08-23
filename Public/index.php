<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/08/2016
 * Time: 20:17
 */

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../App/routes.php';

$framework = new Core\Framework($routes);

$framework->handle($request)->send();