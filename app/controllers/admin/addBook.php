<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can add a book to ther booklist in the library

class AddBook{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_in_library($title);

        //check if book is already in the library
        if($data!=null){
            echo "book already in library";
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
        //if not, book can be added by admin
        else{
            \Model\Books::add_book($title);
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    }
}