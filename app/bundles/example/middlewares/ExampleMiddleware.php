<?php
namespace App\Bundles\Example\Middlewares;

use Src\CoreMiddleware;

class ExampleMiddleware extends CoreMiddleware
{
    public function handler()
    {
        return true;
    }
}