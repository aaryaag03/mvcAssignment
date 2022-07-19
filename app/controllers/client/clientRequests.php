<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ClientRequests{
    public function get(){
        //renders page for client to view their pending requests
        if (isset($_SESSION['c_username']) && isset($_SESSION['c_password'])) {

            echo \View\Loader::make()->render("templates/clientRequests.twig", array(

            "my_requests" => \Model\Requests::my_requests($_SESSION['c_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
    } 
}





