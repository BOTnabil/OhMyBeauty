<?php

namespace App;

abstract class Connect {

    const HOST = "localhost";
    const DB = "ohmybeauty";
    const USER = "root";
    const PASS = "";
    
// Méthodes
    public static function seConnecter(){
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        } catch (\PDOException $ex) {
            return $ex->getMessage();
        }
    }
}
