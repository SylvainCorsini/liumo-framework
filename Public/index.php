<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../Src/Config/Config.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;

if (DEVELOPMENT_ENVIRONMENT == true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'On');
    ini_set('error_log', __DIR__.'/../Log/Error.log');
}

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../App/Routes.php';

foreach ($routes->all() as $item) {
    if ($item->hasDefault('_controller')) {
        $item->setDefault('_controller', '\\App\\Controller\\'.$item->getDefault('_controller'));
    }
}

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();
$dispatcher = new EventDispatcher();

$framework = new Core\Kernel($dispatcher, $matcher, $resolver);
$framework = new HttpKernel\HttpCache\HttpCache($framework, new HttpKernel\HttpCache\Store(__DIR__.'/../cache'));

$framework->handle($request)->send();