<?php

namespace Controller;

class ClientRegisterPage{
    //renders the register page
    public function get(){
        echo \View\Loader::make()->render("templates/clientRegister.twig");
    }

    //registers fresh client if registration details are valid
    public function post(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password1 = $_POST["password1"];

        if($password1 != $password ){
            //if passwords are not identical
            echo "PASSWORDS NOT IDENTICAL";
            echo \View\Loader::make()->render("templates/clientRegister.twig");
        }
        else{
            $client=\Model\Login::return_client($username);
            
            //if username is already taken
            if($client != null){
                echo "USERNAME TAKEN";
                echo \View\Loader::make()->render("templates/clientRegister.twig");

            }
            //else request sent successfully
            else{
                $password = hash("sha256",$password);
                \Model\Login::register_client($username,$password);
                echo "CLIENT REGISTERED";
                echo \View\Loader::make()->render("templates/clientLogin.twig");
            }
        }
    }
}