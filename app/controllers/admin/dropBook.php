<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class DropBook{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_in_library($title);
        if($data==null){
            echo "no such book";
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Books::dropBook($title);
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    }
}