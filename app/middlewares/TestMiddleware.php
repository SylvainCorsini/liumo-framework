<?php
namespace App\Middlewares;

use Src\Middleware;

class TestMiddleware extends Middleware
{
    public function index()
    {
        return true;
    }
}