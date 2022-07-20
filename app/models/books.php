<?php

namespace Model;

class Books{
    public static function my_books($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title from r where username = ? and c=3');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function is_book($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title from r where username = ? and title=?');
        $stmt->execute([$username,$title]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function book_list() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title, count from books where count>0');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function is_book_in_library($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title,count from books where title=?');
        $stmt->execute([$title]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function fine($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT fees from client where username = ? ');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function add_new_book($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into books values(?,1)');
        $stmt->execute([$title]);
    }

    public static function add_book($finalCount,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('UPDATE books SET count=? where title=?');
        $stmt->execute([$finalCount,$title]);
    }

    public static function drop_book($finalCount,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('UPDATE books SET count=? where title=?');
        $stmt->execute([$finalCount,$title]);
    }
}