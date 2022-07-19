<?php

namespace Controller;

//renders the main page of the Library Management System portal

class Home{
    public function get(){
        echo \View\Loader::make()->render("templates/index.twig");
    }
}
