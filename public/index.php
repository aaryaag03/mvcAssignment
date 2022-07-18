<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/clientLogin" => "\Controller\ClientLoginPage",
    "/clientRegister" => "\Controller\ClientRegisterPage",
    "/adminLogin" => "\Controller\AdminLoginPage",
    "/adminRegister" => "\Controller\AdminRegisterPage",

    "/clientLoggedIn"=>"\Controller\ClientLoginPage",
    "/adminLoggedIn"=>"\Controller\AdminLoginPage",

    "/addBook"=>"\Controller\AddBook",
    "/dropBook"=>"\Controller\DropBook",
    "/viewRequests"=>"\Controller\ViewRequests",

    "/takeRequest"=>"\Controller\TakeRequest",
    "/returnRequest"=>"\Controller\ReturnRequest",

    "/allowTake"=>"\Controller\AllowTake",
    "/allowReturn"=>"\Controller\AllowReturn",
    "/allowAdmin"=>"\Controller\AllowAdmin",

    "/denyTake"=>"\Controller\DenyTake",
    "/denyReturn"=>"\Controller\DenyReturn",
    "/denyAdmin"=>"\Controller\DenyAdmin",

    "/keepAdmin"=>"\Controller\AdminLoggedInPage",
    "/keepClient"=>"\Controller\ClientLoggedInPage",

    "/clientBooks"=>"\Controller\ClientBooks",
    "/clientRequests"=>"\Controller\ClientRequests",
    "/clientFine"=>"\Controller\ClientFine",

    "/logout"=>"\Controller\Logout",

));