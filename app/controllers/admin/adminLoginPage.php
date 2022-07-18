<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class adminLoginPage{
    public function get(){
        echo \View\Loader::make()->render("templates/adminLogin.twig");
    }

    public function post(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password = hash("sha256",$password);

        $admin = \Model\Login::verifyAdmin($username,$password);

        if($admin == null){
            //admin has not registered
            echo "YOU ARE NOT AN ADMIN.";
            echo \View\Loader::make()->render("templates/adminLogin.twig");
        }
        else{
            //admin gets logged in
            $_SESSION["a_username"] = $username;
            $_SESSION["a_password"] = $password;
            $instance = new \Controller\adminLoggedInPage();
            $instance->get();
        }
    }
}