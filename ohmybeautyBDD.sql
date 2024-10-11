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
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.categorie : ~4 rows (environ)
DELETE FROM `categorie`;
INSERT INTO `categorie` (`id_categorie`, `designation`) VALUES
	(1, 'CILS'),
	(2, 'CAPILAIRE'),
	(3, 'SOIN DU VISAGE'),
	(4, 'ONGLERIE');

-- Listage de la structure de table ohmybeauty. commande
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `numeroCommande` bigint DEFAULT NULL,
  `dateCommande` datetime NOT NULL,
  `prixTotal` decimal(15,2) NOT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `infosCommande` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_commande`),
  UNIQUE KEY `numeroCommande` (`numeroCommande`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.commande : ~0 rows (environ)
DELETE FROM `commande`;

-- Listage de la structure de table ohmybeauty. contenir
CREATE TABLE IF NOT EXISTS `contenir` (
  `id_contenir` int NOT NULL AUTO_INCREMENT,
  `id_commande` int DEFAULT NULL,
  `id_produit` int DEFAULT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`id_contenir`),
  KEY `id_produit` (`id_produit`),
  KEY `contenir_ibfk_1` (`id_commande`),
  CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`),
  CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.contenir : ~4 rows (environ)
DELETE FROM `contenir`;
INSERT INTO `contenir` (`id_contenir`, `id_commande`, `id_produit`, `quantite`) VALUES
	(1, NULL, 5, 1),
	(2, NULL, 20, 5),
	(3, NULL, 23, 5),
	(4, NULL, 21, 6);

-- Listage de la structure de table ohmybeauty. prestation
CREATE TABLE IF NOT EXISTS `prestation` (
  `id_prestation` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `duree` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '40min',
  `id_categorie` int NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_prestation`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `prestation_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.prestation : ~29 rows (environ)
DELETE FROM `prestation`;
INSERT INTO `prestation` (`id_prestation`, `designation`, `prix`, `duree`, `id_categorie`, `description`) VALUES
	(1, 'Réhaussement', 35.00, '45min', 1, 'test description'),
	(2, 'Extension pose naturelle', 50.00, '45min', 1, 'test description'),
	(3, 'Extension pose mixte', 60.00, '45min', 1, 'test description'),
	(4, 'Remplissage naturel', 30.00, '45min', 1, 'test description'),
	(5, 'Remplissage mixte', 35.00, '30min', 1, 'Remplissage de cils naturel pour une apparence légère'),
	(6, 'Dépose', 10.00, '20min', 1, 'Retrait complet des extensions de cils'),
	(7, 'Lissage brésilien', 90.00, '50min', 2, 'Lissage brésilien pour des cheveux lisses et brillants'),
	(8, 'Lissage Tanin', 100.00, '50min', 2, 'Lissage Tanin pour des cheveux renforcés et lisses'),
	(9, 'Lissage nano-indien', 130.00, '50min', 2, 'Lissage nano-indien pour des cheveux ultra-lisses et brillants'),
	(10, 'Soin botox', 50.00, '40min', 2, 'Soin capillaire revitalisant pour renforcer les cheveux'),
	(11, 'Soin basique', 45.00, '35min', 3, 'Soin basique du visage pour une hydratation quotidienne'),
	(12, 'Soin hydrafacial', 70.00, '40min', 3, 'Soin hydrafacial pour une peau éclatante et purifiée'),
	(13, 'Dermaplaning', 70.00, '30min', 3, 'Dermaplaning pour exfoliation de la peau et élimination des cellules mortes'),
	(14, 'Microneedling', 80.00, '45min', 3, 'Microneedling pour régénérer la peau et stimuler la production de collagène'),
	(15, 'Soins spécifiques', 50.00, '30min', 3, 'Soins spécifiques adaptés à chaque type de peau'),
	(16, 'Pose naturelle gel', 35.00, '30min', 4, 'Pose naturelle de gel sur les ongles pour une apparence élégante'),
	(17, 'Pose couleurs gel', 35.00, '30min', 4, 'Pose de gel coloré pour des ongles aux couleurs vibrantes'),
	(18, 'Pose french gel', 35.00, '30min', 4, 'Pose french gel pour un style classique et élégant'),
	(19, 'Pose nails art', 35.00, '35min', 4, 'Pose de nail art pour un design personnalisé sur les ongles'),
	(20, 'Remplissage nails art', 30.00, '25min', 4, 'Remplissage de nail art pour maintenir un design parfait'),
	(21, 'Massage relaxant', 60.00, '60min', 3, 'Massage pour relâcher les tensions musculaires'),
	(22, 'Soin visage éclat', 80.00, '60min', 3, 'Soin pour redonner de l’éclat à la peau'),
	(23, 'Manucure classique', 30.00, '45min', 4, 'Soin des mains avec pose de vernis classique'),
	(24, 'Pédicure spa', 45.00, '60min', 4, 'Soin des pieds avec bain et massage'),
	(25, 'Coloration cheveux', 70.02, '60min', 2, 'Coloration compl&egrave;te avec produits de soin'),
	(27, 'Soin contour des yeux', 50.00, '30min', 3, 'Soin ciblé pour le contour des yeux'),
	(28, 'Epilation sourcils', 15.00, '15min', 1, 'Epilation des sourcils à la cire ou à la pince'),
	(29, 'Pose de faux cils', 80.00, '60min', 1, 'Pose de faux cils semi-permanents'),
	(30, 'Soin capillaire profond', 40.00, '60min', 2, 'Soin intense pour cheveux abîmés');

-- Listage de la structure de table ohmybeauty. produit
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.produit : ~22 rows (environ)
DELETE FROM `produit`;
INSERT INTO `produit` (`id_produit`, `designation`, `prix`, `image`, `description`, `id_categorie`) VALUES
	(1, 'Lime à ongles', 4.29, 'img_produit.png', 'Lime à ongles pour le façonnage et la finition des ongles', 4),
	(3, 'Kit vernis semi permanent', 24.99, 'img_produit.png', 'Kit vernis semi-permanent pour des ongles brillants et durables', 4),
	(4, 'Ponceuse', 49.99, 'img_produit.png', 'Ponceuse électrique pour préparer les ongles avant la pose de gel', 4),
	(5, 'Kit extension de cils', 11.49, 'img_produit.png', 'Kit complet pour l’extension de cils avec tous les accessoires nécessaires', 1),
	(6, 'Faux cils (10 paires)', 8.99, 'img_produit.png', 'Ensemble de 10 paires de faux cils pour un regard intense', 1),
	(7, 'Sérum croissance', 22.99, 'img_produit.png', 'Sérum pour favoriser la croissance naturelle des cils', 1),
	(8, 'Faux cils magnétiques', 9.99, 'img_produit.png', 'Faux cils magnétiques réutilisables pour une pose facile', 1),
	(10, 'Serre tête skin care', 2.00, 'img_produit.png', 'Serre-tête doux et pratique pour les soins de la peau', 3),
	(11, 'Masque au charbon', 4.50, 'img_produit.png', 'Masque au charbon pour purifier et désincruster les pores', 3),
	(12, 'Masque hydratant', 3.50, 'img_produit.png', 'Masque hydratant pour nourrir et adoucir la peau', 3),
	(13, 'Masque réparateur', 12.90, 'img_produit.png', 'Masque réparateur pour cheveux abîmés', 2),
	(14, 'Kit lissage brésilien', 15.90, 'img_produit.png', 'Kit complet pour lissage brésilien à domicile', 2),
	(15, 'Bonnet en satin', 7.99, 'img_produit.png', 'Bonnet en satin pour protéger les cheveux pendant la nuit', 2),
	(16, 'Elastiques (20 pièces)', 4.00, 'img_produit.png', 'Élastiques résistants pour cheveux, pack de 20 pièces', 2),
	(18, 'Crème hydratante visage', 25.00, 'img_produit.png', 'Crème légère pour hydratation quotidienne', 3),
	(19, 'Huile capillaire', 15.90, 'img_produit.png', 'Huile réparatrice pour cheveux', 2),
	(20, 'Vernis à ongles', 6.50, 'img_produit.png', 'Vernis longue tenue, disponible en plusieurs couleurs', 4),
	(21, 'Gel UV', 9.99, 'img_produit.png', 'Gel UV pour la pose d’ongles', 4),
	(22, 'Poudre à sourcils', 11.99, 'img_produit.png', 'Poudre pour maquillage des sourcils', 1),
	(23, 'Crème anti-âge', 45.00, 'img_produit.png', 'Crème pour réduire les signes de l’âge', 3),
	(24, 'Sérum vitaminé', 19.99, 'img_produit.png', 'Sérum enrichi en vitamines pour la peau', 3),
	(26, 'Lait corporel', 13.90, 'img_produit.png', 'Lait hydratant pour le corps', 3);

-- Listage de la structure de table ohmybeauty. reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int DEFAULT NULL,
  `id_prestation` int DEFAULT NULL,
  `datePrestation` datetime NOT NULL,
  `infosReservation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_prestation` (`id_prestation`),
  KEY `reservation_ibfk_1` (`id_utilisateur`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_prestation`) REFERENCES `prestation` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.reservation : ~0 rows (environ)
DELETE FROM `reservation`;

-- Listage de la structure de table ohmybeauty. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.utilisateur : ~1 rows (environ)
DELETE FROM `utilisateur`;
INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `motDePasse`, `role`) VALUES
	(2, 'test@gmail.com', '$2y$10$l53hSsEXg0Tju0Lw5/wN2.NqARpGVEHqfypBPyvXuRmgvJpiZU35y', 'ADMIN');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
