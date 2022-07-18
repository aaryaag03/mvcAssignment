<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class clientLoggedInPage{
    public function get(){
        if (isset($_SESSION['c_username']) && isset($_SESSION['c_password'])) {

            echo \View\Loader::make()->render("templates/clientLoggedIn.twig", array(

            "book_list" => \Model\Books::book_list(),
            "my_books" => \Model\Books::my_books($_SESSION['c_username']),
            "my_requests" => \Model\Requests::my_requests($_SESSION['c_username']),
            "data" => \Model\Books::fine($_SESSION['c_username']),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/clientLogin.twig");
        }
    } 
}

class TakeRequest{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_available($title);
        if($data==null){
            echo "book not in library";
            $instance = new \Controller\clientLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Requests::takeRequest($_SESSION['c_username'],$title);
            $instance = new \Controller\clientLoggedInPage();
            $instance->get();
        }
    } 
}

class ReturnRequest{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_mine($_SESSION['c_username'],$title);
        if($data==null){
            echo "book is not yours to return";
            $instance = new \Controller\clientLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Requests::returnRequest($_SESSION['c_username'],$title);
            $instance = new \Controller\clientLoggedInPage();
            $instance->get();
        }
    } 
}

