<?php
namespace App;

class Session{

    public static function setUser($user){
        $_SESSION["utilisateur"] = $user;
    }

    public static function getUser(){
        return (isset($_SESSION['utilisateur'])) ? $_SESSION['utilisateur'] : false;
    }

    public static function estAdmin(){
        if(self::getUser() && self::getUser()->possedeRole("ADMIN")){
            return true;
        }
        return false;
    }
}