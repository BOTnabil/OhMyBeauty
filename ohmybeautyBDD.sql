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

-- Listage des données de la table ohmybeauty.categorie : ~0 rows (environ)
DELETE FROM `categorie`;
INSERT INTO `categorie` (`idCategorie`, `designation`) VALUES
	(1, 'CILS'),
	(2, 'CAPILAIRE'),
	(3, 'SOIN DU VISAGE'),
	(4, 'ONGLERIE');

-- Listage des données de la table ohmybeauty.commande : ~0 rows (environ)
DELETE FROM `commande`;

-- Listage des données de la table ohmybeauty.contenir : ~0 rows (environ)
DELETE FROM `contenir`;

-- Listage des données de la table ohmybeauty.prestation : ~0 rows (environ)
DELETE FROM `prestation`;
INSERT INTO `prestation` (`idPrestation`, `designation`, `prix`, `idCategorie`) VALUES
	(1, 'Réhaussement', 35.00, 1),
	(2, 'Extension pose naturelle', 50.00, 1),
	(3, 'Extension pose mixte', 60.00, 1),
	(4, 'Remplissage naturel', 30.00, 1),
	(5, 'Remplissage mixte', 35.00, 1),
	(6, 'Dépose', 10.00, 1),
	(7, 'Lissage brésilien', 90.00, 2),
	(8, 'Lissage Tanin', 100.00, 2),
	(9, 'Lissage nano-indien', 130.00, 2),
	(10, 'Soin botox', 50.00, 2),
	(11, 'Soin basique', 45.00, 3),
	(12, 'Soin hydrafacial', 70.00, 3),
	(13, 'Dermaplaning', 70.00, 3),
	(14, 'Microneedling', 80.00, 3),
	(15, 'Soins spécifiques', 50.00, 3),
	(16, 'Pose naturelle gel', 35.00, 4),
	(17, 'Pose couleurs gel', 35.00, 4),
	(18, 'Pose french gel', 35.00, 4),
	(19, 'Pose nails art', 35.00, 4),
	(20, 'Remplissage nails art', 30.00, 4);

-- Listage des données de la table ohmybeauty.produit : ~0 rows (environ)
DELETE FROM `produit`;

-- Listage des données de la table ohmybeauty.reservation : ~0 rows (environ)
DELETE FROM `reservation`;

-- Listage des données de la table ohmybeauty.utilisateur : ~0 rows (environ)
DELETE FROM `utilisateur`;
INSERT INTO `utilisateur` (`idUtilisateur`, `nom`, `prenom`, `email`, `motDePasse`, `role`) VALUES
	(1, 'Nabil', 'Assatour', 'assatour.nabil@gmail.com', '$2y$10$lmhrwZ9L74IoWPEiU.UjuOu41klSUxVfMMcWiCVtQ5jccA20I3DDm', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
