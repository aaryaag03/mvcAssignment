<?php

namespace Controller;

class ClientRegisterPage{
    public function get(){
        echo \View\Loader::make()->render("templates/clientRegister.twig");
    }

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
            $client=\Model\Login::returnClient($username);
            //if username is taken
            if($client != null){
                echo "USERNAME TAKEN";
                echo \View\Loader::make()->render("templates/clientRegister.twig");

            }
            else{
                $password = hash("sha256",$password);
                \Model\Login::registerClient($username,$password);
                echo "CLIENT REGISTERED";
                echo \View\Loader::make()->render("templates/clientLogin.twig");
            }
        }
    }
}