<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ClientLoginPage{
    //renders the login page
    public function get(){
        echo \View\Loader::make()->render("templates/clientLogin.twig");
    }

    //verifies client username and password and logs them in
    public function post(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashPassword = hash("sha256",$password);

        $client = \Model\Login::verify_client($username,$hashPassword);

        //if client has not registered or if password/username is incorrect
        if($client == null){
            
            $error= "INVALID USERNAME OR PASSWORD";
            echo \View\Loader::make()->render("templates/clientLogin.twig", array(

                "error"=> $error,
                ));
        }
        //client gets logged in if credentials are correct
        else{
            $_SESSION["client_username"] = $username;
            $_SESSION["client_password"] = $hashPassword;
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
    }
}