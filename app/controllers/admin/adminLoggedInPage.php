<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//renders homepage of admin

class AdminLoggedInPage{
    public function get(){
        if (isset($_SESSION['admin_username']) && isset($_SESSION['admin_password'])) {

            echo \View\Loader::make()->render("templates/adminLoggedIn.twig", array(

            "book_list" => \Model\Books::book_list(),
            "username"=> ($_SESSION['admin_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/adminLogin.twig");
        }
    }
}