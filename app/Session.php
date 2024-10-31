<?php

namespace App;

abstract class Session {

// Méthodes
    public static function estAdmin() {
        // Vérifie si le rôle de l'utilisateur est "ADMIN"
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === "ADMIN";
    }
}