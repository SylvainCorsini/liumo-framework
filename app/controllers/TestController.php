<?php
namespace App\Controllers;

use Src\Controller;

class TestController extends Controller
{
    public function index()
    {
        $users = $this->query->table('example')->select('*')->get();
        $this->renderer->assign(array(
                'name' => $this->request->getParameter('name', 'stranger'),
                'users' => $users
            ));
        return $this->renderer->draw('test');
    }
}