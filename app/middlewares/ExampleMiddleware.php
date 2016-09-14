<?php
namespace App\Middlewares;

use Src\CoreMiddleware;

class ExampleMiddleware extends CoreMiddleware
{
    public function handler()
    {
        return true;
    }
}