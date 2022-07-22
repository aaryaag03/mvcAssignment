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

        $error="";

        //if the book does not exist in the library, it can't be deleted
        if($data==null){
            $error= "no such book";

            echo \View\Loader::make()->render("templates/adminLoggedIn.twig", array(

                "book_list" => \Model\Books::book_list(),
                "username"=> ($_SESSION['admin_username']),
                "error"=>$error,
                ));
        }
        //book is deleted if it exists
        else if($data[\enum\constant::book]["count"]>0){
            $finalCount=$data[\enum\constant::book]["count"]-1;
            \Model\Books::drop_book($finalCount,$title);
            $instance = new \Controller\AdminLoggedInPage();
            $instance->get();
        }
    
        else{
            $error="book not in library";
            echo \View\Loader::make()->render("templates/adminLoggedIn.twig", array(

                "book_list" => \Model\Books::book_list(),
                "username"=> ($_SESSION['admin_username']),
                "error"=>$error,
                ));
        }
    }
}