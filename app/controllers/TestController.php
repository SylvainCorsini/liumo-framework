<?php
namespace App\Controllers;

use Src\Controller;

class TestController extends Controller
{
    public function index()
    {
        return $this->renderer->draw('welcome');
    }
}