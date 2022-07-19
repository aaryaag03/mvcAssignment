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
        $password = hash("sha256",$password);

        $admin = \Model\Login::verify_admin($username,$password);

        if($admin == null){
            //if admin has not registered or if password/username is incorrect
            echo "YOU ARE NOT AN ADMIN.";
            echo \View\Loader::make()->render("templates/adminLogin.twig");
        }
        else{
            //admin gets logged in if credentials are correct
            $_SESSION["a_username"] = $username;
            $_SESSION["a_password"] = $password;
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    }
}