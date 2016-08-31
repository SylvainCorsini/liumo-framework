<?php
namespace Src;

use Http\Request;
use Http\Response;
use FastRoute\Dispatcher;
use Scorsi\QueryBuilder\QB\QueryBuilderHandler;
use Scorsi\TemplateEngine\TemplateEngine;

/*
 * Kernel Class
 **************
 *
 * This class will handle the request for calling your controller.
 *
 */
class Kernel
{
    protected $request;             // Http\Request
    protected $response;            // Http\Response
    protected $dispatcher;          // FastRoute\Dispatcher
    protected $renderer;            // Scorsi\TemplateEngine\TemplateEngine
    protected $query;               // Scorsi\QueryBuilder\QB\QueryBuilderHandler

    /**
     * Kernel constructor.
     *
     * @param Request $request
     * @param Response $response
     * @param Dispatcher $dispatcher
     * @param TemplateEngine $renderer
     * @param QueryBuilderHandler $queryBuilder
     */
    public function __construct(Request $request, Response $response, Dispatcher $dispatcher, TemplateEngine $renderer, QueryBuilderHandler $queryBuilder)
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
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                $this->response->setStatusCode(404);
                throw new \Exception('404 page not found');
            case Dispatcher::METHOD_NOT_ALLOWED:
                $this->response->setStatusCode(405);
                throw new \Exception('405 method not allowed');
            case Dispatcher::FOUND:
                $className = $routeInfo[1][0];
                $method = $routeInfo[1][1];
                $vars = $routeInfo[2];
                if (!class_exists($className)) {
                    $this->response->setStatusCode(404);
                    throw new \Exception('Invalid controller:' . $className);
                }
                $class = new $className($this->response, $this->request, $this->renderer, $this->query);
                $content = $class->$method($vars);
                $this->response->setContent($content);
        }
        return $this->response->getContent();
    }
}