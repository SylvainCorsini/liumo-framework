<?php
namespace Src;

use Http\Request;
use Http\Response;
use FastRoute\Dispatcher;
use Scorsi\TemplateEngine\TemplateEngine;

class Kernel
{
    protected $request;
    protected $response;
    protected $dispatcher;
    protected $renderer;

    public function __construct(Request $request, Response $response, Dispatcher $dispatcher, TemplateEngine $renderer)
    {
        $this->request = $request;
        $this->response = $response;
        $this->dispatcher = $dispatcher;
        $this->renderer = $renderer;
    }

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
                $class = new $className($this->response, $this->request, $this->renderer);
                $content = $class->$method($vars);
                $this->response->setContent($content);
                break ;
        }
        return $this->response->getContent();
    }
}