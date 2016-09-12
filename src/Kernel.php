<?php
namespace Src;

use Src\Http\Request;
use Src\Http\Response;
use Src\Routing\Dispatcher;
use Src\QueryBuilder\QueryBuilderHandler;
use Src\TemplateEngine\Renderer;

/*
 * Kernel Class
 **************
 *
 * This class will handle the request for calling your controller.
 *
 */

class Kernel
{
    protected $request;             // Src\Http\Request
    protected $response;            // Src\Http\Response
    protected $dispatcher;          // Src\Routing\Dispatcher
    protected $renderer;            // Src\TemplateEngine\Renderer
    protected $query;               // Src\QueryBuilder\QB\QueryBuilderHandler

    /**
     * Kernel constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param Dispatcher $dispatcher
     * @param Renderer $renderer
     * @param QueryBuilderHandler $queryBuilder
     */
    public function __construct(Request $request, Response $response, Dispatcher $dispatcher, Renderer $renderer, QueryBuilderHandler $queryBuilder)
    {
        $this->request = $request;
        $this->response = $response;
        $this->dispatcher = $dispatcher;
        $this->renderer = $renderer;
        $this->query = $queryBuilder;
    }

    /**
     * Handle request.
     *
     * @throws \Exception
     * @return string
     */
    public function handle()
    {
        $routeInfo = $this->dispatcher->dispatch($this->request->getMethod(), $this->request->getPath());
        if ($routeInfo[0] == Dispatcher::NOT_FOUND) {
            $this->response->setStatusCode(404);
            throw new \Exception('404 Not Found');
        } elseif ($routeInfo[0] == Dispatcher::METHOD_NOT_ALLOWED) {
            $this->response->setStatusCode(405);
            throw new \Exception('405 Method Not Allowed');
        } elseif ($routeInfo[0] == Dispatcher::FOUND) {
            $handler = $routeInfo[1][0];
            $vars = $routeInfo[2];
            $middlewares = $routeInfo[1][1];
            foreach ($middlewares as $middleware) {
                if (!class_exists($middleware[0])) {
                    $this->response->setStatusCode(404);
                    throw new \Exception('Invalid middleware:' . $middleware[0] . '.');
                }
                $middleware[0] = new $middleware[0]($this->response, $this->request);
                if ($middleware[0]->$middleware[1]() === false) {
                    $this->response->setStatusCode(401);
                    throw new \Exception('401 Unauthorized');
                }
            }
            if (!class_exists($handler[0])) {
                $this->response->setStatusCode(404);
                throw new \Exception('Invalid controller:' . $handler[0] . '.');
            }
            $handler[0] = new $handler[0]($this->response, $this->request, $this->renderer, $this->query);
            $return = $handler[0]->$handler[1]($vars);
            if (is_string($return)) {
                $this->response->setContent($return);
            } elseif (is_object($return) && is_a($return, 'Http\HttpResponse')) {
                $this->response = $return;
            } else {
                $this->response->setStatusCode(204);
            }
        }
        return $this->response->returnResponse();
    }
}