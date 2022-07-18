<?php

namespace Model;

class Login{
    public static function verifyClient($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from client where username = ? and password = ? ');
        $stmt->execute([$username , $password]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function verifyAdmin($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from admin where username = ? and password = ? ');
        $stmt->execute([$username , $password]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function returnClient($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from client where username = ? ');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function returnAdmin($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from admin where username = ?');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function registerClient($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into client values( ? , ? , 0) ');
        $stmt->execute([$username , $password]);
    }

    public static function registerAdmin($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into admin values( "?" , "?" )');
        $stmt->execute([$username , $password]);
    }

}