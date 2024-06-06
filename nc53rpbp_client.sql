-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 06 juin 2024 à 03:58
-- Version du serveur :  5.7.36-cll-lve
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nc53rpbp_client`
--

-- --------------------------------------------------------

--
-- Structure de la table `action_commerciales`
--

CREATE TABLE `action_commerciales` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sous_opportunite_id` int(11) DEFAULT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `suivi_prospect` int(11) DEFAULT NULL,
  `priorite` tinyint(1) DEFAULT '0',
  `deadline` varchar(255) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `cloture` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `action_commerciales`
--

INSERT INTO `action_commerciales` (`id`, `libelle`, `commercial_id`, `superieur_id`, `opportunite_id`, `entreprise_client_id`, `type`, `sous_opportunite_id`, `prospect_id`, `resume`, `suivi_prospect`, `priorite`, `deadline`, `update_id`, `cloture`, `created_at`, `updated_at`) VALUES
(1, 'Achète moi des bonbons rouge', 56, 56, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-03-01', NULL, 0, '2024-03-01 15:27:13', '2024-03-01 16:56:12'),
(2, 'SUnu REV', 91, 88, 1, NULL, NULL, NULL, 1, NULL, NULL, 1, '2024-03-02', NULL, 0, '2024-03-01 18:00:38', '2024-03-01 17:00:38'),
(3, 'Achète moi des bonbons', 91, 88, NULL, NULL, NULL, NULL, 2, NULL, NULL, 1, '2024-02-29', NULL, 0, '2024-03-01 18:04:17', '2024-03-01 17:04:17'),
(4, 'Bon', 56, 56, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, '2024-03-01', NULL, 0, '2024-03-01 19:19:50', '2024-03-01 18:19:50');

-- --------------------------------------------------------

--
-- Structure de la table `action_de_suivi`
--

CREATE TABLE `action_de_suivi` (
  `id` int(11) NOT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `sous_opportunite_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bdd_prospects`
--

CREATE TABLE `bdd_prospects` (
  `id` int(11) NOT NULL,
  `nom_entreprise` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_entreprise` varchar(255) DEFAULT NULL,
  `email_1` varchar(255) DEFAULT NULL,
  `email_2` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `backup` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `secteur_activite` int(11) DEFAULT NULL,
  `secteur_pros_a_appeler` varchar(255) DEFAULT NULL,
  `secteur` varchar(255) DEFAULT NULL,
  `autres` varchar(255) DEFAULT NULL,
  `suivi_prospect` int(11) DEFAULT NULL,
  `autres_multis` varchar(255) DEFAULT NULL,
  `provenance` varchar(255) DEFAULT NULL,
  `strategique` tinyint(1) DEFAULT '0',
  `groupe` tinyint(1) DEFAULT '0',
  `multinational` varchar(255) DEFAULT NULL,
  `contact` tinyint(1) DEFAULT '0',
  `pays_id` int(11) DEFAULT NULL,
  `pays` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `taille_prospect` varchar(255) DEFAULT NULL,
  `type_prospect` varchar(255) DEFAULT NULL,
  `commercial1` varchar(255) DEFAULT NULL,
  `commercial2` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `prenom_contact1` varchar(255) DEFAULT NULL,
  `nom_contact1` varchar(255) DEFAULT NULL,
  `email_contact1` varchar(255) DEFAULT NULL,
  `mobile_contact1` varchar(255) DEFAULT NULL,
  `whatshap_contact1` varchar(255) DEFAULT NULL,
  `prenom_contact2` varchar(255) DEFAULT NULL,
  `nom_contact2` varchar(255) DEFAULT NULL,
  `email_contact2` varchar(255) DEFAULT NULL,
  `fonction_contact1` varchar(255) DEFAULT NULL,
  `fonction_contact2` varchar(255) DEFAULT NULL,
  `mobile_contact2` varchar(255) DEFAULT NULL,
  `whatshap_contact2` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bdd_prospects`
--

INSERT INTO `bdd_prospects` (`id`, `nom_entreprise`, `phone`, `email_entreprise`, `email_1`, `email_2`, `adresse`, `site_web`, `logo`, `commercial_id`, `backup`, `superieur_id`, `entreprise_client_id`, `secteur_activite`, `secteur_pros_a_appeler`, `secteur`, `autres`, `suivi_prospect`, `autres_multis`, `provenance`, `strategique`, `groupe`, `multinational`, `contact`, `pays_id`, `pays`, `date`, `ville`, `taille_prospect`, `type_prospect`, `commercial1`, `commercial2`, `zone`, `statut`, `created_at`, `updated_at`, `prenom_contact1`, `nom_contact1`, `email_contact1`, `mobile_contact1`, `whatshap_contact1`, `prenom_contact2`, `nom_contact2`, `email_contact2`, `fonction_contact1`, `fonction_contact2`, `mobile_contact2`, `whatshap_contact2`) VALUES
(1, 'nom_entreprise', NULL, 'email_entreprise', NULL, NULL, 'adresse', 'site_web', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'secteur', NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 'pays', NULL, 'ville', 'taille_prospecte', 'type_prospect', 'commercial1', 'commercial2', NULL, NULL, '2024-03-01 16:46:48', '2024-03-01 15:46:48', 'prenom_contact1', 'nom_contact1', 'email_contact1', 'fonction_contact1', 'mobile_contact1', 'nom_contact2', 'whatshap_contact1', 'prenom_contact2', 'email_contact1', 'email_contact2', 'fonction_contact2', 'mobile_contact2'),
(2, 'Digital1', NULL, 'user1@gmail.com', NULL, NULL, '01 BP', 'digi1.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 'Burkina Faso', NULL, 'Ouagadougou', 'Elevé', 'Qualifié', 'Mano', 'Mano', NULL, NULL, '2024-03-01 16:46:48', '2024-03-01 15:46:48', 'Smith', 'Mano', 'smith@gmail.com', 'Développeur_Web', '5630909', 'Boss1', '5690909', 'Veste1', 'smith@gmail.com', 'boss1@gmail.com', 'Commercant', '20301212'),
(3, 'Digital2', NULL, 'user2@gmail.com', NULL, NULL, '02 Sn', 'digi2.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, 'Senegal', NULL, 'Dakar', 'Elevé', 'Non-qualifié', 'Crisnel', 'Crisnel', NULL, NULL, '2024-03-01 16:46:48', '2024-03-01 15:46:48', 'Junior', 'Crisnel', 'junior@gmail.com', 'Développeur_Web', '2448758', 'Boss2', '2448758', 'Veste2', 'junior@gmail.com', 'boss2@gmail.com', 'Revendeur', '74682852');

-- --------------------------------------------------------

--
-- Structure de la table `commerciaus`
--

CREATE TABLE `commerciaus` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `nbre_appel_quotidien` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `domaine_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `commission_p` varchar(255) DEFAULT NULL,
  `nbre_contact` varchar(255) DEFAULT NULL,
  `objectif_mois` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `nbre_demo` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nom_role` varchar(255) DEFAULT NULL,
  `sup` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commerciaus`
--

INSERT INTO `commerciaus` (`id`, `prenom`, `nom`, `nbre_appel_quotidien`, `email`, `pays_id`, `superieur_id`, `domaine_id`, `entreprise_client_id`, `phone`, `whatsapp`, `commission_p`, `nbre_contact`, `objectif_mois`, `objectif_demo`, `objectif_visite`, `nbre_demo`, `user_id`, `nom_role`, `sup`, `created_at`, `updated_at`) VALUES
(56, 'Fallou', 'GUEYE', NULL, 'fallou.g@illimitis.com', 1, 56, 0, NULL, NULL, NULL, '0.05', '5', '5000000', NULL, '2', '4', 63, 'directeur', NULL, '2023-03-21 11:33:14', '2023-03-21 10:33:14'),
(91, 'Alfred', 'BANTSANTSA', '5', 'alfredbantsantsa@gmail.com', 1, 88, 2, NULL, NULL, NULL, '0.05', '5', '5000000', NULL, NULL, '5', 98, 'responsable', NULL, '2024-03-01 15:08:45', '2024-03-01 14:08:45'),
(90, 'Wivine', 'UWIMINA', '5', 'wivine.divine@gmail.com', 1, 88, 2, NULL, NULL, NULL, '0.05', '5', '5000000', NULL, NULL, '5', 97, 'responsable', NULL, '2024-03-01 15:07:19', '2024-03-01 14:07:19'),
(89, 'Electa', 'KY', '5', 'khyelecta@gmail.com', 1, 88, 2, NULL, NULL, NULL, '0.05', '5', '5000000', NULL, NULL, '5', 96, 'responsable', NULL, '2024-03-01 15:06:15', '2024-03-01 14:06:15'),
(88, 'Almamy  Mahama', 'GBANE', '5', 'almos921@gmail.com', 1, 56, 2, NULL, NULL, NULL, '0.05', '5', '5000000', NULL, NULL, '5', 95, 'directeur', NULL, '2024-03-01 15:04:46', '2024-03-01 14:04:46');

-- --------------------------------------------------------

--
-- Structure de la table `commissions`
--

CREATE TABLE `commissions` (
  `id` int(11) NOT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commissions`
--

INSERT INTO `commissions` (`id`, `commercial_id`, `entreprise_client_id`, `opportunite_id`, `commission`, `created_at`, `updated_at`) VALUES
(1, 25, NULL, 157, '500000', '2022-10-13 16:18:30', '2022-10-13 14:18:30'),
(2, 28, NULL, 187, '40000', '2022-11-14 10:55:49', '2022-11-14 09:55:49'),
(3, 12, NULL, 144, '340000', '2022-02-15 10:53:18', '2022-11-15 09:53:18'),
(4, 28, NULL, 193, '21500', '2022-11-18 08:47:19', '2022-11-18 07:47:19'),
(5, 30, NULL, 170, '35000', '2022-11-18 14:04:01', '2022-11-18 13:04:01'),
(6, 6, NULL, 171, '153400', '2022-11-22 12:06:18', '2022-11-22 11:06:18'),
(7, 25, NULL, 220, '95000', '2022-11-24 14:56:34', '2022-11-24 13:56:34'),
(8, 25, NULL, 221, '988648.25', '2022-11-25 10:10:32', '2022-11-25 09:10:32'),
(9, 32, NULL, 222, '5000', '2022-11-25 14:42:06', '2022-11-25 13:42:06'),
(10, 29, NULL, 209, '189375', '2022-11-27 21:51:35', '2022-11-27 20:51:35'),
(11, 25, NULL, 310, '422887.5', '2023-03-16 17:50:34', '2023-03-16 16:50:34'),
(12, 29, NULL, 283, '127500', '2023-03-17 09:13:53', '2023-03-17 08:13:53'),
(13, 29, NULL, 284, '75000', '2023-03-17 09:14:35', '2023-03-17 08:14:35'),
(14, 6, NULL, 124, '56000', '2023-03-17 10:23:02', '2023-03-17 09:23:02'),
(15, 6, NULL, 313, '153750', '2023-03-17 10:48:40', '2023-03-17 09:48:40'),
(16, 25, NULL, 287, '2082097.8', '2023-05-04 10:37:15', '2023-03-31 08:37:15'),
(17, 13, NULL, 318, '61875', '2023-05-31 10:57:32', '2023-05-31 08:57:32'),
(18, 6, NULL, 208, '115000', '2023-05-31 12:45:43', '2023-05-31 10:45:43'),
(19, 6, NULL, 372, '255000', '2023-05-19 18:11:13', '2023-05-31 16:11:13'),
(20, 29, NULL, 378, '1350000', '2023-04-20 09:23:55', '2023-06-01 07:23:55'),
(21, 6, NULL, 370, '135000', '2023-05-04 16:53:18', '2023-06-01 14:53:18'),
(22, 6, NULL, 369, '300000', '2023-05-11 16:55:27', '2023-06-01 14:55:27'),
(23, 6, NULL, 373, '35000', '2023-05-12 16:59:51', '2023-06-01 14:59:51'),
(24, 6, NULL, 371, '162475', '2023-06-12 17:06:47', '2023-06-01 15:06:47'),
(25, 30, NULL, 381, '150000', '2023-04-28 17:12:57', '2023-06-01 15:12:57'),
(26, 30, NULL, 380, '6355.9', '2023-05-26 17:17:13', '2023-06-01 15:17:13'),
(27, 6, NULL, 314, '637500', '2023-04-05 18:08:49', '2023-06-01 16:08:49'),
(28, 25, NULL, 278, '75000', '2023-06-14 13:05:05', '2023-06-14 11:05:05'),
(29, 6, NULL, 134, '0.15', '2023-06-21 16:08:19', '2023-06-21 14:08:19'),
(30, 6, NULL, 280, '85000', '2023-06-21 16:09:19', '2023-06-21 14:09:19'),
(31, 29, NULL, 396, '48000', '2023-06-22 09:21:26', '2023-07-03 07:21:26'),
(32, 29, NULL, 394, '67500', '2023-06-28 09:21:57', '2023-07-03 07:21:57'),
(33, 29, NULL, 227, '0', '2023-02-13 14:44:46', '2023-07-05 12:44:46'),
(34, 29, NULL, 401, '25000', '2023-03-15 14:51:11', '2023-07-05 12:51:11'),
(35, 29, NULL, 363, '304000', '2023-08-01 12:24:30', '2023-08-01 10:24:30'),
(36, 25, NULL, 392, '420000', '2023-08-04 14:42:29', '2023-08-04 12:42:29'),
(37, 6, NULL, 134, '0.15', '2023-08-09 14:40:03', '2023-08-09 12:40:03'),
(38, 32, NULL, 416, '137000', '2023-08-11 14:21:51', '2023-08-11 12:21:51'),
(39, 29, NULL, 424, '383050', '2023-08-23 09:55:23', '2023-08-23 07:55:23'),
(40, 25, NULL, 399, '1798500', '2023-08-30 12:48:19', '2023-08-30 10:48:19'),
(41, 25, NULL, 420, '675000', '2023-09-05 20:59:12', '2023-09-05 18:59:12'),
(42, 28, NULL, 264, '495000', '2023-09-06 11:46:18', '2023-09-06 09:46:18'),
(43, 30, NULL, 431, '0', '2023-09-15 15:49:38', '2023-09-15 13:49:38'),
(44, 25, NULL, 452, '135405', '2023-10-25 08:57:55', '2023-10-25 06:57:55'),
(45, 36, NULL, 407, '418918.75', '2023-10-25 11:10:43', '2023-10-25 09:10:43'),
(46, 36, NULL, 404, '495000', '2023-10-25 11:11:41', '2023-10-25 09:11:41'),
(47, 36, NULL, 405, '75000', '2023-10-25 11:12:53', '2023-10-25 09:12:53'),
(48, 36, NULL, 406, '5000', '2023-10-25 11:14:03', '2023-10-25 09:14:03'),
(49, 36, NULL, 408, '384396', '2023-10-25 11:14:45', '2023-10-25 09:14:45'),
(50, 36, NULL, 409, '150000', '2023-10-25 11:18:23', '2023-10-25 09:18:23'),
(51, 28, NULL, 367, '585000', '2023-10-25 12:12:43', '2023-10-25 10:12:43'),
(52, 28, NULL, 434, '585000', '2023-10-25 15:04:54', '2023-10-25 13:04:54'),
(53, 6, NULL, 398, '68000', '2023-11-20 16:31:37', '2023-11-20 15:31:37'),
(54, 32, NULL, 473, '161660', '2023-12-06 14:22:21', '2023-12-06 13:22:21'),
(55, 28, NULL, 395, '108000', '2023-12-06 15:53:00', '2023-12-06 14:53:00'),
(56, 28, NULL, 319, '100000', '2023-12-06 16:02:20', '2023-12-06 15:02:20'),
(57, 25, NULL, 485, '250000', '2023-12-11 17:45:34', '2023-12-11 16:45:34'),
(58, 6, NULL, 486, '257125', '2023-12-20 14:31:09', '2023-12-20 13:31:09'),
(59, 28, NULL, 510, '45000', '2024-01-25 11:47:18', '2024-01-25 10:47:18'),
(60, 25, NULL, 540, '360000', '2024-02-19 16:30:38', '2024-02-19 15:30:38'),
(61, 28, NULL, 538, '148500', '2024-02-19 21:08:23', '2024-02-19 20:08:23'),
(62, 56, NULL, 541, '35000', '2024-02-19 23:23:52', '2024-02-19 22:23:52'),
(63, 56, NULL, 541, '40000', '2024-02-19 23:29:34', '2024-02-19 22:29:34'),
(64, 56, NULL, 541, '45000', '2024-02-19 23:33:34', '2024-02-19 22:33:34'),
(65, 56, NULL, 541, '45000', '2024-02-19 23:36:01', '2024-02-19 22:36:01');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `responsabilite` varchar(250) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `prenom`, `nom`, `libelle`, `email`, `phone`, `whatsapp`, `responsabilite`, `commercial_id`, `entreprise_client_id`, `superieur_id`, `prospect_id`, `opportunite_id`, `statut`, `created_at`, `updated_at`) VALUES
(1, 'Joseph', 'Bro', NULL, NULL, NULL, NULL, NULL, 90, NULL, 88, 3, NULL, 0, '2024-03-01 16:40:39', '2024-03-01 15:40:39'),
(2, 'Gauthier', 'Kombo', NULL, 'gathier@gmail.com', '778907878', NULL, 'Directeur', 56, NULL, 56, 6, 2, 0, '2024-03-19 19:05:05', '2024-03-19 18:05:05');

-- --------------------------------------------------------

--
-- Structure de la table `demos`
--

CREATE TABLE `demos` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `commentaire` text,
  `date` date DEFAULT NULL,
  `personne` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE `domaines` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 'FORMATION', '2023-01-13 11:39:06', '2023-01-13 12:39:06'),
(2, 'TECHNOLOGIE', '2023-01-13 11:39:06', '2023-01-13 12:39:06');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise_clients`
--

CREATE TABLE `entreprise_clients` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `statut` int(11) DEFAULT '0',
  `pays_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise_clients`
--

INSERT INTO `entreprise_clients` (`id`, `libelle`, `statut`, `pays_id`, `created_at`, `updated_at`) VALUES
(1, 'ILLIMITIS', 0, 1, '2022-11-21 18:45:10', '2022-11-21 17:45:10'),
(2, 'Maroc-Food', 0, NULL, '2022-11-21 18:45:26', '2022-11-21 17:45:26');

-- --------------------------------------------------------

--
-- Structure de la table `formulaires`
--

CREATE TABLE `formulaires` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `secteur_activite` varchar(255) DEFAULT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `nbre_commerciaux` varchar(255) DEFAULT NULL,
  `version_besoin` varchar(255) DEFAULT NULL,
  `attente_particuliere` varchar(255) DEFAULT NULL,
  `souhait_recontacter` tinyint(4) DEFAULT '0',
  `quand_recontacter` varchar(255) DEFAULT NULL,
  `connaissance_pateforme` varchar(255) DEFAULT NULL,
  `statut` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

CREATE TABLE `historiques` (
  `id` int(11) NOT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `sous_opportunite_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `date_ajouter` datetime DEFAULT NULL,
  `date_modifier` datetime DEFAULT NULL,
  `date_creer_op` datetime DEFAULT NULL,
  `probabilite` varchar(255) DEFAULT NULL,
  `objectif_de_vente` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historiques`
--

INSERT INTO `historiques` (`id`, `opportunite_id`, `sous_opportunite_id`, `entreprise_client_id`, `statut`, `date_ajouter`, `date_modifier`, `date_creer_op`, `probabilite`, `objectif_de_vente`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '12', '2024-03-01 15:23:18', '2024-03-01 15:23:18', '2024-03-01 15:23:18', NULL, NULL, '2024-03-01 16:23:18', '2024-03-01 15:23:18'),
(2, 2, NULL, NULL, '11', '2024-03-19 18:13:14', '2024-03-19 18:23:00', '2024-03-19 18:13:14', NULL, NULL, '2024-03-19 19:13:14', '2024-03-19 18:13:14'),
(3, 2, NULL, NULL, '15', '2024-03-19 18:23:00', '2024-03-19 18:23:00', '2024-03-19 18:23:00', NULL, NULL, '2024-03-19 19:23:00', '2024-03-19 18:23:00');

-- --------------------------------------------------------

--
-- Structure de la table `historiques_probas`
--

CREATE TABLE `historiques_probas` (
  `id` int(11) NOT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `sous_opportunite_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `date_ajouter` datetime DEFAULT NULL,
  `date_modifier` datetime DEFAULT NULL,
  `date_creer_op` datetime DEFAULT NULL,
  `probabilite` varchar(255) DEFAULT NULL,
  `objectif_de_vente` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historiques_probas`
--

INSERT INTO `historiques_probas` (`id`, `opportunite_id`, `sous_opportunite_id`, `entreprise_client_id`, `statut`, `date_ajouter`, `date_modifier`, `date_creer_op`, `probabilite`, `objectif_de_vente`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '12', '2024-03-01 15:23:18', '2024-03-01 15:23:18', '2024-03-01 15:23:18', NULL, NULL, '2024-03-01 16:23:18', '2024-03-01 15:23:18'),
(2, 2, NULL, NULL, '11', '2024-03-19 18:13:14', '2024-03-19 18:13:14', '2024-03-19 18:13:14', NULL, NULL, '2024-03-19 19:13:14', '2024-03-19 18:13:14');

-- --------------------------------------------------------

--
-- Structure de la table `itineraires`
--

CREATE TABLE `itineraires` (
  `id` int(11) NOT NULL,
  `maps` varchar(255) DEFAULT NULL,
  `depart` varchar(255) DEFAULT NULL,
  `arriver` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `multinationals`
--

CREATE TABLE `multinationals` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `multinationals`
--

INSERT INTO `multinationals` (`id`, `libelle`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(1, 'ORANGE', NULL, '2022-10-06 17:16:31', '2022-10-06 15:16:31'),
(2, 'VIVO ENERGY', NULL, '2022-10-06 17:16:31', '2022-10-06 15:16:31'),
(3, 'TOTAL', NULL, '2022-10-07 16:33:24', '2022-10-07 14:33:24'),
(4, 'SHELL', NULL, '2022-10-07 16:33:24', '2022-10-07 14:33:24'),
(5, 'ECOBANK', NULL, '2022-10-07 16:34:03', '2022-10-07 14:34:03'),
(6, 'IAM GOLD', NULL, '2022-10-07 16:34:03', '2022-10-07 14:34:03'),
(7, 'SOCIETE GENERALE', NULL, '2022-10-07 16:34:03', '2022-10-07 14:34:03'),
(8, 'Autres / Others', NULL, '2022-10-08 02:56:54', '2022-10-08 00:56:54'),
(9, 'BMCE', NULL, '2022-10-08 02:05:24', '2022-10-08 00:05:24'),
(10, 'Groupe', NULL, '2022-10-08 02:32:53', '2022-10-08 00:32:53'),
(11, 'ENABEL', NULL, '2022-10-13 15:37:45', '2022-10-13 13:37:45'),
(12, 'CMA CGM', NULL, '2022-10-13 17:30:11', '2022-10-13 15:30:11'),
(13, 'GROUPE ATLANTIQUE BANQUE', NULL, '2022-10-14 13:04:50', '2022-10-14 11:04:50'),
(14, 'GIZ', NULL, '2022-10-17 09:23:56', '2022-10-17 07:23:56'),
(15, 'Orange', NULL, '2022-10-21 17:00:50', '2022-10-21 15:00:50'),
(16, 'UBA', NULL, '2022-10-21 17:02:15', '2022-10-21 15:02:15'),
(18, 'ONG DIAKONIA', NULL, '2022-11-14 10:54:22', '2022-11-14 09:54:22'),
(19, 'CFAO MOTORS', NULL, '2022-11-14 17:45:54', '2022-11-14 16:45:54'),
(22, 'IRC', NULL, '2022-11-18 10:54:40', '2022-11-18 09:54:40'),
(23, 'FIDELIS GROUPE', NULL, '2022-11-21 11:50:20', '2022-11-21 10:50:20'),
(24, 'PREMIERE URGENCE HUMANITAIRE', NULL, '2022-11-21 11:55:24', '2022-11-21 10:55:24'),
(25, 'GROUPE UNIVERS BIO', NULL, '2022-11-21 11:57:27', '2022-11-21 10:57:27'),
(27, 'BANQUE AFRICAINE DE DEVELOPPEMENT', NULL, '2022-11-23 14:33:36', '2022-11-23 13:33:36'),
(29, 'IMPERIAL TOBACO', NULL, '2022-12-02 16:07:28', '2022-12-02 15:07:28'),
(31, 'BANK OF AFRICA', NULL, '2022-12-06 08:34:54', '2022-12-06 07:34:54'),
(32, 'CORIS HOLDING', NULL, '2022-12-07 15:00:41', '2022-12-07 14:00:41'),
(33, 'GROUPE SOPAM', NULL, '2022-12-16 09:29:09', '2022-12-16 08:29:09'),
(34, 'DHL', NULL, '2022-12-16 09:52:53', '2022-12-16 08:52:53'),
(35, 'GROUPE BIA', NULL, '2022-12-16 10:06:11', '2022-12-16 09:06:11'),
(36, 'SUNU ASSURANCE', NULL, '2022-12-20 17:43:54', '2022-12-20 16:43:54'),
(37, 'BAOBAB', NULL, '2022-12-21 17:01:14', '2022-12-21 16:01:14'),
(38, 'GCM GROUPE', NULL, '2022-12-22 12:55:26', '2022-12-22 11:55:26'),
(39, 'COFINA GROUPE', NULL, '2022-12-22 13:44:47', '2022-12-22 12:44:47'),
(40, 'ORABANK', NULL, '2022-12-22 15:23:47', '2022-12-22 14:23:47'),
(41, 'FSIP', NULL, '2023-02-08 12:01:27', '2023-02-08 11:01:27'),
(42, 'GROUPE SIPHARJOONG INTERNATIONAL', NULL, '2023-02-17 11:42:41', '2023-02-17 10:42:41'),
(43, 'SOS VILLAGE INTERNATIONAL', NULL, '2023-03-16 17:44:54', '2023-03-16 16:44:54'),
(44, NULL, NULL, '2023-03-17 16:39:11', '2023-03-17 15:39:11'),
(45, NULL, NULL, '2023-03-21 10:43:33', '2023-03-21 09:43:33'),
(46, 'MAROC TELECOM', NULL, '2023-03-22 09:09:37', '2023-03-22 08:09:37'),
(47, 'UN WOMEN', NULL, '2023-04-06 09:49:18', '2023-04-06 07:49:18'),
(48, 'CIM-FASO', NULL, '2023-04-17 13:15:18', '2023-04-17 11:15:18'),
(49, 'jgdjfkfojd-test', NULL, '2023-04-17 13:18:04', '2023-04-17 11:18:04'),
(50, 'Ubuntu Fingerz United', NULL, '2023-04-17 13:30:53', '2023-04-17 11:30:53'),
(51, 'Ubuntu Fingerz United', NULL, '2023-04-17 13:44:59', '2023-04-17 11:44:59'),
(52, 'Mybank', NULL, '2023-04-17 14:16:34', '2023-04-17 12:16:34'),
(53, 'ONG SOS SAHEL', NULL, '2023-05-15 13:46:54', '2023-05-15 11:46:54'),
(54, NULL, NULL, '2023-05-31 10:37:30', '2023-05-31 08:37:30'),
(55, NULL, NULL, '2023-05-31 12:47:10', '2023-05-31 10:47:10'),
(56, NULL, NULL, '2023-05-31 14:03:09', '2023-05-31 12:03:09'),
(57, 'ONU FEMMES', NULL, '2023-06-01 13:44:40', '2023-06-01 11:44:40'),
(58, 'MERCY CORPS INTERNATIONAL', NULL, '2023-06-21 17:06:20', '2023-06-21 15:06:20'),
(59, NULL, NULL, '2023-07-03 09:18:33', '2023-07-03 07:18:33'),
(60, 'MCA NETWORK', NULL, '2023-07-05 09:23:27', '2023-07-05 07:23:27'),
(61, 'ASECNA', NULL, '2023-07-19 16:15:06', '2023-07-19 14:15:06'),
(62, 'Save The Children', NULL, '2023-08-06 13:50:37', '2023-08-06 11:50:37'),
(63, 'BAD', NULL, '2023-08-07 09:41:22', '2023-08-07 07:41:22'),
(64, 'NEEMBA GROUP', NULL, '2023-10-24 12:05:50', '2023-10-24 10:05:50'),
(65, 'ONU', NULL, '2024-01-24 10:00:14', '2024-01-24 09:00:14');

-- --------------------------------------------------------

--
-- Structure de la table `objectif_commissions`
--

CREATE TABLE `objectif_commissions` (
  `id` int(11) NOT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `Objectif_mois` varchar(255) DEFAULT NULL,
  `commission_p` varchar(255) DEFAULT NULL,
  `nbre_contact` varchar(255) DEFAULT NULL,
  `nbre_demo` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `nbre_appel_quotidien` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `opportunites`
--

CREATE TABLE `opportunites` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `contact` tinyint(1) DEFAULT '0',
  `commercial_id` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `marge` varchar(255) DEFAULT NULL,
  `probabilite` varchar(255) DEFAULT NULL,
  `valeur_actuelle` varchar(255) DEFAULT NULL,
  `objectif_de_vente` varchar(255) DEFAULT NULL,
  `archiver` tinyint(1) DEFAULT '0',
  `target_vente` varchar(255) DEFAULT NULL,
  `origine_id` int(11) DEFAULT NULL,
  `commercial_backup` int(11) DEFAULT NULL,
  `contact_principal_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `contact_secondaire_id` int(11) DEFAULT NULL,
  `raison_annuler` varchar(255) DEFAULT NULL,
  `concurrence` varchar(255) DEFAULT NULL,
  `notes` text,
  `statut` int(11) DEFAULT NULL,
  `vendu` tinyint(1) DEFAULT '0',
  `raison_archive` varchar(255) DEFAULT NULL,
  `deadline_desarchiver` date DEFAULT NULL,
  `raison_abandonner` varchar(255) DEFAULT NULL,
  `date_ajouter` timestamp NULL DEFAULT NULL,
  `date_history` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_history_proba` datetime DEFAULT CURRENT_TIMESTAMP,
  `multinational` tinyint(1) DEFAULT '0',
  `date_debut` varchar(255) DEFAULT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `backup` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `opportunites`
--

INSERT INTO `opportunites` (`id`, `libelle`, `prospect_id`, `contact`, `commercial_id`, `deadline`, `superieur_id`, `marge`, `probabilite`, `valeur_actuelle`, `objectif_de_vente`, `archiver`, `target_vente`, `origine_id`, `commercial_backup`, `contact_principal_id`, `entreprise_client_id`, `contact_secondaire_id`, `raison_annuler`, `concurrence`, `notes`, `statut`, `vendu`, `raison_archive`, `deadline_desarchiver`, `raison_abandonner`, `date_ajouter`, `date_history`, `date_history_proba`, `multinational`, `date_debut`, `pays_id`, `backup`, `created_at`, `updated_at`) VALUES
(1, 'Achète moi des bonbons', 1, 1, 91, '2024-03-31', 88, NULL, '30', NULL, '2300000', 0, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 0, NULL, NULL, NULL, NULL, '2024-03-01 16:23:18', '2024-03-01 16:23:18', 0, NULL, 1, NULL, '2024-03-01 15:23:18', '2024-03-01 14:23:18'),
(2, '50kg de fraise', 6, 1, 56, '2024-04-20', 56, NULL, '80', NULL, '250000', 0, NULL, 4, 90, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, NULL, NULL, '2024-03-19 18:23:00', '2024-03-19 19:13:14', 0, NULL, 1, NULL, '2024-03-19 18:13:14', '2024-03-19 17:23:00');

-- --------------------------------------------------------

--
-- Structure de la table `origines`
--

CREATE TABLE `origines` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `origines`
--

INSERT INTO `origines` (`id`, `libelle`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(1, 'Appel d\'offres 3FPT', NULL, '2022-09-27 17:22:51', '2022-09-27 15:22:51'),
(2, 'Appel d\'offres Entreprise', NULL, '2022-09-27 17:22:51', '2022-09-27 15:22:51'),
(3, 'Initiative ILLIMITIS', NULL, '2022-09-27 17:26:41', '2022-09-27 15:26:41'),
(4, 'Réseau personnel', NULL, '2022-10-03 13:19:37', '2022-10-03 11:19:37');

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`id`, `libelle`, `entreprise_client_id`, `commission`, `created_at`, `updated_at`) VALUES
(1, '3%', NULL, '0.03', '2022-10-02 21:11:27', '2022-10-02 19:11:27'),
(2, '5%', NULL, '0.05', '2022-10-02 21:11:27', '2022-10-02 19:11:27'),
(3, '6%', NULL, '0.06', '2022-10-06 18:03:02', '2022-10-06 16:03:02'),
(4, '7%', NULL, '0.07', '2022-10-06 18:03:02', '2022-10-06 16:03:02'),
(5, '8%', NULL, '0.08', '2022-10-06 18:03:41', '2022-10-06 16:03:41'),
(6, '9%', NULL, '0.09', '2022-10-06 18:03:41', '2022-10-06 16:03:41'),
(7, '10%', NULL, '0.1', '2022-10-06 18:04:09', '2022-10-06 16:04:09'),
(8, '11%', NULL, '0.11', '2022-10-06 18:04:09', '2022-10-06 16:04:09');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('edith.a@illimitis.com', '$2y$10$abzPbNx.5TZQmxu.5S1.VOFRgVzLgSvj9NM8IvL1c31A8kFEGkXqu', '2022-10-27 09:18:05'),
('gnagna.n@illimitis.com', '$2y$10$nCVfo8RfMgy5kOi6tcSLVOIDSEq.7dgyfSP4oJsjZJEcFufSeBCUe', '2022-12-12 08:46:37'),
('anthyme.k@illimitis.com', '$2y$10$JjpvnpuNnE41ybYKtG4iCOrFWPIOZGBRZaKLC5LDKlM69pgRpiBEm', '2023-01-18 09:06:51');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(2, 'Mali', '2020-12-03 23:02:41', '2019-11-26 22:17:57'),
(1, 'Senegal', '2020-12-03 23:02:41', '2019-12-06 12:28:35'),
(3, 'Ghana', '2020-12-03 23:02:41', '2019-11-26 22:18:08'),
(4, 'Cap-vert', '2020-12-03 23:02:41', '2019-11-26 22:18:19'),
(5, 'Burkina Faso', '2020-12-03 23:02:41', '2019-12-06 12:28:26'),
(6, 'Sudan', '2020-12-03 23:02:41', '2019-11-26 22:18:34'),
(7, 'Nigeria', '2020-12-03 23:02:41', '2019-11-26 22:18:44'),
(8, 'Togo', '2020-12-03 23:02:41', '2019-11-26 22:18:51'),
(9, 'RD Congo', '2020-12-03 23:02:41', '2019-11-26 22:19:10'),
(10, 'Afrique du Sud', '2020-12-29 08:38:04', '2020-12-29 00:38:04'),
(11, 'Namibie', '2020-12-03 23:02:41', '2019-11-26 22:19:38'),
(12, 'Zambie', '2020-12-03 23:02:41', '2019-11-26 22:19:46'),
(13, 'Côte d\'Ivoire', '2020-12-03 23:02:41', '2019-11-26 22:23:14'),
(14, 'Algérie', '2020-12-03 23:02:41', '2019-11-26 22:23:24'),
(16, 'Egypte', '2020-12-03 23:02:41', '2019-11-26 22:23:36'),
(17, 'Somalie', '2020-12-03 23:02:41', '2019-11-26 22:23:43'),
(18, 'Angola', '2020-12-03 23:02:41', '2019-11-26 22:25:23'),
(19, 'Bénin', '2020-12-03 23:02:41', '2019-11-26 22:25:33'),
(20, 'Botswana', '2020-12-03 23:02:41', '2019-11-26 22:25:54'),
(21, 'Burundi', '2020-12-03 23:02:41', '2019-11-26 22:26:10'),
(22, 'Cameroun', '2020-12-03 23:02:41', '2019-11-26 22:26:18'),
(23, 'République centrafricaine', '2020-12-03 23:02:41', '2019-11-26 22:26:49'),
(24, 'Comores', '2020-12-03 23:02:41', '2019-11-26 22:26:59'),
(25, 'Congo', '2020-12-03 23:02:41', '2019-11-26 22:27:13'),
(26, 'Djibouti', '2020-12-03 23:02:41', '2019-11-26 22:27:33'),
(27, 'Érythrée', '2020-12-03 23:02:41', '2019-11-26 22:27:55'),
(28, 'Éthiopie', '2020-12-03 23:02:41', '2019-11-26 22:28:06'),
(29, 'Gabon', '2020-12-03 23:02:41', '2019-11-26 22:28:14'),
(30, 'Gambie', '2020-12-03 23:02:41', '2019-11-26 22:28:22'),
(31, 'Guinée Bissau', '2020-12-03 23:02:41', '2019-11-26 22:28:39'),
(32, 'Guinée équatoriale', '2020-12-03 23:02:41', '2019-11-26 22:28:59'),
(33, 'Kenya', '2020-12-03 23:02:41', '2019-11-26 22:29:09'),
(34, 'Lesotho', '2020-12-03 23:02:41', '2019-11-26 22:29:28'),
(35, 'Libéria', '2020-12-03 23:02:41', '2019-11-26 22:29:47'),
(36, 'Libye', '2020-12-03 23:02:41', '2019-11-26 22:29:59'),
(37, 'Madagascar', '2020-12-03 23:02:41', '2019-11-26 22:30:48'),
(38, 'Malawi', '2020-12-03 23:02:41', '2019-11-26 22:31:08'),
(39, 'Maroc', '2020-12-03 23:02:41', '2019-11-26 22:31:22'),
(40, 'Maurice', '2020-12-03 23:02:41', '2019-11-26 22:31:44'),
(41, 'Mauritanie', '2020-12-03 23:02:41', '2019-11-26 22:32:05'),
(42, 'Mozambique', '2020-12-03 23:02:41', '2019-11-26 22:32:21'),
(43, 'Niger', '2020-12-03 23:02:41', '2019-11-26 22:32:28'),
(44, 'Ouganda', '2020-12-03 23:02:41', '2019-11-26 22:32:45'),
(45, 'Rwanda', '2020-12-03 23:02:41', '2019-11-26 22:33:02'),
(46, 'Sao Tomé-et-Principe', '2020-12-03 23:02:41', '2019-11-26 22:33:27'),
(47, 'Seychelles', '2020-12-03 23:02:41', '2019-11-26 22:33:46'),
(48, 'Sierra Leone', '2020-12-03 23:02:41', '2019-11-26 22:33:59'),
(49, 'Sud-Soudan', '2020-12-03 23:02:41', '2019-11-26 22:34:15'),
(50, 'Swaziland', '2020-12-03 23:02:41', '2019-11-26 22:34:31'),
(51, 'Tanzanie', '2020-12-03 23:02:41', '2019-11-26 22:34:50'),
(52, 'Tchad', '2020-12-03 23:02:41', '2019-11-26 22:35:04'),
(53, 'Tunisie', '2020-12-03 23:02:41', '2019-11-26 22:35:13'),
(54, 'Zimbabwe', '2020-12-03 23:02:41', '2019-11-26 22:35:37'),
(55, 'Allemagne', '2020-12-03 23:02:41', '2019-11-26 22:36:15'),
(56, 'Albanie', '2020-12-03 23:02:41', '2019-11-26 22:36:22'),
(57, 'France', '2020-12-03 23:02:41', '2019-11-26 22:36:30'),
(58, 'Italie', '2020-12-03 23:02:41', '2019-11-26 22:36:38'),
(59, 'Portugal', '2020-12-03 23:02:41', '2019-11-26 22:36:45'),
(60, 'Espagne', '2020-12-03 23:02:41', '2019-11-26 22:36:53'),
(61, 'Grèce', '2020-12-03 23:02:41', '2019-11-26 22:37:39'),
(62, 'Belgique', '2020-12-03 23:02:41', '2019-11-26 22:37:50'),
(63, 'Andorre', '2020-12-03 23:02:41', '2019-11-26 22:38:07'),
(64, 'Arménie', '2020-12-03 23:02:41', '2019-11-26 22:38:25'),
(65, 'Autriche', '2020-12-03 23:02:41', '2019-11-26 22:38:34'),
(66, 'Azerbaïdjan', '2020-12-03 23:02:41', '2019-11-26 22:39:24'),
(67, 'Biélorussie', '2020-12-03 23:02:41', '2019-11-26 22:39:53'),
(68, 'Bosnie-Herzégovnie', '2020-12-03 23:02:41', '2019-11-26 22:40:17'),
(69, 'Bulgarie', '2020-12-03 23:02:41', '2019-11-26 22:40:28'),
(70, 'Chypre', '2020-12-03 23:02:41', '2019-11-26 22:40:38'),
(71, 'Croatie', '2020-12-03 23:02:41', '2019-11-26 22:40:47'),
(72, 'Danemark', '2020-12-03 23:02:41', '2019-11-26 22:40:59'),
(73, 'Estonie', '2020-12-03 23:02:41', '2019-11-26 22:41:11'),
(74, 'Finlande', '2020-12-03 23:02:41', '2019-11-26 22:41:32'),
(75, 'Géorgie', '2020-12-03 23:02:41', '2019-11-26 22:41:46'),
(76, 'Hongrie', '2020-12-03 23:02:41', '2019-11-26 22:41:56'),
(77, 'Irlande', '2020-12-03 23:02:41', '2019-11-26 22:42:04'),
(78, 'Islande', '2020-12-03 23:02:41', '2019-11-26 22:42:12'),
(79, 'Lettonie', '2020-12-03 23:02:41', '2019-11-26 22:42:25'),
(80, 'Liechtenstein', '2020-12-03 23:02:41', '2019-11-26 22:42:50'),
(81, 'Lituanie', '2020-12-03 23:02:41', '2019-11-26 22:43:17'),
(82, 'Luxembourg', '2020-12-03 23:02:41', '2019-11-26 22:43:33'),
(83, 'République deMacédoine', '2020-12-03 23:02:41', '2019-11-26 22:44:10'),
(84, 'Malte', '2020-12-03 23:02:41', '2019-11-26 22:44:20'),
(85, 'Moldavie', '2020-12-03 23:02:41', '2019-11-26 22:44:31'),
(86, 'Monaco', '2020-12-03 23:02:41', '2019-11-26 22:44:40'),
(87, 'Monténégro', '2020-12-03 23:02:41', '2019-11-26 22:45:02'),
(88, 'Norvège', '2020-12-03 23:02:41', '2019-11-26 22:45:20'),
(89, 'Pays-Bas', '2020-12-03 23:02:41', '2019-11-26 22:45:34'),
(90, 'Pologne', '2020-12-03 23:02:41', '2019-11-26 22:45:40'),
(91, 'République tchèque', '2020-12-03 23:02:41', '2019-11-26 22:46:06'),
(92, 'Roumanie', '2020-12-03 23:02:41', '2019-11-26 22:46:15'),
(93, 'Royaume-Uni', '2020-12-03 23:02:41', '2019-11-26 22:46:31'),
(94, 'Russie', '2020-12-03 23:02:41', '2019-11-26 22:46:41'),
(95, 'Saint-Marin', '2020-12-03 23:02:41', '2019-11-26 22:47:02'),
(96, 'Serbie', '2020-12-03 23:02:41', '2019-11-26 22:47:13'),
(97, 'Slovaquie', '2020-12-03 23:02:41', '2019-11-26 22:47:26'),
(98, 'Slovénie', '2020-12-03 23:02:41', '2019-11-26 22:47:38'),
(99, 'Suède', '2020-12-03 23:02:41', '2019-11-26 22:47:50'),
(100, 'Suisse', '2020-12-03 23:02:41', '2019-11-26 22:47:59'),
(101, 'Ukraine', '2020-12-03 23:02:41', '2019-11-26 22:48:18'),
(102, 'Vatican', '2020-12-03 23:02:41', '2019-11-26 22:48:30'),
(103, 'Antigua-Barbuda', '2020-12-03 23:02:41', '2019-11-27 09:11:11'),
(104, 'Argentine', '2020-12-03 23:02:41', '2019-11-27 09:11:19'),
(105, 'Bahamas', '2020-12-03 23:02:41', '2019-11-27 09:11:30'),
(106, 'Barbade', '2020-12-03 23:02:41', '2019-11-27 09:11:43'),
(107, 'Belize', '2020-12-03 23:02:41', '2019-11-27 09:11:54'),
(108, 'Bolivie', '2020-12-03 23:02:41', '2019-11-27 09:12:02'),
(109, 'Brésil', '2020-12-03 23:02:41', '2019-11-27 09:12:14'),
(110, 'Canada', '2020-12-03 23:02:41', '2019-11-27 09:12:20'),
(111, 'Chili', '2020-12-03 23:02:41', '2019-11-27 09:12:31'),
(112, 'Colombie', '2020-12-03 23:02:41', '2019-11-27 09:12:37'),
(113, 'Costa Rica', '2020-12-03 23:02:41', '2019-11-27 09:12:47'),
(114, 'Cuba', '2020-12-03 23:02:41', '2019-11-27 09:12:53'),
(115, 'République dominicaine', '2020-12-03 23:02:41', '2019-11-27 09:13:22'),
(116, 'Dominique', '2020-12-03 23:02:41', '2019-11-27 09:13:31'),
(117, 'Équateur', '2020-12-03 23:02:41', '2019-11-27 09:13:51'),
(118, 'États-Unis', '2020-12-03 23:02:41', '2020-01-08 12:41:35'),
(119, 'Grenade', '2020-12-03 23:02:41', '2019-11-27 09:14:25'),
(120, 'Guatemala', '2020-12-03 23:02:41', '2019-11-27 09:14:41'),
(121, 'Guyana', '2020-12-03 23:02:41', '2019-11-27 09:14:48'),
(122, 'Haïti', '2020-12-03 23:02:41', '2019-11-27 09:15:02'),
(123, 'Honduras', '2020-12-03 23:02:41', '2019-11-27 09:15:12'),
(124, 'Jamaïque', '2020-12-03 23:02:41', '2019-11-27 09:15:33'),
(125, 'Mexique', '2020-12-03 23:02:41', '2019-11-27 09:15:42'),
(126, 'Nicaragua', '2020-12-03 23:02:41', '2019-11-27 09:15:55'),
(127, 'Panama', '2020-12-03 23:02:41', '2019-11-27 09:16:04'),
(128, 'Paraguay', '2020-12-03 23:02:41', '2019-11-27 09:16:30'),
(129, 'Pérou', '2020-12-03 23:02:41', '2019-11-27 09:16:38'),
(130, 'Porto Rico', '2020-12-03 23:02:41', '2019-11-27 09:16:50'),
(131, 'Saint-Christophe-et-Niévès', '2020-12-03 23:02:41', '2019-11-27 09:17:25'),
(132, 'Sainte-Lucie', '2020-12-03 23:02:41', '2019-11-27 09:17:40'),
(133, 'Saint-vincenr-et-les-Grenadines', '2020-12-03 23:02:41', '2019-11-27 09:18:17'),
(134, 'Salvador', '2020-12-03 23:02:41', '2019-11-27 09:18:26'),
(135, 'Suriname', '2020-12-03 23:02:41', '2019-11-27 09:18:35'),
(136, 'Trinité-et-Tobago', '2020-12-03 23:02:41', '2019-11-27 09:19:00'),
(137, 'Uruguay', '2020-12-03 23:02:41', '2019-11-27 09:19:15'),
(138, 'Venzuela', '2020-12-03 23:02:41', '2019-11-27 09:19:27'),
(139, 'Afghanistan', '2020-12-03 23:02:41', '2019-11-27 09:20:16'),
(140, 'Arabie Saoudite', '2020-12-03 23:02:41', '2019-11-27 09:20:34'),
(141, 'Bahreïn', '2020-12-03 23:02:41', '2019-11-27 09:20:58'),
(142, 'Bangladesh', '2020-12-03 23:02:41', '2019-11-27 09:21:10'),
(143, 'Bhoutan', '2020-12-03 23:02:41', '2019-11-27 09:21:18'),
(144, 'Birmanie', '2020-12-03 23:02:41', '2019-11-27 09:21:31'),
(145, 'Brunei', '2020-12-03 23:02:41', '2019-11-27 09:21:41'),
(146, 'Cambodge', '2020-12-03 23:02:41', '2019-11-27 09:22:00'),
(147, 'Chine', '2020-12-03 23:02:41', '2019-11-27 09:22:06'),
(148, 'Corée du Nord', '2020-12-03 23:02:41', '2019-11-27 09:22:19'),
(149, 'Corée du Sud', '2020-12-03 23:02:41', '2019-11-27 09:22:29'),
(150, 'Émirats Arabies Unis', '2020-12-03 23:02:41', '2019-11-27 09:22:52'),
(151, 'Inde', '2020-12-03 23:02:41', '2019-11-27 09:22:57'),
(152, 'Indonésie', '2020-12-03 23:02:41', '2019-11-27 09:23:11'),
(153, 'Irak', '2020-12-03 23:02:41', '2019-11-27 09:23:20'),
(154, 'Iran', '2020-12-03 23:02:41', '2019-11-27 09:23:27'),
(155, 'Israël', '2020-12-03 23:02:41', '2019-11-27 09:23:40'),
(156, 'Japon', '2020-12-03 23:02:41', '2019-11-27 09:23:46'),
(157, 'Jordanie', '2020-12-03 23:02:41', '2019-11-27 09:23:59'),
(158, 'Kazakhstan', '2020-12-03 23:02:41', '2019-11-27 09:24:25'),
(159, 'Kazakhizistan', '2020-12-03 23:02:41', '2019-11-27 09:24:53'),
(160, 'Koweït', '2020-12-03 23:02:41', '2019-11-27 09:25:22'),
(161, 'Laos', '2020-12-03 23:02:41', '2019-11-27 09:25:27'),
(162, 'Liban', '2020-12-03 23:02:41', '2019-11-27 09:25:32'),
(163, 'Malaisie', '2020-12-03 23:02:41', '2019-11-27 09:25:45'),
(164, 'Maldives', '2020-12-03 23:02:41', '2019-11-27 09:25:54'),
(165, 'Mongolie', '2020-12-03 23:02:41', '2019-11-27 09:26:24'),
(166, 'Népal', '2020-12-03 23:02:41', '2019-11-27 09:26:32'),
(167, 'Oman', '2020-12-03 23:02:41', '2019-11-27 09:26:37'),
(168, 'Ouzbékistan', '2020-12-03 23:02:41', '2019-11-27 09:26:54'),
(169, 'Palestine', '2020-12-03 23:02:41', '2019-11-27 09:27:08'),
(170, 'Pakistan', '2020-12-03 23:02:41', '2019-11-27 09:27:19'),
(171, 'Philippines', '2020-12-03 23:02:41', '2019-11-27 09:27:43'),
(172, 'Qatar', '2020-12-03 23:02:41', '2019-11-27 09:27:53'),
(173, 'Singapour', '2020-12-03 23:02:41', '2019-11-27 09:28:08'),
(174, 'Sri Lanka', '2020-12-03 23:02:41', '2019-11-27 09:28:18'),
(175, 'Syrie', '2020-12-03 23:02:41', '2019-11-27 09:28:29'),
(176, 'Tadjikistan', '2020-12-03 23:02:41', '2019-11-27 09:28:51'),
(177, 'Taïwan', '2020-12-03 23:02:41', '2019-11-27 09:29:04'),
(178, 'Thaïlande', '2020-12-03 23:02:41', '2019-11-27 09:29:14'),
(179, 'Timor Oriental', '2020-12-03 23:02:41', '2019-11-27 09:29:30'),
(180, 'Turkménistan', '2020-12-03 23:02:41', '2019-11-27 09:30:03'),
(181, 'Turquie', '2020-12-03 23:02:41', '2019-11-27 09:30:13'),
(182, 'Viêt Nam', '2020-12-03 23:02:41', '2019-11-27 09:30:27'),
(183, 'Yémen', '2020-12-03 23:02:41', '2019-11-27 09:30:41'),
(184, 'Australie', '2020-12-03 23:02:41', '2019-11-27 09:31:06'),
(185, 'Fidji', '2020-12-03 23:02:41', '2019-11-27 09:31:15'),
(186, 'Kiribati', '2020-12-03 23:02:41', '2019-11-27 09:31:23'),
(187, 'Marshall', '2020-12-03 23:02:41', '2019-11-27 09:31:36'),
(188, 'Micronésie', '2020-12-03 23:02:41', '2019-11-27 09:31:53'),
(189, 'Nauru', '2020-12-03 23:02:41', '2019-11-27 09:32:04'),
(190, 'Nouvelle-Zélande', '2020-12-03 23:02:41', '2019-11-27 09:32:29'),
(191, 'Palaos', '2020-12-03 23:02:41', '2019-11-27 09:32:38'),
(192, 'Papouasie-Nouvelle-Guinée', '2020-12-03 23:02:41', '2019-11-27 09:33:53'),
(193, 'Salomon', '2020-12-03 23:02:41', '2019-11-27 09:34:11'),
(194, 'Samoa', '2020-12-03 23:02:41', '2019-11-27 09:34:32'),
(195, 'Tonga', '2020-12-03 23:02:41', '2019-11-27 09:34:58'),
(196, 'Tuvalu', '2020-12-03 23:02:41', '2019-11-27 09:35:20'),
(197, 'Vanuatu', '2020-12-03 23:02:41', '2019-11-27 09:35:39'),
(198, 'Guinée', '2022-10-17 12:54:57', '2022-10-17 10:54:57');

-- --------------------------------------------------------

--
-- Structure de la table `performances`
--

CREATE TABLE `performances` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performancesbfs`
--

CREATE TABLE `performancesbfs` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performancescis`
--

CREATE TABLE `performancescis` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performancessns`
--

CREATE TABLE `performancessns` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performance_bf_globales`
--

CREATE TABLE `performance_bf_globales` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performance_ci_globales`
--

CREATE TABLE `performance_ci_globales` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performance_commerciales`
--

CREATE TABLE `performance_commerciales` (
  `id` int(11) NOT NULL,
  `pourcentage` varchar(255) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `commission_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT '0',
  `periodicite` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performance_globales`
--

CREATE TABLE `performance_globales` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `performance_sn_globales`
--

CREATE TABLE `performance_sn_globales` (
  `id` int(11) NOT NULL,
  `semaine` varchar(255) DEFAULT NULL,
  `objectif_vente` varchar(255) DEFAULT NULL,
  `objectif_demo` varchar(255) DEFAULT NULL,
  `objectif_contact` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_demo` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `perfo_vente` varchar(255) DEFAULT NULL,
  `perfo_demo` varchar(255) DEFAULT NULL,
  `perfo_contact` varchar(255) DEFAULT NULL,
  `perfo_visite` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `libelle`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(1, 'Collaboratis', NULL, '2022-09-21 21:21:09', '2022-09-21 19:21:09'),
(2, 'Optievent', NULL, '2022-09-21 21:21:09', '2022-09-21 19:21:09');

-- --------------------------------------------------------

--
-- Structure de la table `prospections`
--

CREATE TABLE `prospections` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `commercial_backup` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `produit_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heure_debut` varchar(255) DEFAULT NULL,
  `heure_fin` varchar(255) DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `resultat_rv` varchar(255) DEFAULT NULL,
  `statut` int(1) DEFAULT '0',
  `suivi_prospect` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prospections`
--

INSERT INTO `prospections` (`id`, `libelle`, `prospect_id`, `commercial_id`, `superieur_id`, `opportunite_id`, `commercial_backup`, `entreprise_client_id`, `produit_id`, `date`, `heure_debut`, `heure_fin`, `lieu`, `resultat_rv`, `statut`, `suivi_prospect`, `created_at`, `updated_at`) VALUES
(1, 'SUnu REV', 1, 91, 88, 1, NULL, NULL, NULL, '2024-03-02', '19:02', NULL, NULL, 'Good', 1, NULL, '2024-03-01 18:00:38', '2024-03-01 17:19:50'),
(2, 'Achète moi des bonbons', 2, 91, 88, NULL, NULL, NULL, NULL, '2024-02-29', '19:04', NULL, NULL, NULL, 0, NULL, '2024-03-01 18:04:17', '2024-03-01 17:04:17');

-- --------------------------------------------------------

--
-- Structure de la table `prospects`
--

CREATE TABLE `prospects` (
  `id` int(11) NOT NULL,
  `nom_entreprise` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `email_entreprise` varchar(255) DEFAULT NULL,
  `secteur_activite` int(11) DEFAULT NULL,
  `secteur_pros_a_appeler` varchar(255) DEFAULT NULL,
  `autres` varchar(255) DEFAULT NULL,
  `suivi_prospect` int(11) DEFAULT NULL,
  `autres_multis` varchar(255) DEFAULT NULL,
  `provenance` varchar(255) DEFAULT NULL,
  `strategique` tinyint(1) DEFAULT '0',
  `groupe` tinyint(1) DEFAULT '0',
  `multinational` varchar(255) DEFAULT NULL,
  `contact` tinyint(1) DEFAULT '0',
  `pays_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `prospect_bdd_id` int(11) DEFAULT NULL,
  `prospect_bdd` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prospects`
--

INSERT INTO `prospects` (`id`, `nom_entreprise`, `phone`, `logo`, `commercial_id`, `superieur_id`, `entreprise_client_id`, `email_entreprise`, `secteur_activite`, `secteur_pros_a_appeler`, `autres`, `suivi_prospect`, `autres_multis`, `provenance`, `strategique`, `groupe`, `multinational`, `contact`, `pays_id`, `date`, `ville`, `zone`, `prospect_bdd_id`, `prospect_bdd`, `created_at`, `updated_at`) VALUES
(1, 'Illimitis Fallou', '+221760121041', NULL, 91, 88, NULL, NULL, 21, NULL, NULL, NULL, NULL, NULL, 0, 0, '19', 0, 62, NULL, NULL, NULL, NULL, NULL, '2024-03-01 15:18:18', '2024-03-01 14:18:18'),
(2, 'Mano', '+221760121041', NULL, 91, 88, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 184, NULL, NULL, NULL, NULL, NULL, '2024-03-01 15:20:41', '2024-03-01 14:20:41'),
(6, 'Restaurant Chez Fallou', '777092285', NULL, 56, 56, NULL, NULL, 0, NULL, 'Restaurant', NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2024-03-19 18:05:05', '2024-03-19 17:05:05'),
(5, 'Illimitis Fallou', NULL, NULL, 88, 56, NULL, NULL, 31, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 93, NULL, NULL, NULL, NULL, NULL, '2024-03-01 18:28:48', '2024-03-01 17:28:48');

-- --------------------------------------------------------

--
-- Structure de la table `prospect_a_appellers`
--

CREATE TABLE `prospect_a_appellers` (
  `id` int(11) NOT NULL,
  `nom_entreprise` varchar(500) DEFAULT NULL,
  `tel_fixe` varchar(255) DEFAULT NULL,
  `tel_mobile` varchar(255) DEFAULT NULL,
  `nom_contact` varchar(255) DEFAULT NULL,
  `tel_contact` varchar(255) DEFAULT NULL,
  `solution_a_vendre` varchar(255) DEFAULT NULL,
  `email_entreprise` varchar(255) DEFAULT NULL,
  `email_contact` varchar(255) DEFAULT NULL,
  `date_import` date DEFAULT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `date_affectation` date DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `date_appel` date DEFAULT NULL,
  `prospect_qualifier` int(11) DEFAULT NULL,
  `prospect_update` int(11) DEFAULT NULL,
  `secteur_activite` varchar(255) DEFAULT NULL,
  `besoin_prioritaire` varchar(255) DEFAULT NULL,
  `autre_besoins` varchar(255) DEFAULT NULL,
  `code_domaine` varchar(255) DEFAULT NULL,
  `probabilite` varchar(255) DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  `site_web` varchar(255) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `raisons`
--

CREATE TABLE `raisons` (
  `id` int(11) NOT NULL,
  `commentaire` text,
  `commercial_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resultat_appels`
--

CREATE TABLE `resultat_appels` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `lib` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `resultat_appels`
--

INSERT INTO `resultat_appels` (`id`, `libelle`, `lib`, `created_at`, `updated_at`) VALUES
(1, 'Prospect qualifié', 'Prospect qualifié', '2023-01-13 10:40:36', '2023-01-13 11:40:36'),
(2, 'Prospect non qualifié', 'Prospect non qualifié', '2023-01-13 10:40:36', '2023-01-13 11:40:36'),
(5, 'Prospect à rappeler', 'Prospect à rappeler', '2023-01-13 10:40:36', '2023-01-13 11:40:36');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `libelle`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(1, 'directeur', NULL, NULL, NULL),
(2, 'commerciaux', NULL, NULL, NULL),
(3, 'responsable', NULL, '2022-10-14 15:16:22', '2022-10-14 13:16:22'),
(4, 'responsable_pole', NULL, '2023-01-31 12:29:18', '2023-01-31 11:29:18');

-- --------------------------------------------------------

--
-- Structure de la table `secteur_activites`
--

CREATE TABLE `secteur_activites` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `secteur_activites`
--

INSERT INTO `secteur_activites` (`id`, `libelle`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(1, 'Agriculture et agro-alimentaire / Agriculture and food processing', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(2, 'Biens de consommation / Consumption Goods', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(3, 'Environnement / Environment', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(4, 'Industrie textile / Textile Industry', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(5, 'Energie / Energy', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(6, 'Tourisme / Tourism', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(7, 'TIC et innovation / ICT and innovation', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(8, 'Artisanat / Arts and crafts', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(9, 'Distribution / Distribution', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(10, 'Industrie manufacturière / Manufacturing industry', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(11, 'Services aux entreprises / Business services', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(12, 'BTP / Construction and public works', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(13, 'Activités médicales et pharmaceutiques / Medical and pharmaceutical activities', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(14, 'Transport & Logistique / Transportation and Logistics', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(15, 'Autres / Others', NULL, '2022-09-26 12:35:26', '2022-09-26 10:35:26'),
(16, 'Bancaire', NULL, '2022-10-08 01:12:47', '2022-10-07 23:12:47'),
(18, 'Télécommunication', NULL, '2022-10-08 01:31:09', '2022-10-07 23:31:09'),
(19, 'ONG', NULL, '2022-10-08 01:55:15', '2022-10-07 23:55:15'),
(21, 'Institution Financière', NULL, '2022-10-08 01:58:05', '2022-10-07 23:58:05'),
(22, 'Automobile', NULL, '2022-10-08 02:02:13', '2022-10-08 00:02:13'),
(24, 'Transfert d\'argent', NULL, '2022-10-08 02:13:31', '2022-10-08 00:13:31'),
(25, 'Supermarché', NULL, '2022-10-08 02:16:04', '2022-10-08 00:16:04'),
(28, 'Formation', NULL, '2022-10-11 14:41:15', '2022-10-11 12:41:15'),
(31, 'Institution', NULL, '2022-10-12 12:15:15', '2022-10-12 10:15:15'),
(32, 'Hydrocarbures', NULL, '2022-10-12 12:19:11', '2022-10-12 10:19:11'),
(33, 'Micro finances', NULL, '2022-10-12 12:31:52', '2022-10-12 10:31:52'),
(35, 'Appui au développement', NULL, '2022-10-13 05:45:30', '2022-10-13 03:45:30'),
(37, 'Promotion des Exportations', NULL, '2022-10-20 12:40:03', '2022-10-20 10:40:03'),
(39, 'Administration', NULL, '2022-10-21 17:42:58', '2022-10-21 15:42:58');

-- --------------------------------------------------------

--
-- Structure de la table `sous_opportunites`
--

CREATE TABLE `sous_opportunites` (
  `id` int(11) NOT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `opportunite` varchar(255) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `statut` tinyint(1) DEFAULT '0',
  `target_vente` varchar(255) DEFAULT NULL,
  `contact` tinyint(1) DEFAULT '0',
  `valeur_actuelle` varchar(255) DEFAULT NULL,
  `marge` varchar(255) DEFAULT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `probabilite` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `objectif_de_vente` varchar(255) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut_opportunites`
--

CREATE TABLE `statut_opportunites` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `probabilite` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `lib` varchar(255) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `statut_opportunites`
--

INSERT INTO `statut_opportunites` (`id`, `libelle`, `probabilite`, `entreprise_client_id`, `lib`, `created_at`, `updated_at`) VALUES
(10, 'Intérêt confirmé', 20, NULL, 'Intérêt confirmé', '2022-09-30 18:42:36', '2022-09-30 16:42:36'),
(11, 'Contact initial', 10, NULL, 'Contact initial', '2022-09-30 18:42:36', '2022-09-30 16:42:36'),
(12, 'Cahier de charges', 30, NULL, 'Cahier de charges', '2022-09-30 18:42:36', '2022-09-30 16:42:36'),
(13, 'En négociation', 50, NULL, 'En négociation', '2022-09-30 18:42:36', '2022-09-30 16:42:36'),
(14, 'Offre envoyée', 40, NULL, 'Offre envoyée', '2022-09-30 18:42:36', '2022-09-30 16:42:36'),
(15, 'Contractualisation', 80, NULL, 'Contractualisation', '2022-09-30 18:42:36', '2022-09-30 16:42:36'),
(16, 'Contrat signé', 100, NULL, 'Contrat signé', '2022-10-02 23:55:47', '2022-10-02 21:55:47'),
(18, 'Perdue', 0, NULL, 'Perdue', '2022-10-11 21:05:26', '2022-10-11 19:05:26');

-- --------------------------------------------------------

--
-- Structure de la table `stock_journalieres`
--

CREATE TABLE `stock_journalieres` (
  `id` int(11) NOT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `montant_vente` varchar(255) DEFAULT NULL,
  `okay` int(11) DEFAULT NULL,
  `objectif_mois` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stock_mensuelles`
--

CREATE TABLE `stock_mensuelles` (
  `id` int(11) NOT NULL,
  `montant` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `nbre_contact` varchar(255) DEFAULT NULL,
  `nbre_contact_ajouter` varchar(255) DEFAULT NULL,
  `nbre_demo` varchar(255) DEFAULT NULL,
  `nbre_demo_ajouter` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `nbre_visite_ajouter` varchar(255) DEFAULT NULL,
  `mois` varchar(255) DEFAULT NULL,
  `pourcentage` varchar(255) DEFAULT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `commission_p` varchar(255) DEFAULT NULL,
  `montant_vente` varchar(255) DEFAULT NULL,
  `objectif_mois` varchar(255) DEFAULT NULL,
  `pourcentage_contact_mois` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `pourcentage_visite_mois` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stock_mensuelles_globales`
--

CREATE TABLE `stock_mensuelles_globales` (
  `id` int(11) NOT NULL,
  `montant` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `nbre_contact` varchar(255) DEFAULT NULL,
  `nbre_contact_ajouter` varchar(255) DEFAULT NULL,
  `nbre_demo` varchar(255) DEFAULT NULL,
  `nbre_demo_ajouter` varchar(255) DEFAULT NULL,
  `objectif_visite` varchar(255) DEFAULT NULL,
  `nbre_visite_ajouter` varchar(255) DEFAULT NULL,
  `mois` varchar(255) DEFAULT NULL,
  `pourcentage` varchar(255) DEFAULT NULL,
  `commission` varchar(255) DEFAULT NULL,
  `commission_p` varchar(255) DEFAULT NULL,
  `montant_vente` varchar(255) DEFAULT NULL,
  `objectif_mois` varchar(255) DEFAULT NULL,
  `pourcentage_contact_mois` varchar(255) DEFAULT NULL,
  `realisation_vente` varchar(255) DEFAULT NULL,
  `realisation_contact` varchar(255) DEFAULT NULL,
  `realisation_visite` varchar(255) DEFAULT NULL,
  `pourcentage_visite_mois` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_prospects`
--

CREATE TABLE `suivi_prospects` (
  `id` int(11) NOT NULL,
  `prospect_appel_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `choix_qualifier` varchar(255) DEFAULT NULL,
  `choix_non_qualifier` varchar(255) DEFAULT NULL,
  `choix_a_rappeler` varchar(255) DEFAULT NULL,
  `domaine_valider` int(11) DEFAULT NULL,
  `centre_dinteret` varchar(255) DEFAULT NULL,
  `personne_a_contacter` varchar(255) DEFAULT NULL,
  `contact_personne` varchar(255) DEFAULT NULL,
  `email_personne` varchar(255) DEFAULT NULL,
  `date_rendezvous` datetime DEFAULT NULL,
  `personne_rv` varchar(255) DEFAULT NULL,
  `contact_rv` varchar(255) DEFAULT NULL,
  `libelle_rv` varchar(255) DEFAULT NULL,
  `commentaire_rv` varchar(255) DEFAULT NULL,
  `lieu_rv` varchar(255) DEFAULT NULL,
  `heure_rv` time DEFAULT NULL,
  `statut_rv` int(11) DEFAULT NULL,
  `resultat_rv` text,
  `date_depot_offre` varchar(255) DEFAULT NULL,
  `date_depot_agreement` varchar(255) DEFAULT NULL,
  `commercial_suivi` int(11) DEFAULT NULL,
  `commentaire_qualifier` varchar(500) DEFAULT NULL,
  `raison_no_qualifier` varchar(255) DEFAULT NULL,
  `date_relance_noqualifier` date DEFAULT NULL,
  `injoignable_comm` varchar(255) DEFAULT NULL,
  `resume` text,
  `date_rappel` datetime DEFAULT NULL,
  `date_a_rappeler` date DEFAULT NULL,
  `demande_rappel` varchar(255) DEFAULT NULL,
  `besoin_rappel` varchar(255) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `etat_qualifier` varchar(255) DEFAULT NULL,
  `pays_id` int(11) DEFAULT NULL,
  `jour` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_prospects22`
--

CREATE TABLE `suivi_prospects22` (
  `id` int(11) NOT NULL,
  `prospect_appel_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `domaine_valider` int(11) DEFAULT NULL,
  `centre_dinteret` varchar(255) DEFAULT NULL,
  `personne_a_contacter` varchar(255) DEFAULT NULL,
  `contact_personne` varchar(255) DEFAULT NULL,
  `email_personne` varchar(255) DEFAULT NULL,
  `date_rendezvous` datetime DEFAULT NULL,
  `personne_rv` varchar(255) DEFAULT NULL,
  `libelle_rv` varchar(255) DEFAULT NULL,
  `commentaire_rv` varchar(255) DEFAULT NULL,
  `raison_no_qualifier` varchar(255) DEFAULT NULL,
  `resume` text,
  `date_rappel` datetime DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `etat_qualifier` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `suivi_qualifiers`
--

CREATE TABLE `suivi_qualifiers` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `suivi_qualifiers`
--

INSERT INTO `suivi_qualifiers` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 'Séance de travail', '2023-01-14 21:05:32', '2023-01-14 20:05:32'),
(2, 'Devis ou courrier à envoyer', '2023-01-14 21:05:32', '2023-01-14 20:05:32'),
(3, 'Se rendre dans l’entreprise', '2023-01-14 21:05:32', '2023-01-14 20:05:32'),
(4, 'Trouver un meilleur interlocuteur/point focal\r\n', '2023-01-14 21:05:32', '2023-01-14 20:05:32');

-- --------------------------------------------------------

--
-- Structure de la table `type_paiements`
--

CREATE TABLE `type_paiements` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_paiements`
--

INSERT INTO `type_paiements` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 'comptant', '2022-11-17 20:17:40', '2022-11-17 19:17:40'),
(2, 'espèce', '2022-11-17 20:17:40', '2022-11-17 19:17:40'),
(3, 'chèque', '2022-11-17 20:18:06', '2022-11-17 19:18:06'),
(4, 'crédit', '2022-11-17 20:18:06', '2022-11-17 19:18:06');

-- --------------------------------------------------------

--
-- Structure de la table `update_opps`
--

CREATE TABLE `update_opps` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) DEFAULT NULL,
  `commentaire` text,
  `personne` text,
  `date` date DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `update_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `nom_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `superieur_id` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_online_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_online_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `change_password` tinyint(1) DEFAULT '0',
  `entreprise_client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `email`, `email_verified_at`, `nom_role`, `superieur_id`, `password`, `remember_token`, `last_online_at`, `heure`, `minute`, `last_online_time`, `change_password`, `entreprise_client_id`, `created_at`, `updated_at`, `photo`) VALUES
(1, 'Admin', 'A', 'admin@gmail.com', NULL, 'admin', NULL, '$2y$10$uCxeKEUM50MIjO2NInRQUO/iOId1p6mrjvjapbapLPJwSSewYx0Vy', NULL, '2023-07-25 16:24:37', '16', '24', '16:24', 0, NULL, NULL, NULL, NULL),
(63, 'Fallou', 'GUEYE', 'fallou.g@illimitis.com', NULL, 'directeur', 56, '$2y$10$1nD7TkgrErfKM6LWCNXcWe867StjHqpGvlBeh4iC9s6f4nNNui..C', '4uQPt3Wbh8iXrlPHhO31Jg0wY8ZIBCoSotjd5TEoR5knbtgfvv8nOpkrL3aZ', '2024-03-19 18:46:12', '18', '46', '18:46', 0, NULL, '2023-02-09 10:52:59', '2023-06-14 11:24:21', 'email_signature Byfeeding (2).png'),
(95, 'Almamy  Mahama', 'GBANE', 'almos921@gmail.com', NULL, 'directeur', 56, '$2y$10$8gn5PGu1trL.XSg4QT8qXedX/DJHweip7OQFWH0Bgi7eB9lUkvFuy', NULL, '2024-03-19 17:27:53', '17', '27', '17:27', 0, NULL, '2024-03-01 15:04:46', '2024-03-01 14:04:46', NULL),
(96, 'Electa', 'KY', 'khyelecta@gmail.com', NULL, 'responsable', 88, '$2y$10$TZpJuXWJRXzpJx7ePDFkUugREjqGrDBAb2QvMQljEOL0olXze2N5u', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2024-03-01 15:06:15', '2024-03-01 14:06:15', NULL),
(97, 'Wivine', 'UWIMINA', 'wivine.divine@gmail.com', NULL, 'responsable', 88, '$2y$10$2prrk8ddTI5B.p/eHP.ivu4oU8jXLw2IZEani5jswnFzQU4to0gci', NULL, '2024-03-01 15:44:10', '15', '44', '15:44', 0, NULL, '2024-03-01 15:07:19', '2024-03-01 14:07:19', NULL),
(98, 'Alfred', 'BANTSANTSA', 'alfredbantsantsa@gmail.com', NULL, 'responsable', 88, '$2y$10$wIvxWDi9KNe7Vy/D5CfGQO0Bdjs.ksyIikH5H8CxWgiClwFUAyDwS', NULL, '2024-03-01 18:23:37', '18', '23', '18:23', 0, NULL, '2024-03-01 15:08:45', '2024-03-01 14:08:45', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(11) NOT NULL,
  `montant` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `montant_debut` varchar(255) DEFAULT NULL,
  `opportunite_id` int(11) DEFAULT NULL,
  `commercial_id` int(11) DEFAULT NULL,
  `entreprise_client_id` int(11) DEFAULT NULL,
  `domaine_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`id`, `montant`, `position`, `montant_debut`, `opportunite_id`, `commercial_id`, `entreprise_client_id`, `domaine_id`, `created_at`, `updated_at`) VALUES
(1, '10000000', NULL, '15000000', 157, 25, NULL, 2, '2022-10-13 16:18:30', '2022-10-13 14:18:30'),
(2, '800000', 0, '1200000', 187, 28, NULL, 1, '2022-11-14 10:55:49', '2022-11-14 09:55:49'),
(3, '6800000', NULL, '10300000', 144, 49, NULL, 1, '2022-02-15 10:53:02', '2022-01-15 09:53:02'),
(4, '430000', 0, '430000', 193, 28, NULL, 2, '2022-11-18 08:47:19', '2022-11-18 07:47:19'),
(5, '700000', 0, '700000', 170, 30, NULL, 1, '2022-11-18 14:04:01', '2022-11-18 13:04:01'),
(6, '3068000', 0, '3068000', 171, 6, NULL, 1, '2022-11-22 12:06:18', '2022-11-22 11:06:18'),
(7, '1900000', 0, '2000000', 220, 25, NULL, 1, '2022-11-24 14:56:34', '2022-11-24 13:56:34'),
(8, '19772965', 0, '20000000', 221, 25, NULL, 2, '2022-11-25 10:10:32', '2022-11-25 09:10:32'),
(9, '100000', 0, '500000', 222, 32, NULL, 1, '2022-11-25 14:42:06', '2022-11-25 13:42:06'),
(10, '3787500', 0, '4000000', 209, 29, NULL, 1, '2022-11-27 21:51:35', '2022-11-27 20:51:35'),
(11, '8457750', 17, '8000000', 310, 25, NULL, 1, '2023-03-16 17:50:34', '2023-03-16 16:50:34'),
(12, '2550000', 15, '2500000', 283, 29, NULL, 1, '2023-03-17 09:13:53', '2023-03-17 08:13:53'),
(13, '1500000', 14, '1500000', 284, 29, NULL, 1, '2023-03-17 09:14:35', '2023-03-17 08:14:35'),
(14, '1120000', 13, '1120000', 124, 6, NULL, 1, '2023-03-17 10:23:02', '2023-03-17 09:23:02'),
(15, '3075000', 16, '3075000', 313, 6, NULL, 1, '2023-03-17 10:48:40', '2023-03-17 09:48:40'),
(16, '42965000', 12, '50000000', 287, 25, NULL, 2, '2023-05-04 10:37:15', '2023-05-04 08:37:15'),
(17, '1237500', 3, '1237500', 318, 36, NULL, 1, '2023-05-31 10:57:32', '2023-05-31 08:57:32'),
(18, '2300000', 6, '2300000', 208, 6, NULL, 1, '2023-05-31 12:45:43', '2023-05-31 10:45:43'),
(19, '5100000', 9, '5100000', 372, 6, NULL, 1, '2023-05-19 18:11:13', '2023-06-01 16:11:13'),
(20, '1350000', 4, '1350000', 378, 29, NULL, 1, '2023-04-28 09:23:55', '2023-04-26 07:23:55'),
(21, '2700000', 7, '2700000', 370, 6, NULL, 1, '2023-05-04 16:53:18', '2023-06-01 14:53:18'),
(22, '6000000', 10, '6000000', 369, 6, NULL, 1, '2023-05-11 16:55:27', '2023-06-01 14:55:27'),
(23, '700000', 2, '699999', 373, 6, NULL, 1, '2023-05-12 16:59:51', '2023-06-01 14:59:51'),
(24, '3249500', 8, '3249500', 371, 6, NULL, 1, '2023-05-12 17:06:47', '2023-06-01 15:06:47'),
(25, '150000', 1, '150000', 381, 30, NULL, 1, '2023-04-28 17:12:57', '2023-06-01 15:12:57'),
(26, '127118', 0, '127118', 380, 30, NULL, 1, '2023-05-26 17:17:13', '2023-06-01 15:17:13'),
(27, '12750000', 11, '12750000', 314, 6, NULL, 1, '2023-04-05 18:08:49', '2023-06-01 16:08:49'),
(28, '1500000', NULL, '3000000', 278, 25, NULL, 1, '2023-06-14 13:05:05', '2023-06-14 11:05:05'),
(29, '3000000', NULL, '3000000', 134, 6, NULL, 1, '2023-06-21 16:08:19', '2023-06-21 14:08:19'),
(30, '1700000', NULL, '1700000', 280, 6, NULL, 1, '2023-06-21 16:09:19', '2023-06-21 14:09:19'),
(31, '960000', NULL, '960000', 396, 29, NULL, 1, '2023-06-22 09:21:26', '2023-07-03 07:21:26'),
(32, '1350000', NULL, '1350000', 394, 29, NULL, 1, '2023-06-28 09:21:57', '2023-07-03 07:21:57'),
(33, '296610', NULL, '296610', 227, 29, NULL, NULL, '2023-02-15 14:44:46', '2023-07-05 12:44:46'),
(34, '500000', NULL, '500000', 401, 29, NULL, 1, '2023-03-15 14:51:11', '2023-07-05 12:51:11'),
(35, '6080000', NULL, '6000000', 363, 29, NULL, 1, '2023-08-01 12:24:30', '2023-08-01 10:24:30'),
(36, '8400000', NULL, '3000000', 392, 25, NULL, 1, '2023-08-04 14:42:29', '2023-08-04 12:42:29'),
(37, '3000000', NULL, '3000000', 134, 6, NULL, 1, '2023-08-09 14:40:03', '2023-08-09 12:40:03'),
(38, '2740000', NULL, '2740000', 416, 32, NULL, NULL, '2023-08-11 14:21:51', '2023-08-11 12:21:51'),
(39, '7661000', NULL, '9000000', 424, 29, NULL, 1, '2023-08-23 09:55:23', '2023-08-23 07:55:23'),
(40, '35970000', NULL, '34999997', 399, 25, NULL, 1, '2023-08-30 12:48:19', '2023-08-30 10:48:19'),
(41, '13500000', NULL, '15000000', 420, 25, NULL, 2, '2023-09-05 20:59:12', '2023-09-05 18:59:12'),
(42, '9900000', NULL, '10000000', 264, 28, NULL, 2, '2023-09-06 11:46:18', '2023-09-06 09:46:18'),
(43, '637500', NULL, '637500', 431, 30, NULL, 1, '2023-09-15 15:49:38', '2023-09-15 13:49:38'),
(44, '2708100', NULL, '2000000', 452, 25, NULL, 1, '2023-10-25 08:57:55', '2023-10-25 06:57:55'),
(45, '8378375', NULL, '8378375', 407, 36, NULL, 2, '2023-04-25 11:10:43', '2023-04-25 09:10:43'),
(46, '9900000', NULL, '9900000', 404, 36, NULL, 2, '2023-02-24 11:11:41', '2023-02-24 10:11:41'),
(47, '1500000', NULL, '1500000', 405, 36, NULL, 2, '2023-01-25 11:12:53', '2023-01-25 10:12:53'),
(48, '100000', NULL, '100000', 406, 36, NULL, 2, '2023-03-24 11:14:03', '2023-03-24 10:14:03'),
(49, '7687920', NULL, '7687920', 408, 36, NULL, 2, '2023-05-25 11:14:45', '2023-05-25 09:14:45'),
(50, '3000000', NULL, '3000000', 409, 36, NULL, 2, '2023-06-26 11:18:23', '2023-06-26 09:18:23'),
(51, '11700000', NULL, '2000000', 367, 28, NULL, 1, '2023-10-25 12:12:43', '2023-10-25 10:12:43'),
(52, '11700000', NULL, '11700000', 434, 28, NULL, 1, '2023-10-25 15:04:54', '2023-10-25 13:04:54'),
(53, '1360000', NULL, '1360000', 398, 6, NULL, 1, '2023-11-20 16:31:37', '2023-11-20 15:31:37'),
(54, '3233200', NULL, '3233200', 473, 32, NULL, 1, '2023-12-06 14:22:21', '2023-12-06 13:22:21'),
(55, '2160000', NULL, '2500000', 395, 28, NULL, 1, '2023-12-06 15:53:00', '2023-12-06 14:53:00'),
(56, '2000000', NULL, '12000000', 319, 28, NULL, 1, '2023-12-06 16:02:20', '2023-12-06 15:02:20'),
(57, '5000000', NULL, '5000000', 485, 25, NULL, 1, '2023-12-11 17:45:34', '2023-12-11 16:45:34'),
(58, '5142500', NULL, '5142500', 486, 6, NULL, 1, '2023-12-20 14:31:09', '2023-12-20 13:31:09'),
(59, '900000', NULL, '1000000', 510, 28, NULL, 1, '2024-01-25 11:47:18', '2024-01-25 10:47:18'),
(60, '7200000', NULL, '7000000', 540, 25, NULL, 2, '2024-02-19 16:30:38', '2024-02-19 15:30:38'),
(61, '2970000', NULL, '3300000', 538, 28, NULL, 1, '2024-02-19 21:08:23', '2024-02-19 20:08:23');

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE `villes` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `villes`
--

INSERT INTO `villes` (`id`, `libelle`, `created_at`, `updated_at`) VALUES
(1, 'Dakar', '2023-06-20 15:36:01', '2023-06-20 17:36:01'),
(2, 'Ouagadougou', '2023-06-20 15:36:01', '2023-06-20 17:36:01'),
(3, 'Cotonou', '2023-06-20 15:50:49', '2023-06-20 17:50:49'),
(4, 'vil', '2023-06-21 13:15:35', '2023-06-21 15:15:35'),
(5, 'ville', '2024-03-01 16:47:13', '2024-03-01 17:47:13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `action_commerciales`
--
ALTER TABLE `action_commerciales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `action_de_suivi`
--
ALTER TABLE `action_de_suivi`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bdd_prospects`
--
ALTER TABLE `bdd_prospects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commerciaus`
--
ALTER TABLE `commerciaus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demos`
--
ALTER TABLE `demos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprise_clients`
--
ALTER TABLE `entreprise_clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formulaires`
--
ALTER TABLE `formulaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historiques_probas`
--
ALTER TABLE `historiques_probas`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `itineraires`
--
ALTER TABLE `itineraires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `multinationals`
--
ALTER TABLE `multinationals`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `objectif_commissions`
--
ALTER TABLE `objectif_commissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `opportunites`
--
ALTER TABLE `opportunites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `origines`
--
ALTER TABLE `origines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performances`
--
ALTER TABLE `performances`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performancesbfs`
--
ALTER TABLE `performancesbfs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performancescis`
--
ALTER TABLE `performancescis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performancessns`
--
ALTER TABLE `performancessns`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performance_bf_globales`
--
ALTER TABLE `performance_bf_globales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performance_ci_globales`
--
ALTER TABLE `performance_ci_globales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performance_commerciales`
--
ALTER TABLE `performance_commerciales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performance_globales`
--
ALTER TABLE `performance_globales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `performance_sn_globales`
--
ALTER TABLE `performance_sn_globales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prospections`
--
ALTER TABLE `prospections`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prospect_a_appellers`
--
ALTER TABLE `prospect_a_appellers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `raisons`
--
ALTER TABLE `raisons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `resultat_appels`
--
ALTER TABLE `resultat_appels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `secteur_activites`
--
ALTER TABLE `secteur_activites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sous_opportunites`
--
ALTER TABLE `sous_opportunites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut_opportunites`
--
ALTER TABLE `statut_opportunites`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_journalieres`
--
ALTER TABLE `stock_journalieres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_mensuelles`
--
ALTER TABLE `stock_mensuelles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock_mensuelles_globales`
--
ALTER TABLE `stock_mensuelles_globales`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suivi_prospects`
--
ALTER TABLE `suivi_prospects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suivi_prospects22`
--
ALTER TABLE `suivi_prospects22`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `suivi_qualifiers`
--
ALTER TABLE `suivi_qualifiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_paiements`
--
ALTER TABLE `type_paiements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `update_opps`
--
ALTER TABLE `update_opps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `villes`
--
ALTER TABLE `villes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `action_commerciales`
--
ALTER TABLE `action_commerciales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `action_de_suivi`
--
ALTER TABLE `action_de_suivi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bdd_prospects`
--
ALTER TABLE `bdd_prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commerciaus`
--
ALTER TABLE `commerciaus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `demos`
--
ALTER TABLE `demos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `entreprise_clients`
--
ALTER TABLE `entreprise_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `formulaires`
--
ALTER TABLE `formulaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historiques`
--
ALTER TABLE `historiques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `historiques_probas`
--
ALTER TABLE `historiques_probas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `itineraires`
--
ALTER TABLE `itineraires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `multinationals`
--
ALTER TABLE `multinationals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `objectif_commissions`
--
ALTER TABLE `objectif_commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `opportunites`
--
ALTER TABLE `opportunites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `origines`
--
ALTER TABLE `origines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT pour la table `performances`
--
ALTER TABLE `performances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performancesbfs`
--
ALTER TABLE `performancesbfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performancescis`
--
ALTER TABLE `performancescis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performancessns`
--
ALTER TABLE `performancessns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performance_bf_globales`
--
ALTER TABLE `performance_bf_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performance_ci_globales`
--
ALTER TABLE `performance_ci_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performance_commerciales`
--
ALTER TABLE `performance_commerciales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performance_globales`
--
ALTER TABLE `performance_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performance_sn_globales`
--
ALTER TABLE `performance_sn_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `prospections`
--
ALTER TABLE `prospections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `prospect_a_appellers`
--
ALTER TABLE `prospect_a_appellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `raisons`
--
ALTER TABLE `raisons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `resultat_appels`
--
ALTER TABLE `resultat_appels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `secteur_activites`
--
ALTER TABLE `secteur_activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `sous_opportunites`
--
ALTER TABLE `sous_opportunites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statut_opportunites`
--
ALTER TABLE `statut_opportunites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `stock_journalieres`
--
ALTER TABLE `stock_journalieres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock_mensuelles`
--
ALTER TABLE `stock_mensuelles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock_mensuelles_globales`
--
ALTER TABLE `stock_mensuelles_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suivi_prospects`
--
ALTER TABLE `suivi_prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suivi_prospects22`
--
ALTER TABLE `suivi_prospects22`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `suivi_qualifiers`
--
ALTER TABLE `suivi_qualifiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_paiements`
--
ALTER TABLE `type_paiements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `update_opps`
--
ALTER TABLE `update_opps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
