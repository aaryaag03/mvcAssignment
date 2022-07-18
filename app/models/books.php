<?php

namespace Model;

class Books{
    public static function my_books($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from books where username = ?');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function book_list() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from books where bool=1');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function is_book_available($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from books where bool=1 and title=?');
        $stmt->execute([$title]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function is_book_in_library($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from books where title=?');
        $stmt->execute([$title]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function is_book_mine($username,$title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from books where title=? and username=? ');
        $stmt->execute([$title, $username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function fine($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT * from client where username = ? ');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function addBook($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into books values(? , 1, "")');
        $stmt->execute([$title]);
    }

    public static function dropBook($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('DELETE from books where title=?');
        $stmt->execute([$title]);
    }
}