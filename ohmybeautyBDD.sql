-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour ohmybeauty
CREATE DATABASE IF NOT EXISTS `ohmybeauty` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ohmybeauty`;

-- Listage de la structure de table ohmybeauty. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.categorie : ~4 rows (environ)
DELETE FROM `categorie`;
INSERT INTO `categorie` (`idCategorie`, `designation`) VALUES
	(1, 'CILS'),
	(2, 'CAPILAIRE'),
	(3, 'SOIN DU VISAGE'),
	(4, 'ONGLERIE');

-- Listage de la structure de table ohmybeauty. commande
CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int NOT NULL AUTO_INCREMENT,
  `dateCommande` date NOT NULL,
  `prixTotal` decimal(15,2) NOT NULL,
  `idUtilisateur` int NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `idUtilisateur` (`idUtilisateur`),
  CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.commande : ~0 rows (environ)
DELETE FROM `commande`;

-- Listage de la structure de table ohmybeauty. contenir
CREATE TABLE IF NOT EXISTS `contenir` (
  `idCommande` int NOT NULL,
  `idProduit` int NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`idCommande`,`idProduit`),
  KEY `idProduit` (`idProduit`),
  CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.contenir : ~0 rows (environ)
DELETE FROM `contenir`;

-- Listage de la structure de table ohmybeauty. prestation
CREATE TABLE IF NOT EXISTS `prestation` (
  `idPrestation` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `duree` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT ' ',
  `idCategorie` int NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`idPrestation`),
  KEY `idCategorie` (`idCategorie`),
  CONSTRAINT `prestation_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.prestation : ~20 rows (environ)
DELETE FROM `prestation`;
INSERT INTO `prestation` (`idPrestation`, `designation`, `prix`, `duree`, `idCategorie`, `description`) VALUES
	(1, 'Réhaussement', 35.00, '45min', 1, 'test description'),
	(2, 'Extension pose naturelle', 50.00, '45min', 1, 'test description'),
	(3, 'Extension pose mixte', 60.00, '45min', 1, 'test description'),
	(4, 'Remplissage naturel', 30.00, '45min', 1, 'test description'),
	(5, 'Remplissage mixte', 35.00, '', 1, ' '),
	(6, 'Dépose', 10.00, '', 1, ' '),
	(7, 'Lissage brésilien', 90.00, '', 2, ' '),
	(8, 'Lissage Tanin', 100.00, '', 2, ' '),
	(9, 'Lissage nano-indien', 130.00, '', 2, ' '),
	(10, 'Soin botox', 50.00, '', 2, ' '),
	(11, 'Soin basique', 45.00, '', 3, ' '),
	(12, 'Soin hydrafacial', 70.00, '', 3, ' '),
	(13, 'Dermaplaning', 70.00, '', 3, ' '),
	(14, 'Microneedling', 80.00, '', 3, ' '),
	(15, 'Soins spécifiques', 50.00, '', 3, ' '),
	(16, 'Pose naturelle gel', 35.00, '', 4, ' '),
	(17, 'Pose couleurs gel', 35.00, '', 4, ' '),
	(18, 'Pose french gel', 35.00, '', 4, ' '),
	(19, 'Pose nails art', 35.00, '', 4, ' '),
	(20, 'Remplissage nails art', 30.00, '', 4, ' ');

-- Listage de la structure de table ohmybeauty. produit
CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `idCategorie` int NOT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `idCategorie` (`idCategorie`),
  CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.produit : ~16 rows (environ)
DELETE FROM `produit`;
INSERT INTO `produit` (`idProduit`, `designation`, `prix`, `image`, `idCategorie`) VALUES
	(1, 'Lime à ongles', 4.29, NULL, 4),
	(2, 'Kit de manucure', 9.50, NULL, 4),
	(3, 'Kit vernis semi permanent', 24.99, NULL, 4),
	(4, 'Ponceuse', 49.99, NULL, 4),
	(5, 'Kit extension de cils', 11.49, NULL, 1),
	(6, 'Faux cils (10 paires)', 8.99, NULL, 1),
	(7, 'Sérum croissance', 22.99, NULL, 1),
	(8, 'Faux cils magnétiques', 9.99, NULL, 1),
	(9, 'Coffret skin care', 29.95, NULL, 3),
	(10, 'Serre tête skin care', 2.00, NULL, 3),
	(11, 'Masque au charbon', 4.50, NULL, 3),
	(12, 'Masque hydratant', 3.50, NULL, 3),
	(13, 'Masque réparateur', 12.90, NULL, 2),
	(14, 'Kit lissage brésilien', 15.90, NULL, 2),
	(15, 'Bonnet en satin', 7.99, NULL, 2),
	(16, 'Elastiques (20 pièces)', 4.00, NULL, 2);

-- Listage de la structure de table ohmybeauty. reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `idUtilisateur` int NOT NULL,
  `idPrestation` int NOT NULL,
  `datePrestation` datetime NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idPrestation`),
  KEY `idPrestation` (`idPrestation`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idPrestation`) REFERENCES `prestation` (`idPrestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.reservation : ~0 rows (environ)
DELETE FROM `reservation`;

-- Listage de la structure de table ohmybeauty. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.utilisateur : ~1 rows (environ)
DELETE FROM `utilisateur`;
INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `email`, `motDePasse`, `role`) VALUES
	(1, 'Nabil', 'Assatour', 'assatour.nabil@gmail.com', '$2y$10$lmhrwZ9L74IoWPEiU.UjuOu41klSUxVfMMcWiCVtQ5jccA20I3DDm', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
