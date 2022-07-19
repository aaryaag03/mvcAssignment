<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can accept a take request for a book by a client

class AllowTake{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::delete_request($username,$title);
        \Model\Requests::allow_take($username,$title);
        \Model\Requests::allow_take_set_time($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}