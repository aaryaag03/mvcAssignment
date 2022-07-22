<?php

namespace Controller;

class AdminRegisterPage{
    //renders the register page
    public function get(){
        echo \View\Loader::make()->render("templates/adminRegister.twig");
    }

    //sends admin request if registration details are valid
    public function post(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $error="";
    
        if($username==""){
            $error= "USERNAME CANNOT BE EMPTY";
            echo \View\Loader::make()->render("templates/adminRegister.twig", array(

                "error"=> $error,
                ));
        }
        else if(strlen($password)<4){
            $error= "MINIMUM PASSWORD LENGTH IS 4";
            echo \View\Loader::make()->render("templates/adminRegister.twig", array(

                "error"=> $error,
                ));
        }

        else if($confirmPassword != $password ){
            //if passwords are not identical
            $error="PASSWORDS NOT IDENTICAL";
            echo \View\Loader::make()->render("templates/adminRegister.twig", array(

                "error"=> $error,
                ));
        }
        else{
            $admin=\Model\Login::return_admin($username);

            //if username is already taken
            if($admin != null){
                $error= "USERNAME TAKEN";
                echo \View\Loader::make()->render("templates/adminRegister.twig", array(

                    "error"=> $error,
                    ));

            }
            //else request sent successfully
            else{
                $hashPassword = hash("sha256",$password);
                \Model\Requests::request_admin($username,$hashPassword);
                $error= "REQUEST SENT";
                echo \View\Loader::make()->render("templates/adminLogin.twig", array(

                    "error"=> $error,
                    ));
            }
        }
    }
}