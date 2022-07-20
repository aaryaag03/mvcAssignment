<?php

namespace Model;

class Requests{
    public static function my_requests($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title,c from r where username = ?');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    //c=0 for take requests, c=1 for return requests, c=2 for admin requests, c=3 for take request granted.

    public static function request_admin($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into r values( ?, ?, 2)');
        $stmt->execute([$username , $password]);
    }

    public static function take_request_set_r($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into r values( ?, ?, 0)');
        $stmt->execute([$username , $title]);
    }

    public static function take_request_set_books($finalCount,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('UPDATE books SET count=? where title=?');
        $stmt->execute([$finalCount,$title]);
    }

    public static function return_request_set_r($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('UPDATE r SET c=1 where username=? and title=?');
        $stmt->execute([$username , $title]);
    }

    // public static function return_request_set_books($title) {
    //     $db = \DB::get_instance();
    //     $stmt = $db->prepare('UPDATE books SET username="" where title=?');
    //     $stmt->execute([$title]);
    // }

    public static function return_request_take_time($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT tt from dates where title=? and username=?');
        $stmt->execute([$title,$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function return_request_current_fees($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT fees from client where username=?');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function return_request_final_fees($finalFees,$username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('UPDATE client SET fees=? where username=?');
        $stmt->execute([$finalFees,$username]);
    }

    public static function return_request_delete($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('DELETE from dates where title=? and username=?');
        $stmt->execute([$title, $username]);
    }

    public static function show_take_requests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT username,title from r where c=0');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function show_return_requests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT username,title from r where c=1');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function show_admin_requests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT username,title from r where c=2');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public function allow_take_deny_return($username,$title){
        $db = \DB::get_instance();
        $stmt = $db->prepare('UPDATE r SET c=3 where username=? and title=?');
        $stmt->execute([$username,$title]); 
    }

    public function allow_take_set_time($username,$title){
        $db = \DB::get_instance();
        $taketime=time();
        $stmt = $db->prepare('INSERT into dates SET username=?, title=?, tt=?');
        $stmt->execute([$username,$title,$taketime]);

    }

    public function allow_admin($username,$title){
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into admin values( ?, ?)');
        $stmt->execute([$username,$title]);    
    }   

    public function delete_request($username,$title){
        $db = \DB::get_instance();
        $stmt = $db->prepare('DELETE from r where username=? and title=?');
        $stmt->execute([$username,$title]);  
    }
}