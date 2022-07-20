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
    
        if($username==""){
            echo "<h3>USERNAME CANNOT BE EMPTY</h3>";
            echo \View\Loader::make()->render("templates/adminRegister.twig");
        }
        else if(strlen($password)<4){
            echo "<h3>MINIMUM PASSWORD LENGTH IS 4</h3>";
            echo \View\Loader::make()->render("templates/adminRegister.twig");
        }

        else if($confirmPassword != $password ){
            //if passwords are not identical
            echo "<h3>PASSWORDS NOT IDENTICAL</h3>";
            echo \View\Loader::make()->render("templates/adminRegister.twig");
        }
        else{
            $admin=\Model\Login::return_admin($username);

            //if username is already taken
            if($admin != null){
                echo "<h3>USERNAME TAKEN</h3>";
                echo \View\Loader::make()->render("templates/adminRegister.twig");

            }
            //else request sent successfully
            else{
                $hashPassword = hash("sha256",$password);
                \Model\Requests::request_admin($username,$hashPassword);
                echo "<h3>REQUEST SENT</h3>";
                echo \View\Loader::make()->render("templates/adminLogin.twig");
            }
        }
    }
}