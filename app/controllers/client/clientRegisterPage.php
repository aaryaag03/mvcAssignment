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

        if($username==""){
            echo "<h3>USERNAME CANNOT BE EMPTY</h3>";
            echo \View\Loader::make()->render("templates/clientRegister.twig");
        }
        else if(strlen($password)<4){
            echo "<h3>MINIMUM PASSWORD LENGTH IS 4</h3>";
            echo \View\Loader::make()->render("templates/clientRegister.twig");
        }

        else if($confirmPassword != $password ){
            //if passwords are not identical
            echo "<h3>PASSWORDS NOT IDENTICAL</h3>";
            echo \View\Loader::make()->render("templates/clientRegister.twig");
        }
        else{
            $client=\Model\Login::return_client($username);
            
            //if username is already taken
            if($client != null){
                echo "<h3>USERNAME TAKEN</h3>";
                echo \View\Loader::make()->render("templates/clientRegister.twig");

            }
            //else request sent successfully
            else{
                $hashPassword = hash("sha256",$password);
                \Model\Login::register_client($username,$hashPassword);
                echo "<h3>CLIENT REGISTERED</h3>";
                echo \View\Loader::make()->render("templates/clientLogin.twig");
            }
        }
    }
}