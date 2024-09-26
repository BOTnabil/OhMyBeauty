<?php
namespace App;

class Session {

// Setters et getters
    public static function setUser($user) {
        $_SESSION["user"] = $user;
    }

    public static function getUser() {
        return isset($_SESSION['user']) ? $_SESSION['user'] : false;
    }

// Méthodes
    public static function estAdmin() {
        // Vérifie si le rôle de l'utilisateur est "ADMIN"
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === "ADMIN";
    }
}