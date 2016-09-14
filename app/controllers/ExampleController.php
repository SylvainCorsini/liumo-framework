<?php
namespace App\Controllers;

use Src\CoreController;

class ExampleController extends CoreController
{
    public function index()
    {
        return $this->renderer->draw('welcome');
    }
}