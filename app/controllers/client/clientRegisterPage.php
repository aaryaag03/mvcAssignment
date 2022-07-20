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

        if($username==""){
            echo "<h3>USERNAME CANNOT BE EMPTY</h3>";
            echo \View\Loader::make()->render("templates/clientRegister.twig");
        }
        else if($password==""){
            echo "<h3>PASSWORD CANNOT BE EMPTY</h3>";
            echo \View\Loader::make()->render("templates/clientRegister.twig");
        }

        else if($password1 != $password ){
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
                $password = hash("sha256",$password);
                \Model\Login::register_client($username,$password);
                echo "<h3>CLIENT REGISTERED</h3>";
                echo \View\Loader::make()->render("templates/clientLogin.twig");
            }
        }
    }
}