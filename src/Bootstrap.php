
<?php
use Http\HttpRequest;
use Http\HttpResponse;
use Scorsi\TemplateEngine\TemplateEngine;

$request = new HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new HttpResponse();
foreach ($response->getHeaders() as $header) {
    header($header, false);
}

$renderer = new TemplateEngine();
$renderer->objectConfigure(RENDERER_SETTINGS);

require 'Debug.php';

/*
$ormCfg = new \Spot\Config();
$ormCfg->addConnection(ORM_DRIVER, ORM_SETTINGS);
$orm = new \Spot\Locator($ormCfg);
*/

$dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
    $routes = include ('../app/routes.php');
    foreach ($routes as $route) {
        $route[2][0] = 'App\\Controllers\\' . $route[2][0];
        $r->addRoute($route[0], DEFAULT_URI . $route[1], $route[2]);
    }
});

$kernel = new \Src\Kernel($request, $response, $dispatcher, $renderer);

echo $kernel->handle();
