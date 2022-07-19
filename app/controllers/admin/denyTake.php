<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can deny a take request for a book by a client

class DenyTake{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::deny_take($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}