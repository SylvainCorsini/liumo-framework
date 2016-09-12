<?php
/*
 * Bootstrap File
 ****************
 *
 * This file permits to start your application.
 *
 */

use Src\Http\HttpRequest;
use Src\Http\HttpResponse;
use Src\TemplateEngine\Renderer;
use Src\Kernel;
use Src\QueryBuilder;
use Src\Routing\RouteCollector;

$request = new HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new HttpResponse();
foreach ($response->getHeaders() as $header) {
    header($header, false);
}

$renderer = new Renderer();
$renderer->objectConfigure(RENDERER_SETTINGS);

$queryConnection = new QueryBuilder\Connection(DB_DRIVER, DB_CONFIG);
$queryBuilder = new QueryBuilder\QueryBuilderHandler($queryConnection);

require_once 'Debug.php';

(ROUTES_CACHE_ENABLED) ? ($fct = "\\Src\\Routing\\cachedDispatcher") : ($fct = "\\Src\\Routing\\simpleDispatcher");

$dispatcher = call_user_func_array($fct, array(
    function (RouteCollector $r) {
        $routes = include ('../' . ROUTES_FILE);
        foreach ($routes as $route) {
            $route[2][0] = 'App\\Controllers\\' . $route[2][0];
            foreach ($route[3] as $key => $value) {
                $route[3][$key] = 'App\\Middlewares\\' . $value;
            }
            $r->addRoute($route[0], DEFAULT_URI . $route[1], $route[2], $route[3]);
        }
    }, array(
        'cacheFile' => '../' . CACHE_PATH . ROUTES_CACHE_FILENAME,
        'routesFile' => '../' . ROUTES_FILE
    )
));

$kernel = new Kernel($request, $response, $dispatcher, $renderer, $queryBuilder);

echo $kernel->handle();
