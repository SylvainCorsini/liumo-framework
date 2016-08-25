<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Core\ControllerCore;

use App\Model\ExampleModel;

class ExampleController extends ControllerCore
{
    public function index(Request $request, $year)
    {
        if (null === $year) {
            $year = date('Y');
        }
        if  (0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100)) {
            $message = 'Yep, this is a leap year!';
        } else {
            $message = 'Nope, this is not a leap year.';
        }
        $this->template->assign('year', $year);
        $this->template->assign('message', $message);
        $this->template->draw('ExampleView');
        return new Response();
    }
}