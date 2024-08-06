<?php
namespace App;

class Session{

    public static function setUser($user){
        $_SESSION["user"] = $user;
    }

    public static function getUser(){
        return (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
    }

    public static function isAdmin(){
        if(self::getUser() && self::getUser()->hasRole("ADMIN")){
            return true;
        }
        return false;
    }
}