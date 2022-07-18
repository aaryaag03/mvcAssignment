<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class TakeRequest{
    public function post(){
        $title=$_POST["title"];
        $data=\Model\Books::is_book_available($title);
        if($data==null){
            echo "book not in library";
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Requests::takeRequest($_SESSION['c_username'],$title);
            $instance = new \Controller\ClientLoggedInPage();
            $instance->get();
        }
    } 
}