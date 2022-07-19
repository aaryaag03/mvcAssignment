<?php

namespace Model;

class Books{
    public static function my_books($username) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title from books where username = ?');
        $stmt->execute([$username]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function book_list() {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title from books where bool=1');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function is_book_in_library($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('SELECT title from books where title=?');
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

    public static function add_book($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('INSERT into books values(? , 1, "")');
        $stmt->execute([$title]);
    }

    public static function drop_book($title) {
        $db = \DB::get_instance();
        $stmt = $db->prepare('DELETE from books where title=?');
        $stmt->execute([$title]);
    }
}