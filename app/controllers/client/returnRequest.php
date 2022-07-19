<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//client can request to return a book

class ReturnRequest{
    public function post(){
        $title=$_POST["title"];

        \Model\Requests::return_request($_SESSION['c_username'],$title);
        $instance = new \Controller\ClientBooks();
        $instance->get();
        
    } 
}