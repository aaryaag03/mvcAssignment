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
            echo "<h3>no such book<h3>";
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
        //book is deleted if it exists
        else if($data[0]["count"]>0){
            $finalCount=$data[0]["count"]-1;
            \Model\Books::drop_book($finalCount,$title);
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    
        else{
            echo "<h3>book not in library<h3>";
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    }
}