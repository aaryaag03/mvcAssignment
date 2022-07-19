<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can accept a request for a user to become admin

class AllowAdmin{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::delete_request($username,$title);
        \Model\Requests::allow_admin($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}