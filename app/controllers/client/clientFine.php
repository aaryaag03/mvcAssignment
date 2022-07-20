<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ClientFine{
    public function get(){
        //renders page for client to view the fine they owe
        if (isset($_SESSION['client_username']) && isset($_SESSION['client_password'])) {

            echo \View\Loader::make()->render("templates/clientFine.twig", array(

            "data" => \Model\Books::fine($_SESSION['client_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
    } 
}





