<?php
namespace App\Controllers;

use Http\HttpResponse;
use Src\Controller;

class TestController extends Controller
{
    public function index()
    {
        return $this->renderer->draw('welcome');
    }
}