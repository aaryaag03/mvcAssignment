<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class AdminLoggedInPage{
    public function get(){
        if (isset($_SESSION['a_username']) && isset($_SESSION['a_password'])) {

            echo \View\Loader::make()->render("templates/adminLoggedIn.twig", array(

            "book_list" => \Model\Books::book_list(),
            "username"=> ($_SESSION['a_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/adminLogin.twig");
        }
    }
}