<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/clientLogin" => "\Controller\clientLoginPage",
    "/clientRegister" => "\Controller\clientRegisterPage",
    "/adminLogin" => "\Controller\adminLoginPage",
    "/adminRegister" => "\Controller\adminRegisterPage",

    "/clientLoggedIn"=>"\Controller\clientLoginPage",
    "/adminLoggedIn"=>"\Controller\adminLoginPage",

    "/addBook"=>"\Controller\AddBook",
    "/dropBook"=>"\Controller\DropBook",
    "/viewRequests"=>"\Controller\ViewRequests",

    "/takeRequest"=>"\Controller\TakeRequest",
    "/returnRequest"=>"\Controller\ReturnRequest",

    "/allowTake"=>"\Controller\AllowTake",
    "/allowReturn"=>"\Controller\AllowReturn",
    "/allowAdmin"=>"\Controller\AllowAdmin",

    "/logout"=>"\Controller\Logout",

));