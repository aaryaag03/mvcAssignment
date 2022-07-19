<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can accept a return request for a book by a client

class AllowReturn{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::allow_return($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}