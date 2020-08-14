-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 14 août 2020 à 10:43
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cec`
--

-- --------------------------------------------------------

--
-- Structure de la table `age_plant`
--

DROP TABLE IF EXISTS `age_plant`;
CREATE TABLE IF NOT EXISTS `age_plant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `age_plant`
--

INSERT INTO `age_plant` (`id`, `nom`, `description`) VALUES
(1, '< 15 jours', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `agriculteur`
--

DROP TABLE IF EXISTS `agriculteur`;
CREATE TABLE IF NOT EXISTS `agriculteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` smallint(6) NOT NULL,
  `age` smallint(6) NOT NULL,
  `statut_famille` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot` smallint(6) NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surface_totale_exploitee` decimal(6,2) DEFAULT NULL,
  `surface_totale_riziere` decimal(6,2) DEFAULT NULL,
  `surface_parcelle_louee` decimal(6,2) DEFAULT NULL,
  `surface_parcelle_en_location` decimal(6,2) DEFAULT NULL,
  `nbr_menage` smallint(6) DEFAULT NULL,
  `nbr_actif` smallint(6) DEFAULT NULL,
  `nbr_mois_autosuffisance_riz` smallint(6) DEFAULT NULL,
  `acces_riziere` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipement_agricole` tinyint(1) DEFAULT NULL,
  `pratique_activite_agricole` tinyint(1) DEFAULT NULL,
  `pratique_elevage_rente` tinyint(1) DEFAULT NULL,
  `pratique_activite_non_agricole` tinyint(1) DEFAULT NULL,
  `pratique_peche` tinyint(1) DEFAULT NULL,
  `autre_programme` tinyint(1) DEFAULT NULL,
  `nbr_mois_soudure` smallint(6) DEFAULT NULL,
  `typologie_id` int(11) DEFAULT NULL,
  `bvpi_id` int(11) DEFAULT NULL,
  `zone_technicien_id` int(11) DEFAULT NULL,
  `op_id` int(11) DEFAULT NULL,
  `ce_id` int(11) DEFAULT NULL,
  `elevage_id` int(11) DEFAULT NULL,
  `culture_id` int(11) DEFAULT NULL,
  `village_id` int(11) DEFAULT NULL,
  `terroir_id` int(11) DEFAULT NULL,
  `sous_region_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `commune_id` int(11) DEFAULT NULL,
  `anciennete_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2366443B42F4634A` (`typologie_id`),
  KEY `IDX_2366443B7AC2280A` (`bvpi_id`),
  KEY `IDX_2366443BC4531AA` (`zone_technicien_id`),
  KEY `IDX_2366443B2F7FAB3F` (`op_id`),
  KEY `IDX_2366443B8D48E193` (`ce_id`),
  KEY `IDX_2366443B4E2F28D` (`elevage_id`),
  KEY `IDX_2366443BB108249D` (`culture_id`),
  KEY `IDX_2366443B5E0D5582` (`village_id`),
  KEY `IDX_2366443BAAE80216` (`terroir_id`),
  KEY `IDX_2366443B832FEA1A` (`sous_region_id`),
  KEY `IDX_2366443B98260155` (`region_id`),
  KEY `IDX_2366443B131A4F72` (`commune_id`),
  KEY `IDX_2366443B3039A7E3` (`anciennete_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `agriculteur`
--

INSERT INTO `agriculteur` (`id`, `nom`, `prenom`, `genre`, `age`, `statut_famille`, `lot`, `district`, `surface_totale_exploitee`, `surface_totale_riziere`, `surface_parcelle_louee`, `surface_parcelle_en_location`, `nbr_menage`, `nbr_actif`, `nbr_mois_autosuffisance_riz`, `acces_riziere`, `equipement_agricole`, `pratique_activite_agricole`, `pratique_elevage_rente`, `pratique_activite_non_agricole`, `pratique_peche`, `autre_programme`, `nbr_mois_soudure`, `typologie_id`, `bvpi_id`, `zone_technicien_id`, `op_id`, `ce_id`, `elevage_id`, `culture_id`, `village_id`, `terroir_id`, `sous_region_id`, `region_id`, `commune_id`, `anciennete_id`) VALUES
(1, 'RAKOTOARINIVO', 'Zacharie Haritiana', 1, 21, 'Fils', 2, 'Antananarivo', '10.00', '5.00', '0.00', '1.00', 4, 3, 6, 'Tsy aiko tsara', 1, 1, 1, 1, 0, 0, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'RAKOTOARINIVO', 'Iaikitiana', 1, 23, '1', 3, 'Antananarivo', '3.00', '1.00', '0.00', '0.00', 4, 2, 2, 'Oui', 0, 1, 1, 1, 1, 0, 2, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'RAKOTOARINIVO', 'Z', 1, 21, '1', 1, 'Antananarivo', '4.00', '1.00', '0.00', '0.00', 3, 1, 3, '1', 0, 1, 0, 0, 0, 0, NULL, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'RAKOTOARINIVO', 'Zacharie Haritiana x', 1, 21, '1', 2, 'Antananarivo', '5.00', '2.00', '0.00', '0.00', 3, 2, 5, '2', 1, 1, 0, 0, 0, 0, 2, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'RAKOTOARINIVO', 'Zacharie Haritiana v', 1, 21, '1', 2, 'Antananarivo', '10.00', '2.00', '0.00', '0.00', 4, 2, 5, 'Tsy aiko tsara', 1, 0, 1, 0, 0, 0, 3, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'RAZAFINDRAZAKA', 'Hanitra', 0, 45, '1', 1, 'Antananarivo', '12.00', '2.00', '0.00', '0.00', 4, 1, 2, 'Tsy aiko tsara', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL, 1, 1, 1, 1, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `anciennete`
--

DROP TABLE IF EXISTS `anciennete`;
CREATE TABLE IF NOT EXISTS `anciennete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `anciennete`
--

INSERT INTO `anciennete` (`id`, `nom`, `description`) VALUES
(1, 'A0', NULL),
(2, 'A1', NULL),
(3, 'A2', NULL),
(4, 'A3&+', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `anciennete_agriculteur`
--

DROP TABLE IF EXISTS `anciennete_agriculteur`;
CREATE TABLE IF NOT EXISTS `anciennete_agriculteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `anciennete_agriculteur`
--

INSERT INTO `anciennete_agriculteur` (`id`, `nom`, `description`) VALUES
(1, '1', NULL),
(2, '2', NULL),
(3, '3', NULL),
(4, '4&+', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bvpi`
--

DROP TABLE IF EXISTS `bvpi`;
CREATE TABLE IF NOT EXISTS `bvpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `bvpi`
--

INSERT INTO `bvpi` (`id`, `nom`, `numero`, `description`) VALUES
(1, 'Ambatonivola', '5', NULL),
(2, 'Langoro', '4', NULL),
(3, 'Antaobe', 's', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ce`
--

DROP TABLE IF EXISTS `ce`;
CREATE TABLE IF NOT EXISTS `ce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ce`
--

INSERT INTO `ce` (`id`, `nom`, `description`) VALUES
(1, 'CE_test_1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

DROP TABLE IF EXISTS `commune`;
CREATE TABLE IF NOT EXISTS `commune` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`id`, `nom`, `description`) VALUES
(1, 'Ambila', NULL),
(2, 'Amboanjo', NULL),
(3, 'Anoloka', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `controlle_biomas`
--

DROP TABLE IF EXISTS `controlle_biomas`;
CREATE TABLE IF NOT EXISTS `controlle_biomas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `controlle_biomas`
--

INSERT INTO `controlle_biomas` (`id`, `nom`, `description`) VALUES
(1, 'Traditionnel', NULL),
(2, 'Herbicide', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `culture`
--

DROP TABLE IF EXISTS `culture`;
CREATE TABLE IF NOT EXISTS `culture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rente` tinyint(1) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `culture`
--

INSERT INTO `culture` (`id`, `nom`, `rente`, `description`) VALUES
(1, 'Vanille', 1, 'Épice utilisé dans divers produits artisanaux et industriels.'),
(2, 'Girofle', 1, 'Épice utilisé dans divers produits artisanaux et industriels ainsi que dans le domaie medical'),
(3, 'Caffe', 1, NULL),
(4, 'Poivre', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `culture_fille`
--

DROP TABLE IF EXISTS `culture_fille`;
CREATE TABLE IF NOT EXISTS `culture_fille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plante_id` int(11) NOT NULL,
  `variete_id` int(11) DEFAULT NULL,
  `age_plant_id` int(11) DEFAULT NULL,
  `culture_mere_id` int(11) DEFAULT NULL,
  `date_plantation` date DEFAULT NULL,
  `qte_semence` decimal(10,2) DEFAULT NULL,
  `production` decimal(10,2) DEFAULT NULL,
  `rdt` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_30DE57A0177B16E8` (`plante_id`),
  KEY `IDX_30DE57A0620D5460` (`variete_id`),
  KEY `IDX_30DE57A05359AD1B` (`age_plant_id`),
  KEY `IDX_30DE57A01AD0BD9E` (`culture_mere_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `culture_fille`
--

INSERT INTO `culture_fille` (`id`, `plante_id`, `variete_id`, `age_plant_id`, `culture_mere_id`, `date_plantation`, `qte_semence`, `production`, `rdt`) VALUES
(1, 1, 4, 1, NULL, '2018-08-12', '12.00', '45.00', '14.00'),
(2, 1, 4, 1, 1, '2018-04-15', '12.00', '24.00', '12.00');

-- --------------------------------------------------------

--
-- Structure de la table `culture_mere`
--

DROP TABLE IF EXISTS `culture_mere`;
CREATE TABLE IF NOT EXISTS `culture_mere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cycle_agricole_id` int(11) DEFAULT NULL,
  `precedent_cultural_id` int(11) DEFAULT NULL,
  `systeme_cultural_id` int(11) DEFAULT NULL,
  `itineraire_cultural_id` int(11) DEFAULT NULL,
  `etat_pc_id` int(11) DEFAULT NULL,
  `etat_mulch_id` int(11) DEFAULT NULL,
  `preparation_parcelle_id` int(11) DEFAULT NULL,
  `controlle_biomas_id` int(11) DEFAULT NULL,
  `mode_installation_id` int(11) DEFAULT NULL,
  `type_pepiniere_id` int(11) DEFAULT NULL,
  `mode_repiquage_id` int(11) DEFAULT NULL,
  `type_sarclage_id` int(11) DEFAULT NULL,
  `degat_cyclonique_id` int(11) DEFAULT NULL,
  `sondage_qualitatif_id` int(11) DEFAULT NULL,
  `parcelle_id` int(11) DEFAULT NULL,
  `nouvelle_plantation` tinyint(1) DEFAULT NULL,
  `surface_cultive` decimal(10,2) DEFAULT NULL,
  `mo_preparation_sol` smallint(6) DEFAULT NULL,
  `mo_installation_culture` smallint(6) DEFAULT NULL,
  `mo_entretien1` int(11) DEFAULT NULL,
  `mo_entretien2` int(11) DEFAULT NULL,
  `mo_entretien3` int(11) DEFAULT NULL,
  `mo_recolte` int(11) DEFAULT NULL,
  `mo_ext_preparation_sol` int(11) DEFAULT NULL,
  `mo_ext_installation_culture` int(11) DEFAULT NULL,
  `mo_ext_entretien1` int(11) DEFAULT NULL,
  `mo_ext_entretien2` int(11) DEFAULT NULL,
  `mo_ext_entretien3` int(11) DEFAULT NULL,
  `mo_ext_recolte` int(11) DEFAULT NULL,
  `date_plantation` date DEFAULT NULL,
  `age_plantation` smallint(6) DEFAULT NULL,
  `qte_fumure_organique` decimal(6,2) DEFAULT NULL,
  `qte_insecticide` decimal(6,2) DEFAULT NULL,
  `mis_en_cloture` tinyint(1) DEFAULT NULL,
  `nbr_sarclage` int(11) DEFAULT NULL,
  `utilisation_pc_fourage` tinyint(1) DEFAULT NULL,
  `mis_en_culture` tinyint(1) DEFAULT NULL,
  `utilisation_pc_paillage_sur_autre_parcelle` tinyint(1) DEFAULT NULL,
  `utilisation_pc_compost` tinyint(1) DEFAULT NULL,
  `basket_compost` tinyint(1) DEFAULT NULL,
  `rente` tinyint(1) DEFAULT NULL,
  `ecobuage` tinyint(1) DEFAULT NULL,
  `sondage_rendement` tinyint(1) DEFAULT NULL,
  `pmg` int(11) DEFAULT NULL,
  `remarque_avsf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee_agricole_avsf` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1744C0B27A83B1C4` (`cycle_agricole_id`),
  KEY `IDX_1744C0B2A3EB127F` (`precedent_cultural_id`),
  KEY `IDX_1744C0B2E42CAA0B` (`systeme_cultural_id`),
  KEY `IDX_1744C0B2EF03C545` (`itineraire_cultural_id`),
  KEY `IDX_1744C0B2C9F47FA4` (`etat_pc_id`),
  KEY `IDX_1744C0B2CB7F3C6D` (`etat_mulch_id`),
  KEY `IDX_1744C0B264CE9167` (`preparation_parcelle_id`),
  KEY `IDX_1744C0B2AE936322` (`controlle_biomas_id`),
  KEY `IDX_1744C0B252A0E116` (`mode_installation_id`),
  KEY `IDX_1744C0B26A4AF869` (`type_pepiniere_id`),
  KEY `IDX_1744C0B2BD4A59D9` (`mode_repiquage_id`),
  KEY `IDX_1744C0B2C81E3BEA` (`type_sarclage_id`),
  KEY `IDX_1744C0B2562A46C1` (`degat_cyclonique_id`),
  KEY `IDX_1744C0B295CEBCE0` (`sondage_qualitatif_id`),
  KEY `IDX_1744C0B24433ED66` (`parcelle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `culture_mere`
--

INSERT INTO `culture_mere` (`id`, `cycle_agricole_id`, `precedent_cultural_id`, `systeme_cultural_id`, `itineraire_cultural_id`, `etat_pc_id`, `etat_mulch_id`, `preparation_parcelle_id`, `controlle_biomas_id`, `mode_installation_id`, `type_pepiniere_id`, `mode_repiquage_id`, `type_sarclage_id`, `degat_cyclonique_id`, `sondage_qualitatif_id`, `parcelle_id`, `nouvelle_plantation`, `surface_cultive`, `mo_preparation_sol`, `mo_installation_culture`, `mo_entretien1`, `mo_entretien2`, `mo_entretien3`, `mo_recolte`, `mo_ext_preparation_sol`, `mo_ext_installation_culture`, `mo_ext_entretien1`, `mo_ext_entretien2`, `mo_ext_entretien3`, `mo_ext_recolte`, `date_plantation`, `age_plantation`, `qte_fumure_organique`, `qte_insecticide`, `mis_en_cloture`, `nbr_sarclage`, `utilisation_pc_fourage`, `mis_en_culture`, `utilisation_pc_paillage_sur_autre_parcelle`, `utilisation_pc_compost`, `basket_compost`, `rente`, `ecobuage`, `sondage_rendement`, `pmg`, `remarque_avsf`, `annee_agricole_avsf`) VALUES
(1, 1, 1, 1, 2, 2, 2, 3, 1, 2, 1, 1, 3, 3, 2, 1, 1, '21.00', 2, 2, 4, 4, 4, 2, 2, 2, 1, 2, 2, 1, '2016-07-11', 2, '4.00', '4.00', 1, 4, 1, 1, 1, 1, 1, 1, 1, 1, 45, 'tsisy', '2012'),
(2, 1, 1, 1, 1, 2, 3, 1, 2, 1, 1, 1, 1, 2, 2, 2, 1, '2.00', 2, 3, 1, 2, 1, 3, 2, 1, 1, 1, 1, 1, '2018-07-13', 2, '12.00', '23.00', 1, 12, 1, 1, 1, 1, 1, 1, 1, 1, 45, 'none', 'none'),
(3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '4.00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2018-08-13', 2, '4.00', '4.00', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 45, 'tsisy', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `cycle_agricole`
--

DROP TABLE IF EXISTS `cycle_agricole`;
CREATE TABLE IF NOT EXISTS `cycle_agricole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cycle_agricole`
--

INSERT INTO `cycle_agricole` (`id`, `nom`, `description`) VALUES
(1, '0708C1', NULL),
(2, '0708C2', NULL),
(3, '0708C3', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `degat_cyclonique`
--

DROP TABLE IF EXISTS `degat_cyclonique`;
CREATE TABLE IF NOT EXISTS `degat_cyclonique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `degat_cyclonique`
--

INSERT INTO `degat_cyclonique` (`id`, `nom`, `description`) VALUES
(1, '< 1/4', NULL),
(2, '1/2 - 3/4', NULL),
(3, '1/4 - 1/2', NULL),
(4, '> 3/4', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200806152857', '2020-08-06 15:29:46', 20601),
('DoctrineMigrations\\Version20200806162044', '2020-08-06 16:20:51', 12327),
('DoctrineMigrations\\Version20200810131958', '2020-08-10 13:20:29', 8787),
('DoctrineMigrations\\Version20200811070051', '2020-08-11 07:01:12', 13012),
('DoctrineMigrations\\Version20200811080726', '2020-08-11 08:08:08', 2374),
('DoctrineMigrations\\Version20200811082158', '2020-08-11 08:22:22', 134),
('DoctrineMigrations\\Version20200811082838', '2020-08-11 08:29:01', 2094),
('DoctrineMigrations\\Version20200811102655', '2020-08-11 10:27:18', 4760),
('DoctrineMigrations\\Version20200811103012', '2020-08-11 10:30:34', 2157),
('DoctrineMigrations\\Version20200812051924', '2020-08-12 05:25:48', 5778),
('DoctrineMigrations\\Version20200812054016', '2020-08-12 05:40:37', 195),
('DoctrineMigrations\\Version20200812065751', '2020-08-12 06:58:02', 15854),
('DoctrineMigrations\\Version20200812113758', '2020-08-12 11:38:27', 51925);

-- --------------------------------------------------------

--
-- Structure de la table `elevage`
--

DROP TABLE IF EXISTS `elevage`;
CREATE TABLE IF NOT EXISTS `elevage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rente` tinyint(1) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `elevage`
--

INSERT INTO `elevage` (`id`, `nom`, `rente`, `description`) VALUES
(1, 'Vache laitiere', 1, NULL),
(2, 'zebu', 0, 'Animal multifonction'),
(3, 'Boeufs de traits', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `emplacement_pi`
--

DROP TABLE IF EXISTS `emplacement_pi`;
CREATE TABLE IF NOT EXISTS `emplacement_pi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emplacement_pi`
--

INSERT INTO `emplacement_pi` (`id`, `nom`, `description`) VALUES
(1, 'Amont', NULL),
(2, 'Intermediaire', NULL),
(3, 'Aval', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipement_agricole`
--

DROP TABLE IF EXISTS `equipement_agricole`;
CREATE TABLE IF NOT EXISTS `equipement_agricole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement_agricole`
--

INSERT INTO `equipement_agricole` (`id`, `nom`, `description`) VALUES
(1, 'Pulverisateur', NULL),
(2, 'Brouette', NULL),
(3, 'Arrosoir', NULL),
(4, 'Herse', NULL),
(5, 'Bicyclette', NULL),
(6, 'Angady', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etat_mulch`
--

DROP TABLE IF EXISTS `etat_mulch`;
CREATE TABLE IF NOT EXISTS `etat_mulch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat_mulch`
--

INSERT INTO `etat_mulch` (`id`, `nom`, `description`) VALUES
(1, '0 insuffisant', NULL),
(2, '1 acceptable', NULL),
(3, '2 bon', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `etat_pc`
--

DROP TABLE IF EXISTS `etat_pc`;
CREATE TABLE IF NOT EXISTS `etat_pc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etat_pc`
--

INSERT INTO `etat_pc` (`id`, `nom`, `description`) VALUES
(1, '0 a refaire', NULL),
(2, '1 en developpement', NULL),
(3, '2 bien developpe', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `fumure_organique`
--

DROP TABLE IF EXISTS `fumure_organique`;
CREATE TABLE IF NOT EXISTS `fumure_organique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fumure_organique`
--

INSERT INTO `fumure_organique` (`id`, `nom`, `description`) VALUES
(1, 'NPK', NULL),
(2, 'Uree', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `insecticide`
--

DROP TABLE IF EXISTS `insecticide`;
CREATE TABLE IF NOT EXISTS `insecticide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `insecticide`
--

INSERT INTO `insecticide` (`id`, `nom`, `description`) VALUES
(1, 'Herbicide', NULL),
(2, 'Fongicide', NULL),
(3, 'Autre', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `itineraire_cultural`
--

DROP TABLE IF EXISTS `itineraire_cultural`;
CREATE TABLE IF NOT EXISTS `itineraire_cultural` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `systeme_id` int(11) DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `riz` tinyint(1) DEFAULT NULL,
  `vivrier_hors` tinyint(1) DEFAULT NULL,
  `rmme` tinyint(1) DEFAULT NULL,
  `pc_en_pure` tinyint(1) DEFAULT NULL,
  `couverture_culture_rente` tinyint(1) DEFAULT NULL,
  `reforestation` tinyint(1) DEFAULT NULL,
  `culture_rente` tinyint(1) DEFAULT NULL,
  `pc_associe` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_26FC1CA3346F772E` (`systeme_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `itineraire_cultural`
--

INSERT INTO `itineraire_cultural` (`id`, `systeme_id`, `nom`, `riz`, `vivrier_hors`, `rmme`, `pc_en_pure`, `couverture_culture_rente`, `reforestation`, `culture_rente`, `pc_associe`) VALUES
(1, 1, 'Manioc + Arachis', 0, 1, 0, 0, 0, 0, 0, 0),
(2, 1, 'test', 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

DROP TABLE IF EXISTS `localisation`;
CREATE TABLE IF NOT EXISTS `localisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`id`, `nom`, `description`) VALUES
(1, 'Agnala makarana', NULL),
(2, 'Agnalalava', NULL),
(3, 'Agnambazaha', NULL),
(4, 'Agnateza', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `milieu`
--

DROP TABLE IF EXISTS `milieu`;
CREATE TABLE IF NOT EXISTS `milieu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `milieu`
--

INSERT INTO `milieu` (`id`, `nom`, `description`) VALUES
(1, 'Bas-fond', NULL),
(2, 'Bourrelet de berge', NULL),
(3, 'Riziere', NULL),
(4, 'Tanety', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mode_faire_valoir`
--

DROP TABLE IF EXISTS `mode_faire_valoir`;
CREATE TABLE IF NOT EXISTS `mode_faire_valoir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_faire_valoir`
--

INSERT INTO `mode_faire_valoir` (`id`, `nom`, `description`) VALUES
(1, 'Location', NULL),
(2, 'Metayage', NULL),
(3, 'Pret', NULL),
(4, 'Propre', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mode_installation`
--

DROP TABLE IF EXISTS `mode_installation`;
CREATE TABLE IF NOT EXISTS `mode_installation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_installation`
--

INSERT INTO `mode_installation` (`id`, `nom`, `description`) VALUES
(1, 'LAB', NULL),
(2, 'CV', NULL),
(3, 'CM', NULL),
(4, 'Poquet', NULL),
(5, 'Volee', NULL),
(6, 'Repiquage', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `mode_repiquage`
--

DROP TABLE IF EXISTS `mode_repiquage`;
CREATE TABLE IF NOT EXISTS `mode_repiquage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_repiquage`
--

INSERT INTO `mode_repiquage` (`id`, `nom`, `description`) VALUES
(1, 'En foule', NULL),
(2, 'En ligne', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `nbr_culture_agriculteur`
--

DROP TABLE IF EXISTS `nbr_culture_agriculteur`;
CREATE TABLE IF NOT EXISTS `nbr_culture_agriculteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `culture_id` int(11) NOT NULL,
  `agriculteur_id` int(11) NOT NULL,
  `nbr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B23F1B4DB108249D` (`culture_id`),
  KEY `IDX_B23F1B4D7EBB810E` (`agriculteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nbr_culture_agriculteur`
--

INSERT INTO `nbr_culture_agriculteur` (`id`, `culture_id`, `agriculteur_id`, `nbr`) VALUES
(1, 1, 5, 20),
(2, 2, 5, 2),
(3, 1, 6, 2),
(4, 2, 6, 1),
(5, 3, 6, 1),
(6, 4, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `nbr_elevage_agriculteur`
--

DROP TABLE IF EXISTS `nbr_elevage_agriculteur`;
CREATE TABLE IF NOT EXISTS `nbr_elevage_agriculteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agriculteur_id` int(11) NOT NULL,
  `elevage_id` int(11) NOT NULL,
  `nbr` int(11) NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_335A5D387EBB810E` (`agriculteur_id`),
  KEY `IDX_335A5D384E2F28D` (`elevage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nbr_elevage_agriculteur`
--

INSERT INTO `nbr_elevage_agriculteur` (`id`, `agriculteur_id`, `elevage_id`, `nbr`, `commentaire`) VALUES
(1, 3, 1, 2, NULL),
(2, 3, 2, 5, NULL),
(3, 3, 3, 1, NULL),
(4, 4, 2, 2, NULL),
(5, 4, 3, 3, NULL),
(6, 5, 1, 1, NULL),
(7, 5, 2, 2, NULL),
(8, 5, 3, 1, NULL),
(9, 6, 1, 1, NULL),
(10, 6, 2, 2, NULL),
(11, 6, 3, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `nbr_equipement_agricole_agriculteur`
--

DROP TABLE IF EXISTS `nbr_equipement_agricole_agriculteur`;
CREATE TABLE IF NOT EXISTS `nbr_equipement_agricole_agriculteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipement_agricole_id` int(11) NOT NULL,
  `agriculteur_id` int(11) NOT NULL,
  `nbr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_32C0AD1C2C2FC99` (`equipement_agricole_id`),
  KEY `IDX_32C0AD1C7EBB810E` (`agriculteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nbr_equipement_agricole_agriculteur`
--

INSERT INTO `nbr_equipement_agricole_agriculteur` (`id`, `equipement_agricole_id`, `agriculteur_id`, `nbr`) VALUES
(1, 1, 5, 4),
(2, 2, 5, 5),
(3, 3, 5, 7),
(4, 5, 5, 2),
(5, 6, 5, 2),
(6, 1, 6, 2),
(7, 2, 6, 2),
(8, 3, 6, 3),
(9, 4, 6, 2),
(11, 6, 6, 2);

-- --------------------------------------------------------

--
-- Structure de la table `nbr_fumure_culture_m`
--

DROP TABLE IF EXISTS `nbr_fumure_culture_m`;
CREATE TABLE IF NOT EXISTS `nbr_fumure_culture_m` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fumure_id` int(11) DEFAULT NULL,
  `culture_id` int(11) DEFAULT NULL,
  `nbr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E9E1DD168AA46A9F` (`fumure_id`),
  KEY `IDX_E9E1DD16B108249D` (`culture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nbr_fumure_culture_m`
--

INSERT INTO `nbr_fumure_culture_m` (`id`, `fumure_id`, `culture_id`, `nbr`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 2),
(3, 1, 2, 1),
(4, 2, 2, 1),
(5, 1, 3, 1),
(6, 2, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `nbr_insecticide_culture_m`
--

DROP TABLE IF EXISTS `nbr_insecticide_culture_m`;
CREATE TABLE IF NOT EXISTS `nbr_insecticide_culture_m` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `insecticide_id` int(11) DEFAULT NULL,
  `culture_id` int(11) DEFAULT NULL,
  `nbr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E2478F941A6E270` (`insecticide_id`),
  KEY `IDX_E2478F9B108249D` (`culture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nbr_insecticide_culture_m`
--

INSERT INTO `nbr_insecticide_culture_m` (`id`, `insecticide_id`, `culture_id`, `nbr`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 2),
(3, 1, 2, 1),
(4, 2, 2, 1),
(5, 1, 3, 1),
(6, 2, 3, 1),
(7, 3, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `op`
--

DROP TABLE IF EXISTS `op`;
CREATE TABLE IF NOT EXISTS `op` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `op`
--

INSERT INTO `op` (`id`, `nom`, `description`) VALUES
(1, 'OP_test_1', 'opt1');

-- --------------------------------------------------------

--
-- Structure de la table `parcelle`
--

DROP TABLE IF EXISTS `parcelle`;
CREATE TABLE IF NOT EXISTS `parcelle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agriculteur_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `type_sol_id` int(11) DEFAULT NULL,
  `mode_faire_valoir_id` int(11) DEFAULT NULL,
  `localisation_id` int(11) DEFAULT NULL,
  `milieu_id` int(11) DEFAULT NULL,
  `surface` decimal(6,2) NOT NULL,
  `irrigation` tinyint(1) DEFAULT NULL,
  `compaction` tinyint(1) DEFAULT NULL,
  `contre_saison` tinyint(1) DEFAULT NULL,
  `zone_erodible` tinyint(1) DEFAULT NULL,
  `longitude` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `risque_innondation` tinyint(1) DEFAULT NULL,
  `ancien_code_parcelle` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anciennete_id` int(11) DEFAULT NULL,
  `zc_id` int(11) DEFAULT NULL,
  `emplacement_pi_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C56E2CF67EBB810E` (`agriculteur_id`),
  KEY `IDX_C56E2CF6C54C8C93` (`type_id`),
  KEY `IDX_C56E2CF6EC3101F1` (`type_sol_id`),
  KEY `IDX_C56E2CF62CCD5D04` (`mode_faire_valoir_id`),
  KEY `IDX_C56E2CF6C68BE09C` (`localisation_id`),
  KEY `IDX_C56E2CF6735F057F` (`milieu_id`),
  KEY `IDX_C56E2CF63039A7E3` (`anciennete_id`),
  KEY `IDX_C56E2CF6C5D34BBC` (`zc_id`),
  KEY `IDX_C56E2CF6477E35CC` (`emplacement_pi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parcelle`
--

INSERT INTO `parcelle` (`id`, `agriculteur_id`, `type_id`, `type_sol_id`, `mode_faire_valoir_id`, `localisation_id`, `milieu_id`, `surface`, `irrigation`, `compaction`, `contre_saison`, `zone_erodible`, `longitude`, `latitude`, `observation`, `risque_innondation`, `ancien_code_parcelle`, `anciennete_id`, `zc_id`, `emplacement_pi_id`) VALUES
(1, 1, 1, 1, 1, 1, 1, '21.00', 1, 0, 1, 1, NULL, NULL, NULL, 1, NULL, 4, NULL, 1),
(2, 6, 1, 1, 4, 1, 1, '12.00', 1, 1, 1, 1, '47.53613', '-18.91368', 'Rien d\'important à signaler', 1, 'Ancien_code_test', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `precedent_cultural`
--

DROP TABLE IF EXISTS `precedent_cultural`;
CREATE TABLE IF NOT EXISTS `precedent_cultural` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installe_sur_pdt` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `precedent_cultural`
--

INSERT INTO `precedent_cultural` (`id`, `nom`, `description`, `installe_sur_pdt`) VALUES
(1, 'Ananas ou banane (+ PC)', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `preparation_parcelle`
--

DROP TABLE IF EXISTS `preparation_parcelle`;
CREATE TABLE IF NOT EXISTS `preparation_parcelle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `preparation_parcelle`
--

INSERT INTO `preparation_parcelle` (`id`, `nom`, `description`) VALUES
(1, 'Tetik\'antsy', NULL),
(2, 'Pietinage zebu', NULL),
(3, 'Hersage', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`id`, `nom`, `description`) VALUES
(1, 'Vatovavy fitovinany', NULL),
(2, 'Boeny', NULL),
(3, 'Itasy', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sondage_qualitatif`
--

DROP TABLE IF EXISTS `sondage_qualitatif`;
CREATE TABLE IF NOT EXISTS `sondage_qualitatif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sondage_qualitatif`
--

INSERT INTO `sondage_qualitatif` (`id`, `nom`, `description`) VALUES
(1, '0 null', NULL),
(2, '1 mauvais', NULL),
(3, '2 moyen', NULL),
(4, '3 bon', NULL),
(5, '4 tres bon', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sous_region`
--

DROP TABLE IF EXISTS `sous_region`;
CREATE TABLE IF NOT EXISTS `sous_region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DF7D038198260155` (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sous_region`
--

INSERT INTO `sous_region` (`id`, `region_id`, `nom`, `description`) VALUES
(1, NULL, 'Manakara', NULL),
(2, 1, 'Vohipeno', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `systeme_cultural`
--

DROP TABLE IF EXISTS `systeme_cultural`;
CREATE TABLE IF NOT EXISTS `systeme_cultural` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `milieu_id` int(11) DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `systeme_cultural_export` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97CACABA735F057F` (`milieu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `systeme_cultural`
--

INSERT INTO `systeme_cultural` (`id`, `milieu_id`, `nom`, `systeme_cultural_export`, `description`) VALUES
(1, 4, 'Manioc + PC', 'Manioc + PC', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `terroir`
--

DROP TABLE IF EXISTS `terroir`;
CREATE TABLE IF NOT EXISTS `terroir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `terroir`
--

INSERT INTO `terroir` (`id`, `nom`, `description`) VALUES
(1, 'Ambodivoangy', NULL),
(2, 'Ambatofotsiloha', NULL),
(3, 'Amborobe', NULL),
(4, 'Ankajoloka', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `nom`, `description`) VALUES
(1, 'Demo', NULL),
(2, 'Diffusion', NULL),
(3, 'Essai', NULL),
(4, 'Pre diffusion', NULL),
(5, 'Reference', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_pepiniere`
--

DROP TABLE IF EXISTS `type_pepiniere`;
CREATE TABLE IF NOT EXISTS `type_pepiniere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_pepiniere`
--

INSERT INTO `type_pepiniere` (`id`, `nom`, `description`) VALUES
(1, 'Amelioree', NULL),
(2, 'Traditionnel', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_sarclage`
--

DROP TABLE IF EXISTS `type_sarclage`;
CREATE TABLE IF NOT EXISTS `type_sarclage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_sarclage`
--

INSERT INTO `type_sarclage` (`id`, `nom`, `description`) VALUES
(1, 'Mannuel', NULL),
(2, 'Sarcleuse', NULL),
(3, 'Herbicide', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_sol`
--

DROP TABLE IF EXISTS `type_sol`;
CREATE TABLE IF NOT EXISTS `type_sol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_sol`
--

INSERT INTO `type_sol` (`id`, `nom`, `description`) VALUES
(1, 'Bon', NULL),
(2, 'Moyen', NULL),
(3, 'Pauvre', NULL),
(4, 'Tourbeux', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `typologie`
--

DROP TABLE IF EXISTS `typologie`;
CREATE TABLE IF NOT EXISTS `typologie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typologie`
--

INSERT INTO `typologie` (`id`, `nom`, `description`) VALUES
(1, 'Typologie_test_1', 'description');

-- --------------------------------------------------------

--
-- Structure de la table `variete`
--

DROP TABLE IF EXISTS `variete`;
CREATE TABLE IF NOT EXISTS `variete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `culture_id` int(11) DEFAULT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2CD7CD58B108249D` (`culture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `variete`
--

INSERT INTO `variete` (`id`, `culture_id`, `nom`, `description`) VALUES
(1, NULL, 'Arabica', NULL),
(2, NULL, 'Biclonage', NULL),
(3, NULL, 'Robusta', NULL),
(4, 1, 'Local', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `village`
--

DROP TABLE IF EXISTS `village`;
CREATE TABLE IF NOT EXISTS `village` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `village`
--

INSERT INTO `village` (`id`, `nom`, `description`) VALUES
(1, 'Agnala makarana', NULL),
(2, 'Agnalalava', NULL),
(3, 'Agnalatsily', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `zc`
--

DROP TABLE IF EXISTS `zc`;
CREATE TABLE IF NOT EXISTS `zc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `zc`
--

INSERT INTO `zc` (`id`, `nom`, `description`) VALUES
(1, 'Ancien zonage', NULL),
(2, 'BFD', NULL),
(3, 'Hors zonage', NULL),
(4, 'PI', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `zone_technicien`
--

DROP TABLE IF EXISTS `zone_technicien`;
CREATE TABLE IF NOT EXISTS `zone_technicien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `zone_technicien`
--

INSERT INTO `zone_technicien` (`id`, `nom`, `description`) VALUES
(1, 'Zone_techniciens_test_1', 's');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agriculteur`
--
ALTER TABLE `agriculteur`
  ADD CONSTRAINT `FK_2366443B131A4F72` FOREIGN KEY (`commune_id`) REFERENCES `commune` (`id`),
  ADD CONSTRAINT `FK_2366443B2F7FAB3F` FOREIGN KEY (`op_id`) REFERENCES `op` (`id`),
  ADD CONSTRAINT `FK_2366443B3039A7E3` FOREIGN KEY (`anciennete_id`) REFERENCES `anciennete_agriculteur` (`id`),
  ADD CONSTRAINT `FK_2366443B42F4634A` FOREIGN KEY (`typologie_id`) REFERENCES `typologie` (`id`),
  ADD CONSTRAINT `FK_2366443B4E2F28D` FOREIGN KEY (`elevage_id`) REFERENCES `elevage` (`id`),
  ADD CONSTRAINT `FK_2366443B5E0D5582` FOREIGN KEY (`village_id`) REFERENCES `village` (`id`),
  ADD CONSTRAINT `FK_2366443B7AC2280A` FOREIGN KEY (`bvpi_id`) REFERENCES `bvpi` (`id`),
  ADD CONSTRAINT `FK_2366443B832FEA1A` FOREIGN KEY (`sous_region_id`) REFERENCES `sous_region` (`id`),
  ADD CONSTRAINT `FK_2366443B8D48E193` FOREIGN KEY (`ce_id`) REFERENCES `ce` (`id`),
  ADD CONSTRAINT `FK_2366443B98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`),
  ADD CONSTRAINT `FK_2366443BAAE80216` FOREIGN KEY (`terroir_id`) REFERENCES `terroir` (`id`),
  ADD CONSTRAINT `FK_2366443BB108249D` FOREIGN KEY (`culture_id`) REFERENCES `culture` (`id`),
  ADD CONSTRAINT `FK_2366443BC4531AA` FOREIGN KEY (`zone_technicien_id`) REFERENCES `zone_technicien` (`id`);

--
-- Contraintes pour la table `culture_fille`
--
ALTER TABLE `culture_fille`
  ADD CONSTRAINT `FK_30DE57A0177B16E8` FOREIGN KEY (`plante_id`) REFERENCES `culture` (`id`),
  ADD CONSTRAINT `FK_30DE57A01AD0BD9E` FOREIGN KEY (`culture_mere_id`) REFERENCES `culture_mere` (`id`),
  ADD CONSTRAINT `FK_30DE57A05359AD1B` FOREIGN KEY (`age_plant_id`) REFERENCES `age_plant` (`id`),
  ADD CONSTRAINT `FK_30DE57A0620D5460` FOREIGN KEY (`variete_id`) REFERENCES `variete` (`id`);

--
-- Contraintes pour la table `culture_mere`
--
ALTER TABLE `culture_mere`
  ADD CONSTRAINT `FK_1744C0B24433ED66` FOREIGN KEY (`parcelle_id`) REFERENCES `parcelle` (`id`),
  ADD CONSTRAINT `FK_1744C0B252A0E116` FOREIGN KEY (`mode_installation_id`) REFERENCES `mode_installation` (`id`),
  ADD CONSTRAINT `FK_1744C0B2562A46C1` FOREIGN KEY (`degat_cyclonique_id`) REFERENCES `degat_cyclonique` (`id`),
  ADD CONSTRAINT `FK_1744C0B264CE9167` FOREIGN KEY (`preparation_parcelle_id`) REFERENCES `preparation_parcelle` (`id`),
  ADD CONSTRAINT `FK_1744C0B26A4AF869` FOREIGN KEY (`type_pepiniere_id`) REFERENCES `type_pepiniere` (`id`),
  ADD CONSTRAINT `FK_1744C0B27A83B1C4` FOREIGN KEY (`cycle_agricole_id`) REFERENCES `cycle_agricole` (`id`),
  ADD CONSTRAINT `FK_1744C0B295CEBCE0` FOREIGN KEY (`sondage_qualitatif_id`) REFERENCES `sondage_qualitatif` (`id`),
  ADD CONSTRAINT `FK_1744C0B2A3EB127F` FOREIGN KEY (`precedent_cultural_id`) REFERENCES `precedent_cultural` (`id`),
  ADD CONSTRAINT `FK_1744C0B2AE936322` FOREIGN KEY (`controlle_biomas_id`) REFERENCES `controlle_biomas` (`id`),
  ADD CONSTRAINT `FK_1744C0B2BD4A59D9` FOREIGN KEY (`mode_repiquage_id`) REFERENCES `mode_repiquage` (`id`),
  ADD CONSTRAINT `FK_1744C0B2C81E3BEA` FOREIGN KEY (`type_sarclage_id`) REFERENCES `type_sarclage` (`id`),
  ADD CONSTRAINT `FK_1744C0B2C9F47FA4` FOREIGN KEY (`etat_pc_id`) REFERENCES `etat_pc` (`id`),
  ADD CONSTRAINT `FK_1744C0B2CB7F3C6D` FOREIGN KEY (`etat_mulch_id`) REFERENCES `etat_mulch` (`id`),
  ADD CONSTRAINT `FK_1744C0B2E42CAA0B` FOREIGN KEY (`systeme_cultural_id`) REFERENCES `systeme_cultural` (`id`),
  ADD CONSTRAINT `FK_1744C0B2EF03C545` FOREIGN KEY (`itineraire_cultural_id`) REFERENCES `itineraire_cultural` (`id`);

--
-- Contraintes pour la table `itineraire_cultural`
--
ALTER TABLE `itineraire_cultural`
  ADD CONSTRAINT `FK_26FC1CA3346F772E` FOREIGN KEY (`systeme_id`) REFERENCES `systeme_cultural` (`id`);

--
-- Contraintes pour la table `nbr_culture_agriculteur`
--
ALTER TABLE `nbr_culture_agriculteur`
  ADD CONSTRAINT `FK_B23F1B4D7EBB810E` FOREIGN KEY (`agriculteur_id`) REFERENCES `agriculteur` (`id`),
  ADD CONSTRAINT `FK_B23F1B4DB108249D` FOREIGN KEY (`culture_id`) REFERENCES `culture` (`id`);

--
-- Contraintes pour la table `nbr_elevage_agriculteur`
--
ALTER TABLE `nbr_elevage_agriculteur`
  ADD CONSTRAINT `FK_335A5D384E2F28D` FOREIGN KEY (`elevage_id`) REFERENCES `elevage` (`id`),
  ADD CONSTRAINT `FK_335A5D387EBB810E` FOREIGN KEY (`agriculteur_id`) REFERENCES `agriculteur` (`id`);

--
-- Contraintes pour la table `nbr_equipement_agricole_agriculteur`
--
ALTER TABLE `nbr_equipement_agricole_agriculteur`
  ADD CONSTRAINT `FK_32C0AD1C2C2FC99` FOREIGN KEY (`equipement_agricole_id`) REFERENCES `equipement_agricole` (`id`),
  ADD CONSTRAINT `FK_32C0AD1C7EBB810E` FOREIGN KEY (`agriculteur_id`) REFERENCES `agriculteur` (`id`);

--
-- Contraintes pour la table `nbr_fumure_culture_m`
--
ALTER TABLE `nbr_fumure_culture_m`
  ADD CONSTRAINT `FK_E9E1DD168AA46A9F` FOREIGN KEY (`fumure_id`) REFERENCES `fumure_organique` (`id`),
  ADD CONSTRAINT `FK_E9E1DD16B108249D` FOREIGN KEY (`culture_id`) REFERENCES `culture_mere` (`id`);

--
-- Contraintes pour la table `nbr_insecticide_culture_m`
--
ALTER TABLE `nbr_insecticide_culture_m`
  ADD CONSTRAINT `FK_E2478F941A6E270` FOREIGN KEY (`insecticide_id`) REFERENCES `insecticide` (`id`),
  ADD CONSTRAINT `FK_E2478F9B108249D` FOREIGN KEY (`culture_id`) REFERENCES `culture_mere` (`id`);

--
-- Contraintes pour la table `parcelle`
--
ALTER TABLE `parcelle`
  ADD CONSTRAINT `FK_C56E2CF62CCD5D04` FOREIGN KEY (`mode_faire_valoir_id`) REFERENCES `mode_faire_valoir` (`id`),
  ADD CONSTRAINT `FK_C56E2CF63039A7E3` FOREIGN KEY (`anciennete_id`) REFERENCES `anciennete` (`id`),
  ADD CONSTRAINT `FK_C56E2CF6477E35CC` FOREIGN KEY (`emplacement_pi_id`) REFERENCES `emplacement_pi` (`id`),
  ADD CONSTRAINT `FK_C56E2CF6735F057F` FOREIGN KEY (`milieu_id`) REFERENCES `milieu` (`id`),
  ADD CONSTRAINT `FK_C56E2CF67EBB810E` FOREIGN KEY (`agriculteur_id`) REFERENCES `agriculteur` (`id`),
  ADD CONSTRAINT `FK_C56E2CF6C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `FK_C56E2CF6C5D34BBC` FOREIGN KEY (`zc_id`) REFERENCES `zc` (`id`),
  ADD CONSTRAINT `FK_C56E2CF6C68BE09C` FOREIGN KEY (`localisation_id`) REFERENCES `localisation` (`id`),
  ADD CONSTRAINT `FK_C56E2CF6EC3101F1` FOREIGN KEY (`type_sol_id`) REFERENCES `type_sol` (`id`);

--
-- Contraintes pour la table `sous_region`
--
ALTER TABLE `sous_region`
  ADD CONSTRAINT `FK_DF7D038198260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

--
-- Contraintes pour la table `systeme_cultural`
--
ALTER TABLE `systeme_cultural`
  ADD CONSTRAINT `FK_97CACABA735F057F` FOREIGN KEY (`milieu_id`) REFERENCES `milieu` (`id`);

--
-- Contraintes pour la table `variete`
--
ALTER TABLE `variete`
  ADD CONSTRAINT `FK_2CD7CD58B108249D` FOREIGN KEY (`culture_id`) REFERENCES `culture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
