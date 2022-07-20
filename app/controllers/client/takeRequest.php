<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//client can request to take a book

class TakeRequest{
    public function post(){
        $title=$_POST["title"];
        
        $data=\Model\Books::is_book($_SESSION['client_username'],$title);
        if($data==null){
            $data=\Model\Books::is_book_in_library($title);
            $finalCount=$data[\enum\constant::book]["count"]-1;

            \Model\Requests::take_request_set_r($_SESSION['client_username'],$title);
            \Model\Requests::take_request_set_books($finalCount,$title);
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
        else{
            echo "<h3>YOU ALREADY HAVE THIS BOOK</h3>";
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
    
    } 
}