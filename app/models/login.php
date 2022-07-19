<?php

namespace Model;

class Login{
    public static function verify_client($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT username from client where username = ? and password = ? ');
        $stmt->execute([$username , $password]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function verify_admin($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT username from admin where username = ? and password = ? ');
        $stmt->execute([$username , $password]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function return_client($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT username from client where username = ? ');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function return_admin($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT username from admin where username = ?');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function register_client($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into client values( ? , ? , 0) ');
        $stmt->execute([$username , $password]);
    }

    public static function register_admin($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into admin values( "?" , "?" )');
        $stmt->execute([$username , $password]);
    }

}