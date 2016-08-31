<?php

namespace Models;

class View
    implements \Countable
{

    protected $data;

    public function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }

    public function __isset($prop)
    {
        return isset($this->data[$prop]);
    }

    public function __get($prop)
    {
        return $this->data[$prop];
    }

    public function render($template)
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    public function count()
    {
        return count($this->data);
    }
}