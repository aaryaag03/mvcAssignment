<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class DenyAdmin{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::denyAdmin($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}