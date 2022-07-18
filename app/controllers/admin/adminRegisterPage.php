<?php

namespace Controller;

class adminRegisterPage{
    public function get(){
        echo \View\Loader::make()->render("templates/adminRegister.twig");
    }

    public function post(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password1 = $_POST["password1"];

        if($password1 != $password ){
            //if passwords are not identical
            echo "PASSWORDS NOT IDENTICAL";
            echo \View\Loader::make()->render("templates/adminRegister.twig");
        }
        else{
            $admin=\Model\Login::returnAdmin($username);
            //if username is taken
            if($admin != null){
                echo "USERNAME TAKEN";
                echo \View\Loader::make()->render("templates/adminRegister.twig");

            }
            else{
                $password = hash("sha256",$password);
                \Model\Requests::requestAdmin($username,$password);
                echo "REQUEST SENT";
                echo \View\Loader::make()->render("templates/adminLogin.twig");
            }
        }
    }
}