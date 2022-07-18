<?php

namespace Model;

class Requests{
    public static function my_requests($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from r where username = ?');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    //c=0 for take requests, c=1 for return requests, c=2 for admin requests

    public static function requestAdmin($username,$password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into r values( ?, ?, 2)');
        $stmt->execute([$username , $password]);
    }

    public static function takeRequest($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into r values( ?, ?, 0)');
        $stmt->execute([$username , $title]);
        $stmt = $db->prepare('UPDATE books SET bool= 0 where title=?');
        $stmt->execute([$title]);
        
    }

    public static function returnRequest($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into r values( ?, ?, 1)');
        $stmt->execute([$username , $title]);

        $stmt = $db->prepare('UPDATE books SET username="" where title=?');
        $stmt->execute([$title]);

        // $stmt = $db->prepare('SELECT * from dates where title=?');
        // $stmt->execute([$title]);
        // $rows = $stmt->fetchAll();

        // $stmt = $db->prepare('SELECT * from client where username=?');
        // $stmt->execute([$username]);
        // $rows1 = $stmt->fetchAll();
        // echo $rows1[0]["fees"];
        // $rt=mktime();
        // if($rt-$rows[0]["tt"]>60000){
        //     ($rows1[0]["fees"] )= $rows1[0]["fees"] + 10;
        //     $stmt = $db->prepare('UPDATE client SET fees=? where username=?');
        //     $stmt->execute([$rows1[0]["fees"],$username]); 
        // }

        // $stmt = $db->prepare('DELETE from dates where title=?');
        // $stmt->execute([$title]);
    }

    public static function showTakeRequests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from r where c=0');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function showReturnRequests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from r where c=1');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function showAdminRequests() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from r where c=2');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public function allowTake($username,$title){
        $db = \DB::get_instance();
        $stmt = $db->prepare('DELETE from r where username=? and title=?');
        $stmt->execute([$username,$title]);
        $stmt = $db->prepare('UPDATE books SET username=? where title=?');
        $stmt->execute([$username,$title]);    
    }

    public function allowReturn($username,$title){
        $db = \DB::get_instance();
        $stmt = $db->prepare('DELETE from r where username=? and title=?');
        $stmt->execute([$username,$title]);
        $stmt = $db->prepare('UPDATE books SET username="",bool=1 where title=?');
        $stmt->execute([$title]);    
    }

    public function allowAdmin($username,$title){
        $db = \DB::get_instance();
        $stmt = $db->prepare('DELETE from r where username=? and title=?');
        $stmt->execute([$username,$title]);
        $stmt = $db->prepare('INSERT into admin values( ?, ?)');
        $stmt->execute([$username,$title]);    
    }   
}