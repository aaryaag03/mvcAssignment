<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class adminLoggedInPage{
    public function get(){
        if (isset($_SESSION['a_username']) && isset($_SESSION['a_password'])) {

            echo \View\Loader::make()->render("templates/adminLoggedIn.twig", array(

            "book_list" => \Model\Books::book_list(),
            ));
        }
        else
        {
            echo \View\Loader::make()->render("templates/adminLogin.twig");
        }
    }
    
}

class ViewRequests{
    public function post(){
        echo \View\Loader::make()->render("templates/requests.twig", array(

        "takeRequests" => \Model\Requests::showTakeRequests(),
        "returnRequests" => \Model\Requests::showReturnRequests(),
        "adminRequests" => \Model\Requests::showAdminRequests(),
        ));
    }
}

class AddBook{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_in_lib($title);
        if($data!=null){
            echo "book already in library";
            $instance = new \Controller\adminLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Books::addBook($title);
            $instance = new \Controller\adminLoggedInPage();
            $instance->get();
        }
    }
}

class DropBook{
    public function post(){
        $title=$_POST["bookname"];
        $data=\Model\Books::is_book_in_lib($title);
        if($data==null){
            echo "no such book";
            $instance = new \Controller\adminLoggedInPage();
            $instance->get();
        }
        else{
            \Model\Books::dropBook($title);
            $instance = new \Controller\adminLoggedInPage();
            $instance->get();
        }
    }
}

class AllowTake{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::allowTake($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}

class AllowReturn{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::allowReturn($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}

class AllowAdmin{
    public function post(){
        $title=$_POST["title"];
        $username=$_POST["username"];
        \Model\Requests::allowAdmin($username,$title);
        $instance = new \Controller\ViewRequests();
        $instance->post();
    }
}