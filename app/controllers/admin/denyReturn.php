<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can deny a return request for a book by a client

class DenyReturn{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::allow_take_deny_return($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}