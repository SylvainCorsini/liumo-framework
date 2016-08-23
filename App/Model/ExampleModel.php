<?php
/**
 * Created by PhpStorm.
 * User: Sylvain
 * Date: 23/08/2016
 * Time: 21:21
 */

namespace App\Model;

class ExampleModel
{
    public function isLeapYear($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }
        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
}