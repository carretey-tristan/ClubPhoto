-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 nov. 2025 à 09:53
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clubphoto`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `idarti` int NOT NULL AUTO_INCREMENT,
  `titrearti` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `datearti` date NOT NULL,
  `textearti` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idphotographe` int NOT NULL,
  `idtype` int NOT NULL,
  PRIMARY KEY (`idarti`),
  KEY `idtype` (`idtype`),
  KEY `idphotographe` (`idphotographe`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`idarti`, `titrearti`, `datearti`, `textearti`, `idphotographe`, `idtype`) VALUES
(1, 'Découvrez les mystères des clowns d\'horreur', '2025-01-17', 'Plongez dans le monde fascinant et terrifiant des clowns d\'horreur, avec leurs maquillages sombres, leurs sourires inquiétants et leurs histoires captivantes.', 1, 1),
(2, 'Les clowns rigolos : maîtres du rire', '2025-01-17', 'Explorez les facéties des clowns rigolos, ces maîtres de l\'humour qui illuminent les scènes avec leurs gags hilarants et leurs costumes éclatants.', 2, 2),
(3, 'Les clowns tristes : poésie et émotions', '2025-01-17', 'Découvrez la profondeur émotive des clowns tristes, ces personnages qui mêlent mélancolie et grâce pour toucher le cœur du public.', 3, 3),
(4, 'Clowns acrobates : artistes du mouvement', '2025-01-17', 'Admirez la virtuosité des clowns acrobates, qui allient humour et performances physiques spectaculaires pour émerveiller leur public.', 4, 4),
(5, 'Un voyage dans le monde des clowns psychédéliques', '2025-01-17', 'Entrez dans un univers vibrant et excentrique avec les clowns psychédéliques, où couleurs éclatantes et créativité débridée se rencontrent.', 5, 5),
(6, 'Clowns grotesques : l\'art de l\'exagération', '2025-01-17', 'Apprenez à apprécier les clowns grotesques, ces personnages étranges et fascinants qui jouent sur les traits caricaturaux pour surprendre.', 6, 6),
(7, 'Clowns musicaux : l\'harmonie du rire', '2025-01-17', 'Découvrez les talents des clowns musicaux, qui marient humour et musique pour offrir des spectacles uniques et mémorables.', 7, 7),
(8, 'Clowns mimes : maîtres du silence', '2025-01-17', 'Appréciez l\'art subtil des clowns mimes, qui communiquent avec élégance et créativité sans prononcer un mot.', 8, 8),
(9, 'Le plus rigolo des clown les plus rigolo', '2025-01-24', 'Voici le clown le plus rigolo des clown les plus rigolo avec sa belle moustache il vous feras rire a coups sur!!', 7, 2),
(10, 'Le Clown d’Horreur : Symbole de Nos Peurs Cachées', '2025-01-01', 'Les clowns d’horreur mêlent rire et effroi, transformant un symbole d’innocence en une source de cauchemars. Leur sourire figé et leurs gestes exagérés suscitent un malaise, alimentant la coulrophobie, la peur des clowns. Popularisé par des œuvres comme \\\"Ça\\\" de Stephen King, le clown horrifique est devenu une icône culturelle, incarnant nos peurs les plus profondes.', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idphoto` int NOT NULL AUTO_INCREMENT,
  `titrephoto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `textephoto` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imagephoto` varchar(50) NOT NULL,
  `idarti` int NOT NULL,
  PRIMARY KEY (`idphoto`),
  KEY `idarti` (`idarti`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idphoto`, `titrephoto`, `textephoto`, `imagephoto`, `idarti`) VALUES
(1, 'Clown d\'Horreur', 'Un clown effrayant dans une ambiance sinistre.', 'clownhorreur.jpg', 1),
(2, 'Clown Rigolo', 'Un clown comique avec un nez rouge et des habits c', 'clownrigolo.jpg', 2),
(3, 'Clown Triste', 'Un clown mélancolique évoquant des émotions profon', 'clowntriste.jpg', 3),
(4, 'Clown Acrobate', 'Un clown en pleine performance acrobatique.', 'clownacrobate.jpg', 4),
(5, 'Clown Psychédélique', 'Un clown coloré dans un univers psychédélique.', 'clownpsychedelique.jpg', 5),
(6, 'Clown Grotesque', 'Un clown avec des traits exagérés et caricaturaux.', 'clowngrotesque.jpg', 6),
(7, 'Clown Musical', 'Un clown jouant d\'un instrument de musique.', 'clownmusical.jpg', 7),
(8, 'Clown Mime', 'Un clown silencieux utilisant des gestes expressif', 'clownmime.jpg', 8),
(9, 'Clown Le plus rigolo', 'Le plus rigolo des clowns rigolo', 'clownrigolo2.jpg', 9),
(10, 'Clown horreur', 'clown qui fais peur', 'clownhorreur2.jpg', 10);

-- --------------------------------------------------------

--
-- Structure de la table `photographe`
--

DROP TABLE IF EXISTS `photographe`;
CREATE TABLE IF NOT EXISTS `photographe` (
  `idphotographe` int NOT NULL AUTO_INCREMENT,
  `nomphotographe` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prenomphotographe` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idphotographe`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photographe`
--

INSERT INTO `photographe` (`idphotographe`, `nomphotographe`, `prenomphotographe`, `password`) VALUES
(0, 'admin', 'admin', '$2y$10$qArTse7bH1NN./cohJ6Sme0kHMhBlTRsYGD.1OTikTabN5uw6ummS'),
(1, 'Dupont', 'Jeane', '$2y$10$rpy7e7yzD.eGtxoZwZQAr.Xgba2Avv5Su.rQZQMletvNuaaL2ypAa'),
(2, 'Martin', 'Claire', '$2y$10$iJU1Qrg0AAc.A9ASn/3bnOgvswaWnriycUq5KJZm.j5CtiZx2bLW.'),
(3, 'Durand', 'Paul', '$2y$10$8zrsdfg0Ojz/ZZspWfFLpO.fsWsS4eOKcgJLNSbkCzBxcfdov2eCO'),
(4, 'Bernard', 'Sophie', '$2y$10$LmVZ7EDEUdI.EE67NiyyF.7JVNo4CB6dAVt1p8HX7T0ZQfKcDpt22'),
(5, 'Lemoine', 'Luc', '$2y$10$rDF.V4g3sDk7Mw2r06wDduezbj.w60NhSwHCrw1zPmDlIbkpGIZfq'),
(6, 'Moreau', 'Julie', '$2y$10$PaVTTwg/Fxc.F1hQM/JoxO4CcckChHb04kz216OksEytTkqaY/ixm'),
(7, 'Rousseau', 'Émile', '$2y$10$WCr6rMsTIT536lXoFbYWSuwT.mDm/zwpWdN1HIEUP0i.ao1KfcPmu'),
(8, 'Petit', 'Marie', '$2y$10$iIp3Mn/xR64qQqwlbybcpeHDat123Mbh9M9xIbmY.RsYrYVa56JHa'),
(9, 'Girard', 'Hugo', '$2y$10$DjEuuzJWTN/Ilec2Du/KgONwL9MXajjkA7mBvFj5wG//rJsoxGEHC'),
(10, 'Blanc', 'Emma', '$2y$10$gNJuwk0eHNVaj04vmkAEIelEaOiLxbL..5l.v3lonUHmYHOY8woO6');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `idtype` int NOT NULL,
  `nomtype` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idtype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`idtype`, `nomtype`) VALUES
(1, 'Clown d\'Horreur'),
(2, 'Clown Rigolo'),
(3, 'Clown Triste'),
(4, 'Clown Acrobate'),
(5, 'Clown Psychédélique'),
(6, 'Clown Grotesque'),
(7, 'Clown Musical'),
(8, 'Clown Mime');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idtype`) REFERENCES `type` (`idtype`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`idphotographe`) REFERENCES `photographe` (`idphotographe`) ON DELETE CASCADE;

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`idarti`) REFERENCES `article` (`idarti`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
