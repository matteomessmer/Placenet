-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Giu 17, 2017 alle 17:10
-- Versione del server: 5.7.18-0ubuntu0.17.04.1
-- Versione PHP: 7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `idComment` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `content` text NOT NULL,
  `publicationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `comments`
--

INSERT INTO `comments` (`idComment`, `idPost`, `idUser`, `content`, `publicationTime`) VALUES
(1, 5, 1, 'Ci ho provato', '2017-06-01 14:44:41'),
(2, 5, 1, 'AndrÃ  meglio la prossima volta', '2017-06-01 14:45:37'),
(3, 5, 1, '\'; drop database; --', '2017-06-01 14:47:58'),
(4, 5, 1, 'Ci rinuncio', '2017-06-01 14:48:58'),
(5, 7, 1, 'Bravo', '2017-06-07 14:07:18'),
(6, 6, 1, 'Piacere di conoscerti :)', '2017-06-07 14:07:39'),
(7, 19, 191, 'Prego:)', '2017-06-10 14:52:03'),
(8, 25, 192, 'Stai zitto capra ignorate', '2017-06-10 16:53:49'),
(9, 25, 192, '', '2017-06-10 16:54:04'),
(10, 25, 192, '', '2017-06-10 16:54:05'),
(11, 25, 192, '', '2017-06-10 16:54:06'),
(12, 25, 192, '', '2017-06-10 16:54:06'),
(13, 25, 192, '', '2017-06-10 16:54:06'),
(14, 25, 192, '', '2017-06-10 16:54:06'),
(15, 25, 192, '', '2017-06-10 16:54:07'),
(16, 25, 192, '', '2017-06-10 16:54:07'),
(17, 25, 192, '', '2017-06-10 16:54:07'),
(18, 25, 192, '', '2017-06-10 16:54:07'),
(19, 25, 192, '', '2017-06-10 16:54:07'),
(20, 25, 192, '', '2017-06-10 16:54:07'),
(21, 25, 192, '', '2017-06-10 16:54:08'),
(22, 25, 192, '', '2017-06-10 16:54:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `friend_requests`
--

CREATE TABLE `friend_requests` (
  `IDA` int(11) NOT NULL,
  `IDB` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `friend_requests`
--

INSERT INTO `friend_requests` (`IDA`, `IDB`, `date`, `message`) VALUES
(1, 2, '2017-05-17 14:13:57', NULL),
(1, 190, '2017-06-17 09:34:06', NULL),
(1, 192, '2017-06-17 15:05:02', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `photodislikes`
--

CREATE TABLE `photodislikes` (
  `idUser` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `photolikes`
--

CREATE TABLE `photolikes` (
  `idUser` int(11) NOT NULL,
  `idPhoto` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `photos`
--

CREATE TABLE `photos` (
  `IdPhoto` int(11) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(10,8) DEFAULT NULL,
  `IdUser` int(11) NOT NULL,
  `link` varchar(500) NOT NULL,
  `IdPost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `photos`
--

INSERT INTO `photos` (`IdPhoto`, `latitude`, `longitude`, `IdUser`, `link`, `IdPost`) VALUES
(1, '45.91101590', '11.03948580', 1, 'https://geo2.ggpht.com/cbk?panoid=pP8o7Dm9EV5ErGZdt5hcGg&output=thumbnail&cb_client=search.TACTILE.gps&thumb=2&w=408&h=200&yaw=303.4234&pitch=0&thumbfov=100', 0),
(2, '53.34838130', '-6.25955570', 1, '/images/posts/dublin.png', 0),
(3, '52.51625930', '13.37767900', 1, 'images/posts/593bbad61fdc012912118873_7c0ba35a29_o.jpg', 18),
(4, '46.06502480', '11.08277170', 190, 'images/posts/593c0a6fa4404190IMG_4176.JPG', 20),
(5, '46.26175300', '11.06406600', 191, 'images/posts/593c0a7ed8c42191la casa.png', 21),
(6, '11.06367970', '46.26237106', 190, 'images/posts/593c1c44d58d81905e4b5a1fe31d4e3a875d40b07955efa9_c1b966c18735412183964304748185dd_header.jpeg', 22),
(7, '46.26237106', '11.06367970', 190, 'images/posts/593c1c8d018f719015999-psychedelic-1920x1200-artistic-wallpaper.jpg', 23),
(8, '46.15222931', '11.09687996', 190, 'images/posts/593e8cbab7d2f190new_york_architecture_fisheye_buildings_skyscrapers_night_lights_hdr_1920x1080.jpg', 26);

-- --------------------------------------------------------

--
-- Struttura della tabella `postdislikes`
--

CREATE TABLE `postdislikes` (
  `idUser` int(11) NOT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `postdislikes`
--

INSERT INTO `postdislikes` (`idUser`, `idPost`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `postlikes`
--

CREATE TABLE `postlikes` (
  `idUser` int(11) NOT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `postlikes`
--

INSERT INTO `postlikes` (`idUser`, `idPost`) VALUES
(1, 1),
(1, 5),
(1, 6),
(1, 7),
(192, 25);

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `idPost` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `onIdUser` int(11) NOT NULL,
  `content` blob,
  `creationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`idPost`, `idUser`, `onIdUser`, `content`, `creationTime`) VALUES
(1, 1, 1, 0x42756f6e67696f726e6f2c206d6f6e646f21, '2017-05-22 17:20:45'),
(2, 1, 1, 0x51756573746f20c3a820696c206d696f207365636f6e646f20706f73742c206f67676920c3a820756e612062656c6c612067696f726e61746121203a29, '2017-05-22 17:22:31'),
(3, 1, 1, 0x4563636f20696c20336f20706f7374212121, '2017-05-22 17:22:58'),
(4, 1, 1, 0x41204769616e6c7563612050696c617469206e6f6e207069616363696f6e6f20692063756363696f6c69203a28, '2017-05-24 11:17:31'),
(5, 1, 1, 0x272064726f70207461626c652075736572733b202d2d, '2017-05-24 11:19:45'),
(6, 2, 2, 0x4369616f20612074757474692c20736f6e6f20437269737469616e6f, '2017-05-31 17:58:48'),
(7, 2, 2, 0x4f67676920686f2064656369736f20646920706f7374617265, '2017-05-31 17:59:11'),
(8, 1, 1, 0x4f6767692073746f20666163656e646f2070726f677265737369203a29, '2017-06-09 09:53:21'),
(9, 188, 188, 0x42656c6c6f2071756573746f20506c6163654e657421, '2017-06-09 09:54:19'),
(10, 1, 2, 0x4369616f20437269737469616e6f203a29, '2017-06-10 08:30:15'),
(15, 1, 2, 0x546920636f6e64697669646f2071756573746120666f746f21, '2017-06-10 09:20:01'),
(16, 1, 1, 0x4368652062656c6c6120666f746f, '2017-06-10 09:21:32'),
(17, 1, 1, 0x4368652062656c6c6120666f746f, '2017-06-10 09:24:05'),
(18, 1, 1, 0x4368652062656c6c6120666f746f, '2017-06-10 09:24:38'),
(19, 190, 191, 0x4369616f204d6172636f2c206772617a69652070657220617665722061636365747461746f206c61206d696120726963686965737461203a292929, '2017-06-10 14:50:25'),
(20, 190, 190, 0x4369616f2061207475747469212121, '2017-06-10 15:04:15'),
(21, 191, 190, '', '2017-06-10 15:04:30'),
(22, 190, 190, 0x42756f6e67696f726e6f206461204d6f6e636f766f, '2017-06-10 16:20:20'),
(23, 190, 190, 0x42756f6e6173657261203a29, '2017-06-10 16:21:33'),
(24, 192, 190, 0x53656920756e2063696363696f6e6520, '2017-06-10 16:51:52'),
(25, 192, 192, 0x53746f206775617264616e646f20756e2066696c6d20636865206e6f6e206d692070696163652065204d617474656f20c3a82063696363696f6e65, '2017-06-10 16:53:16'),
(26, 190, 190, 0x4369616f2061207475747469206461205a616d62616e61, '2017-06-12 12:44:42'),
(27, 1, 190, 0x4369616f204d617474656f2c206772617a69652070657220506c6163654e6574212121, '2017-06-17 14:55:13'),
(28, 190, 1, 0x4369616f204d6172696f2c206772617a696520706572206573736572746920697363726974746f203a29, '2017-06-17 14:56:25'),
(29, 190, 192, 0x4369616f20446965676f203a29, '2017-06-17 14:58:00'),
(30, 1, 192, 0x4369616f20646965676f, '2017-06-17 15:00:55'),
(31, 1, 192, 0x4772617a69652070657220617665726d692061676769756e746f21, '2017-06-17 15:05:00'),
(32, 1, 193, 0x5065726368c3a9206e6f6e207469207069616363696f6e6f20692063756363696f6c693f, '2017-06-17 15:07:28'),
(33, 1, 193, 0x4369616f, '2017-06-17 15:08:12');

-- --------------------------------------------------------

--
-- Struttura della tabella `relations`
--

CREATE TABLE `relations` (
  `IDA` int(11) NOT NULL,
  `IDB` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `relations`
--

INSERT INTO `relations` (`IDA`, `IDB`) VALUES
(1, 2),
(190, 191),
(192, 190),
(193, 190);

-- --------------------------------------------------------

--
-- Struttura della tabella `tokens`
--

CREATE TABLE `tokens` (
  `token` varchar(64) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `tokens`
--

INSERT INTO `tokens` (`token`, `mail`, `name`, `surname`, `password`) VALUES
('3d4e9c3add8ee388f22208f3ce3b4b3d', 'leo.comper97@hotmail.com', 'leonardo', 'comper', 'leoleo1810'),
('5953095828124374642b6843b1fb891d', 'cristiano.vergari@marconirovereto.it', 'Cristiano', 'Vergari', 'VergaDoro');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Name` blob NOT NULL,
  `Surname` blob NOT NULL,
  `Mail` blob NOT NULL,
  `Password` blob NOT NULL,
  `Cover_img` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `Profile_img` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `addressLat` decimal(10,8) DEFAULT NULL,
  `addressLon` decimal(10,8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`ID`, `Name`, `Surname`, `Mail`, `Password`, `Cover_img`, `Profile_img`, `sex`, `addressLat`, `addressLon`) VALUES
(1, 0x4d6172696f, 0x526f737369, 0x6d6172696f2e726f737369406d61696c2e6974, 0x4d6172696f42656c6c6f31, 'http://www.hdfbcover.com/randomcovers/covers/keep-smiling-Facebook-covers.jpg', 'images/profiles/593bf051cf9e31Cover.jpg', NULL, NULL, NULL),
(2, 0x437269737469616e6f, 0x56657267617269, 0x637269737469616e6f2e76657267617269406d6172636f6e69726f76657265746f2e6974, 0x5665726761726931, 'https://andreaabagnale.files.wordpress.com/2012/12/baby-panda-wallpaper.jpg', 'images/vergari.jpg', NULL, NULL, NULL),
(171, 0x677265676f7279, 0x776f6f64, 0x677265676f72792e776f6f64406578616d706c652e636f6d, 0x6c696c6c69616e, NULL, 'https://randomuser.me/api/portraits/men/88.jpg', NULL, NULL, NULL),
(170, 0x6173686572, 0x777269676874, 0x61736865722e777269676874406578616d706c652e636f6d, 0x313335373930, NULL, 'https://randomuser.me/api/portraits/men/67.jpg', NULL, NULL, NULL),
(169, 0x67696c626572746f, 0x63617374726f, 0x67696c626572746f2e63617374726f406578616d706c652e636f6d, 0x3231313232313132, NULL, 'https://randomuser.me/api/portraits/men/89.jpg', NULL, NULL, NULL),
(168, 0x6a6f656c, 0x61726f6c61, 0x6a6f656c2e61726f6c61406578616d706c652e636f6d, 0x7175616c697479, NULL, 'https://randomuser.me/api/portraits/men/95.jpg', NULL, NULL, NULL),
(167, 0x6976616e, 0x6e65616c, 0x6976616e2e6e65616c406578616d706c652e636f6d, 0x62656c6c, NULL, 'https://randomuser.me/api/portraits/men/71.jpg', NULL, NULL, NULL),
(166, 0x6f73636172, 0x63616d706f73, 0x6f736361722e63616d706f73406578616d706c652e636f6d, 0x726963686d6f6e64, NULL, 'https://randomuser.me/api/portraits/men/54.jpg', NULL, NULL, NULL),
(165, 0x656d696c65, 0x6272756e, 0x656d696c652e6272756e406578616d706c652e636f6d, 0x707269657374, NULL, 'https://randomuser.me/api/portraits/men/88.jpg', NULL, NULL, NULL),
(164, 0x637269737469616e, 0x63616272657261, 0x637269737469616e2e63616272657261406578616d706c652e636f6d, 0x7269676874, NULL, 'https://randomuser.me/api/portraits/men/41.jpg', NULL, NULL, NULL),
(163, 0x616c6578616e646572, 0x6e677579656e, 0x616c6578616e6465722e6e677579656e406578616d706c652e636f6d, 0x6d616e6368657374, NULL, 'https://randomuser.me/api/portraits/men/97.jpg', NULL, NULL, NULL),
(162, 0x736f72656e, 0x676972617564, 0x736f72656e2e676972617564406578616d706c652e636f6d, 0x7a7a7a7a7a7a7a, NULL, 'https://randomuser.me/api/portraits/men/12.jpg', NULL, NULL, NULL),
(161, 0xd8b9d8a8d8a7d8b3, 0xd8addb8cd8afd8b1db8c, 0xd8b9d8a8d8a7d8b32ed8addb8cd8afd8b1db8c406578616d706c652e636f6d, 0x77696c6466697265, NULL, 'https://randomuser.me/api/portraits/men/95.jpg', NULL, NULL, NULL),
(160, 0x6a61636f62, 0x6d6f6f7265, 0x6a61636f622e6d6f6f7265406578616d706c652e636f6d, 0x74726f75626c65, NULL, 'https://randomuser.me/api/portraits/men/50.jpg', NULL, NULL, NULL),
(159, 0xd985d987d8afdb8cd8b3, 0xd986d983d98820d986d8b8d8b1, 0xd985d987d8afdb8cd8b32ed986d983d988d986d8b8d8b1406578616d706c652e636f6d, 0x6368617365, NULL, 'https://randomuser.me/api/portraits/women/89.jpg', NULL, NULL, NULL),
(158, 0x6d61636974, 0x6567656c69, 0x6d616369742e6567656c69406578616d706c652e636f6d, 0x323532353235, NULL, 'https://randomuser.me/api/portraits/men/4.jpg', NULL, NULL, NULL),
(157, 0x61696e6f, 0x6c656874696e656e, 0x61696e6f2e6c656874696e656e406578616d706c652e636f6d, 0x67657262696c, NULL, 'https://randomuser.me/api/portraits/women/33.jpg', NULL, NULL, NULL),
(156, 0x73656261737469616e, 0x6a6f6e6573, 0x73656261737469616e2e6a6f6e6573406578616d706c652e636f6d, 0x6f6666696365, NULL, 'https://randomuser.me/api/portraits/men/92.jpg', NULL, NULL, NULL),
(155, 0x6c6f67616e, 0x6d6f72696e, 0x6c6f67616e2e6d6f72696e406578616d706c652e636f6d, 0x3230323032303230, NULL, 'https://randomuser.me/api/portraits/men/68.jpg', NULL, NULL, NULL),
(154, 0x74616d617261, 0x706f72746f, 0x74616d6172612e706f72746f406578616d706c652e636f6d, 0x6368726973, NULL, 'https://randomuser.me/api/portraits/women/90.jpg', NULL, NULL, NULL),
(153, 0x667269656472696368, 0x706f7070, 0x6672696564726963682e706f7070406578616d706c652e636f6d, 0x776f6f6479, NULL, 'https://randomuser.me/api/portraits/men/17.jpg', NULL, NULL, NULL),
(152, 0x6176657279, 0x6672656e6368, 0x61766572792e6672656e6368406578616d706c652e636f6d, 0x6d616a6f72, NULL, 'https://randomuser.me/api/portraits/women/37.jpg', NULL, NULL, NULL),
(151, 0x6a6f73696e69, 0x6461206d6f7461, 0x6a6f73696e692e64616d6f7461406578616d706c652e636f6d, 0x636c75746368, NULL, 'https://randomuser.me/api/portraits/women/73.jpg', NULL, NULL, NULL),
(150, 0x6c75636965, 0x617562657274, 0x6c756369652e617562657274406578616d706c652e636f6d, 0x726f626572746f, NULL, 'https://randomuser.me/api/portraits/women/54.jpg', NULL, NULL, NULL),
(149, 0x6875676f, 0x6865726e616e64657a, 0x6875676f2e6865726e616e64657a406578616d706c652e636f6d, 0x66617274, NULL, 'https://randomuser.me/api/portraits/men/74.jpg', NULL, NULL, NULL),
(148, 0x6d617267617578, 0x6d6f72656175, 0x6d6172676175782e6d6f72656175406578616d706c652e636f6d, 0x616e67656c73, NULL, 'https://randomuser.me/api/portraits/women/96.jpg', NULL, NULL, NULL),
(147, 0x6d6172696f, 0x6d6f72656e6f, 0x6d6172696f2e6d6f72656e6f406578616d706c652e636f6d, 0x73616e646965676f, NULL, 'https://randomuser.me/api/portraits/men/94.jpg', NULL, NULL, NULL),
(146, 0x616c65786973, 0x62726f776e, 0x616c657869732e62726f776e406578616d706c652e636f6d, 0x6265656663616b65, NULL, 'https://randomuser.me/api/portraits/women/33.jpg', NULL, NULL, NULL),
(145, 0x64656e697a, 0x736f6c6d617a, 0x64656e697a2e736f6c6d617a406578616d706c652e636f6d, 0x3235383032353830, NULL, 'https://randomuser.me/api/portraits/women/81.jpg', NULL, NULL, NULL),
(144, 0x63657968756e, 0x79c4b16c64c4b172c4b16d, 0x63657968756e2e79c4b16c64c4b172c4b16d406578616d706c652e636f6d, 0x636c6f756473, NULL, 'https://randomuser.me/api/portraits/men/20.jpg', NULL, NULL, NULL),
(143, 0x6a756c6965, 0x6761726e696572, 0x6a756c69652e6761726e696572406578616d706c652e636f6d, 0x706f6b6572, NULL, 'https://randomuser.me/api/portraits/women/38.jpg', NULL, NULL, NULL),
(142, 0x65766572657474, 0x67726179, 0x657665726574742e67726179406578616d706c652e636f6d, 0x7065636b6572, NULL, 'https://randomuser.me/api/portraits/men/35.jpg', NULL, NULL, NULL),
(141, 0x6c6f75616e65, 0x726f62657274, 0x6c6f75616e652e726f62657274406578616d706c652e636f6d, 0x626c6f6f6479, NULL, 'https://randomuser.me/api/portraits/women/67.jpg', NULL, NULL, NULL),
(140, 0x70656472616d, 0x76616e2064652072656570, 0x70656472616d2e76616e646572656570406578616d706c652e636f6d, 0x736861727065, NULL, 'https://randomuser.me/api/portraits/men/56.jpg', NULL, NULL, NULL),
(139, 0x746572657361, 0x677565727265726f, 0x7465726573612e677565727265726f406578616d706c652e636f6d, 0x316d69636861656c, NULL, 'https://randomuser.me/api/portraits/women/22.jpg', NULL, NULL, NULL),
(138, 0x6e69786f6e, 0x6576616e73, 0x6e69786f6e2e6576616e73406578616d706c652e636f6d, 0x6a656570, NULL, 'https://randomuser.me/api/portraits/men/77.jpg', NULL, NULL, NULL),
(137, 0x6169746f72, 0x647572616e, 0x6169746f722e647572616e406578616d706c652e636f6d, 0x646f67676572, NULL, 'https://randomuser.me/api/portraits/men/17.jpg', NULL, NULL, NULL),
(136, 0x616c65786961, 0x73616e6368657a, 0x616c657869612e73616e6368657a406578616d706c652e636f6d, 0x666c6f756e646572, NULL, 'https://randomuser.me/api/portraits/women/4.jpg', NULL, NULL, NULL),
(135, 0x6f6f6e61, 0x77697274616e656e, 0x6f6f6e612e77697274616e656e406578616d706c652e636f6d, 0x62616e676b6f6b, NULL, 'https://randomuser.me/api/portraits/women/69.jpg', NULL, NULL, NULL),
(134, 0x6969726973, 0x74616e6e6572, 0x69697269732e74616e6e6572406578616d706c652e636f6d, 0x726164696f, NULL, 'https://randomuser.me/api/portraits/women/58.jpg', NULL, NULL, NULL),
(133, 0x62656e6a616d696e, 0x6d617274696e, 0x62656e6a616d696e2e6d617274696e406578616d706c652e636f6d, 0x7368616e6e6f6e31, NULL, 'https://randomuser.me/api/portraits/men/93.jpg', NULL, NULL, NULL),
(132, 0x726f6e, 0x68616d696c746f6e, 0x726f6e2e68616d696c746f6e406578616d706c652e636f6d, 0x7468756d6273, NULL, 'https://randomuser.me/api/portraits/men/46.jpg', NULL, NULL, NULL),
(131, 0x62726f6f6b6c796e, 0x686f706b696e73, 0x62726f6f6b6c796e2e686f706b696e73406578616d706c652e636f6d, 0x726f62696e73, NULL, 'https://randomuser.me/api/portraits/women/3.jpg', NULL, NULL, NULL),
(130, 0x6d6f7267616e, 0x676972617264, 0x6d6f7267616e2e676972617264406578616d706c652e636f6d, 0x6d656c616e6965, NULL, 'https://randomuser.me/api/portraits/men/95.jpg', NULL, NULL, NULL),
(129, 0x656c697a6162657468, 0x7461796c6f72, 0x656c697a61626574682e7461796c6f72406578616d706c652e636f6d, 0x626564666f7264, NULL, 'https://randomuser.me/api/portraits/women/62.jpg', NULL, NULL, NULL),
(128, 0x72756469, 0x736368696c6c6572, 0x727564692e736368696c6c6572406578616d706c652e636f6d, 0x63616d653131, NULL, 'https://randomuser.me/api/portraits/men/45.jpg', NULL, NULL, NULL),
(127, 0x6b617472696e65, 0x7261736d757373656e, 0x6b617472696e652e7261736d757373656e406578616d706c652e636f6d, 0x74696e6b6572, NULL, 'https://randomuser.me/api/portraits/women/76.jpg', NULL, NULL, NULL),
(126, 0x616e67656c, 0x636f6f6b, 0x616e67656c2e636f6f6b406578616d706c652e636f6d, 0x6a616371756573, NULL, 'https://randomuser.me/api/portraits/men/5.jpg', NULL, NULL, NULL),
(125, 0x73696d6f6e, 0x6a6f6e6573, 0x73696d6f6e2e6a6f6e6573406578616d706c652e636f6d, 0x6368656e, NULL, 'https://randomuser.me/api/portraits/men/5.jpg', NULL, NULL, NULL),
(124, 0x696c6f6e61, 0x77696974616c61, 0x696c6f6e612e77696974616c61406578616d706c652e636f6d, 0x6d61696c6d616e, NULL, 'https://randomuser.me/api/portraits/women/62.jpg', NULL, NULL, NULL),
(123, 0x6f66c3a96c6961, 0x6e756e6573, 0x6f66c3a96c69612e6e756e6573406578616d706c652e636f6d, 0x7468756d626e696c73, NULL, 'https://randomuser.me/api/portraits/women/85.jpg', NULL, NULL, NULL),
(122, 0xd8b9d984db8cd8b1d8b6d8a7, 0xd8a7d8add985d8afdb8c, 0xd8b9d984db8cd8b1d8b6d8a72ed8a7d8add985d8afdb8c406578616d706c652e636f6d, 0x626f776c696e67, NULL, 'https://randomuser.me/api/portraits/men/1.jpg', NULL, NULL, NULL),
(121, 0x6e617468616e61c3ab6c, 0x726f6c6c616e64, 0x6e617468616e61c3ab6c2e726f6c6c616e64406578616d706c652e636f6d, 0x6669736879, NULL, 'https://randomuser.me/api/portraits/men/82.jpg', NULL, NULL, NULL),
(120, 0x7665726f6e696361, 0x68696c6c, 0x7665726f6e6963612e68696c6c406578616d706c652e636f6d, 0x63687269737479, NULL, 'https://randomuser.me/api/portraits/women/74.jpg', NULL, NULL, NULL),
(119, 0x7376656e6a61, 0x6d61796572, 0x7376656e6a612e6d61796572406578616d706c652e636f6d, 0x353235323532, NULL, 'https://randomuser.me/api/portraits/women/78.jpg', NULL, NULL, NULL),
(118, 0x6461767574, 0x6572626179, 0x64617675742e6572626179406578616d706c652e636f6d, 0x6669656c6473, NULL, 'https://randomuser.me/api/portraits/men/24.jpg', NULL, NULL, NULL),
(117, 0x68656e7279, 0x6d6f6f7265, 0x68656e72792e6d6f6f7265406578616d706c652e636f6d, 0x62656e6e657474, NULL, 'https://randomuser.me/api/portraits/men/63.jpg', NULL, NULL, NULL),
(116, 0xc3bc6c6bc3bc, 0x7965746b696e6572, 0xc3bc6c6bc3bc2e7965746b696e6572406578616d706c652e636f6d, 0x6f656469707573, NULL, 'https://randomuser.me/api/portraits/women/15.jpg', NULL, NULL, NULL),
(115, 0x6d61676e7573, 0x63687269737469616e73656e, 0x6d61676e75732e63687269737469616e73656e406578616d706c652e636f6d, 0x736f6c7574696f6e, NULL, 'https://randomuser.me/api/portraits/men/34.jpg', NULL, NULL, NULL),
(114, 0xd8a7db8cd984db8cd8a7, 0xd8b1d8b6d8a7db8cdb8c, 0xd8a7db8cd984db8cd8a72ed8b1d8b6d8a7db8cdb8c406578616d706c652e636f6d, 0x736369656e6365, NULL, 'https://randomuser.me/api/portraits/men/85.jpg', NULL, NULL, NULL),
(113, 0x67656e65, 0x73616e6368657a, 0x67656e652e73616e6368657a406578616d706c652e636f6d, 0x616e74686f6e79, NULL, 'https://randomuser.me/api/portraits/men/34.jpg', NULL, NULL, NULL),
(112, 0x6a6f68616e, 0x706f756c73656e, 0x6a6f68616e2e706f756c73656e406578616d706c652e636f6d, 0x74726f79, NULL, 'https://randomuser.me/api/portraits/men/82.jpg', NULL, NULL, NULL),
(111, 0x61726961, 0x74686f6d70736f6e, 0x617269612e74686f6d70736f6e406578616d706c652e636f6d, 0x7374756e6e6572, NULL, 'https://randomuser.me/api/portraits/women/24.jpg', NULL, NULL, NULL),
(110, 0x66656e61, 0x7669616e61, 0x66656e612e7669616e61406578616d706c652e636f6d, 0x62697a6b6974, NULL, 'https://randomuser.me/api/portraits/women/49.jpg', NULL, NULL, NULL),
(109, 0x6e6563617469, 0x70616b73c3bc74, 0x6e65636174692e70616b73c3bc74406578616d706c652e636f6d, 0x6d6f6f6e6579, NULL, 'https://randomuser.me/api/portraits/men/39.jpg', NULL, NULL, NULL),
(108, 0xd985d8add985d8af, 0xd8b1d8b6d8a7db8cdb8c, 0xd985d8add985d8af2ed8b1d8b6d8a7db8cdb8c406578616d706c652e636f6d, 0x77697a61726431, NULL, 'https://randomuser.me/api/portraits/men/25.jpg', NULL, NULL, NULL),
(107, 0x7365616e, 0x64756e63616e, 0x7365616e2e64756e63616e406578616d706c652e636f6d, 0x686f74617373, NULL, 'https://randomuser.me/api/portraits/men/97.jpg', NULL, NULL, NULL),
(106, 0x746f6464, 0x72686f646573, 0x746f64642e72686f646573406578616d706c652e636f6d, 0x6d656d62657273, NULL, 'https://randomuser.me/api/portraits/men/38.jpg', NULL, NULL, NULL),
(105, 0x6f6e64696e6f, 0x6e617363696d656e746f, 0x6f6e64696e6f2e6e617363696d656e746f406578616d706c652e636f6d, 0x77656e6479, NULL, 'https://randomuser.me/api/portraits/men/1.jpg', NULL, NULL, NULL),
(104, 0x7269636172646f, 0x6772616e74, 0x7269636172646f2e6772616e74406578616d706c652e636f6d, 0x3171327733653472, NULL, 'https://randomuser.me/api/portraits/men/40.jpg', NULL, NULL, NULL),
(103, 0x66616269656e, 0x73696d6f6e, 0x66616269656e2e73696d6f6e406578616d706c652e636f6d, 0x736b6970, NULL, 'https://randomuser.me/api/portraits/men/18.jpg', NULL, NULL, NULL),
(172, 0x66616e6e79, 0x63617270656e74696572, 0x66616e6e792e63617270656e74696572406578616d706c652e636f6d, 0x67616767696e67, NULL, 'https://randomuser.me/api/portraits/women/88.jpg', NULL, NULL, NULL),
(173, 0x7665646174, 0x616bc4b1c59fc4b16b, 0x76656461742e616bc4b1c59fc4b16b406578616d706c652e636f6d, 0x3133313331333133, NULL, 'https://randomuser.me/api/portraits/men/8.jpg', NULL, NULL, NULL),
(174, 0x6c6f75, 0x7065746974, 0x6c6f752e7065746974406578616d706c652e636f6d, 0x67616c6572696573, NULL, 'https://randomuser.me/api/portraits/women/50.jpg', NULL, NULL, NULL),
(175, 0x7061696765, 0x686172726973, 0x70616967652e686172726973406578616d706c652e636f6d, 0x6475636b73, NULL, 'https://randomuser.me/api/portraits/women/5.jpg', NULL, NULL, NULL),
(176, 0x6a6572656d696168, 0x77696c736f6e, 0x6a6572656d6961682e77696c736f6e406578616d706c652e636f6d, 0x66616d6f7573, NULL, 'https://randomuser.me/api/portraits/men/35.jpg', NULL, NULL, NULL),
(177, 0x666cc3a176696f, 0x6d617274696e73, 0x666cc3a176696f2e6d617274696e73406578616d706c652e636f6d, 0x6272756365, NULL, 'https://randomuser.me/api/portraits/men/99.jpg', NULL, NULL, NULL),
(178, 0x726fc3ab6c6c65, 0x6265636b6572, 0x726fc3ab6c6c652e6265636b6572406578616d706c652e636f6d, 0x706f7461746f, NULL, 'https://randomuser.me/api/portraits/women/1.jpg', NULL, NULL, NULL),
(179, 0x766963746f72, 0x6d6f72616c6573, 0x766963746f722e6d6f72616c6573406578616d706c652e636f6d, 0x6f6f6f6f6f6f, NULL, 'https://randomuser.me/api/portraits/men/32.jpg', NULL, NULL, NULL),
(180, 0x73616d75656c, 0x6b696e6e756e656e, 0x73616d75656c2e6b696e6e756e656e406578616d706c652e636f6d, 0x776865656c73, NULL, 'https://randomuser.me/api/portraits/men/80.jpg', NULL, NULL, NULL),
(181, 0x6865726d656c696e6461, 0x63616c6465697261, 0x6865726d656c696e64612e63616c6465697261406578616d706c652e636f6d, 0x647572616e676f, NULL, 'https://randomuser.me/api/portraits/women/23.jpg', NULL, NULL, NULL),
(182, 0x6a6f, 0x77656c6368, 0x6a6f2e77656c6368406578616d706c652e636f6d, 0x6f7263686964, NULL, 'https://randomuser.me/api/portraits/women/25.jpg', NULL, NULL, NULL),
(183, 0x636861726c6f747465, 0x6162726168616d, 0x636861726c6f7474652e6162726168616d406578616d706c652e636f6d, 0x706570706572, NULL, 'https://randomuser.me/api/portraits/women/2.jpg', NULL, NULL, NULL),
(184, 0x6672616e6369736361, 0x67696d656e657a, 0x6672616e63697363612e67696d656e657a406578616d706c652e636f6d, 0x7369656d656e73, NULL, 'https://randomuser.me/api/portraits/women/80.jpg', NULL, NULL, NULL),
(185, 0x6d61c3ab6c6961, 0x706963617264, 0x6d61c3ab6c69612e706963617264406578616d706c652e636f6d, 0x68756e74, NULL, 'https://randomuser.me/api/portraits/women/32.jpg', NULL, NULL, NULL),
(186, 0x736f666961, 0x636162616c6c65726f, 0x736f6669612e636162616c6c65726f406578616d706c652e636f6d, 0x766f79657572, NULL, 'https://randomuser.me/api/portraits/women/12.jpg', NULL, NULL, NULL),
(187, 0x65657475, 0x72616e74616c61, 0x656574752e72616e74616c61406578616d706c652e636f6d, 0x6564756172646f, NULL, 'https://randomuser.me/api/portraits/men/13.jpg', NULL, NULL, NULL),
(188, 0x4c756361, 0x4d6f72616e64696e69, 0x6c7563612e6d6f72616e64696e69393840676d61696c2e636f6d, 0x6d6573736d6572, NULL, 'images/profiles/593a6a651f5b3188il cantastorie.jpg', NULL, NULL, NULL),
(190, 0x6d617474656f, 0x6d6573736d6572, 0x6d617474656f2e6d73736d7240676d61696c2e636f6d, 0x4d6573736d657231, 'images/covers/5944fbf6e30c419058465_the_simpsons_stupid_world_homer_simpson.jpg', 'images/profiles/5944fc16ecb8e190Piet_Program_Hello_World.gif', 'M', '46.26161000', '11.06361000'),
(191, 0x4d6172636f, 0x4d6573736d6572, 0x6d6172636f2e6d73736d7240676d61696c2e636f6d, 0x4d6174656f63756c6f, NULL, 'images/profiles/593c07dbcd5ba191the magik jack.png', NULL, NULL, NULL),
(192, 0x646965676f, 0x4c6f6d6261726469, 0x446965676f6c6f6d62617264692e646c40676d61696c2e636f6d, 0x646965676f3032, NULL, NULL, NULL, NULL, NULL),
(193, 0x4769616e6c756361, 0x50696c617469, 0x70696c6174692e6769616e40676d61696c2e636f6d, 0x50696c61746931, NULL, NULL, NULL, NULL, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComment`);

--
-- Indici per le tabelle `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`IDA`,`IDB`);

--
-- Indici per le tabelle `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`IdPhoto`);

--
-- Indici per le tabelle `postdislikes`
--
ALTER TABLE `postdislikes`
  ADD PRIMARY KEY (`idUser`,`idPost`);

--
-- Indici per le tabelle `postlikes`
--
ALTER TABLE `postlikes`
  ADD PRIMARY KEY (`idUser`,`idPost`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idPost`);

--
-- Indici per le tabelle `relations`
--
ALTER TABLE `relations`
  ADD PRIMARY KEY (`IDA`,`IDB`);

--
-- Indici per le tabelle `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`token`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `comments`
--
ALTER TABLE `comments`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT per la tabella `photos`
--
ALTER TABLE `photos`
  MODIFY `IdPhoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
