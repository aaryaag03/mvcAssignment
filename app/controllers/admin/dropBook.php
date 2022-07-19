<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//admin can delete a book from the library

class DropBook{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_in_library($title);

        //if the book does not exist in the library, it can't be deleted
        if($data==null){
            echo "no such book";
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
        //book is deleted if it exists
        else{
            \Model\Books::drop_book($title);
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    }
}