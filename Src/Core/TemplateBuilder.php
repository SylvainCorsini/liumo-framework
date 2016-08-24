<?php
namespace Core;

class TemplateBuilder
{
    protected $variables = array();
    protected $view;

    public function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    public function view($filename)
    {
        $this->view = $filename;
    }

    public function render()
    {
        extract($this->variables);
        if (isset($this->view) && file_exists('/App/View/'.$this->view.'.php')) {
            return include '/App/View/'.$this->view.'.php';
        }
        return '';
    }
}