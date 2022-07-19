<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//renders homepage of client

class ClientLoggedInPage{
    public function get(){
        if (isset($_SESSION['c_username']) && isset($_SESSION['c_password'])) {

            echo \View\Loader::make()->render("templates/clientLoggedIn.twig", array(

            "book_list" => \Model\Books::book_list(),
            "username"=>($_SESSION['c_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
    } 
}





