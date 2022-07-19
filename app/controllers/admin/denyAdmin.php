<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can deny a request for a user to become admin

class DenyAdmin{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::deny_admin($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}