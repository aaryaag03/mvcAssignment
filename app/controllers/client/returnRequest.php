<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

//client can request to return a book

class ReturnRequest{
    public function post(){
        $title=$_POST["title"];

        \Model\Requests::return_request_set_r($_SESSION['client_username'],$title);

        $takeTime=\Model\Requests::return_request_take_time($_SESSION['client_username'],$title);
        $currentFees=\Model\Requests::return_request_current_fees($_SESSION['client_username']);

        $returnTime=time();
        if($returnTime-$takeTime[0]["tt"]>60){
            $finalFees = $currentFees[0]["fees"] + 10;
            \Model\Requests::return_request_final_fees($finalFees,$_SESSION['client_username']);
        }

        \Model\Requests::return_request_delete($_SESSION['client_username'],$title);

        $instance = new \Controller\ClientBooks();
        $instance->get();
        
    } 
}