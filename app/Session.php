<?php
namespace App;

class Session{

    public static function setUser($user){
        $_SESSION["utilisateur"] = $user;
    }

    public static function getUser(){
        return (isset($_SESSION['utilisateur'])) ? $_SESSION['utilisateur'] : false;
    }

    public static function isAdmin(){
        if(self::getUser() && self::getUser()->hasRole("ADMIN")){
            return true;
        }
        return false;
    }
}