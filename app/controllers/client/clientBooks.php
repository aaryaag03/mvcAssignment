<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ClientBooks{
    public function get(){
        if (isset($_SESSION['c_username']) && isset($_SESSION['c_password'])) {

            echo \View\Loader::make()->render("templates/clientBooks.twig", array(

            "my_books" => \Model\Books::my_books($_SESSION['c_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
    } 
}





