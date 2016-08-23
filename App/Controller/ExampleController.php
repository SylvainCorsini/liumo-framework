<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/08/2016
 * Time: 21:19
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Model\ExampleModel;

class ExampleController
{
    public function index(Request $request, $year)
    {
        $leapyear = new ExampleModel();
        if ($leapyear->isLeapYear($year)) {
            return new Response('Yep, this is a leap year!');
        }
        return new Response('Nope, this is not a leap year.');
    }
}