-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 04:05 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `userid`, `firstname`, `lastname`, `passwordHash`, `active`, `sessionid`) VALUES
(1, 'admin', 'First', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 1, '346f743c-0d6f-420d-805b-ba7f7709eb1a'),
(2, 'bado6002', 'Donghee', 'Baik', '2ac9cb7dc02b3c0083eb70898e549b63', 1, ''),
(3, 'trau6000', 'Audrey', 'Trigub-Clove', 'cc2f410031aea40769918b7adb73a696', 1, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(108, 'All of these statements are correct.', 27, 1, 'Tous les énoncés sont corrects..');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(27, 'How would you evaluate the risk of sharing passwords?', 0, 0, 'https://player.vimeo.com/video/241087842', 'Comment évalueriez-vous le risque de partager des mots de passe?', 'https://player.vimeo.com/video/244338734', 6);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(9, 'PHISHING', 'PHISHING', 1);

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
