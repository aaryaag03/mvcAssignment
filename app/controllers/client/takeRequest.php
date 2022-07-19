<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//client can request to take a book

class TakeRequest{
    public function post(){
        $title=$_POST["title"];
    
        \Model\Requests::take_request_set_r($_SESSION['c_username'],$title);
        \Model\Requests::take_request_set_books($title);
        $instance = new \Controller\ClientLoggedInPage();
        $instance->get();
    
    } 
}