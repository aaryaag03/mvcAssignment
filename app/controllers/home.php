<?php

namespace Controller;

class Home{
    public function get(){
        echo \View\Loader::make()->render("templates/index.twig");
    }
}

class Logout{
    public function get(){
        
        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();

        echo \View\Loader::make()->render("templates/index.twig");
    }
}