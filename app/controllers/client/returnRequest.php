<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//client can request to return a book

class ReturnRequest{
    public function post(){
        $title=$_POST["title"];
        $data=\Model\Books::is_book_mine($_SESSION['c_username'],$title);

        //checks if book belongs to client, only then it can be returned.

        if($data==null){
            echo "book is not yours to return";
            $instance = new \Controller\ClientBooks();
            $instance->get();
        }
        else{
            \Model\Requests::return_request($_SESSION['c_username'],$title);
            $instance = new \Controller\ClientBooks();
            $instance->get();
        }
    } 
}