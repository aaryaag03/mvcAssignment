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

        $data=\Model\Books::is_book_in_library($title);
        $finalCount=$data[0]["count"]+1;
        \Model\Books::add_book($finalCount,$title);
        \Model\Requests::delete_request($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}