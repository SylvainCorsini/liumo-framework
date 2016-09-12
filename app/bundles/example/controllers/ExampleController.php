<?php
namespace App\Bundles\Example\Controllers;

use Src\Controller;

class ExampleController extends Controller
{
    public function index()
    {
        return $this->renderer->draw('welcome');
    }
}