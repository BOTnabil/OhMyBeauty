<?php

namespace Model\Managers;

use App\Connect;

class CommandeManager {

    // mettre ici la requete sql qui va créer les données de la commande et de contenir dans la BDD
    
    private $db;

    public function __construct() {
        $this->db = Connect::seConnecter(); // Initialisation de la connexion à la base de données
    }

    // Méthode pour obtenir tous les services d'une catégorie spécifique
    public function test() {
        $query = "
           
        ";
        $result = $this->db->query($query);

        return $result->fetchAll();
    }
}
