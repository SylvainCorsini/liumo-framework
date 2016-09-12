<?php
namespace App\Bundles\Example\Middlewares;

use Src\Middleware;

class ExampleMiddleware extends Middleware
{
    public function handler()
    {
        return true;
    }
}