-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2022 at 08:37 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizdb2022`
--
CREATE DATABASE IF NOT EXISTS `quizdb2022` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `quizdb2022`;

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

DROP TABLE IF EXISTS `adminusers`;
CREATE TABLE IF NOT EXISTS `adminusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passwordHash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `sessionid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `userid`, `firstname`, `lastname`, `passwordHash`, `active`, `sessionid`) VALUES
(1, 'admin', 'First', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 1, '03993240-210b-40c9-a917-39962876adf9'),
(2, 'bado6002', 'Donghee', 'Baik', '2ac9cb7dc02b3c0083eb70898e549b63', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `scenes`
--

DROP TABLE IF EXISTS `scenes`;
CREATE TABLE IF NOT EXISTS `scenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sceneId` int(11) NOT NULL,
  `storyId` int(11) NOT NULL DEFAULT 0,
  `spriteId` int(11) NOT NULL,
  `objType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `npcName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `animKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moveTo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zIndex` int(11) NOT NULL,
  `vectorX` int(11) NOT NULL,
  `vectorY` int(11) NOT NULL,
  `startX` int(11) NOT NULL,
  `startY` int(11) NOT NULL,
  `endX` int(11) NOT NULL,
  `endY` int(11) NOT NULL,
  `timeFrame` int(11) NOT NULL,
  `txtLabel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txtStr` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `initRead` tinyint(1) NOT NULL DEFAULT 0,
  `removeSprite` tinyint(1) NOT NULL DEFAULT 0,
  `lastAnimKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `spriteScale` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `scenes`
--

INSERT INTO `scenes` (`id`, `sceneId`, `storyId`, `spriteId`, `objType`, `npcName`, `animKey`, `moveTo`, `zIndex`, `vectorX`, `vectorY`, `startX`, `startY`, `endX`, `endY`, `timeFrame`, `txtLabel`, `txtStr`, `initRead`, `removeSprite`, `lastAnimKey`, `spriteScale`) VALUES
(1, 0, 0, 0, 'DECORATION', 'compDesk1', 'compDeskLock', 'NO', 1, 0, 0, 280, 200, 280, 200, 1, 'Computer', 'Computer', 0, 0, 'compDeskLock', 1),
(2, 1, 0, 13, 'DECORATION', 'labChemistTabR', 'labChemistTabRKey', 'NO', 1, 0, 0, 620, 250, 620, 250, 1, 'labChemistTable', '', 0, 0, 'labChemistTabRKey', 2.1);

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL,
  `storyId` int(11) NOT NULL,
  `topicid` int(11) NOT NULL,
  `rmCoordX` int(11) NOT NULL,
  `rmCoordY` int(11) NOT NULL,
  `nextScene` int(11) NOT NULL,
  `lastScene` int(11) NOT NULL,
  `questCoordX` int(11) NOT NULL,
  `questCoordY` int(11) NOT NULL,
  `storyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `storyId`, `topicid`, `rmCoordX`, `rmCoordY`, `nextScene`, `lastScene`, `questCoordX`, `questCoordY`, `storyName`) VALUES
(0, 0, 9, 3, 1, 0, 6, 450, 350, 'LockYourComputer'),
(1, 1, 3, 3, 3, 0, 4, 450, 300, 'DontTalkTooMuch'),
(2, 2, 2, 1, 3, 0, 6, 450, 350, 'Cafeterias'),
(3, 3, 9, 2, 3, 0, 5, 450, 350, 'ComputerLock2');

-- --------------------------------------------------------

--
-- Table structure for table `tabanswers`
--

DROP TABLE IF EXISTS `tabanswers`;
CREATE TABLE IF NOT EXISTS `tabanswers` (
  `ansId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ansTxt` text COLLATE utf8_unicode_ci NOT NULL,
  `ansQId` bigint(20) NOT NULL,
  `ansIsValid` tinyint(1) NOT NULL,
  `ansTxtFRA` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ansId`),
  KEY `ansQId` (`ansQId`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tabanswers`
--

INSERT INTO `tabanswers` (`ansId`, `ansTxt`, `ansQId`, `ansIsValid`, `ansTxtFRA`) VALUES
(1, 'Call your team and discuss the completion of a AH 223 report.', 1, 0, 'Vous appelez votre équipe et préparez un rapport AH 223.'),
(2, 'You call Help Desk at 48484 to inform them.', 1, 1, 'Vous appelez le soutien  informatique au 48484 pour les informer.'),
(3, 'You call 55555 and call an IS code as the whole network could be infected.', 1, 0, 'Vous appelez 55555 pour déclencher un code IS, puisque l\'ensemble du réseau pourrait être  infecté.'),
(4, 'None of these statements is correct.', 1, 0, 'Aucun énoncé n\'est correct.'),
(5, 'Call HELP DESK at 48484.', 2, 1, 'Appeler le soutien informatique au 48484.'),
(6, 'Ignore the message.', 2, 0, ' Ignorer le message. '),
(7, 'Request advice on social networks.', 2, 0, 'Demander des conseils sur les réseaux sociaux. '),
(8, 'None of these statements is correct.', 2, 0, 'Aucun énoncé n\'est correct.'),
(9, 'Confidentiality of patient information.', 3, 0, 'Confidentialité des informations des patients.'),
(10, 'Management of the security of informational assets.', 3, 0, 'Gestion sécuritaire des actifs informationnels.'),
(11, 'Acceptable use of information assets .', 3, 0, 'Utilisation acceptable des ressources informationnelles.'),
(12, 'All of the statements are correct.', 3, 1, 'Tous les énoncés sont corrects.'),
(13, 'You would call your manager and discuss the completion of a AH 223 report.', 4, 0, 'Vous appelez votre superviseur pour déterminer s\'il y a lieu de remplir un formulaire d\'incident AH 223.'),
(14, 'You would call Help Desk at 48484 .', 4, 1, 'Vous appelez le Centre d\'appel au 48484 .'),
(15, 'You would call 55555 and trigger an \'IS\'  code as the whole network could be infected.', 4, 0, 'Vous appelez 55555 et déclenchez un code \'IS\' car tout le réseau pourrait être infecté.'),
(16, 'None of these statements is correct.', 4, 0, 'Aucun énoncé n\'est correct.'),
(17, 'Direct him to the section of the website where all of the P&P\'s are posted.', 5, 0, 'Vous le dirigez vers la section de l\'intranet où se trouvent les Politiques et procédures.'),
(18, 'You remind him to ask the patient for written consent prior to taking pictures and file it in his medical file.', 5, 1, 'Vous lui rappelez de demander le consentement écrit au patient avant de prendre des photos et de le classer dans son dossier médical.'),
(19, 'You let him take the picture and use it regardless of his consent because he\'s the surgeon.', 5, 0, 'Le médecin étant le chirurgien qui a opéré le patient, vous le laissez prendre la photo et l\'utiliser, sans recueillir le consentement de l\'intéressé.'),
(20, 'None of these statements is correct.', 5, 0, 'Aucun énoncé n\'est correct.'),
(21, 'Acceptable use of information assets.', 6, 0, 'Utilisation acceptable des ressources informationnelles.'),
(22, 'Management of the security of informational assets.', 6, 0, 'Sécurité des actifs informationnels. '),
(23, 'Disclosure of patient informationt.', 6, 0, 'Divulgation des informations des patients. '),
(24, 'All of these statements are correct.', 6, 1, 'Tous les énoncés sont corrects. '),
(25, 'Move the cursor back and hope the action is undone?', 7, 0, 'Sur votre navigateur web, vous cliquez sur le bouton de retour à la page précédente, en espérant que cela annulera votre erreur.'),
(26, 'Erase the windows explorer files and hope nobody notices?', 7, 0, 'Vous ouvrez votre explorateur Windows et effacez les fichiers chiffrés en espérant que personne ne le remarquera.'),
(27, 'Call 48484 and inform them of your involuntary action?', 7, 1, 'Vous appelez le 48484 et l\'informez de votre action involontaire.'),
(28, 'Keep working as if nothing happened?', 7, 0, 'Vous continuez à travailler comme si de rien n\'était.'),
(29, 'The logo on the email looks familiar and the personal information required sounds legitimate, so you click on the link.', 8, 0, 'Le logo dans le courriel vous est familier et les informations personnelles requises semblent légitimes, vous cliquez donc sur le lien.'),
(30, 'As you receive lots of offers during holiday season you inadvertently click on the link.', 8, 0, 'Comme vous recevez de nombreuses offres pendant le temps des fêtes, vous cliquez dessus par habitude.'),
(31, 'You doubt the email as this company should not have your professional address, so you inform the Help Desk at 48484. ', 8, 1, 'Vous trouvez étrange que cette compagnie dispose de votre adresse courriel professionnelle et, dans le doute, vous informez le Soutien Technique au 48484.'),
(32, 'None of these statements is correct.', 8, 0, 'Aucun énoncé n\'est correct.'),
(33, 'It is not necessary because the system logs off automatically every 15 minutes.', 9, 0, 'Ce n\'est pas nécessaire, car le système se déconnecte automatiquement après 15 minutes d\'inactivité.'),
(34, 'It is necessary to prevent others to snoop into your files.', 9, 1, 'C\'est nécessaire, pour empêcher autrui de fouiner dans vos fichiers.'),
(35, 'It is not important because you are not responsible for activity in your account from the time you log in to the time you log out.', 9, 0, 'Ce n\'est pas important car vous n\'êtes pas responsable de l\'activité sur votre compte durant vos temps de connexion.'),
(36, 'All of these statements are correct.', 9, 0, 'Aucun énoncé n\'est correct.'),
(37, 'To use simple and short password. ', 10, 0, 'utiliser un mot de passe simple et court. '),
(38, 'To use a complex password with upper and lower case characters as well as numbers and some symbols.', 10, 1, 'Utiliser un mot de passe complexe avec des caractères majuscules et minuscules ainsi que des chiffres et certains symboles.'),
(39, 'To leave your workstation unlocked allowing a colleague to access later, when he has the time.', 10, 0, 'Laisser sa session de travail déverrouillée, pour permettre à un collègue d\'y accéder plus tard, quand il aura un moment.'),
(40, 'To write your password on a post-it and stick it on your monitor, in an open office .', 10, 0, 'Noter son mot de passe sur un papillon adhésif collé sur son moniteur, dans un bureau non verrouillé.'),
(41, 'To use robust passwords.', 11, 0, 'Utiliser des mots de passe forts.'),
(42, 'To lock or close your session if you step out of your office.', 11, 0, 'Verrouiller ou fermer la session si vous quittez votre poste de travail informatique.'),
(43, 'To restrict the access to patient information  only to members of the patient\'s care team.', 11, 0, 'Restreindre l\'accès aux informations-patients aux seuls les membres de son équipe de soins .'),
(44, 'All of these statements are correct.', 11, 1, 'Tous les énoncés sont corrects.'),
(45, 'Before we let them in, we should ask for their identity and who  they are going to see. Once they are duly identified, escort them to a designated office.', 12, 0, 'Avant l\'avoir fait entrer, je lui demande son identité et celle de la personne qu\'il vient voir. Une fois le visiteur identifié, Je l\'accompagne jusqu\'au bureau de cette personnne.'),
(46, 'If the host is not in his office, invite the visitor to wait outside.', 12, 0, 'Si ladite personne n\'est pas à son bureau, j\'invite le visiteur à ressortir des locaux.'),
(47, 'If the visitor refuses to wait outside, inform the physical security service in your building.', 12, 0, 'Si le visiteur refuse de ressortir des locaux, j\'avertis immédiatement le service de la sécurité physique.'),
(48, 'All of these statements are correct.', 12, 1, 'Tous les énoncés sont corrects.'),
(49, 'So that everyone knows who you are.', 13, 0, 'Pour que tout le monde sache qui vous êtes.'),
(50, 'So that everyone can ask who you are looking for.', 13, 0, 'Pour que chacun puisse demander qui vous cherchez.'),
(51, 'So that other staff may consider you are presumably entitled to circulate in the premises.', 13, 1, 'Pour que les autres membres du personnel puissent vous identifier et valider auprès de la sécurité que vous avez le droit de circuler dans des locaux du CUSM.'),
(52, 'None of these statements is correct.', 13, 0, 'Aucun énoncé n\'est correct.'),
(53, 'As it complies to a policy and procedure.', 14, 0, 'Puisqu\'il est conforme à une politique et procédure.'),
(54, 'As it identifies who you are and allows security to validate your electronic privileges to circulate in restricted secured areas.', 14, 1, 'Puisqu\'il  vous identifie et permet à la sécurité de valider vos privilèges électroniques pour circuler dans des zones sécurisées restreintes.'),
(55, 'So that visitors can ask you for information.', 14, 0, 'Pour des visiteurs qui pourraient vous demander des informations.'),
(56, 'All of these statements are correct.', 14, 0, 'Tous les énoncés sont corrects.'),
(57, 'We should never take pictures of patientsbecause this infringes their rights. ', 15, 0, 'On ne peut jamais prendre de photos d\'un patient car cela viole ses droits et libertés. '),
(58, 'We should never takepictures with a smartphone. ', 15, 0, 'On ne peut jamais prendre des photos du patient avec un téléphone cellulaire.'),
(59, 'The pictures should be taken in a way that the patient is clearly recognizable.', 15, 0, 'Les photos doivent être prises de manière à ce que le patient soit clairement reconnaissable.'),
(60, 'The pictures where a patient can be recognized should be taken only with previous patient consent.', 15, 1, 'Les photos permettant d\'identifier un patient ne peuvent être prises qu\'avec le consentement préalable de celui-ci.'),
(61, 'To converse about the diagnoses of patients you are treating.', 16, 0, 'de parler des diagnostics des patients que vous traitez.'),
(62, 'To talk about the cultural and sport activities you practice at the hospital\'s premises.', 16, 1, 'de parler des activités culturelles ou sportives que vous exercez dans les locaux de l\'hôpital.'),
(63, ' To give your personal opinion about a Public Health policy that is being deployed by the government.', 16, 0, 'de donner votre avis personnel sur la politique de santé publique menée par le gouvernement.'),
(64, ' All of these statements are correct.', 16, 0, 'Tous les énoncés sont corrects.'),
(65, 'Only when the patient visits a newborn in the nursery.', 17, 0, 'Uniquement lorsque le patient visite un nouveau-né dans la pouponnière.'),
(66, 'Only when the patient is undergoing a surgical procedure that is innovative and might be presented in a medical teaching session .', 17, 0, 'Seulement lorsque le patient subit une intervention chirurgicale innovante, qui pourrait être présentée dans une session d\'enseignement médical.'),
(67, 'Only when the patient is aware that he is part of a research project.', 17, 0, 'Seulement dans le cadre d\'un projet de recherche.'),
(68, 'When the patient can be identified in that photo.', 17, 1, 'Lorsque le patient peut être identifié sur la photo.'),
(69, 'Use it across multiple sites. ', 18, 0, 'L\'utiliser sur plusieurs sites internet ou bases de données profesionnelles.'),
(70, 'Share it with colleagues.', 18, 0, 'Le partager avec vos collègues.'),
(71, 'Ensure it is clearly written on a post it on your computer screen in an open office.', 18, 0, 'Vous assurer qu\'il est écrit clairement sur un papillon adhésif sur votre écran d\'ordinateur, à votre bureau en aire ouverte.'),
(72, 'None of these statements is correct.', 18, 1, 'Aucun énoncé n\'est correct.'),
(73, 'That has less than 8  characters.', 19, 0, 'Qui a moins de 8 caractères.'),
(74, 'Built with a word where  \'E\' is replaced by \'3\' ', 19, 0, 'Qui est constitué d\'un mot tiré du dictionnaire dans lequel les \'E\' sont remplacés par des \'3\' '),
(75, 'That all its characters are lowercase.', 19, 0, 'Qui contient uniquement des caractères minuscules.'),
(76, 'None of these statements is correct.', 19, 1, 'Aucun énoncé n\'est correct.'),
(77, 'A date easy to remember.', 20, 0, 'Une date facile à retenir.'),
(78, 'An easy and short word that you can find in the dictionary.', 20, 0, 'Un mot simple et court trouvable dans n\'importe quel dictionnaire.'),
(79, 'A long word (more than 20 letters) that you can find in the dictionary.', 20, 0, 'Un mot très long (plus de 20 lettres) du dictionnaire. '),
(80, 'None of these statements is correct.', 20, 1, 'Aucun énoncé n\'est correct.'),
(81, 'it is created by including special characters and numbers.', 21, 0, 'qu\'il inclut des caractères spéciaux et des chiffres.'),
(82, 'it is protected from others\'  sight.', 21, 0, 'qu\'il soit conservé hors  de la vue d\'autrui.'),
(83, 'it uses initial letters of words from a long phrase that you like.', 21, 0, 'qu\'il soit constitué des premières lettres des mots d\'une longue phrase que vous aimez.'),
(84, 'All of these statements are correct.', 21, 1, 'Tous les énoncés sont corrects.'),
(85, 'Use a very pricy toothbrush that you can show to everybody.', 22, 0, 'Utilisez une brosse à dents très chère pour la montrer à tout le monde.'),
(86, 'Make sure of leaving it in a visible place so your colleague can use when in need.', 22, 0, 'Assurez-vous de la laisser dans un endroit visible afin que votre collègue puisse l\'utiliser en cas de besoin.'),
(87, 'Keep the same one for a lifetime.', 22, 0, 'Gardez la même pour toute une vie.'),
(88, 'None of these statements is correct.', 22, 1, 'Aucun de ces énoncés n\'est correct.'),
(89, 'Call the security guard to inform they are contravening the privacy of the patient.', 23, 0, 'Vous appelez le gardien de sécurité pour l\'informer que ces employés portent atteinte à la vie privée du patient.'),
(90, 'Kindly request them to continue their conversation in a private place.', 23, 1, 'Vous demandez à ces employés de continuer leur conversation dans un lieu privé.'),
(91, 'Engage in conversation with them and start asking them questions about the surgery.', 23, 0, 'Vous engagez la conversation avec eux et leur posez des questions sur la chirurgie de ce patient .'),
(92, 'All of these statements are correct.', 23, 0, 'Tous les énoncés sont corrects.'),
(93, 'Could you kindly identify yourself? ', 24, 0, 'Pourriez-vous vous identifier ? '),
(94, 'Would you please let us know where your meeting is taking place? ', 24, 0, 'Pourriez-vous nous dire où votre réunion a lieu?'),
(95, 'I will certainly inform your host so he can come and look for you.', 24, 0, 'Je vais informer votre hôte et lui demander de passer vous chercher.'),
(96, 'All of these statements are correct', 24, 1, 'Tous les énoncés sont corrects.'),
(97, 'You invite him to trespass into your section and look around.', 25, 0, 'l\'invitez dans votre section pour qu\'il puisse regarder l\'environnement.'),
(98, 'You invite him to leave your section as he does not have an ID card.', 25, 0, 'l\'invitez à quitter votre section, car il n\'a pas de carte d\'identité.'),
(99, 'You call the physical security office in your building immediately .', 25, 1, 'Vous appelez la sécurité physique immédiatement. '),
(100, 'All of these statements are correct.', 25, 0, 'Tous les énoncés sont corrects.'),
(101, 'You give the intern  your login information (user ID and password)  so that she can access information .', 26, 0, 'Vous donnez vos identifiant et mot de passe à la stagiaire pour qu\'elle puisse accéder à vos fichiers. '),
(102, 'You leave your session active on your workstation so that the intern can work whenever she needs to.', 26, 0, 'Vous laissez votre session active en tout temps sur votre poste informatique pour que la stagiaire puisse y travailler quand elle en a besoin.'),
(103, 'You copy your login information on a post-it and stick it on the monitor in an open office so that the intern can work while you are away . ', 26, 0, 'Vous inscrivez vos identifiant et mot de passe sur un papillon adhésif que vous collez sur votre poste de travail en aire ouverte pour que la stagiaire puisse travailler sur vos dossiers durant votre absence.'),
(104, 'All of these statements are correct.', 26, 1, 'Aucun de ces énoncés n\'est approprié.'),
(105, 'Low because the probability of having a malicious colleague is minimal.', 27, 0, 'Faible parce que la probabilité d\'avoir des collègues malintentionnés est minime.'),
(106, 'Medium because in escence, it is possible that one of my colleagues might be tempted to look for information that concerns me and he shouldn\'t.', 27, 0, 'Moyen, essentiellement parce qu\'il est possible qu\'un de mes collègues soit tenté de rechercher indûment des informations me concernant.'),
(107, 'High because I am accountable of all the activity occurring during my session, including unacceptable use of MUHC\'s information assets  by other individuals.', 27, 0, 'Elevé, parce que je suis responsable de toutes les activités qui se produisent pendant ma session, y compris l\'utilisation inappropriée d\'actifs informationnels du CUSM par d\'autres personnes.'),
(108, 'All of these statements are correct.', 27, 1, 'Tous les énoncés sont corrects..'),
(109, 'Q54-Ans1-Test-ENG-change0EN===', 54, 0, 'Q54-Ans1-Test-FRA-change0==='),
(110, 'Q54-Ans2-Test-ENG-change1ENx', 54, 1, 'Q54-Ans1-Test-FRA-change1x'),
(111, 'Q54-Ans3-Test-ENG-change2ENx', 54, 0, 'Q54-Ans3-Test-FRA-change2x'),
(112, 'Q54-Ans4-Test-ENG-change3ENx', 54, 0, 'Q54-Ans4-Test-FRA-change3x');

-- --------------------------------------------------------

--
-- Table structure for table `tabquestions`
--

DROP TABLE IF EXISTS `tabquestions`;
CREATE TABLE IF NOT EXISTS `tabquestions` (
  `qId` bigint(20) NOT NULL AUTO_INCREMENT,
  `qTxt` text COLLATE utf8_unicode_ci NOT NULL,
  `qIsTaken` tinyint(1) NOT NULL,
  `qIsAnswered` tinyint(1) NOT NULL,
  `questionurl` text COLLATE utf8_unicode_ci NOT NULL,
  `qTxtFRA` text COLLATE utf8_unicode_ci NOT NULL,
  `questionurlFRA` text COLLATE utf8_unicode_ci NOT NULL,
  `topicid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`qId`),
  KEY `question_topics` (`topicid`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tabquestions`
--

INSERT INTO `tabquestions` (`qId`, `qTxt`, `qIsTaken`, `qIsAnswered`, `questionurl`, `qTxtFRA`, `questionurlFRA`, `topicid`) VALUES
(1, 'You suspect your computer and the information you are accessing on a database are compromised…. You then:', 0, 0, 'https://player.vimeo.com/video/303102987', 'Vous soupçonnez que votre ordinateur a été piraté et que les informations auxquelles vous accédez par son intermédiaire sont compromises. Aussitôt:', 'https://player.vimeo.com/video/303103168', 4),
(2, 'You received an email from  a hacker informing you that he took control of your professional data and requesting a ransom. What should you do?', 0, 0, 'https://player.vimeo.com/video/303102987', 'Vous avez reçu un courriel d\'un pirate vous informant qu\'il a pris le contrôle de vos données professionnelles et demande une rançon. Que devriez-vous faire?', 'https://player.vimeo.com/video/303103168', 4),
(3, 'A staff member takes advantage of an open session to snoop into a colleague\'s medical record. What is the main violation she/he is incurring?', 0, 0, 'https://player.vimeo.com/video/302832544', 'Un membre du personnel profite d\'une session ouverte sur un poste informatiquepour fouiner dans le dossier médical d\'un collègue. Quelle norme professionnelle viole-t-il ?', 'https://player.vimeo.com/video/302833635', 4),
(4, 'You are receiving an email request to click on a link and provide login information for computer maintenance. What would you do?', 0, 0, 'https://player.vimeo.com/video/303102987', 'Vous recevez un courriel vous demandant de cliquer sur un lien afin d\'effectuer une mise à jour logicielle. La page web qui s\'affiche alors vous demande de fournir vos identifiants et mot de passe d\'accès au réseau. Que faites-vous ?', 'https://player.vimeo.com/video/241087789', 5),
(5, 'You are part of the care team of a patient that has an identifiable tattoo on his body. In preparation for a lecture, the physician wants to take a picture of his body at the level of the tattoo, to document the case. You:', 0, 0, 'https://player.vimeo.com/video/302832544', 'Vous faites partie de l\'équipe de soins d\'un patient qui porte un tatouage particulier susceptible de l\'identifier aisément. En vue d\'une conférence qu\'il doit bientôt donner pour présenter le cas de ce patient, un médecin veut prendre une photo du corps de ce patient au niveau de son tatouage. Que faites-vous?', 'https://player.vimeo.com/video/302833635', 2),
(6, 'An employee has had to go on sick leave. He looks at the results of his last blood tests on OACIS. What principle would he be infringing?', 0, 0, 'https://player.vimeo.com/video/302832544', 'Un employé a dû partir en congé maladie. Il accède et regarde les résultats de ses derniers tests sur OACIS. Quel principe enfreint-il?', 'https://player.vimeo.com/video/302833635', 8),
(7, 'You have just clicked on an infected Internet link received by email. In doing so, you have just triggered crypto-ransomware on your computer, which begins to encrypt your files and displays a ransom note on the screen. What do you do?', 0, 0, 'https://player.vimeo.com/video/303102987', 'Vous venez de cliquer sur un lien Internet piégé, reçu par courriel. Ce faisant, vous venez de faire entrer sur votre ordinateur un crypto-rançongiciel, qui commence à chiffrer vos fichiers et affiche à l\'écran une demande de rançon. Que faites-vous?', 'https://player.vimeo.com/video/241087789', 7),
(8, 'You received a product offer email What should you do?', 0, 0, 'https://player.vimeo.com/video/303102987', 'Vous avez reçu un courriel commercial. Que devriez-vous faire?', 'https://player.vimeo.com/video/241087789', 9),
(9, 'Why would you always need to lock or log off your work station?', 0, 0, 'https://player.vimeo.com/video/302832544', 'Doit-on vraiment toujours verrouiller ou  déconnecter sa session en quittant son poste  de travail?', 'https://player.vimeo.com/video/302833635', 9),
(10, 'Which of the following are security acceptable practices to secure the access to your work station?', 0, 0, 'https://player.vimeo.com/video/302832544', 'Parmi les déclarations suivantes, lesquelles sont des pratiques acceptables en matière de sécurisation des accès à sa session de travail sur son poste informatique?', 'https://player.vimeo.com/video/302833635', 9),
(11, 'Which are the best practices for protecting patient information?', 0, 0, 'https://player.vimeo.com/video/302832544', 'Quelles sont les meilleures pratiques pour protéger les informations des patients qui sont stockées dans nos bases de données:', 'https://player.vimeo.com/video/302833635', 3),
(12, 'It is possible to welcome visitors without identity cards to our offices, with the following precautions?', 0, 0, 'https://player.vimeo.com/video/241087789', 'Il est possible de donner accès à nos bureaux administratifs à des visiteurs, qui ne portent pas de carte d\'identité du CUSM ; mais en prenant les précautions suivantes?', 'https://player.vimeo.com/video/244339235', 4),
(13, 'Why is it important to wear your ID card?', 0, 0, 'https://player.vimeo.com/video/241087789', 'Pourquoi est-il important de porter votre carte d\'identité de façon visible ?', 'https://player.vimeo.com/video/244339235', 3),
(14, 'Wearing a visible ID card is important:', 0, 0, 'https://player.vimeo.com/video/241087789', 'Le port d\'une carte d\'identité est important…', 'https://player.vimeo.com/video/244339235', 2),
(15, 'What are the requirements for taking pictures of patients?', 0, 0, 'https://player.vimeo.com/video/302832544', 'Quelles sont les exigences pour prendre des photos de patients?', 'https://player.vimeo.com/video/302833635', 2),
(16, 'In MUHC\'S public spaces especially elevators, corridors and coffee shops, where there are other people,  it is permitted:', 0, 0, 'https://player.vimeo.com/video/241087805', 'Dans les locaux du CUSM, en présence d\'autres personnes (notamment dans les espaces publics comme les ascenseurs, les couloirs et les cafés), il est permis:', 'https://player.vimeo.com/video/244339094', 6),
(17, 'When do you need patient consent for taking pictures of him/her?', 0, 0, 'https://player.vimeo.com/video/241087805', 'Quand avez-vous besoin du consentement du patient pour le prendre en photo ?', 'https://player.vimeo.com/video/244339094', 4),
(18, 'Once you have a consistent password you can:', 0, 0, 'https://player.vimeo.com/video/241087822', 'Une fois que vous avez un mot de passe fort, vous pouvez…', 'https://player.vimeo.com/video/244338953', 2),
(19, 'The best password is the one:', 0, 0, 'https://player.vimeo.com/video/241087822', 'Un mot de passe fort est un mot de passe…', 'https://player.vimeo.com/video/244338953', 2),
(20, 'When making the choice of a password to protect the  access to a database you will ensure it Is:', 0, 0, 'https://player.vimeo.com/video/241087822', 'Pour sécuriser votre accès à une base de données, vous pouvez choisir comme mot de passe …', 'https://player.vimeo.com/video/244338953', 7),
(21, 'If you want to choose a password that will be difficult to discover by people with bad intentions, you will make sure that:', 0, 0, 'https://player.vimeo.com/video/241087822', 'Si vous faites le choix d\'un mot de passe difficile à découvrir par des personnes mal intentionnées, vous vous assurez ...:', 'https://player.vimeo.com/video/244338953', 3),
(22, 'Passwords are like toothbrushes, so you should:', 0, 0, 'https://player.vimeo.com/video/241087842', 'Les mots de passe sont comme les brosses à dents.', 'https://player.vimeo.com/video/244338734', 2),
(23, 'You are in the hospital and you are in the cafeteria. Sitting next to you 2 members of the staff are talking about a patient currently in the  operating room, who is actually a renown politician. You:', 0, 0, 'https://player.vimeo.com/video/241087805', 'Vous vous trouvez à la cafétéria de l\'hôpital. Assis à côté de vous, deux membres du personnel discutent d\'un patient présentement en salle d\'opérations… qui s\'avère être un politicien de renom. Que faites-vous?', 'https://player.vimeo.com/video/244339094', 4),
(24, 'A person who does not wear an ID card arrives for a meeting on your floor and requests access to your premises. You open the door, and ask :', 0, 0, 'https://player.vimeo.com/video/241087789', 'Une personne qui ne porte pas de carte d\'identité, se présente à votre étage et demande à accéder à vos locaux. Vous lui ouvrez la porte , et lui demandez….', 'https://player.vimeo.com/video/244339235', 5),
(25, 'There is an incident at the hospital and the press is covering it. A journalist wanders around the hospital to try to gather additional information t. You notice a gentleman with no ID card and:', 0, 0, 'https://player.vimeo.com/video/241087789', 'Il y a un incident à l\'hôpital et la presse le couvre. Un journaliste se promène dans l\'hôpital, peut-être cherche-t-il  des informations supplémentaires. Vous remarquez une personne qui ne porte pas de carte donc vous…', 'https://player.vimeo.com/video/244339235', 5),
(26, 'You are a medical secretary, and an intern has been hired to work with you during a period of heavy workload. Which of the following is inappropriate?', 0, 0, 'https://player.vimeo.com/video/241087842', 'Vous êtes secrétaire médicale et une stagiaire a été embauché pour  vous assister pendant une période de lourde charge de travail. Lequel des énoncés suivants est inapproprié?', 'https://player.vimeo.com/video/244338734', 3),
(27, 'How would you evaluate the risk of sharing passwords?', 0, 0, 'https://player.vimeo.com/video/241087842', 'Comment évalueriez-vous le risque de partager des mots de passe?', 'https://player.vimeo.com/video/244338734', 6),
(54, 'test  1a1', 0, 0, 'http://Example-1.ca22', 'test fra 1a1', 'http://NewExampleFRA-3.ca22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabusers`
--

DROP TABLE IF EXISTS `tabusers`;
CREATE TABLE IF NOT EXISTS `tabusers` (
  `uId` bigint(20) NOT NULL AUTO_INCREMENT,
  `uIUN` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `uFName` text COLLATE utf8_unicode_ci NOT NULL,
  `uLName` text COLLATE utf8_unicode_ci NOT NULL,
  `uRetryCount` int(11) NOT NULL,
  `uTimer` int(11) NOT NULL,
  `uTotalScore` int(11) NOT NULL,
  `uIsFinished` tinyint(1) NOT NULL,
  `timestart` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `timefinish` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `listofquestions` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `sessionId` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`uId`),
  UNIQUE KEY `sessionId` (`sessionId`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tabusers`
--

INSERT INTO `tabusers` (`uId`, `uIUN`, `uFName`, `uLName`, `uRetryCount`, `uTimer`, `uTotalScore`, `uIsFinished`, `timestart`, `timefinish`, `listofquestions`, `comment`, `sessionId`) VALUES
(140, 'UNKNOWN', '', '', 1, 0, 0, 0, '01/21/2022 17:08:30', '', 'qF:15; ', 'Inserted: ', '77661391-2f2c-4f7b-9124-72874e042695'),
(141, 'UNKNOWN', '', '', 2, 0, 0, 0, '01/24/2022 17:33:37', '', 'qF:5; ', 'Inserted: ', 'efbfdcd3-cc77-4f36-bd24-e20eefc6391e'),
(142, 'UNKNOWN', '', '', 3, 0, 1, 0, '01/26/2022 15:51:16', '', 'qT:17; ', 'Inserted: ', '232bb5f6-8379-4ab5-9510-b42561ae5f5d'),
(143, 'UNKNOWN', '', '', 4, 0, 0, 0, '01/31/2022 11:21:57', '', 'qF:11; ', 'Inserted: ', '61160a38-af1f-4970-86f5-745bdb50d732'),
(144, 'UNKNOWN', '', '', 5, 0, 0, 0, '01/31/2022 11:23:00', '', 'qF:23; ', 'Inserted: ', '6d6700f8-555f-4aac-8a51-670728e05021'),
(145, 'UNKNOWN', '', '', 6, 0, 1, 0, '01/31/2022 11:55:18', '', 'qT:11; ', 'Inserted: ', '12d57c33-ee60-44e8-ae0f-4fb0aa21057e'),
(146, 'UNKNOWN', '', '', 7, 0, 1, 0, '01/31/2022 12:18:09', '', 'qT:3; ', 'Inserted: ', '3b03631c-98c7-4909-8bbc-2ccd210245eb'),
(147, 'UNKNOWN', '', '', 8, 0, 1, 0, '01/31/2022 12:29:27', '', 'qT:13; ', 'Inserted: ', 'cb8cc5b6-372d-4519-b7f1-46a635ea8e2c'),
(148, 'UNKNOWN', '', '', 9, 0, 0, 0, '01/31/2022 12:31:41', '', 'qF:6; ', 'Inserted: ', '5a4d3a8e-9b33-40d0-970c-0495cc8d1b6c'),
(149, 'UNKNOWN', '', '', 10, 0, 1, 0, '01/31/2022 12:52:40', '', 'qT:25; ', 'Inserted: ', 'e7039cae-0bbc-4504-838a-6a9af30908ea'),
(150, 'UNKNOWN', '', '', 11, 0, 0, 0, '01/31/2022 12:53:51', '', 'qF:25; ', 'Inserted: ', '13788aac-054e-424c-b376-cb662b926ce2'),
(151, 'UNKNOWN', '', '', 12, 0, 0, 0, '01/31/2022 12:59:07', '', 'qF:18; ', 'Inserted: ', 'e90c3b58-0980-4894-97e5-0d60f30f379d'),
(152, 'UNKNOWN', '', '', 13, 0, 0, 0, '01/31/2022 13:03:40', '', 'qF:8; ', 'Inserted: ', 'f7f962e6-9d53-44b6-b46f-536332cade90'),
(153, 'UNKNOWN', '', '', 14, 0, 0, 0, '01/31/2022 13:13:41', '', 'qF:26; ', 'Inserted: ', 'a7b57717-fb95-4bdb-8797-ddee7d056458'),
(154, 'UNKNOWN', '', '', 15, 0, 0, 0, '01/31/2022 13:20:31', '', 'qF:22; ', 'Inserted: ', 'c7ea213a-d027-4af5-a7c4-7a888a9e64f8'),
(155, 'UNKNOWN', '', '', 16, 0, 0, 0, '01/31/2022 13:27:19', '', 'qF:1; qF:1; ', '', 'cba9829b-651f-47fc-9405-79112eb54b63'),
(156, 'UNKNOWN', '', '', 17, 0, 1, 0, '01/31/2022 13:32:07', '', 'qT:10; qF:1; qF:1; ', '', '32abbce6-1097-4737-a42f-73139fdd5652'),
(157, 'UNKNOWN', '', '', 18, 0, 0, 0, '01/31/2022 13:39:53', '', 'qF:11; qF:11; ', '', '69ceb661-9c91-484d-8d53-f8d01367bff0'),
(158, 'UNKNOWN', '', '', 19, 144, 3, 1, '02/01/2022 08:05:46', '02/01/2022 08:08:46', 'qT:25; qF:10; qT:10; qF:9; qT:9; ', '1)Stars: 5 2)Likes: eee 3)Suggest: rrr', '1b2308ab-ad41-4b60-b17e-c0fc3be27b7d'),
(159, 'UNKNOWN', '', '', 20, 0, 0, 0, '02/21/2022 13:54:50', '', 'qF:11; qF:11; qF:11; ', '', '51323cbd-0e00-42b7-984d-ffd4bb455791'),
(160, 'UNKNOWN', '', '', 21, 0, 1, 0, '02/21/2022 14:02:40', '', 'qT:9; ', 'Inserted: ', '41c4a41d-c4c4-46c5-b652-c9a21f3a12e4'),
(161, 'UNKNOWN', '', '', 22, 0, 0, 0, '02/21/2022 14:06:00', '', 'qF:24; qF:24; qF:24; qF:24; qF:20; qF:20; ', '', '37e61931-b185-4df5-933d-b8c4a1e5361a'),
(162, 'UNKNOWN', '', '', 23, 155, 3, 1, '02/24/2022 18:27:38', '02/24/2022 18:36:17', 'qF:27; qF:27; qT:11; qF:9; qF:10; qF:10; qF:10; qF:10; qF:10; qT:10; qT:20; ', '1)Stars: 4 2)Likes: Great game! 3)Suggest: Cool', '229cf5fe-c981-4572-930e-6354efda8ba7'),
(163, 'UNKNOWN', '', '', 24, 0, 1, 0, '02/24/2022 19:18:29', '', 'qF:4; qT:4; ', '', 'd54cfb46-8007-4e23-9b27-903825efbdde'),
(164, 'UNKNOWN', '', '', 25, 0, 1, 0, '02/24/2022 19:46:27', '', 'qT:26; ', 'Inserted: ', 'bd45c95b-4c17-4cdc-862d-8224f3a40d89'),
(165, 'UNKNOWN', '', '', 26, 0, 1, 0, '02/24/2022 19:59:38', '', 'qT:12; qF:13; qF:9; qF:9; ', '', '4700ce5c-af5f-4c8e-aaf4-c605a90f508d'),
(166, 'UNKNOWN', '', '', 27, 0, 1, 0, '02/24/2022 21:36:13', '', 'qT:2; ', 'Inserted: ', 'eff881bf-aaac-448c-9952-41ee9c32a18a'),
(167, 'UNKNOWN', '', '', 28, 0, 1, 0, '02/24/2022 22:08:54', '', 'qF:7; qF:7; qF:7; qT:26; ', '', 'e5c27f39-aa98-45e7-a85c-cc8adeb99c70'),
(168, 'UNKNOWN', '', '', 29, 0, 1, 0, '02/27/2022 13:27:16', '', 'qT:26; ', 'Inserted: ', '4326026d-14c5-4daa-a5c3-73434b30abfb'),
(169, 'UNKNOWN', '', '', 30, 0, 1, 0, '02/27/2022 13:36:46', '', 'qT:26; ', 'Inserted: ', 'c1fb35ae-ec15-4e45-aa22-f4832f417911'),
(170, 'UNKNOWN', '', '', 31, 0, 0, 0, '02/28/2022 08:01:54', '', 'qF:26; ', 'Inserted: ', '8bb223bb-1542-4bea-86b4-5b6859a62db5'),
(171, 'UNKNOWN', '', '', 32, 0, 0, 0, '02/28/2022 08:15:31', '', 'qF:15; ', 'Inserted: ', '4485c529-a549-43ed-a8ab-053cfa7fdb9d'),
(172, 'UNKNOWN', '', '', 33, 90, 2, 1, '02/28/2022 08:25:12', '02/28/2022 08:28:05', 'qF:23; qT:23; qT:26; ', '1)Stars: 5 2)Likes: Cool game 3)Suggest: Make More', '4a7f75bc-a9b4-4ad4-8560-9328b4e61ad9'),
(173, 'BADO6002', '', '', 1, 109, 3, 1, '02/28/2022 12:22:39', '02/28/2022 12:25:10', 'qT:17; qT:26; qT:17; ', '1)Stars: 4 2)Likes: Thank you - very good game! 3)Suggest: I want to have more games like that!', 'a8e84d82-c3e1-49b1-9223-21247de59f76'),
(174, 'UNKNOWN', '', '', 34, 233, 2, 1, '03/01/2022 08:36:14', '03/01/2022 08:41:18', 'qF:16; qT:16; qT:26; ', '1)Stars: 5 2)Likes: ertertert 3)Suggest: ertert', '9d7008af-0cce-4d34-906f-222a779e508f'),
(175, 'UNKNOWN', 'ZAAL6006', 'ZAAL6006', 35, 130, 4, 1, '03/01/2022 11:48:25', '03/01/2022 11:50:59', 'qT:14; qT:26; qT:3; qT:26; qF:14; ', '1)Stars: 5 2)Likes: Nice 3)Suggest: Great game', 'd2dee76e-881b-4c53-a99a-8e04c2ce602e'),
(176, 'UNKNOWN', '', '', 36, 0, 1, 0, '03/01/2022 13:18:52', '', 'qT:18; ', 'Inserted: ', 'da50f69d-b45a-4c87-b956-2223af3d56a2'),
(177, 'UNKNOWN', '', '', 37, 0, 1, 0, '03/03/2022 10:37:41', '', 'qT:13; ', 'Inserted: ', 'd4fc7c9b-3276-4a00-963e-469d5f3fc83c'),
(178, 'UNKNOWN', '', '', 38, 0, 0, 0, '03/03/2022 11:14:42', '', 'qF:13; ', 'Inserted: ', '6def39a4-3e45-4030-a5c8-87111943415e'),
(179, 'UNKNOWN', 'ZAAL6006', 'ZAAL6006', 39, 0, 1, 0, '03/03/2022 12:18:24', '', '11; ', 'Inserted: ', '846db952-ac87-40d6-afdc-aef55a1d14ca'),
(180, 'UNKNOWN', '', '', 40, 0, 0, 0, '03/03/2022 13:47:12', '', '9; ', 'Inserted: ', '229d96fa-7738-42d5-87d0-6a000e5cbd70'),
(181, 'UNKNOWN', '', '', 41, 0, 0, 0, '03/03/2022 15:26:34', '', '13; 9; ', '', '020f0349-a30a-4518-af4f-3f78bea85914'),
(182, 'UNKNOWN', '', '', 42, 139, 1, 1, '03/03/2022 16:35:25', '03/03/2022 16:38:18', '24; 10; ', '1)Stars: 5 2)Likes: sdfsdg 3)Suggest: sdfgdf', 'b242b1ca-3164-4efe-a2f4-03bad1b89ad7'),
(183, 'UNKNOWN', '', '', 43, 0, 0, 0, '03/03/2022 16:56:26', '', '4; ', 'Inserted: ', '4573296c-6cbf-48a5-bb78-edee16735ac3'),
(184, 'UNKNOWN', '', '', 44, 0, 0, 0, '03/03/2022 18:56:52', '', '25; ', 'Inserted: ', 'a10cbfc2-597f-4ee1-ba5b-c040eb0b7a0f'),
(185, 'UNKNOWN', '', '', 45, 0, 1, 0, '03/03/2022 18:59:27', '', '25; ', 'Inserted: ', 'e280c26e-f5fd-4481-b56a-4253f5fce208'),
(186, 'UNKNOWN', '', '', 46, 0, 1, 0, '03/03/2022 19:29:41', '', '7; 6; 6; ', '', 'b1e838e2-5ac1-4217-9ced-0d8d86bbaeb2'),
(187, 'UNKNOWN', '', '', 47, 0, 0, 0, '03/03/2022 19:31:58', '', '6; ', 'Inserted: ', '5e81f5b6-bb5b-40d6-9ac9-c18045a85afd'),
(188, 'UNKNOWN', '', '', 48, 97, 4, 1, '03/03/2022 19:47:10', '03/03/2022 19:48:58', '4; 7; 7; 6; 21; 21; ', '', 'c9d9cba9-1a10-4fec-8b66-82a859326836'),
(189, 'UNKNOWN', '', '', 49, 52, 2, 1, '03/04/2022 11:00:02', '03/04/2022 11:01:05', '4; 20; ', '', '39633f43-fa95-4a84-8068-5ebc33499459'),
(190, 'UNKNOWN', 'ZAAL6006', 'ZAAL6006', 50, 60, 3, 1, '03/04/2022 11:22:05', '03/04/2022 11:23:32', '4; 20; 6; ', '1)Stars: 5 2)Likes: Cool! 3)Suggest: I like that game', '01e836c1-ddd8-4ddd-8893-5090c1369819'),
(191, 'UNKNOWN', '', '', 51, 49, 2, 1, '03/04/2022 13:24:13', '03/04/2022 13:25:21', '24; 7; ', '', '23345987-7e59-4fde-a8d4-46c7f0dd7a27'),
(192, 'UNKNOWN', '', '', 52, 160, 2, 1, '03/04/2022 17:01:54', '03/04/2022 17:11:07', '6; 27; 27; ', '1)Stars: 4 2)Likes: dAWfdsaef 3)Suggest: sefsef', '38cf6bf5-d035-4e23-ac39-a60b286feeeb'),
(193, 'UNKNOWN', '', '', 53, 0, 0, 0, '03/04/2022 17:24:15', '', '25; ', 'Inserted: ', '6e9dbe03-ec6c-42f7-bd0a-78bf587b1502'),
(194, 'UNKNOWN', '', '', 54, 163, 3, 1, '03/04/2022 17:40:27', '03/04/2022 17:43:25', '4; 7; 8; 8; 8; 8; ', '', '7ec4c03f-60da-41ca-be91-d574161f6f63'),
(195, 'UNKNOWN', '', '', 55, 44, 2, 1, '03/04/2022 17:43:30', '03/04/2022 17:45:18', '9; 9; 16; ', '1)Stars: 5 2)Likes: Done 3)Suggest: ', 'f8bc03a1-d92d-4ebd-bcb9-ab829ced00a3'),
(196, 'UNKNOWN', '', '', 56, 357, 3, 1, '03/05/2022 11:53:27', '03/05/2022 11:59:48', '4; 7; 7; 6; ', '1)Stars: 5 2)Likes: hi 3)Suggest: ', '6bc2a942-5763-4479-a609-5cd23cb21b67'),
(197, 'UNKNOWN', '', '', 57, 0, 1, 0, '03/06/2022 14:03:01', '', '25; 25; ', '', '8452d969-36fc-4571-a6fd-98990d34397d'),
(198, 'UNKNOWN', '', '', 58, 0, 0, 0, '03/06/2022 17:50:14', '', '10; ', 'Inserted: ', '6dc6a96d-98c9-40ad-9601-8c877f7ebcbd'),
(199, 'UNKNOWN', '', '', 59, 0, 1, 0, '03/06/2022 18:07:36', '', '8; 8; ', '', '556ee61a-5627-4886-85ba-20c22339b586'),
(200, 'UNKNOWN', '', '', 60, 0, 1, 0, '03/06/2022 18:09:16', '', '10; ', 'Inserted: ', 'a2c74a8a-9d09-479f-836c-7db14b49539d'),
(201, 'UNKNOWN', '', '', 61, 0, 1, 0, '03/06/2022 18:25:24', '', '9; 9; ', '', '0249aab6-e1e1-40d8-a4a9-7f134e6b1c97'),
(202, 'UNKNOWN', '', '', 62, 0, 1, 0, '03/06/2022 18:29:55', '', '8; 8; ', '', 'e0ba81a9-c2dc-4a3e-8dfa-2ad48f796a51'),
(203, 'UNKNOWN', '', '', 63, 0, 0, 0, '03/06/2022 18:40:58', '', '10; ', 'Inserted: ', 'd0c190a7-bd7b-4142-8fd9-127a575a47f5'),
(204, 'UNKNOWN', '', '', 64, 0, 1, 0, '03/06/2022 19:05:39', '', '25; 25; 25; ', '', '71b65556-5e5b-4d85-9226-555063fa18e9'),
(205, 'UNKNOWN', '', '', 65, 0, 1, 0, '03/06/2022 19:51:23', '', '10; ', 'Inserted: ', '5ec642c0-4e74-400b-96dc-060bc9c58327'),
(206, 'UNKNOWN', '', '', 66, 0, 0, 0, '03/06/2022 19:53:58', '', '10; ', 'Inserted: ', 'df08fa0b-f417-41dc-a97a-ee4f62f26dd8'),
(207, 'UNKNOWN', '', '', 67, 0, 0, 0, '03/06/2022 19:55:22', '', '10; ', 'Inserted: ', 'f59bd555-39a1-4b16-86e7-d79f561b1dc2'),
(208, 'UNKNOWN', '', '', 68, 0, 1, 0, '03/06/2022 19:59:06', '', '25; 25; 25; 25; 25; ', '', '72c780f7-309c-46df-af4b-76c0ee5f3c50'),
(209, 'UNKNOWN', '', '', 69, 0, 0, 0, '03/06/2022 20:06:15', '', '24; 24; 24; 24; ', '', '0f9d7bd7-4a41-4b04-84a6-173296441c71'),
(210, 'UNKNOWN', '', '', 70, 0, 1, 0, '03/06/2022 20:08:27', '', '24; 24; ', '', '5593e153-d4e9-494c-bfde-03a0cd10abca'),
(211, 'UNKNOWN', '', '', 71, 0, 1, 0, '03/06/2022 20:10:07', '', '20; ', 'Inserted: ', 'c558fd15-6bf4-41a8-8d99-54a7c86e8512'),
(212, 'UNKNOWN', '', '', 72, 136, 2, 1, '03/07/2022 17:24:32', '03/07/2022 17:30:07', '24; 9; ', '1)Stars: 5 2)Likes: wdawd 3)Suggest: awdawd', '81f4fe46-c0dc-44b4-8b1d-c8ca6879fdab'),
(213, 'UNKNOWN', '', '', 73, 0, 0, 0, '03/07/2022 17:30:11', '', '25; ', 'Inserted: ', 'e979f2a6-841a-4c6e-8c81-e0dd696b346e'),
(214, 'UNKNOWN', '', '', 74, 0, 1, 0, '03/07/2022 18:07:49', '', '6; ', 'Inserted: ', 'e54486f0-622d-496e-83d0-32525d10a2cc'),
(215, 'UNKNOWN', '', '', 75, 0, 2, 0, '03/07/2022 18:23:09', '', '25; 7; ', '', '767962e2-39d3-4589-9311-949d8d82948f'),
(216, 'UNKNOWN', '', '', 76, 0, 1, 0, '03/07/2022 18:25:28', '', '24; ', 'Inserted: ', 'd7a3df4f-2241-4745-bf80-8ec021874946'),
(217, 'UNKNOWN', '', '', 77, 0, 1, 0, '03/07/2022 18:27:04', '', '24; 24; ', '', 'a76691e8-806b-4bc0-a892-9a71ed0a9808'),
(218, 'UNKNOWN', '', '', 78, 0, 1, 0, '03/07/2022 18:29:20', '', '27; ', 'Inserted: ', 'b4dceb09-9274-4a1a-8c08-3f55007807b2'),
(219, 'UNKNOWN', '', '', 79, 0, 3, 0, '03/07/2022 18:32:46', '', '24; 7; 7; 6; 6; 6; ', '', '9591eadd-c997-4d2d-96b4-bc91a4aba92b'),
(220, 'UNKNOWN', '', '', 80, 0, 1, 0, '03/08/2022 17:46:18', '', '25; 25; 8; ', '', '8a78bd2e-a258-4e97-b5f5-d0972935e156'),
(221, 'UNKNOWN', '', '', 81, 0, 1, 0, '03/09/2022 08:59:57', '', '20; ', 'Inserted: ', '7605745d-a55e-4d20-9780-5b23d7ed1b80'),
(222, 'UNKNOWN', '', '', 82, 0, 3, 0, '03/09/2022 09:00:58', '', '25; 25; 20; 19; ', '', '30526fc3-9bb8-422b-bcb0-523a2f504bbd'),
(223, 'UNKNOWN', '', '', 83, 0, 2, 0, '03/09/2022 09:05:36', '', '25; 25; 20; ', '', '777953a2-b88f-4df7-a052-bc7541234e41'),
(224, 'UNKNOWN', '', '', 84, 0, 0, 0, '03/09/2022 09:33:23', '', '24; ', 'Inserted: ', '4bc60e21-3a3d-4e21-ad0e-fdde741f529d'),
(225, 'UNKNOWN', '', '', 85, 0, 1, 0, '03/09/2022 09:37:55', '', '25; ', 'Inserted: ', '6bf6beb9-5944-46db-be9c-de90b66ec182'),
(226, 'UNKNOWN', '', '', 86, 0, 1, 0, '03/09/2022 09:42:20', '', '4; ', 'Inserted: ', '8f886727-fa0e-41e8-8e65-2ecf68036fdb'),
(227, 'UNKNOWN', '', '', 87, 0, 1, 0, '03/09/2022 09:45:15', '', '4; ', 'Inserted: ', '4fdc707b-36e2-4e41-92ad-71945d451ba6'),
(228, 'UNKNOWN', '', '', 88, 0, 1, 0, '03/09/2022 09:47:50', '', '24; 24; ', '', '33d4367a-9b2d-41b2-abd9-09eb1cddc3f2'),
(229, 'UNKNOWN', '', '', 89, 0, 2, 0, '03/09/2022 09:50:07', '', '4; 20; ', '', 'd50b8a2e-28dd-42b1-9aad-ac9dfee2a1f1'),
(230, 'UNKNOWN', '', '', 90, 0, 3, 0, '03/09/2022 09:54:12', '', '4; 7; 6; ', '', 'bf30af97-b4fe-467c-9f97-cbf9f5adee1f'),
(231, 'UNKNOWN', '', '', 91, 0, 1, 0, '03/09/2022 09:58:02', '', '24; ', 'Inserted: ', 'd9416532-3181-468c-9bc7-299119b6e1a1'),
(232, 'UNKNOWN', '', '', 92, 0, 1, 0, '03/09/2022 09:59:34', '', '4; ', 'Inserted: ', 'a321bbcf-ab64-4b44-9735-067599f7b6be'),
(233, 'UNKNOWN', '', '', 93, 0, 1, 0, '03/09/2022 10:04:17', '', '4; ', 'Inserted: ', '222f4cfa-acc8-40de-863c-0f86e20b1285'),
(234, 'UNKNOWN', '', '', 94, 0, 1, 0, '03/09/2022 10:05:51', '', '4; ', 'Inserted: ', '73552f4f-260e-48af-855f-848d591e94da'),
(235, 'UNKNOWN', '', '', 95, 0, 1, 0, '03/09/2022 10:07:37', '', '4; ', 'Inserted: ', '61fbf6e8-8bc1-4156-bed2-f5203c5c7e8c'),
(236, 'UNKNOWN', '', '', 96, 0, 1, 0, '03/09/2022 10:08:14', '', '4; ', 'Inserted: ', '3eaab802-4470-4493-8a1f-3422f0917be8'),
(237, 'UNKNOWN', '', '', 97, 221, 8, 1, '03/09/2022 10:08:42', '03/09/2022 10:13:12', '25; 20; 6; 22; 8; 8; 8; 21; 21; 16; 9; 9; ', '', 'd8c0c520-255f-48c1-8e66-c46bc3592943'),
(238, 'UNKNOWN', '', '', 98, 12, 1, 1, '03/09/2022 10:14:33', '03/09/2022 10:15:35', '10; ', '1)Stars: 5 2)Likes:  3)Suggest: ', '87d2b12e-5673-4516-affc-eb90bd8f4e1b'),
(239, 'UNKNOWN', '', '', 99, 0, 1, 0, '03/09/2022 10:22:47', '', '20; ', 'Inserted: ', '00509006-047f-4bda-ae60-bf25d15bcd80'),
(240, 'UNKNOWN', '', '', 100, 0, 1, 0, '03/09/2022 10:29:26', '', '24; 24; ', '', 'e8a4062c-4224-4ae8-aa3f-ea596bba6223');

-- --------------------------------------------------------

--
-- Table structure for table `topicslist`
--

DROP TABLE IF EXISTS `topicslist`;
CREATE TABLE IF NOT EXISTS `topicslist` (
  `topicid` int(11) NOT NULL AUTO_INCREMENT,
  `titleENG` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titleFRA` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`topicid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topicslist`
--

INSERT INTO `topicslist` (`topicid`, `titleENG`, `titleFRA`, `active`) VALUES
(1, 'UNDEFINED/COMMON TOPIC', 'UNDEFINED/COMMON TOPIC', 1),
(2, 'COMPLEX PASSWORDS', 'MOTS DE PASSE COMPLEXES', 1),
(3, 'INFORMATION CLASSIFICATION', 'CLASSEMENT DES INFORMATIONS', 1),
(4, 'CONFIDENTIAL INFORMATION UNPROTECTED', 'INFORMATIONS CONFIDENTIELLES NON PROTÉGÉES', 1),
(5, 'SAFE ONLINE SHOPPING', 'ACHATS EN LIGNE SÉCURISÉS', 1),
(6, 'TELEWORK AND INFORMATION SECURITY', 'TÉLÉTRAVAIL ET SÉCURITÉ DE L\'INFORMATION', 1),
(7, 'USING DOUBLE FACTOR AUTHENTICATION', 'EN UTILISANT LE DOUBLE FACTEUR D\'AUTHENTIFICATION', 1),
(8, 'SOCIAL MEDIAS', 'Réseaux Sociaux', 1),
(9, 'PHISHING', 'PHISHING', 1),
(13, 'test - title', 'test -title inn French', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabanswers`
--
ALTER TABLE `tabanswers`
  ADD CONSTRAINT `tabanswers_ibfk_1` FOREIGN KEY (`ansQId`) REFERENCES `tabquestions` (`qId`) ON UPDATE CASCADE;

--
-- Constraints for table `tabquestions`
--
ALTER TABLE `tabquestions`
  ADD CONSTRAINT `tabquestions_ibfk_1` FOREIGN KEY (`topicid`) REFERENCES `topicslist` (`topicid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
