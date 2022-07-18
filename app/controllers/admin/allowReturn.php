<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class AllowReturn{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::allowReturn($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}