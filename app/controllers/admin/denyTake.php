<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class DenyTake{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::denyTake($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}