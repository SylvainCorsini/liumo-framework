<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use QB;
use TPL;

class ExampleController
{
    public function index(Request $request, $year)
    {
        $users = QB::table('example')->select('*')->get();
        TPL::assign('users', $users);
        TPL::assign('test1', "<h1>test</h1>");
        TPL::assign('test2', "<h1>test</h1>");
        TPL::draw('test');
    }
}