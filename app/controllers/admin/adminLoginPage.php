<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class AdminLoginPage{
    //renders the login page 
    public function get(){
        echo \View\Loader::make()->render("templates/adminLogin.twig");
    }
    
    //verifies admin username and password and logs them in
    public function post(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashPassword = hash("sha256",$password);
        $error="";

        $admin = \Model\Login::verify_admin($username,$hashPassword);

        if($admin == null){
            //if admin has not registered or if password/username is incorrect
            $error="INVALID USERNAME OR PASSWORD";
            echo \View\Loader::make()->render("templates/adminLogin.twig", array(

                "error"=> $error,
                ));
        }
        else{
            //admin gets logged in if credentials are correct
            $_SESSION["admin_username"] = $username;
            $_SESSION["admin_password"] = $hashPassword;
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    }
}