<?php
namespace App;

class Session {
    public static function setUser($user) {
        $_SESSION["user"] = $user;
    }

    public static function getUser() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }

    public static function estAdmin() {
        // Vérifie si le rôle de l'utilisateur est "ADMIN"
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === "ADMIN";
    }

    public static function getRole() {
        // Retourne le rôle de l'utilisateur connecté
        return isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
    }
}