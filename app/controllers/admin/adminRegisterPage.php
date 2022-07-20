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
        $password1 = $_POST["password1"];

        if($username==""){
            echo "<h3>USERNAME CANNOT BE EMPTY</h3>";
            echo \View\Loader::make()->render("templates/adminRegister.twig");
        }
        else if($password==""){
            echo "<h3>PASSWORD CANNOT BE EMPTY</h3>";
            echo \View\Loader::make()->render("templates/adminRegister.twig");
        }

        else if($password1 != $password ){
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
                $password = hash("sha256",$password);
                \Model\Requests::request_admin($username,$password);
                echo "<h3>REQUEST SENT</h3>";
                echo \View\Loader::make()->render("templates/adminLogin.twig");
            }
        }
    }
}