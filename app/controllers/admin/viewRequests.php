<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
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