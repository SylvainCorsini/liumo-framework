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
            $handlerClass = $routeInfo[1][0][0];
            $handlerMethod = $routeInfo[1][0][1];
            $vars = $routeInfo[2];
            $middlewares = $routeInfo[1][1];
            foreach ($middlewares as $middleware) {
                $middlewareClass = $middleware[0];
                $middlewareMethod = $middleware[1];
                if (!class_exists($middlewareClass)) {
                    $this->response->setStatusCode(404);
                    throw new \Exception('Invalid middleware:' . $middlewareClass . '.');
                }
                $middlewareClass = new $middlewareClass($this->response, $this->request);
                if ($middlewareClass->$middlewareMethod() === false) {
                    $this->response->setStatusCode(401);
                    throw new \Exception('401 Unauthorized');
                }
            }
            if (!class_exists($handlerClass)) {
                $this->response->setStatusCode(404);
                throw new \Exception('Invalid controller:' . $handlerClass . '.');
            }
            $handlerClass = new $handlerClass($this->response, $this->request, $this->renderer, $this->query);
            $return = $handlerClass->$handlerMethod($vars);
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