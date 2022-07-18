<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class AllowAdmin{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::allowAdmin($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}