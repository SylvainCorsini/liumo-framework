<?php
namespace Src;

use Src\Http\Response;
use Src\Http\Request;

/*
 * Middleware Class
 ******************
 *
 * This class will initialize all middlewares dependencies.
 *
 */

class Middleware
{
    public $response;               // Src\Http\Response
    public $request;                // Src\Http\Request

    /**
     * Controller constructor.
     *
     * @param Response $response
     * @param Request $request
     */
    public function __construct(Response $response, Request $request)
    {
        $this->response = $response;
        $this->request = $request;
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