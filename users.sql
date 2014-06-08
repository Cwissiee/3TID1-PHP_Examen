-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  mysql51-99.perso
-- Généré le :  Sam 07 Juin 2014 à 18:48
-- Version du serveur :  5.1.73-1.1+squeeze+build0+1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `dimarcocbdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL,
  `matiere` varchar(255) NOT NULL,
  `adresse` varchar(500) NOT NULL,
  `tarif` varchar(3) NOT NULL,
  `horaire` varchar(83) NOT NULL,
  `presentation` text NOT NULL,
  `age` int(3) NOT NULL,
  `permis` varchar(3) NOT NULL,
  `fumeur` varchar(3) NOT NULL,
  `deplacement` varchar(3) NOT NULL,
  `dp_km` int(5) NOT NULL,
  `materiel` varchar(3) NOT NULL,
  `exp` int(3) NOT NULL,
  `cours` varchar(17) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `etude` varchar(255) NOT NULL,
  `langue` varchar(255) NOT NULL,
  `activite` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `activate` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `email`, `mdp`, `statut`, `niveau`, `matiere`, `adresse`, `tarif`, `horaire`, `presentation`, `age`, `permis`, `fumeur`, `deplacement`, `dp_km`, `materiel`, `exp`, `cours`, `lieu`, `etude`, `langue`, `activite`, `photo`, `activate`) VALUES
(10, 'Elisa', 'Hernandez', 'apppaaache@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Professeur', 'Supérieur de type court', 'Mathématiques', '6000 Charleroi, Belgium', '20€', '0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,1,1,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'Bonjour, je suis actuellement retrait&eacute;e de l''enseignement et je d&eacute;sire mettre &agrave; proﬁt mon temps aﬁn d&rsquo;apporter mon aide aux enfants en difficult&eacute; scolaire. Avec une exp&eacute;rience dans le sup&eacute;rieur, j&rsquo;ai &eacute;galement pu assister &agrave; beaucoup de cours de rattrapage organis&eacute;s par l&rsquo;&eacute;cole. Je dirais donc que c&rsquo;est du &ldquo;d&eacute;j&agrave; vu&rdquo; pour moi cette exp&eacute;rience. Je te recevrais &agrave; mon domicile, ainsi tu pourras te sentir &agrave; l&rsquo;aise et au calme dans une ambiance studieuse de travail. Je suis impatiente de pouvoir t&rsquo;aider!', 56, 'Oui', 'Non', 'Oui', 10, 'Oui', 31, 'Seul ou en groupe', '&Agrave; mon Domicile', '&Eacute;tudes sup&eacute;rieures , sp&eacute;ciales math-sciences', 'Fran&ccedil;ais, Espagnol', 'Retrait&eacute;e', '83569b747d953bcdd8dcb0a0d378dda0.png', 1),
(11, 'Christina', 'Di Marco', 'christina.dimarco.hernandez@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Élève', 'Supérieur de type court', 'Mathématiques', '6220 Fleurus, Belgium', '20€', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'Bonjour, je recherche un professeur particulier pour m&rsquo;aider en math, plus particuli&egrave;rement pour la g&eacute;om&eacute;trie et les probl&egrave;mes, car pour l&rsquo;instant je suis en &eacute;chec. Merci, Christina', 18, 'Non', 'Non', 'Oui', 25, 'Non', 0, 'Seul', '', '', '', '', '60457e2a6ed6562c337ac7643a44c7e1.png', 1),
(13, 'Maria', 'Del Rio', 'chrisdim90@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Parent', 'Supérieur de type long', 'Français', '7110 La Louvière', '30€', '0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,1,1,0,0,1,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0', 'Bonjour, \r\nje suis &agrave; la recherche d&rsquo;un professeur particulier pour des cours de soutien en fran&ccedil;ais pour mon enfant qui est en difficult&eacute; scolaire. Une fois un premier contact &eacute;tabli, nous aborderons le reste dans les d&eacute;tails. Cordialement, Maria', 45, 'Non', 'Non', 'Non', 0, 'Non', 0, 'Seul', '', '', '', '', '667b5a5a33e310dfbcd38ebc7b22a1dc.png', 1),
(20, 'olivier', 'di stefano', 'lekooka@gmail.com', '8c2a8b3ad486151a5c26508a9169660c', 'Professeur', 'Maternelle', 'Biologie', 'Tamines, Belgique', '20€', '0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'Ceci sera la premi&egrave;re chose qui sera vue sur votre proﬁl, veillez donc &agrave; ce que &ccedil;a soit irr&eacute;prochable et ne n&eacute;gligez pas votre orthographe.\r\nPr&eacute;sentez-vous bri&egrave;vement en faisant part de vos motivations et indiquez votre exp&eacute;rience.\r\nVeuillez compl&eacute;ter votre pr&eacute;sentation de 20 caract&egrave;res minimum', 46, 'Non', 'Non', 'Non', 0, 'Non', 100, 'Seul ou en groupe', 'namur', '', '', '', '3d035846b7c313c2c4c4ee23cb82d3f9.png', 1),
(21, 'Monique', 'Fere', 'Crisouillee@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Professeur', 'Supérieur de type court', 'Mathématiques', '5000 Namur, Belgium', '30€', '0,0,0,0,0,0,0,1,0,0,0,0,1,1,0,0,1,0,0,1,1,0,0,1,0,0,1,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0', 'Bonjour, je souhaite mettre &agrave; proﬁt mes comp&eacute;tences en tant que professeur aﬁn d&rsquo;apporter mon aide aux enfants en difficult&eacute; scolaire. \r\nJe souhaite vraiment te permettre d''&eacute;voluer, alors n''h&eacute;site pas!', 33, 'Oui', 'Oui', 'Non', 0, 'Non', 7, 'Seul', '&Agrave; mon Domicile', ' &Eacute;tudes sup&eacute;rieures', 'Fran&ccedil;ais, Anglais', 'Enseignante', '426fe79a2c36ba05a2822e217c4f97d6.png', 1),
(22, 'Sebastien', 'Neemans', 'tfedwm14@gmail.com', '631f3b1d21d3adcef7ef78fce1737fb8', 'Professeur', 'Supérieur de type court', 'Mathématiques', '5000 Namur, Belgium', '40€', '0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,0,1,0,0,0,1,0,1,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0', 'Bonjour, je me pr&eacute;sente, Sebastien Neemans, je suis &agrave; votre disposition pour vous aider dans quelconques difficult&eacute;s en ce qui concerne les math&eacute;matiques et vous permettre d''y voir plus clair.\nAvec une exp&eacute;rience dans le sup&eacute;rieur, j''assiste &eacute;galement les &eacute;l&egrave;ves lors des cours de rattrapage organis&eacute;s par l''&eacute;cole. Je te recevrai &agrave; mon domicile, ainsi tu pourras te sentir &agrave; l''aise et au calme dans une ambiance studieuse de travail. Ensemble nous y arriverons!', 35, 'Oui', 'Non', 'Oui', 10, 'Oui', 12, 'Seul ou en groupe', '&Agrave; mon Domicile', '&Eacute;tudes sup&eacute;rieures , sp&eacute;ciales math', 'Fran&ccedil;ais, Anglais', 'Enseignant', '31a2c9547ae0e9fc9bdb82e40d06e463.png', 1),
(23, '', '', '', '', 'Professeur', '', '', '', '', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 'ddededeci sera la premi&egrave;re chose qui sera vue sur votre proﬁl, veillez donc &agrave; ce que &ccedil;a soit irr&eacute;prochable et ne n&eacute;gligez pas votre orthographe.\r\nPr&eacute;sentez-vous bri&egrave;vement en faisant part de vos motivations et indiquez votre exp&eacute;rience.', 10, 'Non', 'Non', 'Non', 0, 'Non', 1, 'Seul ou en groupe', '1 an', '', '', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
