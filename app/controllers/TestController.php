<?php
namespace App\Controllers;

use Src\Controller;

class TestController extends Controller
{
    public function index()
    {
        $users = $this->query->table('example')->select('*')->get();
        $this->renderer
            ->assign('name', $this->request->getParameter('name', 'stranger'))
            ->assign('users', $users);
        return $this->renderer->draw('test');
    }
}