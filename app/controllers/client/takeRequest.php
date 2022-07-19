<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//client can request to take a book

class TakeRequest{
    public function post(){
        $title=$_POST["title"];
        $data=\Model\Books::is_book_available($title);

        //checks if book is in library, only then take request can be made

        if($data==null){
            echo "book not in library";
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Requests::take_request($_SESSION['c_username'],$title);
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
    } 
}