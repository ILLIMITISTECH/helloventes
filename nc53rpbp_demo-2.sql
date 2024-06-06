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
-- Base de données : `nc53rpbp_demo`
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
(45, 'Nouvelle rencontre avec le DRH pour établir un programme', 10, 10, 172, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 0, '2023-01-14 13:47:30', '2023-01-24 08:24:40'),
(46, 'Relance en fin du mois', 10, 10, 172, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-14 15:38:19', '2023-01-15 10:11:15'),
(56, 'Les appeler le 25 Octobre pour leur offrir des places en ADF', 10, 10, 173, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 1, '2023-01-24 16:41:05', '2023-01-28 04:37:05'),
(69, 'Obtenir une date claire pour la mission d\'immersion de la Directrice du Programme', 12, 10, 146, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-15 11:59:16', '2023-01-18 03:51:24'),
(70, 'Compléter la liste des 10 places offertes pour combler les 04 restantes', 12, 10, 145, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 1, '2023-01-15 12:01:52', '2023-01-18 03:51:54'),
(78, 'Appeler Mikaella pour confirmation de la session.', 10, 10, 184, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-15 15:04:15', '2023-01-18 09:38:29'),
(81, 'Relancer SUNU Assurances', 6, 10, 134, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-15 15:13:19', '2023-01-28 18:05:13'),
(84, 'Démo collaboratis au bureau exécutif', 28, 13, 163, NULL, 'oui', NULL, 159, NULL, NULL, 1, '2023-01-01', NULL, 0, '2023-01-18 10:47:48', '2023-01-18 05:47:48'),
(86, 'Appeler le DG', 29, 13, 209, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-18 13:48:06', '2023-01-18 09:02:14'),
(89, 'Relance point focal', 29, 13, 227, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-18 13:53:13', '2023-01-18 09:02:11'),
(94, 'Relance pour un RDV dans la semaine du 28/11/2022', 13, 13, 176, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-18 14:00:30', '2023-01-25 09:29:47'),
(96, 'Envoyer une Offre Financière', 13, 13, 138, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-18 14:03:02', '2023-01-24 09:53:56'),
(106, 'Renvoyer projet de contrat.', 25, 10, 122, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 0, '2023-01-18 14:57:08', '2023-01-30 13:10:11'),
(107, 'Relance DG.', 25, 10, 204, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 0, '2023-01-18 14:58:36', '2023-01-30 14:02:22'),
(127, 'Relance pour prise de rendez-vous', 33, 13, 234, NULL, 'non', NULL, 232, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-21 17:14:52', '2023-01-24 09:47:24'),
(147, 'Tenir une session de cadrage sur HelloVentes', 29, 13, 232, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 0, '2023-01-30 18:52:10', '2023-01-30 13:52:10'),
(148, 'test', 25, 10, 232, NULL, 'oui', NULL, 95, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-30 18:57:25', '2023-01-30 14:02:44'),
(149, 'Modifier les actions', 25, 10, 232, NULL, 'oui', NULL, 95, NULL, NULL, 1, '2023-01-01', NULL, 0, '2023-01-30 18:57:52', '2023-01-30 14:03:55'),
(150, 'Katyzen tech', 29, 13, 146, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 0, '2023-01-30 18:59:27', '2023-01-30 13:59:27'),
(132, 'Rendez-vous', 33, 13, 244, NULL, 'oui', NULL, 234, NULL, NULL, 1, '2023-01-01', NULL, 1, '2023-01-23 14:39:20', '2023-01-25 08:11:31'),
(151, 'Modifier les actions tests', 12, 10, 234, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 0, '2023-01-30 19:17:15', '2023-01-30 14:17:15'),
(152, 'Rencontrer DG ORANGE', 25, 10, 234, NULL, NULL, NULL, 253, NULL, NULL, 1, '2023-01-01', NULL, 0, '2023-01-30 19:18:38', '2023-01-30 14:18:38'),
(153, 'Tester les solutions', 29, 13, 234, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 0, '2023-01-30 19:19:39', '2023-01-30 14:19:39'),
(154, 'Envoie les offres', 25, 10, 234, NULL, 'oui', NULL, 253, NULL, NULL, 1, '2023-01-01', NULL, 0, '2023-01-30 19:20:17', '2023-01-30 14:20:17'),
(155, 'Modifier les action', 29, 13, 184, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-01-01', NULL, 0, '2023-01-30 19:42:19', '2023-01-30 14:42:19'),
(144, 'Appeler Bodiel M. pour confirmer le déjeuner', 6, 10, 132, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-01-01', NULL, 0, '2023-01-25 17:46:43', '2023-01-25 12:46:43'),
(400, 'Rencontrer le directeur commercial', 29, 13, 122, NULL, NULL, NULL, 95, NULL, NULL, 1, '2023-02-15', NULL, 0, '2023-02-13 12:57:12', '2023-02-13 09:57:12'),
(401, 'Rendez-vous avec responsable formation', 25, 10, NULL, NULL, NULL, NULL, 216, NULL, NULL, 1, '2023-02-16', NULL, 0, '2023-02-13 12:59:52', '2023-02-13 09:59:52'),
(420, 'Faire une démo', 33, 13, 216, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-04-15', NULL, 0, '2023-04-14 10:05:33', '2023-04-14 06:05:33'),
(422, 'Présenter Helloventes', 25, NULL, NULL, NULL, NULL, NULL, 1388, NULL, NULL, 1, '2023-04-18', NULL, 0, '2023-04-17 11:38:12', '2023-04-17 07:38:12');

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
(6, 'Rosalie', 'Mendy', '12', 'rosalie@helloventes.com', 1, 10, NULL, NULL, NULL, NULL, '0.05', '20', '5000000', NULL, '10', '20', 11, 'commerciaux', NULL, '2023-05-09 12:18:06', '2023-05-09 08:18:06'),
(10, 'Paul', 'Edwar', '10', 'paul@helloventes.com', 1, 10, NULL, NULL, NULL, NULL, '0.08', '20', '20000000', NULL, '20', '20', 15, 'responsable', NULL, '2023-05-09 12:17:23', '2023-05-09 08:17:23'),
(12, 'Marie', 'Fall', '10', 'marie@helloventes.com', 1, 10, NULL, NULL, NULL, NULL, '0.05', '20', '5000000', NULL, '50', '30', 17, 'commerciaux', NULL, '2023-05-09 12:16:30', '2023-05-09 08:16:30'),
(13, 'Patrick', 'Verra', '10', 'responsable@helloventes.com', 5, 13, NULL, NULL, NULL, NULL, '0.05', '20', '10000000', NULL, '20', '20', 18, 'responsable', NULL, '2023-05-09 12:16:57', '2023-05-09 08:16:57'),
(28, 'Emma', 'Sako', '10', 'emma@helloventes.com', 5, 13, NULL, NULL, NULL, NULL, '0.03', '20', '10000000', NULL, '10', '10', 35, 'commerciaux', NULL, '2023-05-09 12:15:37', '2023-05-09 08:15:37'),
(25, 'Pierre', 'Ngom', '30', 'directeur@helloventes.com', 1, 10, NULL, NULL, NULL, NULL, '0.03', '20', '5000000', NULL, '10', '20', 32, 'directeur', NULL, '2023-05-09 12:17:45', '2023-05-09 08:17:45'),
(29, 'Jean', 'Francois', '30', 'jean@helloventes.com', 5, 13, NULL, NULL, NULL, NULL, '0.05', '10', '20000000', NULL, '20', '10', 36, 'commerciaux', NULL, '2023-05-09 12:16:08', '2023-05-09 08:16:08'),
(39, 'gny', 'Diouf', NULL, 'gny.dev@gmail.com', 5, 13, NULL, NULL, NULL, NULL, '0.05', '20', '5000000', NULL, NULL, '10', 46, 'commerciaux', NULL, '2023-01-30 19:49:48', '2023-01-30 14:50:20'),
(33, 'Emilie', 'Sagna', '30', 'user@helloventes.com', 5, 13, NULL, NULL, NULL, NULL, '0.05', '20', '10000000', NULL, '20', '10', 40, 'commerciaux', NULL, '2023-05-09 12:15:14', '2023-05-09 08:15:14');

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
(1, 25, NULL, 122, '500000', '2023-01-01 00:00:00', '2023-01-13 09:18:30'),
(2, 6, NULL, 134, '40000', '2023-01-01 00:00:00', '2023-01-14 05:55:49'),
(3, 12, NULL, 145, '340000', '2023-01-01 00:00:00', '2023-01-15 05:53:18'),
(4, 28, NULL, 163, '21500', '2023-01-01 00:00:00', '2023-01-18 03:47:19'),
(6, 6, NULL, 132, '153400', '2023-01-01 00:00:00', '2023-01-22 07:06:18'),
(7, 25, NULL, 204, '95000', '2023-01-01 00:00:00', '2023-01-24 09:56:34'),
(10, 29, NULL, 227, '189375', '2023-01-01 00:00:00', '2023-01-27 16:51:35'),
(11, 25, NULL, 232, '200000', '2023-01-01 00:00:00', '2023-01-30 13:58:38'),
(12, 33, NULL, 223, '280000', '2023-01-01 00:00:00', '2023-01-01 09:10:52'),
(13, 13, NULL, 176, '90000', '2023-01-01 00:00:00', '2023-01-01 09:13:20'),
(14, 25, NULL, 237, '90000', '2023-01-01 00:00:00', '2023-01-01 09:14:43'),
(15, 25, NULL, 235, '100000', '2023-03-06 14:11:39', '2023-03-06 12:11:39'),
(16, 25, NULL, 233, '225000', '2023-03-06 14:16:17', '2023-03-06 12:16:17'),
(17, 33, NULL, 216, '315000', '2023-04-14 10:45:47', '2023-04-14 06:45:47'),
(18, 25, NULL, 234, '250000', '2023-04-14 10:49:30', '2023-04-14 06:49:30'),
(19, 25, NULL, 236, '60000', '2023-05-09 12:19:25', '2023-05-09 08:19:25');

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
(269, 'Julie', 'Gomis Dosseh', NULL, 'jgomis@kirene.sn', '776505977', NULL, 'DRH', 10, NULL, 10, 106, 134, 0, '2023-01-01 00:00:00', '2023-01-14 08:32:48'),
(275, 'WILFRIED', 'SOMÉ', NULL, 'wilfried.some@uad.com', '+22676129995', NULL, 'Responsable innovation et redynamisation du groupe', 13, NULL, 13, 95, 122, 0, '2023-01-01 00:00:00', '2023-01-16 18:30:47'),
(281, 'DAO', 'NOUHOUN', NULL, 'd_amidou@cgeimmobilier', '+22679264533', NULL, 'Chef d\'Agence', 13, NULL, 13, 113, 145, 0, '2023-01-01 00:00:00', '2023-01-20 11:48:31'),
(323, 'gnagna', 'Ndiaye', NULL, 'gnagna.big@dev.com', '664555', NULL, 'PM', 25, NULL, NULL, 253, NULL, 0, '2023-01-01 00:00:00', '2023-01-30 14:10:55'),
(324, 'FALU', 'fall', NULL, 'awa@gmail.com', '55555555', NULL, 'PM', 25, NULL, NULL, 253, 234, 0, '2023-01-01 00:00:00', '2023-01-30 15:16:11'),
(325, 'Lufa', 'ndiaye', NULL, 'fallou.dev@big.com', '77890987654', NULL, 'PM', 25, NULL, NULL, 253, 234, 0, '2023-01-01 00:00:00', '2023-01-30 14:21:51'),
(326, 'fatou', 'fall', NULL, 'fatou@g.com', '55555555', NULL, 'PM', NULL, NULL, NULL, NULL, 237, 0, '2023-01-01 00:00:00', '2023-01-30 16:33:30'),
(327, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 237, 0, '2023-01-01 00:00:00', '2023-01-30 16:33:30'),
(595, 'Momo', 'Dembele', NULL, 'momo@gmail.com', '00000244', NULL, NULL, 33, NULL, 13, 244, NULL, 0, '2023-04-14 11:03:54', '2023-04-14 07:03:54'),
(596, 'Jean', 'Paul', NULL, 'jean@gmail.com', '0000000890', NULL, NULL, 33, NULL, 13, 234, NULL, 0, '2023-04-14 11:04:34', '2023-04-14 07:04:34');

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

--
-- Déchargement des données de la table `demos`
--

INSERT INTO `demos` (`id`, `libelle`, `commercial_id`, `superieur_id`, `entreprise_client_id`, `opportunite_id`, `prospect_id`, `commentaire`, `date`, `personne`, `created_at`, `updated_at`) VALUES
(3, 'Presentations Hello Ventes', 25, NULL, NULL, 232, 95, NULL, '2023-01-30', 'kikii', '2023-01-30 19:00:00', '2023-01-30 18:57:52');

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
(1, 'FORMATION', '2023-01-13 10:39:06', '2023-01-13 12:39:06'),
(2, 'TECHNOLOGIE', '2023-01-13 10:39:06', '2023-01-13 12:39:06');

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
(1, 'ILLIMITIS', 0, 1, '2022-11-21 18:45:10', '2022-11-21 16:45:10'),
(2, 'Maroc-Food', 0, NULL, '2022-11-21 18:45:26', '2022-11-21 16:45:26');

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
(1, 'ORANGE', NULL, '2022-10-06 17:16:31', '2022-10-06 13:16:31'),
(2, 'VIVO ENERGY', NULL, '2022-10-06 17:16:31', '2022-10-06 13:16:31'),
(3, 'TOTAL', NULL, '2022-10-07 16:33:24', '2022-10-07 12:33:24'),
(4, 'SHELL', NULL, '2022-10-07 16:33:24', '2022-10-07 12:33:24'),
(5, 'ECOBANK', NULL, '2022-10-07 16:34:03', '2022-10-07 12:34:03'),
(6, 'IAM GOLD', NULL, '2022-10-07 16:34:03', '2022-10-07 12:34:03'),
(7, 'SOCIETE GENERALE', NULL, '2022-10-07 16:34:03', '2022-10-07 12:34:03'),
(8, 'Autres / Others', NULL, '2022-10-08 02:56:54', '2022-10-07 22:56:54'),
(9, 'BMCE', NULL, '2022-10-08 02:05:24', '2022-10-07 22:05:24'),
(10, 'Groupe', NULL, '2022-10-08 02:32:53', '2022-10-07 22:32:53'),
(11, 'ENABEL', NULL, '2022-10-13 15:37:45', '2022-10-13 11:37:45'),
(12, 'CMA CGM', NULL, '2022-10-13 17:30:11', '2022-10-13 13:30:11'),
(13, 'GROUPE ATLANTIQUE BANQUE', NULL, '2022-10-14 13:04:50', '2022-10-14 09:04:50'),
(14, 'GIZ', NULL, '2022-10-17 09:23:56', '2022-10-17 05:23:56'),
(15, 'Orange', NULL, '2022-10-21 17:00:50', '2022-10-21 13:00:50'),
(16, 'UBA', NULL, '2022-10-21 17:02:15', '2022-10-21 13:02:15'),
(18, 'ONG DIAKONIA', NULL, '2022-11-14 10:54:22', '2022-11-14 08:54:22'),
(19, 'CFAO MOTORS', NULL, '2022-11-14 17:45:54', '2022-11-14 15:45:54'),
(22, 'IRC', NULL, '2022-11-18 10:54:40', '2022-11-18 08:54:40'),
(23, 'FIDELIS GROUPE', NULL, '2022-11-21 11:50:20', '2022-11-21 09:50:20'),
(24, 'PREMIERE URGENCE HUMANITAIRE', NULL, '2022-11-21 11:55:24', '2022-11-21 09:55:24'),
(25, 'GROUPE UNIVERS BIO', NULL, '2022-11-21 11:57:27', '2022-11-21 09:57:27'),
(27, 'BANQUE AFRICAINE DE DEVELOPPEMENT', NULL, '2022-11-23 14:33:36', '2022-11-23 12:33:36'),
(29, 'IMPERIAL TOBACO', NULL, '2022-12-02 16:07:28', '2022-12-02 14:07:28'),
(31, 'BANK OF AFRICA', NULL, '2022-12-06 08:34:54', '2022-12-06 06:34:54'),
(32, 'CORIS HOLDING', NULL, '2022-12-07 15:00:41', '2022-12-07 13:00:41'),
(33, 'GROUPE SOPAM', NULL, '2022-12-16 09:29:09', '2022-12-16 07:29:09'),
(34, 'DHL', NULL, '2022-12-16 09:52:53', '2022-12-16 07:52:53'),
(35, 'GROUPE BIA', NULL, '2022-12-16 10:06:11', '2022-12-16 08:06:11'),
(36, 'SUNU ASSURANCE', NULL, '2022-12-20 17:43:54', '2022-12-20 15:43:54'),
(37, 'BAOBAB', NULL, '2022-12-21 17:01:14', '2022-12-21 15:01:14'),
(38, 'GCM GROUPE', NULL, '2022-12-22 12:55:26', '2022-12-22 10:55:26'),
(39, 'COFINA GROUPE', NULL, '2022-12-22 13:44:47', '2022-12-22 11:44:47'),
(40, 'ORABANK', NULL, '2022-12-22 15:23:47', '2022-12-22 13:23:47'),
(41, 'FSIP', NULL, '2023-02-08 12:01:27', '2023-02-08 10:01:27'),
(42, 'GROUPE SIPHARJOONG INTERNATIONAL', NULL, '2023-02-17 11:42:41', '2023-02-17 09:42:41');

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

--
-- Déchargement des données de la table `objectif_commissions`
--

INSERT INTO `objectif_commissions` (`id`, `commercial_id`, `Objectif_mois`, `commission_p`, `nbre_contact`, `nbre_demo`, `objectif_visite`, `nbre_appel_quotidien`, `entreprise_client_id`, `date`, `created_at`, `updated_at`) VALUES
(10, 33, '5000000', '0.05', '30', '10', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 16:22:44'),
(12, 12, '2312500', '0.05', '20', '8', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 16:24:33'),
(13, NULL, '5000000', '0.06', '20', '2', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 16:16:54'),
(17, NULL, '5000000', '0.05', '20', '5', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 16:13:26'),
(18, 33, '5000000', '0.03', '30', '4', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 13:27:53'),
(19, NULL, '5000000', '0.05', '30', '4', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 16:17:33'),
(20, 33, '5000000', '0.07', '30', '4', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 16:24:12'),
(21, 39, '5000000', '0.05', '20', '10', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 14:50:20'),
(22, 13, '10000000', '0.06', '20', '20', NULL, NULL, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 15:51:28'),
(35, 28, '5000000', '0.06', '20', '6', '6', '5', NULL, '2023-04-07 00:00:00', '2023-04-06 12:49:16', '2023-04-06 08:49:16'),
(36, 33, '10000000', '0.05', '20', '10', '20', '30', NULL, NULL, '2023-05-09 12:15:14', '2023-05-09 08:15:14'),
(37, 28, '10000000', '0.03', '20', '10', '10', '10', NULL, NULL, '2023-05-09 12:15:37', '2023-05-09 08:15:37'),
(38, 29, '20000000', '0.05', '10', '10', '20', '30', NULL, NULL, '2023-05-09 12:16:08', '2023-05-09 08:16:08'),
(39, 12, '5000000', '0.05', '20', '30', '50', '10', NULL, NULL, '2023-05-09 12:16:30', '2023-05-09 08:16:30'),
(40, 13, '10000000', '0.05', '20', '20', '20', '10', NULL, NULL, '2023-05-09 12:16:57', '2023-05-09 08:16:57'),
(41, 10, '20000000', '0.08', '20', '20', '20', '10', NULL, NULL, '2023-05-09 12:17:23', '2023-05-09 08:17:23'),
(42, 25, '5000000', '0.03', '20', '20', '10', '30', NULL, NULL, '2023-05-09 12:17:45', '2023-05-09 08:17:45'),
(43, 6, '5000000', '0.05', '20', '20', '10', '12', NULL, NULL, '2023-05-09 12:18:06', '2023-05-09 08:18:06');

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
(134, 'Formations en prise de parole en public', 106, 1, 6, NULL, 10, NULL, '20', NULL, '4500000', 2, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, NULL, NULL, '2023-01-07 20:00:50', '2023-01-18 15:20:29', NULL, NULL, NULL, NULL, '2023-01-07 18:00:50', '2023-01-07 11:00:50'),
(132, 'Programme de transformation managériale', 101, 1, 6, NULL, 10, NULL, '40', NULL, '15000000', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, NULL, NULL, '2023-01-07 19:46:14', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-07 17:46:14', '2023-01-07 10:46:14'),
(122, 'Formation en leadership et mangement pour 10 managers', 95, 1, 25, '2023-01-06', 10, NULL, '80', NULL, '54000000', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'En prospection depuis 2019', 13, 0, NULL, NULL, NULL, NULL, '2023-01-07 17:29:33', '2023-01-18 15:20:29', NULL, NULL, NULL, NULL, '2023-01-07 15:29:33', '2023-01-11 12:00:21'),
(138, 'Communication managériale', 145, 0, 13, '2023-01-16', 13, NULL, '60', NULL, '500000', 0, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 0, NULL, NULL, NULL, NULL, '2023-01-10 09:15:46', '2023-01-18 15:20:29', NULL, NULL, NULL, NULL, '2023-01-10 07:15:46', '2023-01-10 00:15:46'),
(145, 'Vente HelloVentes', 113, 0, 12, '2022-12-10', 10, NULL, '40', NULL, '4200000', 2, NULL, 3, 6, NULL, NULL, NULL, NULL, NULL, 'En attente des feedbacks de l\'équipe formation et partenaires', 14, 0, NULL, NULL, NULL, NULL, '2023-01-11 16:07:25', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-11 15:57:33', '2023-01-11 09:07:25'),
(146, 'Formation intelligence émotionnelle', 111, 0, 12, '2023-01-02', 10, NULL, NULL, NULL, '35000000', 0, NULL, 3, 25, NULL, NULL, NULL, NULL, NULL, 'Chercher le contrat / convention de partenariat', 10, 0, NULL, NULL, NULL, NULL, '2023-01-30 18:59:01', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-11 16:06:04', '2023-01-30 14:00:17'),
(148, 'Solution digitale mobiqgri', 115, 0, 12, '2023-01-10', 10, NULL, '70', NULL, '10000000', 0, NULL, 3, 10, NULL, NULL, NULL, NULL, NULL, 'Relance mensuel par mail et téléphone', 14, 0, NULL, NULL, NULL, NULL, '2023-01-11 18:47:49', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-11 16:47:49', '2023-01-11 09:47:49'),
(159, 'Gestion des talents et hauts potentiels', 174, 1, 13, '2023-01-12', 13, NULL, '80', NULL, '4720000', 0, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'Le DRH rassure que Le budget est déjà voté et que nous somme en bonne posture pour décrocher le marché', 16, 0, NULL, NULL, NULL, NULL, '2023-02-13 12:47:51', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-13 17:35:16', '2023-02-13 09:47:51'),
(163, 'Formation Itil et Cobit', 158, 1, 28, '2023-01-10', 13, NULL, '90', NULL, '1200000', 2, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'Formation planifiée de 80 personnes. A date 60 personnes ont été formées. Le reste se fera en début 2023 car il y a un programme de formation du groupe qui est en cours', 14, 0, NULL, NULL, NULL, NULL, '2023-01-13 20:18:02', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-13 18:18:02', '2023-01-18 04:27:01'),
(164, 'Gestion des stocks', 158, 1, 28, '2023-01-28', 13, NULL, '30', NULL, '10000000', 0, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, 'Présentation du programme de Tranformation managériale à programmer d\'ici fin oct', 13, 0, NULL, NULL, NULL, NULL, '2023-01-13 20:21:19', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-13 18:21:19', '2023-01-18 04:26:04'),
(172, 'Management de sécurité', 177, 1, 10, '2023-01-30', 10, NULL, '30', NULL, '2000000', 0, NULL, 4, 12, NULL, NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, NULL, NULL, '2023-01-14 17:37:24', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-14 15:37:24', '2023-01-14 08:37:24'),
(173, 'Stratégie et marketing digital', 176, 1, 10, '2023-01-30', 10, NULL, '40', NULL, '1000000', 0, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, NULL, NULL, '2023-01-14 17:40:19', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-14 15:40:19', '2023-01-14 08:40:19'),
(174, 'StarterClass ', 178, 1, 10, '2023-01-15', 10, NULL, '40', NULL, '10000000', 0, NULL, 4, 32, NULL, NULL, NULL, NULL, NULL, NULL, 11, 0, NULL, NULL, NULL, NULL, '2023-01-14 17:42:59', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-14 15:42:59', '2023-01-14 08:42:59'),
(176, 'KidClass', 182, 1, 13, '2023-01-19', 13, NULL, '80', NULL, '2000000', 2, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 0, NULL, NULL, NULL, NULL, '2023-01-17 01:37:29', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-16 23:37:29', '2023-01-01 09:13:20'),
(184, 'Programme de transformation commerciale', 184, 1, 10, '2022-12-02', 10, NULL, '90', NULL, '300000', 0, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, NULL, NULL, '2023-01-11 16:21:47', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-21 15:26:02', '2023-01-18 09:37:49'),
(185, 'Coaching exécutif', 193, 1, 10, '2023-01-31', 10, NULL, '70', NULL, '590000', 0, NULL, 3, 32, NULL, NULL, NULL, NULL, NULL, NULL, 14, 0, NULL, NULL, NULL, NULL, '2023-01-21 17:31:47', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-21 15:31:47', '2023-01-21 08:31:47'),
(189, 'Optievent', 202, 0, 10, '2023-01-25', 10, NULL, '0', NULL, '5000000', 0, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 0, NULL, NULL, NULL, NULL, '2023-01-26 14:54:48', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-26 12:54:48', '2023-01-26 05:54:48'),
(227, 'Management de centre d\'appel', 249, 1, 29, '2023-01-16', 13, NULL, '60', NULL, '10000000', 2, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0, NULL, NULL, NULL, NULL, '2023-01-28 09:26:57', '2023-01-28 09:26:57', 0, NULL, NULL, NULL, '2023-01-28 08:26:57', '2023-01-28 03:26:57'),
(236, 'test tech', 253, 0, 25, '2022-12-30', NULL, NULL, '100', NULL, '2000000', 2, NULL, 1, 39, NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, NULL, NULL, NULL, NULL, '2023-02-13 12:53:26', '2023-02-13 12:54:23', NULL, NULL, NULL, NULL, '2023-01-30 20:29:01', '2023-05-09 08:19:25'),
(237, 'ADF', 253, 0, 25, '2022-12-30', NULL, NULL, '50', NULL, '2000000', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 0, NULL, NULL, NULL, NULL, '2023-01-30 21:33:30', '2023-01-30 21:33:30', NULL, NULL, NULL, NULL, '2023-01-30 20:33:30', '2023-01-01 09:14:43'),
(204, 'Suivi évaluation et gestion axée sur les résultats', 212, 1, 25, '2022-12-17', 10, NULL, '80', NULL, '5000000', 2, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 'Phase 1 : Nov/Dec et Phase 2 : Janvier a Mars 2023', 11, 0, NULL, NULL, NULL, NULL, '2023-01-16 07:34:27', '2023-01-18 15:20:29', 0, NULL, NULL, NULL, '2023-01-16 06:34:27', '2023-01-16 01:34:27'),
(232, 'Solution HelloVentes', 95, 0, 25, '2022-12-30', NULL, NULL, NULL, NULL, '5000000', 2, NULL, 1, 33, NULL, NULL, NULL, NULL, NULL, NULL, 10, 0, NULL, NULL, NULL, NULL, '2023-01-30 18:51:44', '2023-01-30 18:53:55', NULL, NULL, NULL, NULL, '2023-01-30 18:45:49', '2023-01-30 13:58:38'),
(233, 'Executive Class', 253, 0, 25, '2022-12-30', NULL, NULL, '40', NULL, '5000000', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, NULL, NULL, NULL, NULL, '2023-01-30 20:12:14', '2023-01-30 20:12:14', NULL, NULL, NULL, NULL, '2023-01-30 19:12:14', '2023-03-06 12:16:17'),
(234, 'Katyzen beauty', 253, 0, 25, '2022-12-30', NULL, NULL, '40', NULL, '6000000', 2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, NULL, NULL, NULL, NULL, '2023-01-30 20:16:11', '2023-01-30 20:16:11', 0, NULL, NULL, NULL, '2023-01-30 19:16:11', '2023-04-14 06:49:30'),
(235, 'Modifier les action dev', 234, 0, 25, '2022-12-30', NULL, NULL, '50', NULL, '2000000', 2, NULL, 1, 28, NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, NULL, NULL, NULL, NULL, '2023-01-30 20:29:35', '2023-01-30 20:29:35', NULL, NULL, NULL, NULL, '2023-01-30 19:29:35', '2023-03-06 12:11:39'),
(209, 'Transformation digitale', 216, 1, 29, '2022-12-18', 13, NULL, '90', NULL, '4000000', 0, NULL, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 0, NULL, NULL, NULL, NULL, '2023-01-21 14:54:31', '2023-01-21 14:49:27', 0, NULL, NULL, NULL, '2023-01-18 13:01:03', '2023-01-27 16:51:35'),
(216, 'Système de management de la qualité', 234, 1, 33, '2022-12-23', 13, NULL, '20', NULL, '4500000', 2, NULL, 3, 13, NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, NULL, NULL, NULL, NULL, '2023-01-23 15:38:13', '2023-01-23 15:38:13', NULL, NULL, NULL, NULL, '2023-01-23 14:38:13', '2023-04-14 06:45:47'),
(223, 'Team building', 244, 1, 33, '2022-12-29', 13, NULL, '10', NULL, '4000000', 2, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, 0, NULL, NULL, NULL, NULL, '2023-01-25 15:44:19', '2023-01-25 15:44:19', NULL, NULL, NULL, NULL, '2023-01-25 14:44:19', '2023-01-01 09:10:52'),
(226, 'Outils pour la gestion du capital humain', 246, 1, 28, '2023-01-28', 13, NULL, '90', NULL, '5000000', 0, NULL, 3, 13, NULL, NULL, NULL, NULL, NULL, NULL, 16, 0, NULL, NULL, NULL, NULL, '2023-02-13 12:50:48', '2023-01-25 16:36:49', 0, NULL, NULL, NULL, '2023-01-25 15:36:49', '2023-02-13 09:50:48'),
(283, 'Appel d\'offre formation management de la productivité', 209, 1, 13, '2023-03-15', 13, NULL, '20', NULL, '3500000', 0, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 0, NULL, NULL, NULL, NULL, '2023-02-13 13:40:29', '2023-02-13 13:40:29', 0, NULL, NULL, NULL, '2023-02-13 12:40:29', '2023-02-13 09:40:29');

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
(1, 'Appel d\'offres 3FPT', NULL, '2022-09-27 17:22:51', '2022-09-27 13:22:51'),
(2, 'Appel d\'offres Entreprise', NULL, '2022-09-27 17:22:51', '2022-09-27 13:22:51'),
(3, 'Initiative ILLIMITIS', NULL, '2022-09-27 17:26:41', '2022-09-27 13:26:41'),
(4, 'Réseau personnel', NULL, '2022-10-03 13:19:37', '2022-10-03 09:19:37');

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
('edith.a@illimitis.com', '$2y$10$abzPbNx.5TZQmxu.5S1.VOFRgVzLgSvj9NM8IvL1c31A8kFEGkXqu', '2022-10-27 07:18:05'),
('gnagna.n@illimitis.com', '$2y$10$nCVfo8RfMgy5kOi6tcSLVOIDSEq.7dgyfSP4oJsjZJEcFufSeBCUe', '2022-12-12 07:46:37'),
('anthyme.k@illimitis.com', '$2y$10$JjpvnpuNnE41ybYKtG4iCOrFWPIOZGBRZaKLC5LDKlM69pgRpiBEm', '2023-01-18 08:06:51'),
('fallou.g@illimitis.com', '$2y$10$/M/NDtlw2aRs0zct0rUpSOovet/s4te4npeJqz.CMbjFNOGOlt.gm', '2023-02-03 09:38:08');

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

--
-- Déchargement des données de la table `performances`
--

INSERT INTO `performances` (`id`, `semaine`, `objectif_vente`, `objectif_demo`, `objectif_contact`, `realisation_vente`, `realisation_demo`, `realisation_contact`, `objectif_visite`, `realisation_visite`, `perfo_vente`, `perfo_demo`, `perfo_contact`, `perfo_visite`, `commercial_id`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(121, '1', '5000000', NULL, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, 29, NULL, '2023-01-30 19:00:00', '2023-01-21 19:07:41'),
(125, '1', '5000000', NULL, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, 33, NULL, '2023-01-30 19:00:00', '2023-01-21 19:07:41'),
(132, '1', '5000000', NULL, '20', '3068000', '0', '0', NULL, NULL, '61.36', '0', '0', NULL, 6, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15'),
(135, '1', '10000000', NULL, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, 10, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15'),
(137, '1', '5000000', NULL, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, 12, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15'),
(138, '1', '10000000', NULL, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, 13, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15'),
(140, '1', '5000000', NULL, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, 28, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15'),
(142, '1', '10000000', NULL, NULL, '21672965', '0', '2', NULL, NULL, '216.72965', '0', '0', NULL, 25, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15'),
(143, '1', '5000000', NULL, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, 29, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15'),
(147, '1', '5000000', '4', '30', '0', '0', '2', NULL, NULL, '0', '0', '10', NULL, 33, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:15');

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

--
-- Déchargement des données de la table `performancesbfs`
--

INSERT INTO `performancesbfs` (`id`, `semaine`, `objectif_vente`, `objectif_demo`, `objectif_contact`, `realisation_vente`, `realisation_demo`, `realisation_contact`, `perfo_vente`, `perfo_demo`, `perfo_contact`, `perfo_visite`, `objectif_visite`, `realisation_visite`, `entreprise_client_id`, `commercial_id`, `created_at`, `updated_at`) VALUES
(508, '1', '5000000', NULL, NULL, '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, 28, '2023-01-30 19:00:00', '2023-01-25 15:20:14'),
(509, '1', '5000000', NULL, NULL, '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, 29, '2023-01-30 19:00:00', '2023-01-25 15:20:14'),
(512, '1', '5000000', '4', '30', '0', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, 33, '2023-01-30 19:00:00', '2023-01-25 15:20:14');

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

--
-- Déchargement des données de la table `performancessns`
--

INSERT INTO `performancessns` (`id`, `semaine`, `objectif_vente`, `objectif_demo`, `objectif_contact`, `realisation_vente`, `realisation_demo`, `realisation_contact`, `objectif_visite`, `realisation_visite`, `perfo_vente`, `perfo_demo`, `perfo_contact`, `perfo_visite`, `commercial_id`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(507, '1', '10000000', NULL, NULL, '21672965', '0', '2', NULL, NULL, '216.72965', '0', '0', NULL, 25, NULL, '2023-01-30 19:00:00', '2023-01-25 15:20:16'),
(628, '1', '1250000', '0', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', 6, NULL, '2023-03-06 12:27:56', '2023-03-06 14:27:56'),
(629, '1', '578125', '1', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', 10, NULL, '2023-03-06 12:27:56', '2023-03-06 14:27:56'),
(630, '1', '578125', '2', '5', '0', '0', '0', '0', '0', '0', '0', '0', '0', 12, NULL, '2023-03-06 12:27:56', '2023-03-06 14:27:56'),
(631, '1', '2500000', '0', '0', '6500000', '0', '0', '0', '0', '65', '0', '0', '0', 25, NULL, '2023-03-06 12:27:56', '2023-03-06 14:27:56');

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

--
-- Déchargement des données de la table `performance_bf_globales`
--

INSERT INTO `performance_bf_globales` (`id`, `semaine`, `objectif_vente`, `objectif_demo`, `objectif_contact`, `realisation_vente`, `realisation_demo`, `realisation_contact`, `objectif_visite`, `realisation_visite`, `perfo_vente`, `perfo_demo`, `perfo_contact`, `perfo_visite`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(115, '1', '55000000', '0', '0', '1930000', '0', '5', NULL, NULL, '38.6', '0', '0', NULL, NULL, '2023-01-01 00:00:00', '2023-01-21 14:07:43'),
(116, '1', '55000000', '8', '60', '0', '0', '2', NULL, NULL, '0', '0', '10', NULL, NULL, '2023-01-01 00:00:00', '2023-01-25 10:20:09'),
(117, '1', '110000000', '8', '60', '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, '2023-01-01 00:00:00', '2023-01-25 10:20:14');

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

--
-- Déchargement des données de la table `performance_globales`
--

INSERT INTO `performance_globales` (`id`, `semaine`, `objectif_vente`, `objectif_demo`, `objectif_contact`, `realisation_vente`, `realisation_demo`, `realisation_contact`, `objectif_visite`, `realisation_visite`, `perfo_vente`, `perfo_demo`, `perfo_contact`, `perfo_visite`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(115, '1', '125000000', '0', '40', '1930000', '0', '13', NULL, NULL, '38.6', '0', '20', NULL, NULL, '2023-01-01 00:00:00', '2023-01-18 10:12:40'),
(116, '1', '125000000', '0', '40', '0', '0', '3', NULL, NULL, '0', '0', '0', NULL, NULL, '2023-01-01 00:00:00', '2023-01-21 14:01:27'),
(117, '1', '250000000', '0', '40', '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, '2023-01-01 00:00:00', '2023-01-21 14:07:41'),
(118, '1', '500000000', '12', '130', '24840965', '0', '5', NULL, NULL, '280.08965', '0', '10', NULL, NULL, '2023-01-01 00:00:00', '2023-01-25 10:20:15');

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

--
-- Déchargement des données de la table `performance_sn_globales`
--

INSERT INTO `performance_sn_globales` (`id`, `semaine`, `objectif_vente`, `objectif_demo`, `objectif_contact`, `realisation_vente`, `realisation_demo`, `realisation_contact`, `objectif_visite`, `realisation_visite`, `perfo_vente`, `perfo_demo`, `perfo_contact`, `perfo_visite`, `entreprise_client_id`, `created_at`, `updated_at`) VALUES
(113, '1', '70000000', '0', '40', '0', '0', '2', NULL, NULL, '0', '0', '0', NULL, NULL, '2023-01-01 00:00:00', '2023-01-21 14:01:28'),
(115, '1', '70000000', '0', '40', '0', '0', '9', NULL, NULL, '0', '0', '20', NULL, NULL, '2023-01-01 00:00:00', '2023-01-21 14:07:38'),
(116, '1', '140000000', '4', '70', '24840965', '0', '3', NULL, NULL, '280.08965', '0', '0', NULL, NULL, '2023-01-01 00:00:00', '2023-01-25 10:20:16');

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
(1, 'Collaboratis', NULL, '2022-09-21 21:21:09', '2022-09-21 17:21:09'),
(2, 'Optievent', NULL, '2022-09-21 21:21:09', '2022-09-21 17:21:09');

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
(18, 'Dépôt offres de service', 101, 6, 10, NULL, NULL, NULL, NULL, '2023-01-22', '11:00', NULL, NULL, NULL, 1, NULL, '2023-01-01 00:00:00', '2023-01-25 09:34:00'),
(19, 'Relance pour prise de rendez-vous', 95, 25, 10, NULL, NULL, NULL, NULL, '2023-01-24', '08:30', NULL, NULL, NULL, 1, NULL, '2023-01-01 00:00:00', '2023-01-25 09:32:24'),
(20, 'Dépôt offres de service', 97, 6, 10, NULL, NULL, NULL, NULL, '2023-01-24', '10:00', NULL, NULL, NULL, 1, NULL, '2023-01-01 00:00:00', '2023-01-25 09:34:07'),
(31, 'Rencontrer DG ORANGE', 253, 25, NULL, 234, NULL, NULL, NULL, '2023-01-30', '12:00', NULL, NULL, NULL, 0, NULL, '2023-01-01 00:00:00', '2023-01-30 14:18:38'),
(32, 'Envoie les offres', 253, 25, NULL, 234, NULL, NULL, NULL, '2023-01-30', '13:30', NULL, NULL, NULL, 0, NULL, '2023-01-01 00:00:00', '2023-01-30 14:20:17'),
(282, NULL, 1093, 13, 13, NULL, NULL, NULL, NULL, '2023-02-16', '09:45', NULL, NULL, NULL, 0, 2179, '2023-02-13 12:44:11', '2023-02-13 09:44:11'),
(283, 'Rendez-vous avec responsable formation', 216, 25, 10, NULL, NULL, NULL, NULL, '2023-02-16', '14:00', NULL, NULL, NULL, 0, NULL, '2023-02-13 12:59:52', '2023-02-13 09:59:52'),
(411, NULL, 1388, 33, 13, NULL, NULL, NULL, NULL, '2023-04-15', '12:00', NULL, 'Dakar', NULL, 0, 3930, '2023-04-13 11:34:53', '2023-04-13 07:34:53'),
(412, 'Présenter Helloventes', 1388, 25, 10, NULL, NULL, NULL, NULL, '2023-04-18', '12:00', NULL, NULL, NULL, 0, NULL, '2023-04-17 11:38:12', '2023-04-17 07:38:12');

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
(101, 'Groupe Sonatel', NULL, NULL, 6, 10, NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-07 15:48:43', '2023-01-07 08:48:43'),
(95, 'SAR SA', NULL, 'default-woman-avatar-people-female-icon-vector-15729765.jpg', 25, 10, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-07 15:28:25', '2023-01-30 13:47:36'),
(97, 'Auchan', NULL, NULL, 6, 10, NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, 1, 1, '3', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-07 15:32:40', '2023-01-07 08:32:40'),
(106, 'Eiffage', NULL, NULL, 6, 10, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, 1, 13, NULL, NULL, NULL, NULL, NULL, '2023-01-07 17:52:36', '2023-01-07 10:52:36'),
(111, 'PAPS SN', NULL, NULL, 12, 10, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-07 18:33:31', '2023-01-31 04:46:55'),
(113, 'SENELEC', NULL, NULL, 12, 10, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-07 18:42:02', '2023-01-07 18:45:20'),
(115, 'CORAF', NULL, NULL, 12, 10, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 13, NULL, NULL, NULL, NULL, NULL, '2023-01-07 18:51:53', '2023-01-07 19:23:04'),
(210, 'Gab oil', NULL, NULL, 6, 10, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, 1, 1, '8', 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-15 12:49:12', '2023-01-15 07:49:12'),
(145, 'Sen Eau', NULL, NULL, 13, 13, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-10 07:12:16', '2023-01-10 00:12:16'),
(149, 'Supeco', NULL, 'Sodigaz.jpeg', 13, 13, NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-10 08:37:21', '2023-01-15 12:59:52'),
(158, 'ECOBANK', '56249495', NULL, 28, 13, NULL, NULL, 15, NULL, 'Banque', NULL, NULL, NULL, 1, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-12 12:11:10', '2023-01-12 05:11:10'),
(202, 'Touareg', NULL, NULL, 10, 10, NULL, NULL, 28, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-26 12:48:47', '2023-01-26 05:48:47'),
(174, 'Groupe ISM', NULL, 'cma cgm.jpeg', 13, 13, NULL, NULL, 14, NULL, NULL, NULL, 'CMA CGM', NULL, 1, 1, '8', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-13 17:30:11', '2023-01-15 11:00:52'),
(176, 'Mutuelle entreprise', '338641800', NULL, 10, 10, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-14 13:23:16', '2023-01-14 06:23:16'),
(177, 'Sen Ventes', '338490198', NULL, 10, 10, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-14 13:26:44', '2023-01-14 06:26:44'),
(178, 'DG entreprise', '338495666', NULL, 10, 10, NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-14 13:32:48', '2023-01-14 06:32:48'),
(182, 'Salon des PME', NULL, NULL, 13, 13, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-16 23:30:47', '2023-01-16 16:30:47'),
(184, 'Majorel', NULL, NULL, 10, 10, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-17 09:36:33', '2023-01-17 02:36:33'),
(193, 'Total', NULL, NULL, 10, 10, NULL, NULL, 15, NULL, 'ND', NULL, NULL, NULL, 0, 0, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-21 15:30:06', '2023-01-21 08:30:06'),
(209, 'NIYEL', '25498800', NULL, 13, 13, NULL, NULL, 9, NULL, NULL, NULL, 'CFAO MOTORS', NULL, 1, 1, '8', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-14 17:45:54', '2023-01-14 12:45:54'),
(212, 'Enabel', NULL, 'kok.jpg', 25, 10, NULL, NULL, 35, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2023-01-16 06:32:52', '2023-01-30 16:03:19'),
(216, 'FNUAP', NULL, NULL, 29, 13, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-18 12:55:10', '2023-01-18 07:55:10'),
(234, 'RH', '74683244', 'kok.jpg', 33, 13, NULL, NULL, 16, NULL, NULL, NULL, 'BANQUE AFRICAINE DE DEVELOPPEMENT', NULL, 1, 1, '8', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-23 14:33:36', '2023-01-30 16:01:27'),
(253, 'GIVAGRO SéNéGAL', '77890987654', NULL, 25, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-30 19:10:12', '2023-01-30 14:10:12'),
(244, 'MBS', '70213535', NULL, 33, 13, NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-25 14:30:41', '2023-01-25 09:30:41'),
(246, 'OPC', '64288910', NULL, 28, 13, NULL, NULL, 4, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-25 15:35:07', '2023-01-25 10:35:07'),
(249, 'BPI', NULL, NULL, 29, 13, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 1, 1, '8', 1, 5, NULL, NULL, NULL, NULL, NULL, '2023-01-28 08:20:59', '2023-01-28 03:20:59'),
(1093, 'SOCIETE D\'EQUIPEMENT AGRICOLE ET INDUSTRIEL', NULL, NULL, 29, 13, NULL, NULL, NULL, NULL, NULL, 2179, NULL, 'Prospect appelé', 0, 0, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, '2023-02-13 12:44:11', '2023-02-13 09:44:11'),
(1388, 'ABS', '334567866', NULL, 28, 13, NULL, NULL, 0, 'Service', NULL, 3930, NULL, 'Prospect appelé', 0, 0, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, '2023-04-13 11:34:53', '2023-04-13 07:34:53');

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

--
-- Déchargement des données de la table `prospect_a_appellers`
--

INSERT INTO `prospect_a_appellers` (`id`, `nom_entreprise`, `tel_fixe`, `tel_mobile`, `nom_contact`, `tel_contact`, `solution_a_vendre`, `email_entreprise`, `email_contact`, `date_import`, `pays_id`, `date_affectation`, `commercial_id`, `date_appel`, `prospect_qualifier`, `prospect_update`, `secteur_activite`, `besoin_prioritaire`, `autre_besoins`, `code_domaine`, `probabilite`, `statut`, `site_web`, `superieur_id`, `created_at`, `updated_at`) VALUES
(11319, 'FunTech', NULL, NULL, 'Demba Gueye', '338976578', 'Vendre une solution', NULL, NULL, NULL, NULL, NULL, 33, NULL, NULL, NULL, 'Technologie', NULL, NULL, NULL, NULL, NULL, NULL, 13, '2023-04-12 08:52:18', '2023-04-12 12:52:18'),
(11320, 'ABS', NULL, NULL, 'Pierre Ngom', '334567866', 'Formaton', NULL, NULL, NULL, 1, NULL, 33, NULL, NULL, NULL, 'Service', NULL, NULL, NULL, NULL, 1, NULL, 13, '2023-04-12 08:52:18', '2023-04-13 11:34:53');

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

--
-- Déchargement des données de la table `raisons`
--

INSERT INTO `raisons` (`id`, `commentaire`, `commercial_id`, `superieur_id`, `created_at`, `updated_at`) VALUES
(1, 'Excellente fonctionnalité ! Keep the good work up', 10, 10, '2022-12-07 12:08:26', '2022-12-07 12:08:26');

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
(1, 'Prospect qualifié', 'Prospect qualifié', '2023-01-13 09:40:36', '2023-01-13 11:40:36'),
(2, 'Prospect non qualifié', 'Prospect non qualifié', '2023-01-13 09:40:36', '2023-01-13 11:40:36'),
(5, 'Prospect à rappeler', 'Prospect à rappeler', '2023-01-13 09:40:36', '2023-01-13 11:40:36');

-- --------------------------------------------------------

--
-- Structure de la table `resultat_appelsold`
--

CREATE TABLE `resultat_appelsold` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `lib` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Déchargement des données de la table `stock_journalieres`
--

INSERT INTO `stock_journalieres` (`id`, `commercial_id`, `entreprise_client_id`, `superieur_id`, `montant_vente`, `okay`, `objectif_mois`, `created_at`, `updated_at`) VALUES
(14, 25, NULL, NULL, '1800000', NULL, NULL, '2023-01-30 19:00:00', '2023-01-01 14:14:43'),
(15, 25, NULL, NULL, '6500000', NULL, NULL, '2023-03-06 12:11:39', '2023-03-06 14:11:39'),
(16, 25, NULL, NULL, '6500000', NULL, NULL, '2023-03-06 12:16:17', '2023-03-06 14:16:17'),
(17, 33, NULL, NULL, '4500000', NULL, NULL, '2023-04-14 06:45:47', '2023-04-14 10:45:47'),
(18, 25, NULL, NULL, '5000000', NULL, NULL, '2023-04-14 06:49:30', '2023-04-14 10:49:30'),
(19, 25, NULL, NULL, '2000000', NULL, NULL, '2023-05-09 08:19:25', '2023-05-09 12:19:25');

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
  `pourcentage_contact_mois` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `stock_mensuelles`
--

INSERT INTO `stock_mensuelles` (`id`, `montant`, `created_at`, `updated_at`, `commercial_id`, `entreprise_client_id`, `superieur_id`, `nbre_contact`, `nbre_contact_ajouter`, `nbre_demo`, `nbre_demo_ajouter`, `objectif_visite`, `nbre_visite_ajouter`, `mois`, `pourcentage`, `commission`, `commission_p`, `montant_vente`, `objectif_mois`, `pourcentage_contact_mois`) VALUES
(15, NULL, '2023-01-01 00:00:00', '2023-01-31 17:00:03', 25, NULL, 10, NULL, '8', NULL, NULL, NULL, NULL, NULL, '100', '500000', '0.05', '10000000', '10000000', '0'),
(16, NULL, '2023-01-01 00:00:00', '2023-01-31 17:00:03', 29, NULL, 13, NULL, '3', NULL, NULL, NULL, NULL, NULL, '0', '0', '	\r\n0.05', '0', '5000000', '0'),
(20, NULL, '2023-01-01 00:00:00', '2023-01-31 17:00:03', 33, NULL, 13, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', '0', '	\r\n0.05', '0', '5000000', '0');

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

--
-- Déchargement des données de la table `suivi_prospects`
--

INSERT INTO `suivi_prospects` (`id`, `prospect_appel_id`, `type`, `choix_qualifier`, `choix_non_qualifier`, `choix_a_rappeler`, `domaine_valider`, `centre_dinteret`, `personne_a_contacter`, `contact_personne`, `email_personne`, `date_rendezvous`, `personne_rv`, `contact_rv`, `libelle_rv`, `commentaire_rv`, `lieu_rv`, `heure_rv`, `statut_rv`, `resultat_rv`, `date_depot_offre`, `date_depot_agreement`, `commercial_suivi`, `commentaire_qualifier`, `raison_no_qualifier`, `date_relance_noqualifier`, `injoignable_comm`, `resume`, `date_rappel`, `date_a_rappeler`, `demande_rappel`, `besoin_rappel`, `commercial_id`, `etat_qualifier`, `pays_id`, `jour`, `created_at`, `updated_at`) VALUES
(3930, 11320, 1, 'Rendez-vous obtenu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-15 00:00:00', 'Mr Ndiaye', '09000140', NULL, NULL, 'Dakar', '12:00:00', NULL, NULL, NULL, NULL, 28, NULL, NULL, NULL, NULL, NULL, '2023-04-17 00:00:00', NULL, NULL, NULL, 33, NULL, 5, '2023-04-13', '2023-04-13 07:34:53', '2023-04-13 11:34:53');

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
(1, 'Séance de travail', '2023-01-14 21:05:32', '2023-01-14 19:05:32'),
(2, 'Devis ou courrier à envoyer', '2023-01-14 21:05:32', '2023-01-14 19:05:32'),
(3, 'Se rendre dans l’entreprise', '2023-01-14 21:05:32', '2023-01-14 19:05:32'),
(4, 'Trouver un meilleur interlocuteur/point focal\r\n', '2023-01-14 21:05:32', '2023-01-14 19:05:32');

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

--
-- Déchargement des données de la table `update_opps`
--

INSERT INTO `update_opps` (`id`, `libelle`, `commentaire`, `personne`, `date`, `commercial_id`, `entreprise_client_id`, `superieur_id`, `opportunite_id`, `prospect_id`, `update_id`, `created_at`, `updated_at`) VALUES
(3, 'En négociation', 'Le prospect affirme être en train de gérer en interne des actions prioritaires. Il va nous revenir sous peu pour nous proposer des dates pour les formations demandées.\r\n\r\nDeux tentatives d\'appel et un mail lui ont été envoyé cette semaine (la période du 22 au 27 Novembre lui a été proposée). \r\nGeoffroy pourrait tenter de le rencontrer en Côte d\'Ivoire durant son séjour pour pousser l\'opportunité.', 'Kadio BOSSON - Country Learning Partner UBA CI', '2023-01-15', 10, NULL, 10, 134, 106, NULL, '2023-01-30 19:00:00', '2023-01-15 11:10:37'),
(4, 'Poursuivant la réalisation de la mission d\'immersion avant envoi d\'une convention de partenariat', 'En attente de la validation de la période (dates) d\'immersion par la Directrice du programme', 'Daouda Alkaly SAGNA', '2023-01-15', 10, NULL, 10, 132, 101, NULL, '2023-01-30 19:00:00', '2023-01-15 11:16:13'),
(5, 'Places offertes au webinaire ADF du 26 Novembre', '10 places leur ont été offerte. 06 personnes figurent sur la liste de participants qu\'ils nous ont fourni. \r\n\r\nIls nous ont dit qu\'ils sont vraiment intéressé par ILLIMITIS et l\'idée de travailler avec nous en 2023 car leur budget de formation pour cette année est déjà épuisé.\r\n\r\nDans le suivi de la relation client, j\'envisage de leur faire parvenir notre catalogue 2023 dès que possible pour renforcer cet intérêt', 'Demba NDIABE', '2023-01-15', 10, NULL, 10, 122, 95, NULL, '2023-01-30 19:00:00', '2023-01-15 11:52:08'),
(15, 'test', NULL, 'momo', '2023-01-30', 25, NULL, NULL, 232, 95, NULL, '2023-01-30 19:00:00', '2023-01-30 18:57:25');

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
(1, 'Admin', 'A', 'admin@gmail.com', NULL, 'admin', NULL, '$2y$10$uCxeKEUM50MIjO2NInRQUO/iOId1p6mrjvjapbapLPJwSSewYx0Vy', NULL, '2023-01-12 10:37:35', '10', '37', '10:37', 0, NULL, NULL, NULL, 'pp.jpg'),
(11, 'Rosalie', 'Mendy', 'rosalie@helloventes.com', NULL, 'commerciaux', 10, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', NULL, '2023-01-30 13:25:04', '13', '25', '13:25', 1, NULL, '2022-09-07 16:12:25', '2023-01-14 10:34:04', 'pp.jpg'),
(15, 'Paul', 'Edwar', 'paul@helloventes.com', NULL, 'responsable', 10, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', NULL, '2023-01-30 13:23:32', '13', '23', '13:23', 1, NULL, '2022-09-29 15:52:42', '2023-01-17 01:34:17', 'pp.jpg'),
(17, 'Marie', 'Fall', 'marie@helloventes.com', NULL, 'commerciaux', 10, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', NULL, '2023-01-01 14:28:28', '14', '28', '14:28', 1, NULL, '2022-09-29 15:53:36', '2023-01-13 10:28:28', 'pp.jpg'),
(18, 'Patrick', 'Verra', 'responsable@helloventes.com', NULL, 'responsable', 13, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', NULL, '2023-09-18 13:55:55', '13', '55', '13:55', 1, NULL, '2022-09-29 15:54:02', '2023-01-26 07:44:06', 'pp.jpg'),
(32, 'Pierre', 'Ngom', 'directeur@helloventes.com', NULL, 'directeur', 10, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', 'b2Ghv4mL9jXlvU2gqH6ENtu727jznjjVQLdirRb7Ecjaq15iHt7I8rWACByW', '2023-09-18 12:51:20', '12', '51', '12:51', 1, NULL, '2023-01-05 17:47:22', '2023-01-29 13:47:21', 'pp.jpg'),
(35, 'Emma', 'Sako', 'emma@helloventes.com', NULL, 'commerciaux', 13, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', NULL, '2023-01-30 14:28:15', '14', '28', '14:28', 1, NULL, '2023-01-07 15:26:32', '2023-01-17 03:30:07', 'pp.jpg'),
(36, 'Jean', 'Francois', 'jean@helloventes.com', NULL, 'commerciaux', 13, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', 'UMjV6AxeVruObp0gTns6ImuzlOeEppUazBl8dR7c5zILH9vw9mnUXfv4n5cf', '2023-01-30 14:34:06', '14', '34', '14:34', 1, NULL, '2023-01-07 15:27:24', '2023-01-17 05:40:41', 'pp.jpg'),
(40, 'Emilie', 'Sagna', 'user@helloventes.com', NULL, 'commerciaux', 13, '$2y$10$j4xxgkgyFlkVgFH.zqx0IeGZ4e5fbSwFSG.8NvgRZbXlSthOV8l.K', 'gIhRCENzRi7R0BtiO8ETHe4VJOADkoL2aSeysFW0odUvp3TbkoF11kgIvQAu', '2023-09-18 14:01:58', '14', '01', '14:01', 1, NULL, '2023-01-07 16:00:19', '2023-01-16 08:15:02', 'pp.jpg'),
(46, 'gny', 'Diouf', 'gny.dev@gmail.com', NULL, 'commerciaux', 13, '$2y$10$GxYISDhfxUOA1tVrkE9fiOK7707bt0IcH1dXEI2XEYqHJXe.n9bXu', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2023-01-30 19:49:48', '2023-01-30 14:49:48', 'pp.jpg');

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
(1, '10000000', NULL, '15000000', 122, 25, NULL, NULL, '2023-01-01 00:00:00', '2023-01-13 09:18:30'),
(2, '800000', NULL, '1200000', 134, 6, NULL, NULL, '2023-01-01 00:00:00', '2023-01-14 05:55:49'),
(3, '6800000', NULL, '10300000', 145, 12, NULL, NULL, '2023-01-01 00:00:00', '2022-01-15 05:53:02'),
(4, '430000', NULL, '430000', 163, 28, NULL, NULL, '2023-01-01 00:00:00', '2023-01-18 03:47:19'),
(6, '3068000', NULL, '3068000', 132, 6, NULL, NULL, '2023-01-01 00:00:00', '2023-01-22 07:06:18'),
(7, '1900000', NULL, '2000000', 204, 25, NULL, NULL, '2023-01-01 00:00:00', '2023-01-24 09:56:34'),
(10, '3787500', NULL, '4000000', 227, 29, NULL, NULL, '2023-01-01 00:00:00', '2023-01-27 16:51:35'),
(11, '4000000', NULL, '5000000', 232, 25, NULL, NULL, '2023-01-01 00:00:00', '2023-01-30 13:58:38'),
(12, '4000000', NULL, '4000000', 223, 33, NULL, NULL, '2023-01-01 00:00:00', '2023-01-01 09:10:52'),
(13, '1500000', NULL, '2000000', 176, 13, NULL, NULL, '2023-01-01 00:00:00', '2023-01-01 09:13:20'),
(14, '1800000', NULL, '2000000', 237, 25, NULL, NULL, '2023-01-01 00:00:00', '2023-01-01 09:14:43'),
(15, '2000000', NULL, '2000000', 235, 25, NULL, NULL, '2023-03-06 14:11:39', '2023-03-06 12:11:39'),
(16, '4500000', NULL, '5000000', 233, 25, NULL, NULL, '2023-03-06 14:16:17', '2023-03-06 12:16:17'),
(17, '4500000', NULL, '4500000', 216, 33, NULL, NULL, '2023-04-14 10:45:47', '2023-04-14 06:45:47'),
(18, '5000000', NULL, '6000000', 234, 25, NULL, NULL, '2023-04-14 10:49:30', '2023-04-14 06:49:30'),
(19, '2000000', NULL, '2000000', 236, 25, NULL, NULL, '2023-05-09 12:19:25', '2023-05-09 08:19:25');

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
(4, 'vil', '2023-06-21 13:15:35', '2023-06-21 15:15:35');

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
-- Index pour la table `resultat_appelsold`
--
ALTER TABLE `resultat_appelsold`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=568;

--
-- AUTO_INCREMENT pour la table `action_de_suivi`
--
ALTER TABLE `action_de_suivi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bdd_prospects`
--
ALTER TABLE `bdd_prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commerciaus`
--
ALTER TABLE `commerciaus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=738;

--
-- AUTO_INCREMENT pour la table `demos`
--
ALTER TABLE `demos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historiques_probas`
--
ALTER TABLE `historiques_probas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `itineraires`
--
ALTER TABLE `itineraires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `multinationals`
--
ALTER TABLE `multinationals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `objectif_commissions`
--
ALTER TABLE `objectif_commissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `opportunites`
--
ALTER TABLE `opportunites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=437;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT pour la table `performancesbfs`
--
ALTER TABLE `performancesbfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT pour la table `performancessns`
--
ALTER TABLE `performancessns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=632;

--
-- AUTO_INCREMENT pour la table `performance_bf_globales`
--
ALTER TABLE `performance_bf_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT pour la table `performance_commerciales`
--
ALTER TABLE `performance_commerciales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `performance_globales`
--
ALTER TABLE `performance_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT pour la table `performance_sn_globales`
--
ALTER TABLE `performance_sn_globales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `prospections`
--
ALTER TABLE `prospections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT pour la table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1639;

--
-- AUTO_INCREMENT pour la table `prospect_a_appellers`
--
ALTER TABLE `prospect_a_appellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11321;

--
-- AUTO_INCREMENT pour la table `raisons`
--
ALTER TABLE `raisons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `resultat_appels`
--
ALTER TABLE `resultat_appels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `resultat_appelsold`
--
ALTER TABLE `resultat_appelsold`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `stock_mensuelles`
--
ALTER TABLE `stock_mensuelles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `suivi_prospects`
--
ALTER TABLE `suivi_prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3931;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `villes`
--
ALTER TABLE `villes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
