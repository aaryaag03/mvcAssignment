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
        $data=\Model\Books::is_book_in_library($title);
        $finalCount=$data[\enum\constant::book]["count"]+1;
        \Model\Books::add_book($finalCount,$title);
        \Model\Requests::delete_request($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}