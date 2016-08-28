<?php
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
    ini_set('error_log', __DIR__.'/../../log/error.log');
}

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../../app/routes.php';

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

$framework->handle($request)->send();