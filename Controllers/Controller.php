<?php

namespace Controllers;


use Models\Settings;
use Models\View;

class Controller
{
    protected $view;
    public function __construct()
    {
        $this->view = new View();
        $this->view->title = Settings::SITE_TITLE;
        $this->view->description = Settings::SITE_DESCRIPTION;
        $this->view->server = $_SERVER['SERVER_NAME'];
    }

}