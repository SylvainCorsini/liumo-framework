<?php
namespace App\Controllers;

use Src\Controller;

class TestController extends Controller
{
    public function index()
    {
        $this->renderer->assign('name', $this->request->getParameter('name', 'stranger'));
        return $this->renderer->draw('test');
    }
}