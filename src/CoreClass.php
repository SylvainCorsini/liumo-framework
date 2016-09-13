<?php
namespace Src;

use Src\Http\Response;
use Src\Http\Request;
use Src\QueryBuilder\QueryBuilderHandler;

/*
 * CoreClass
 ***********
 *
 * This class will initialize all bundles classes dependencies.
 *
 */

class CoreClass
{
    public $response;               // Src\Http\Response
    public $request;                // Src\Http\Request
    public $query;                  // Src\QueryBuilder\QB\QueryBuilderHandler

    /**
     * Controller constructor.
     *
     * @param Response $response
     * @param Request $request
     * @param QueryBuilderHandler $queryBuilderHandler
     */
    public function __construct(Response $response, Request $request, QueryBuilderHandler $queryBuilderHandler)
    {
        $this->response = $response;
        $this->request = $request;
        $this->query = $queryBuilderHandler;
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