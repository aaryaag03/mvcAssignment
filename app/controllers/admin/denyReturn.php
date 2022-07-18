<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class DenyReturn{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::denyReturn($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}