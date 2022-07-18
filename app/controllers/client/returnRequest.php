<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ReturnRequest{
    public function post(){
        $title=$_POST["title"];
        $data=\Model\Books::is_book_mine($_SESSION['c_username'],$title);
        if($data==null){
            echo "book is not yours to return";
            $instance = new \Controller\ClientBooks();
            $instance->get();
        }
        else{
            \Model\Requests::returnRequest($_SESSION['c_username'],$title);
            $instance = new \Controller\ClientBooks();
            $instance->get();
        }
    } 
}