<?php
namespace Src;

use Http\Response;
use Http\Request;
use Src\QueryBuilder\QueryBuilderHandler;
use Src\TemplateEngine\Renderer;

/*
 * Controller Class
 ******************
 *
 * This class will initialize all controllers dependencies.
 *
 */
class Controller
{
    public $response;               // Http\Response
    public $request;                // Http\Request
    public $renderer;               // Src\TemplateEngine\TemplateEngine
    public $query;                  // Src\QueryBuilder\QB\QueryBuilderHandler

    /**
     * Controller constructor.
     *
     * @param Response $response
     * @param Request $request
     * @param Renderer $templateEngine
     * @param QueryBuilderHandler $queryBuilder
     */
    public function __construct(Response $response, Request $request, Renderer $templateEngine, QueryBuilderHandler $queryBuilder)
    {
        $this->response = $response;
        $this->request = $request;
        $this->renderer = $templateEngine;
        $this->query = $queryBuilder;
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @throws \BadMethodCallException
     * @param string $method
     * @param $arguments
     */
    public function __call($method, $arguments)
    {
        throw new \BadMethodCallException("Method [{$method}] does not exist.");
    }
}