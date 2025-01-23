-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 23 jan. 2025 à 15:59
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bookmarket`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` bigint NOT NULL,
  `id_product` bigint NOT NULL,
  `price` bigint NOT NULL,
  `condition` enum('New','Like_New','Good','Acceptable','Damaged') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `annonce_id_product_foreign` (`id_product`),
  KEY `annonce_id_user_foreign` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `id_user`, `id_product`, `price`, `condition`) VALUES
(1, 1, 101, 200, 'New'),
(2, 2, 102, 150, 'Like_New'),
(3, 3, 103, 100, 'Good'),
(4, 4, 104, 50, 'Acceptable'),
(5, 5, 105, 20, 'Damaged');

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `biography` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`id`, `name`, `biography`) VALUES
(1, 'J.K. Rowling', 'Author of the Harry Potter series'),
(2, 'George R.R. Martin', 'Author of A Song of Ice and Fire'),
(3, 'J.R.R. Tolkien', 'Author of The Lord of the Rings'),
(4, 'Agatha Christie', 'Famous for her mystery novels'),
(5, 'Stephen King', 'Master of horror and suspense');

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Fantasy'),
(2, 'Science Fiction'),
(3, 'Mystery'),
(4, 'Thriller'),
(5, 'Non-Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `img_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `img_path`) VALUES
(1, 'default.png'),
(6, '677e8a97cc0d2heromobile.png'),
(18, '6792626a27dc2Discord_IiLG4SYfql.png'),
(7, '677e8acd73ca7images.jpg'),
(17, '67926220806dbDiscord_IiLG4SYfql.png'),
(8, '677e8b25882b0heromobile.png'),
(9, '677e8b302357bimages.jpg'),
(10, '677e8c137dde6wood.jpg'),
(11, '677e9cace952etsuna.jpg'),
(12, '677e9d698f33aAsta_apr_s_son_entrainement___Heart.webp'),
(13, '677e9d8e521f2tsuna.jpg'),
(14, '677e9d9d33f5dtsuna.jpg'),
(15, '677e9e2d9f919images.jpg'),
(16, '677e9fc1ce287images.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `image_annonce`
--

DROP TABLE IF EXISTS `image_annonce`;
CREATE TABLE IF NOT EXISTS `image_annonce` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_image` bigint NOT NULL,
  `id_annonce` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_annonce_id_annonce_foreign` (`id_annonce`),
  KEY `image_annonce_id_image_foreign` (`id_image`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_image` bigint NOT NULL,
  `id_type` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_author` bigint DEFAULT NULL,
  `specifications` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_type_foreign` (`id_type`),
  KEY `product_id_image_foreign` (`id_image`),
  KEY `product_id_author_foreign` (`id_author`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `id_image`, `id_type`, `name`, `id_author`, `specifications`) VALUES
(101, 1, 1, 'Harry Potter and the Philosopher\'s Stone', 1, 'Hardcover edition'),
(102, 2, 1, 'A Game of Thrones', 2, 'Paperback edition'),
(103, 3, 1, 'The Hobbit', 3, 'Collector edition'),
(104, 4, 1, 'Murder on the Orient Express', 4, 'Audiobook edition'),
(105, 5, 1, 'The Shining', 5, 'E-Book edition');

-- --------------------------------------------------------

--
-- Structure de la table `product_genre`
--

DROP TABLE IF EXISTS `product_genre`;
CREATE TABLE IF NOT EXISTS `product_genre` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_genre` bigint NOT NULL,
  `id_product` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_genre_id_genre_foreign` (`id_genre`),
  KEY `product_genre_id_product_foreign` (`id_product`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `product_genre`
--

INSERT INTO `product_genre` (`id`, `id_genre`, `id_product`) VALUES
(1, 1, 101),
(2, 1, 102),
(3, 1, 103),
(4, 3, 104),
(5, 4, 105),
(6, 2, 102),
(7, 1, 105);

-- --------------------------------------------------------

--
-- Structure de la table `professional_details`
--

DROP TABLE IF EXISTS `professional_details`;
CREATE TABLE IF NOT EXISTS `professional_details` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` bigint NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `professional_details_id_user_foreign` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `professional_details`
--

INSERT INTO `professional_details` (`id`, `id_user`, `company_name`, `company_address`, `company_phone`) VALUES
(1, 5, 'JoboCorp', 'Addr Entr', '0987654321'),
(2, 8, 'Blair and Berg LLC', 'Cline Smith Co', '123123123'),
(3, 9, 'Ware Morton Trading', 'Deleon Robertson Co', '322'),
(4, 10, 'JoboCorporationAbo', 'JoboLand', '7080');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `type_name`) VALUES
(1, 'Livre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_image` bigint NOT NULL DEFAULT '1',
  `username` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `profile_desc` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username_unique` (`username`),
  KEY `user_id_image_foreign` (`id_image`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `id_image`, `username`, `user_password`, `user_mail`, `profile_desc`, `role`) VALUES
(1, 1, 'Dupont', 'azerty', 'Dupont@gmail.com', 'Ici le goat', 'admin'),
(3, 1, 'LeGoat', '$2y$10$GcfcWsdH3H1t4YGV13PBFurJzDMv.0jd8lkAouuQsnYcozamZApw2', 'konuvasin@mailinator.com', '', 'user'),
(4, 1, 'xywyqixoz', '$2y$10$VkC0d..FRuQIUZQM4Qy/OeCTriC0ziqZ3hHlclPFoJAQa11yXGMOC', 'pijijaxisu@mailinator.com', '', 'user'),
(5, 1, 'Woosh', '$2y$10$VVsZHaVRiozlXxiE0PZKk.hRuyqdQatWpofXhwz10FyGxr1.0Y2ri', 'naim@gmail.com', '', 'user'),
(6, 14, 'Momo42', '$2y$10$LY2AUqI2bpLlXeGhbxB2SeA0u1PxPdBmXw3mK3gjJBCBGtoXhX0aq', 'mohand@gmail.com', 'Salut la teamax', 'user'),
(7, 16, 'NaimH', '$2y$10$W/gmx3Oegj/ndSDbg0knjOYl3hBtjm58eeKAFjqvQEfRkCR0HbSiy', 'Hamidi@gmail.com', '', 'user'),
(8, 9, 'naimd', '$2y$10$6JjW249qbd2MBntVKgM9WuyzXErJF0DVJ2831NfxMqrqcA9BzKCDu', 'naimda@gmail.com', 'HALLo', 'professional'),
(9, 1, 'byralagyva', '$2y$10$h3Dl.B2uuV3Io4HFjuwnh.TcpHyT2rNVo86jRzlzW9d4.K35BOfkq', 'huwofobef@mailinator.com', '', 'user'),
(10, 18, 'Wooshibou', '$2y$10$KeQW.A/.6eGy1aBdpX77FO0TinJl/QdjzlrG314S33g60DIiIeE4C', 'woosh@gmail.com', 'C&#039;était moi Barry !', 'professional');

-- --------------------------------------------------------

--
-- Structure de la table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` bigint NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_details_id_user_foreign` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user_details`
--

INSERT INTO `user_details` (`id`, `id_user`, `address`, `phone`, `country`, `firstName`, `lastName`) VALUES
(1, 4, 'Maiores mollitia qui', '0665656565', 'Et rerum reiciendis', 'Caleb', 'Sweet'),
(2, 5, 'Joboland', '1234567890', 'France', 'Naim', 'Deb'),
(3, 6, '8 Rue Terrenoire', '12341234', 'France', 'Mohanditayo', 'LeGoat'),
(4, 7, 'Jsplas', '87187162871', 'France', 'Naim', 'Hamidi'),
(5, 8, 'Suscipit dolore tota', '12341244', 'France', 'NaimAAAAAAA', 'DebFDSF'),
(6, 9, 'Et reprehenderit ver', '122', 'Aliquip consequatur', 'Avram', 'Weeks'),
(7, 10, 'Franceito', '1234', 'Francito', 'Wooosh', 'Wooosh');

-- --------------------------------------------------------

--
-- Structure de la table `user_transactions`
--

DROP TABLE IF EXISTS `user_transactions`;
CREATE TABLE IF NOT EXISTS `user_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_annonce` bigint NOT NULL,
  `id_user` bigint NOT NULL,
  `transactionAt` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_transactions_id_annonce_foreign` (`id_annonce`),
  KEY `user_transactions_id_user_foreign` (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
