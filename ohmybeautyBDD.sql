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
  `numeroCommande` bigint NOT NULL,
  `dateCommande` datetime NOT NULL,
  `prixTotal` decimal(15,2) NOT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `infosCommande` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_commande`),
  UNIQUE KEY `numeroCommande` (`numeroCommande`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.commande : ~0 rows (environ)
DELETE FROM `commande`;
INSERT INTO `commande` (`id_commande`, `numeroCommande`, `dateCommande`, `prixTotal`, `id_utilisateur`, `infosCommande`) VALUES
	(10, 163450211024562, '2024-10-21 16:34:50', 107.91, 2, 'Poudre à sourcils (Quantité : 9, Prix unitaire : 11.99 €).<br> Sous-total : 107.91 €.');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.contenir : ~0 rows (environ)
DELETE FROM `contenir`;
INSERT INTO `contenir` (`id_contenir`, `id_commande`, `id_produit`, `quantite`) VALUES
	(11, 10, 22, 9);

-- Listage de la structure de table ohmybeauty. prestation
CREATE TABLE IF NOT EXISTS `prestation` (
  `id_prestation` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `duree` int NOT NULL,
  `id_categorie` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_prestation`),
  KEY `id_categorie` (`id_categorie`),
  CONSTRAINT `prestation_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.prestation : ~29 rows (environ)
DELETE FROM `prestation`;
INSERT INTO `prestation` (`id_prestation`, `designation`, `prix`, `duree`, `id_categorie`, `description`) VALUES
	(1, 'Réhaussement', 35.00, 45, 1, 'Réhaussement des cils pour un effet naturel et courbé sans utilisation de mascara'),
	(2, 'Extension pose naturelle', 50.00, 45, 1, 'Pose d’extensions de cils pour un effet naturel et discret'),
	(3, 'Extension pose mixte', 60.00, 45, 1, 'Pose d’extensions de cils avec un mélange de cils naturels et volumineux'),
	(4, 'Remplissage naturel', 30.00, 45, 1, 'Remplissage des extensions de cils pour maintenir un effet naturel'),
	(5, 'Remplissage mixte', 35.00, 30, 1, 'Remplissage des extensions de cils pour un effet mixte, entre naturel et volume'),
	(6, 'Dépose', 10.00, 20, 1, 'Retrait complet des extensions de cils pour retrouver les cils naturels'),
	(7, 'Lissage brésilien', 90.00, 50, 2, 'Lissage brésilien pour des cheveux plus lisses, brillants et sans frisottis'),
	(8, 'Lissage Tanin', 100.00, 50, 2, 'Lissage au Tanin pour renforcer les cheveux tout en leur apportant souplesse et brillance'),
	(9, 'Lissage nano-indien', 130.00, 50, 2, 'Lissage nano-indien pour des cheveux ultra-lisses et durablement soyeux'),
	(10, 'Soin botox', 50.00, 40, 2, 'Soin Botox capillaire pour nourrir et réparer intensément les cheveux abîmés'),
	(11, 'Soin basique', 45.00, 35, 3, 'Soin du visage basique pour nettoyer et hydrater la peau en profondeur'),
	(12, 'Soin hydrafacial', 70.00, 40, 3, 'Soin hydrafacial pour une hydratation en profondeur et une peau éclatante'),
	(13, 'Dermaplaning', 70.00, 30, 3, 'Dermaplaning pour exfolier la peau et éliminer les cellules mortes, laissant la peau douce et lisse'),
	(14, 'Microneedling', 80.00, 45, 3, 'Microneedling pour stimuler la production de collagène et renouveler la peau'),
	(15, 'Soins spécifiques', 50.00, 30, 3, 'Soins spécifiques personnalisés pour répondre aux besoins individuels de chaque type de peau'),
	(16, 'Pose naturelle gel', 35.00, 30, 4, 'Pose de gel naturel sur les ongles pour une apparence élégante et raffinée'),
	(17, 'Pose couleurs gel', 35.00, 30, 4, 'Pose de gel coloré pour des ongles éclatants et durables'),
	(18, 'Pose french gel', 35.00, 30, 4, 'Pose de gel french pour un look classique et sophistiqué des ongles'),
	(19, 'Pose nails art', 35.00, 35, 4, 'Pose de nail art personnalisé pour un design unique sur vos ongles'),
	(20, 'Remplissage nails art', 30.00, 25, 4, 'Remplissage de nail art pour prolonger la tenue et la beauté de vos ongles décorés'),
	(21, 'Massage relaxant', 60.00, 60, 3, 'Massage pour relâcher les tensions musculaires'),
	(22, 'Soin visage éclat', 80.00, 60, 3, 'Soin pour redonner de l’éclat à la peau'),
	(23, 'Manucure classique', 30.00, 45, 4, 'Soin des mains avec pose de vernis classique'),
	(24, 'Pédicure spa', 45.00, 60, 4, 'Soin des pieds avec bain et massage'),
	(25, 'Coloration cheveux', 70.00, 60, 2, 'Coloration compl&egrave;te avec produits de soin'),
	(27, 'Soin contour des yeux', 50.00, 30, 3, 'Soin ciblé pour le contour des yeux'),
	(28, 'Epilation sourcils', 15.00, 15, 1, 'Epilation des sourcils à la cire ou à la pince'),
	(29, 'Pose de faux cils', 80.00, 60, 1, 'Pose de faux cils semi-permanents'),
	(30, 'Soin capillaire profond', 40.00, 60, 2, 'Soin intense pour cheveux abîmés');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table ohmybeauty.produit : ~23 rows (environ)
DELETE FROM `produit`;
INSERT INTO `produit` (`id_produit`, `designation`, `prix`, `image`, `description`, `id_categorie`) VALUES
	(1, 'Lime &agrave; ongles', 4.29, '67335bbaa3622.webp', 'Lime &agrave; ongles pour le fa&ccedil;onnage et la finition des ongles', 4),
	(3, 'Kit vernis semi permanent', 24.99, '67335b863936f.webp', 'Kit vernis semi-permanent pour des ongles brillants et durables', 4),
	(4, 'Ponceuse', 49.99, '67335b5fa36b9.webp', 'Ponceuse &eacute;lectrique pour pr&eacute;parer les ongles avant la pose de gel', 4),
	(6, 'Faux cils', 8.99, '67334e657e892.webp', 'Ensemble de 10 paires de faux cils pour un regard intense', 1),
	(7, 'S&eacute;rum croissance', 22.99, '67334ef5ed2b5.webp', 'S&eacute;rum pour favoriser la croissance naturelle des cils', 1),
	(8, 'Faux cils magn&eacute;tiques', 9.99, '67334f06d1e64.webp', 'Faux cils magn&eacute;tiques r&eacute;utilisables pour une pose facile', 1),
	(10, 'Serre t&ecirc;te skin care', 2.00, '6733564484e5d.webp', 'Serre-t&ecirc;te doux et pratique pour les soins de la peau', 3),
	(11, 'Masque au charbon', 4.50, '6733560081dab.webp', 'Masque au charbon pour purifier et d&eacute;sincruster les pores', 3),
	(12, 'Masque hydratant', 3.50, '673356535ecd8.webp', 'Masque hydratant pour nourrir et adoucir la peau', 3),
	(13, 'Masque r&eacute;parateur', 12.90, '6733524135acf.webp', 'Masque r&eacute;parateur pour cheveux ab&icirc;m&eacute;s', 2),
	(14, 'Kit lissage br&eacute;silien', 15.90, '673352a987574.webp', 'Kit complet pour lissage br&eacute;silien &agrave; domicile', 2),
	(16, 'Elastiques', 4.00, '673352bd902de.webp', '&Eacute;lastiques r&eacute;sistants pour cheveux, pack de 20 pi&egrave;ces', 2),
	(18, 'Cr&egrave;me hydratante visage', 25.00, '6733571e0d544.webp', 'Cr&egrave;me l&eacute;g&egrave;re pour hydratation quotidienne', 3),
	(21, 'Gel UV', 9.99, '67335c793f600.webp', 'Gel UV pour la pose d&rsquo;ongles', 4),
	(22, 'Crayon pour sourcils', 11.99, '6733512317bac.webp', 'Poudre pour maquillage des sourcils', 1),
	(23, 'Cr&egrave;me anti-&acirc;ge', 45.00, '67335727edfab.webp', 'Cr&egrave;me pour r&eacute;duire les signes de l&rsquo;&acirc;ge', 3),
	(29, 'Mascara volume', 12.99, '67335132cfc90.webp', 'Mascara pour volume et courbure intense', 1),
	(30, 'Recourbe-cils', 8.99, '6733513d0fedd.webp', 'Accessoire pour recourber les cils', 1),
	(32, 'Shampoing r&eacute;parateur', 10.90, '673353b0892b1.webp', 'Shampoing pour cheveux ab&icirc;m&eacute;s', 2),
	(33, 'Conditionneur lissant', 12.50, '673353a33e4bf.webp', 'Conditionneur pour un lissage parfait', 2),
	(34, 'Spray thermo-protecteur', 9.99, '6733537f55502.webp', 'Protection pour cheveux avant coiffage', 2),
	(36, 'Tonique rafra&icirc;chissant', 7.99, '67335735e0682.webp', 'Tonique pour purifier et rafra&icirc;chir la peau', 3),
	(38, 'Huile cuticules', 6.50, '67335b44822fb.webp', 'Huile pour hydrater et nourrir les cuticules', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- Listage des données de la table ohmybeauty.utilisateur : ~0 rows (environ)
DELETE FROM `utilisateur`;
INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `motDePasse`, `role`) VALUES
	(2, 'test@gmail.com', '$2y$10$l53hSsEXg0Tju0Lw5/wN2.NqARpGVEHqfypBPyvXuRmgvJpiZU35y', 'ADMIN');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
