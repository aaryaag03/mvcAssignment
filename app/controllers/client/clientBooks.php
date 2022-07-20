<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ClientBooks{
    public function get(){
        //renders page for client to view the books they own
        if (isset($_SESSION['client_username']) && isset($_SESSION['client_password'])) {

            echo \View\Loader::make()->render("templates/clientBooks.twig", array(

            "my_books" => \Model\Books::my_books($_SESSION['client_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
    } 
}





