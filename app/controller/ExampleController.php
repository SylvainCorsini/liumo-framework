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
        $result = QB::table('example')->select('*')->get();
        if (null === $year) {
            $year = date('Y');
        }
        if  (0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100)) {
            $message = 'Yep, this is a leap year!';
        } else {
            $message = 'Nope, this is not a leap year.';
        }
        TPL::assign('year', $year)
            ->assign('message', $message)
            ->assign('users', $result)
            ->draw('ExampleView');
        return new Response();
    }

    public function test(Request $request)
    {
        return new RedirectResponse(BASE_URL);
    }
}