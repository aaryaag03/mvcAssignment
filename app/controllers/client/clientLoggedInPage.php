<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//renders homepage of client

class ClientLoggedInPage{
    public function get(){
        if (isset($_SESSION['client_username']) && isset($_SESSION['client_password'])) {

            echo \View\Loader::make()->render("templates/clientLoggedIn.twig", array(

            "book_list" => \Model\Books::book_list(),
            "username"=>$_SESSION['client_username'],
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
    } 
}





