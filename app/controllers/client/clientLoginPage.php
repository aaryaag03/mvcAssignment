<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ClientLoginPage{
    public function get(){
        echo \View\Loader::make()->render("templates/clientLogin.twig");
    }

    public function post(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = hash("sha256",$password);

        $client = \Model\Login::verifyClient($username,$password);

        if($client == null){
            //client has not registered
            echo "YOU ARE NOT A CLIENT.";
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
        else{
            //Successful login
            $_SESSION["c_username"] = $username;
            $_SESSION["c_password"] = $password;
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
    }
}