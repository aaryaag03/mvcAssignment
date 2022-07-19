<?php

namespace Controller;

if(!isset($_SESSION)){
    session_start();
}

class ViewRequests{
    public function post(){
        echo \View\Loader::make()->render("templates/requests.twig", array(

        "takeRequests" => \Model\Requests::show_take_requests(),
        "returnRequests" => \Model\Requests::show_return_requests(),
        "adminRequests" => \Model\Requests::show_admin_requests(),
        ));
    }
}