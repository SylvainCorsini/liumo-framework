<?php
namespace Src;

use Http\Response;
use Http\Request;
use Scorsi\TemplateEngine\TemplateEngine;

class Controller
{
    public $response;
    public $request;
    public $renderer;

    public function __construct(Response $response, Request $request, TemplateEngine $templateEngine)
    {
        $this->response = $response;
        $this->request = $request;
        $this->renderer = $templateEngine;
    }
}