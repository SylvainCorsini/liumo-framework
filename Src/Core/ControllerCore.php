<?php
namespace Core;

use Core\Rain\Rain;

class ControllerCore
{
    public $view;

    public function __construct()
    {
        $this->view = new Rain();
        $this->view->objectConfigure(array(
            "tpl_dir"   =>  "../App/View",
            "cache_dir" =>  "../Cache"
        ));
    }
}