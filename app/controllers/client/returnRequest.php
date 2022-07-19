<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//client can request to return a book

class ReturnRequest{
    public function post(){
        $title=$_POST["title"];

        \Model\Requests::return_request_set_r($_SESSION['c_username'],$title);
        \Model\Requests::return_request_set_books($title);

        $takeTime=\Model\Requests::return_request_take_time($_SESSION['c_username'],$title);
        $currentFees=\Model\Requests::return_request_current_fees($_SESSION['c_username']);

        $returnTime=time();
        if($returnTime-$takeTime[0]["tt"]>60){
            $finalFees = $currentFees[0]["fees"] + 10;
            \Model\Requests::return_request_final_fees($finalFees,$_SESSION['c_username']);
        }

        \Model\Requests::return_request_delete($_SESSION['c_username'],$title);

        $instance = new \Controller\ClientBooks();
        $instance->get();
        
    } 
}