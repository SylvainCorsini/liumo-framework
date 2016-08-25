<?php
namespace Core;

use Core\Rain\Rain;

class ControllerCore
{
    public $template;

    public function __construct()
    {
        $this->template = new Rain();
        $this->template->objectConfigure(array(
            "tpl_dir"   =>  "../App/View",
            "cache_dir" =>  "../Cache"
        ));
    }
}