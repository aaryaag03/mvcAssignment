<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class AddBook{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_in_library($title);
        if($data!=null){
            echo "book already in library";
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Books::addBook($title);
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    }
}