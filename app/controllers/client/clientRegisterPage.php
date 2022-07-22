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
        $confirmPassword = $_POST["confirmPassword"];
        $error="";

        if($username==""){
            $error= "USERNAME CANNOT BE EMPTY";
            echo \View\Loader::make()->render("templates/clientRegister.twig", array(

                "error"=> $error,
                ));
        }
        else if(strlen($password)<4){
            $error= "MINIMUM PASSWORD LENGTH IS 4";
            echo \View\Loader::make()->render("templates/clientRegister.twig", array(

                "error"=> $error,
                ));
        }

        else if($confirmPassword != $password ){
            //if passwords are not identical
            $error="PASSWORDS NOT IDENTICAL";
            echo \View\Loader::make()->render("templates/clientRegister.twig", array(

                "error"=> $error,
                ));
        }
        else{
            $client=\Model\Login::return_client($username);
            
            //if username is already taken
            if($client != null){
                $error= "USERNAME TAKEN";
                echo \View\Loader::make()->render("templates/clientRegister.twig", array(

                    "error"=> $error,
                    ));

            }
            //else request sent successfully
            else{
                $hashPassword = hash("sha256",$password);
                \Model\Login::register_client($username,$hashPassword);
                $error= "CLIENT REGISTERED";
                echo \View\Loader::make()->render("templates/clientLogin.twig", array(

                    "error"=> $error,
                    ));
            }
        }
    }
}