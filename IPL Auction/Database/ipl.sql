-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2018 at 11:08 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipl`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `sold_cpy`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sold_cpy` ()  begin
 declare f int default 0;
 declare player_id1 int;
 declare role1 varchar(20);
 declare player_name1 varchar(20);
  declare team_name1 varchar(20);
 declare base_price1 bigint;
declare points1 int;
declare team_id1 int;
declare bid_price1 bigint;
declare a bigint;
declare c1 cursor for select role, player_id,player_name,base_price,points,team_id,team_name,bid_price from bids ORDER BY bid_price DESC LIMIT 1;
declare continue handler for NOT FOUND set f=1;
 open c1;
 l1:loop
 fetch c1 into  role1, player_id1,player_name1,base_price1,points1,team_id1,team_name1,bid_price1;
 if f=1 then
 leave l1;
 end if;
 insert into sold_players( role, player_id,player_name,base_price,points,team_id,team_name,bid_price) values( role1, player_id1,player_name1,base_price1,points1,team_id1,team_name1,bid_price1);
 iterate l1;
 end loop l1;
  UPDATE players SET status='SOLD' WHERE player_id=player_id1;
  UPDATE teams SET balance=balance-bid_price1 WHERE team_name=team_name1;
 DELETE FROM bids; 
 close c1;
 end$$

DROP PROCEDURE IF EXISTS `unsold_cpy`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `unsold_cpy` ()  begin
 declare f int default 0;
 declare player_id1 int;
 declare role1 varchar(20);
 declare player_name1 varchar(20);
 declare base_price1 bigint;
declare points1 int;
declare c1 cursor for select role, player_id,player_name,base_price,points from bids;
declare continue handler for NOT FOUND set f=1;
 open c1;
 l2:loop
 fetch c1 into  role1, player_id1,player_name1,base_price1,points1;
 if f=1 then
 leave l2;
 end if;
 insert into unsold_players( role, player_id,player_name,base_price,points) values( role1, player_id1,player_name1,base_price1,points1);
 iterate l2;
 end loop l2;
 close c1;
 UPDATE players SET status='UNSOLD' WHERE player_id=player_id1;
 DELETE FROM bids;
 end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `all_rounder`
--

DROP TABLE IF EXISTS `all_rounder`;
CREATE TABLE IF NOT EXISTS `all_rounder` (
  `player_id` int(11) NOT NULL,
  `batting_style` varchar(20) NOT NULL,
  `runs` int(11) NOT NULL,
  `high_score` int(11) NOT NULL,
  `bowling_style` varchar(50) NOT NULL,
  `wickets` int(11) NOT NULL,
  `best_bowl` varchar(20) NOT NULL,
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_rounder`
--

INSERT INTO `all_rounder` (`player_id`, `batting_style`, `runs`, `high_score`, `bowling_style`, `wickets`, `best_bowl`) VALUES
(68, 'RIGHT-HANDED', 220, 39, 'RIGHT-ARM-MEDIUM FAST', 9, '20\\2'),
(69, 'LEFT-HANDED', 77, 65, 'RIGHT-ARM-OFF-SPIN', 3, '31\\1'),
(70, 'RIGHT-HANDED', 446, 39, 'RIGHT-ARM-MEDIUM FAST', 34, '10\\2'),
(71, 'LEFT-HANDED', 2652, 83, 'LEFT-ARM-ORTHODOX-SPIN', 36, '29\\4'),
(72, 'RIGHT-HANDED', 1379, 70, 'RIGHT-ARM-MEDIUM FAST', 136, '22\\4'),
(73, 'LEFT-HANDED', 512, 103, 'RIGHT-ARM-MEDIUM FAST', 20, '15\\3'),
(74, 'LEFT-HANDED', 1821, 48, 'LEFT-ARM-ORTHODOX-SPIN', 93, '16\\5'),
(75, 'LEFT-HANDED', 686, 44, 'LEFT-ARM-ORTHODOX-SPIN', 61, '21\\4'),
(76, 'RIGHT-HANDED', 0, 0, 'RIGHT-ARM-MEDIUM', 3, '43\\2'),
(77, 'LEFT-HANDED', 2029, 87, 'RIGHT-ARM-OFF-SPIN', 23, '17\\4'),
(78, 'RIGHT-HANDED', 3177, 117, 'RIGHT-ARM-MEDIUM-FAST', 92, '29\\4'),
(79, 'RIGHT-HANDED', 2476, 78, 'RIGHT-ARM-MEDIUM', 56, '44\\4'),
(80, 'RIGHT-HANDED', 1397, 95, 'RIGHT-ARM-OFF-SPIN', 16, '15\\2'),
(81, 'RIGHT-HANDED', 485, 82, 'RIGHT-ARM-MEDIUM-FAST', 56, '23\\4'),
(82, 'RIGHT-HANDED', 29, 12, 'RIGHT-ARM-MEDIUM-FAST', 0, '0'),
(83, 'LEFT-HANDED', 0, 0, 'LEFT-ARM-ORTHODOX-SPIN', 0, '0'),
(84, 'LEFT-HANDED', 538, 95, 'LEFT-ARM-MEDIUM-FAST', 11, '18\\2'),
(85, 'RIGHT-HANDED', 313, 63, 'RIGHT-ARM-OFFBREAK', 1, '21\\1'),
(86, 'RIGHT-HANDED', 0, 0, 'LEFT-ARM-MEDIUM-FAST', 2, '24\\1'),
(87, 'LEFT-HANDED', 356, 36, 'LEFT-ARM-ORTHODOX-SPIN', 31, '18\\4'),
(88, 'RIGHT-HANDED', 23, 18, 'RIGHT-ARM-MEDIUM-FAST', 6, '19\\2'),
(89, 'RIGHT-HANDED', 257, 40, 'RIGHT-ARM-MEDIUM', 6, '4\\3'),
(90, 'RIGHT-HANDED', 262, 52, 'RIGHT-ARM-MEDIUM-FAST', 13, '15\\4'),
(91, 'LEFT-HANDED', 737, 66, 'LEFT-ARM-ORTHODOX-SPIN', 57, '17\\3'),
(92, 'RIGHT-HANDED', 63, 18, 'RIGHT-ARM-MEDIUM-FAST', 25, '6/3'),
(93, 'RIGHT-HANDED', 460, 54, 'RIGHT-ARM-MEDIUM-FAST', 6, '16\\2'),
(94, 'RIGHT-HANDED', 170, 43, 'RIGHT-ARM-MEDIUM-FAST', 13, '47\\3'),
(151, 'RIGHT-HANDED', 890, 88, 'RIGHT-ARM FAST', 44, '20\\4');

-- --------------------------------------------------------

--
-- Table structure for table `auctioner`
--

DROP TABLE IF EXISTS `auctioner`;
CREATE TABLE IF NOT EXISTS `auctioner` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auctioner`
--

INSERT INTO `auctioner` (`username`, `password`) VALUES
('pratik', 'pratik123'),
('sachin', 'sachin123'),
('omkar', 'omkar123'),
('sanket', 'sanket123');

-- --------------------------------------------------------

--
-- Table structure for table `batsman`
--

DROP TABLE IF EXISTS `batsman`;
CREATE TABLE IF NOT EXISTS `batsman` (
  `player_id` int(11) NOT NULL,
  `batting_style` varchar(20) NOT NULL,
  `runs` int(11) NOT NULL,
  `high_score` int(11) NOT NULL,
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batsman`
--

INSERT INTO `batsman` (`player_id`, `batting_style`, `runs`, `high_score`) VALUES
(1, 'RIGHT-HANDED', 4948, 113),
(2, 'RIGHT-HANDED', 1124, 72),
(3, 'RIGHT-HANDED', 917, 69),
(4, 'RIGHT-HANDED', 334, 56),
(5, 'LEFT-HANDED', 382, 65),
(6, 'RIGHT-HANDED', 1457, 73),
(7, 'RIGHT-HANDED', 1364, 77),
(8, 'RIGHT-HANDED', 245, 65),
(9, 'RIGHT-HANDED', 934, 68),
(10, 'LEFT-HANDED', 1276, 61),
(11, 'RIGHT-HANDED', 1738, 88),
(12, 'RIGHT-HANDED', 228, 45),
(13, 'LEFT-HANDED', 4985, 100),
(14, 'RIGHT-HANDED', 0, 0),
(15, 'RIGHT-HANDED', 4493, 109),
(16, 'RIGHT-HANDED', 0, 0),
(17, 'LEFT-HANDED', 741, 70),
(18, 'RIGHT-HANDED', 0, 0),
(19, 'RIGHT-HANDED', 1459, 83),
(20, 'LEFT-HANDED', 0, 0),
(21, 'LEFT-HANDED', 1637, 101),
(22, 'LEFT-HANDED', 0, 0),
(23, 'RIGHT-HANDED', 8, 8),
(24, 'RIGHT-HANDED', 0, 0),
(25, 'RIGHT-HANDED', 0, 0),
(26, 'RIGHT-HANDED', 1218, 96),
(27, 'LEFT-HANDED', 3994, 175),
(28, 'RIGHT-HANDED', 2523, 127),
(29, 'LEFT-HANDED', 76, 28),
(30, 'RIGHT-HANDED', 1146, 89),
(31, 'LEFT-HANDED', 93, 33),
(32, 'LEFT-HANDED', 0, 0),
(33, 'RIGHT-HANDED', 0, 0),
(34, 'RIGHT-HANDED', 875, 93),
(35, 'RIGHT-HANDED', 19, 18),
(36, 'RIGHT-HANDED', 179, 91),
(37, 'RIGHT-HANDED', 1695, 75),
(38, 'RIGHT-HANDED', 203, 57),
(39, 'LEFT-HANDED', 4217, 93),
(40, 'LEFT-HANDED', 0, 0),
(41, 'RIGHT-HANDED', 1012, 95),
(42, 'LEFT-HANDED', 29, 16),
(43, 'RIGHT-HANDED', 2499, 114),
(44, 'RIGHT-HANDED', 342, 51),
(45, 'LEFT-HANDED', 115, 44),
(46, 'RIGHT-HANDED', 148, 45),
(47, 'RIGHT-HANDED', 57, 32),
(48, 'RIGHT-HANDED', 617, 93),
(49, 'LEFT-HANDED', 4058, 95),
(50, 'LEFT-HANDED', 137, 33),
(51, 'RIGHT-HANDED', 3427, 103);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `role` varchar(20) NOT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(50) NOT NULL,
  `base_price` bigint(20) NOT NULL,
  `points` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `team_name` varchar(20) DEFAULT NULL,
  `bid_price` bigint(20) DEFAULT NULL,
  KEY `player_id` (`player_id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`role`, `player_id`, `player_name`, `base_price`, `points`, `team_id`, `team_name`, `bid_price`) VALUES
('BATSMAN', 5, 'EVIN LEWIS', 500000, 10, NULL, 'Auction Started', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bowler`
--

DROP TABLE IF EXISTS `bowler`;
CREATE TABLE IF NOT EXISTS `bowler` (
  `player_id` int(11) NOT NULL,
  `bowling_style` varchar(50) NOT NULL,
  `wickets` int(11) NOT NULL,
  `best_bowl` varchar(20) NOT NULL,
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bowler`
--

INSERT INTO `bowler` (`player_id`, `bowling_style`, `wickets`, `best_bowl`) VALUES
(126, 'RIGHT-ARM FAST', 0, '0'),
(95, 'RIGHT ARM MEDIUM FAST', 56, '5\\17'),
(96, 'LEFT-ARM?FAST-MEDIUM', 24, '3\\16'),
(97, 'RIGHT-ARM OFF-SPIN', 134, '18\\5'),
(98, 'RIGHT-ARM-FAST', 10, '4\\30'),
(99, 'LEFT-ARM ORTHODOX', 0, '0\\0'),
(100, 'RIGHT-ARM OFF BREAK', 110, '34\\4'),
(101, 'RIGHT-ARM-MEDIUM', 11, '15\\3'),
(102, 'RIGHT-ARM OFF-SPIN', 112, '5\\19'),
(103, 'RIGHT-ARM FAST', 4, '3\\17'),
(104, 'RIGHT-ARM?LEG BREAK', 38, '3\\19'),
(105, 'RIGHT-ARM FAST', 7, '2\\21'),
(106, 'LEFT-ARM?FAST-MEDIUM', 2, '1\\24'),
(107, 'RIGHT-ARM LEG BREAK', 2, '1\\26'),
(108, 'LEFT-ARM-FAST', 61, '3\\26'),
(109, 'RIGHT-ARM-FAST-MEDIUM', 83, '4\\20'),
(110, 'LEG-SPINNER', 53, '28\\4'),
(111, 'RIGHT-ARM LEG BREAK', 15, '4\\23'),
(112, 'LEG-BREAK', 10, '3\\36'),
(113, 'RIGHT-ARM MEDIUM', 19, '5\\14'),
(114, 'RIGHT-ARM LEG SPIN', 82, '4\\25'),
(115, 'RIGHT-ARM-FAST-MEDIUM', 5, '29\\2'),
(116, 'RIGHT-ARM-FAST-MEDIUM', 120, '5\\19'),
(117, 'RIGHT-ARM-FAST', 11, '10\\4'),
(118, 'RIGHT-ARM-FAST-MEDIUM', 63, '3\\7'),
(119, 'RIGHT-ARM-FAST-MEDIUM', 79, '4\\14'),
(120, 'RIGHT-ARM MEDIUM', 90, '4\\14'),
(121, 'RIGHT-ARM?FAST-MEDIUM', 16, '3\\29'),
(122, 'RIGHT-ARM-FAST', 0, '0\\49'),
(123, 'RIGHT-ARM OFF BREAK', 3, '1\\13'),
(124, 'RIGHT-ARM MEDIUM', 41, '2\\28'),
(125, 'RIGHT?ARM FAST', 0, '0\\34'),
(126, 'RIGHT-ARM FAST', 0, '0'),
(127, 'RIGHT-ARM-FAST-MEDIUM', 105, '4\\40'),
(128, 'RIGHT-ARM-FAST-MEDIUM', 10, '2\\15'),
(129, 'LEFT-ARM FAST-MEDIUM', 33, '3\\19'),
(130, 'RIGHT-ARM OFFBREAK', 12, '3\\16'),
(131, 'RIGHT-ARM-FAST-MEDIUM', 43, '4\\39'),
(132, 'RIGHT-ARM OFF BREAK', 14, '3\\27'),
(133, 'LEFT-ARM ORTHODOX SPIN', 35, '4\\20'),
(134, '?RIGHT-ARM?LEG BREAK', 18, '4\\16'),
(135, 'RIGHT-ARM OFFBREAK', 0, '0\\47'),
(136, '?LEFT-ARM?FAST-MEDIUM', 0, '0\\0'),
(137, 'RIGHT-ARM LEG SPIN', 140, '4\\17'),
(138, 'RIGHT-ARM-FAST-MEDIUM', 21, '4\\32'),
(139, 'RIGHT-ARM-FAST-MEDIUM', 14, '4\\15'),
(140, 'RIGHT-ARM FAST-MEDIUM', 2, '1\\29'),
(141, 'RIGHT-ARM?FAST-MEDIUM', 12, '4\\11'),
(142, 'LEFT-ARM ORTHODOX SPIN', 40, '3\\16'),
(143, 'LEFT-ARM MEDIUM-FAST', 68, '4\\21'),
(144, 'LEFT-ARM MEDIUM', 5, '2\\17'),
(145, 'LEFT-ARM?FAST-MEDIUM', 67, '5\\25'),
(146, 'RIGHT-ARM?FAST-MEDIUM', 27, '3\\24'),
(147, 'RIGHT-ARM?FAST-MEDIUM', 111, '4\\24'),
(148, 'RIGHT-ARM LEG BREAK', 5, '1\\14'),
(149, 'RIGHT-ARM?FAST-MEDIUM', 18, '3\\23'),
(150, 'RIGHT-ARM-OFF-SPIN', 11, '2\\12');

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_teams`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `list_teams`;
CREATE TABLE IF NOT EXISTS `list_teams` (
`team_id` int(11)
,`team_name` varchar(20)
,`image` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE IF NOT EXISTS `players` (
  `role` varchar(20) NOT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `base_price` bigint(20) NOT NULL,
  `points` int(11) NOT NULL,
  `matches` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`role`, `player_id`, `player_name`, `age`, `country`, `image`, `base_price`, `points`, `matches`, `status`) VALUES
('BATSMAN', 1, 'VIRAT KOHLI', 30, 'IND', 'Player Profile/1.png', 1500000, 40, 163, ''),
('BATSMAN', 2, 'SURYAKUMAR YADAV', 28, 'IND', 'Player Profile/2.png', 700000, 25, 69, ''),
('BATSMAN', 3, 'KEDAR JADHAV', 33, 'IND', 'Player Profile/3.png', 700000, 20, 65, ''),
('BATSMAN', 4, 'SAM BILLINGS', 27, 'ENG', 'Player Profile/4.png', 500000, 10, 21, ''),
('BATSMAN', 5, 'EVIN LEWIS', 27, 'WI', 'Player Profile/5.png', 500000, 10, 13, ''),
('BATSMAN', 6, 'FAF DU PLESSIS', 34, 'SA', 'Player Profile/6.png', 700000, 25, 59, ''),
('BATSMAN', 7, 'MANDEEP SINGH', 27, 'IND', 'Player Profile/7.png', 700000, 25, 84, ''),
('BATSMAN', 8, 'PRITHVI SHAW', 19, 'IND', 'Player Profile/8.png', 500000, 5, 9, ''),
('BATSMAN', 9, 'MANAYNK AGARWAL', 27, 'IND', 'Player Profile/9.png', 700000, 20, 64, ''),
('BATSMAN', 10, 'SAURABH TIWARY', 29, 'IND', 'Player Profile/10.png', 700000, 25, 81, ''),
('BATSMAN', 11, 'AARON FINCH', 32, 'AUS', 'Player Profile/11.png', 1000000, 30, 75, ''),
('BATSMAN', 12, 'SARFARAZ KHAN', 21, 'IND', 'Player Profile/12.png', 500000, 10, 25, ''),
('BATSMAN', 13, 'SURESH RAINA', 32, 'IND', 'Player Profile/13.png', 1500000, 40, 176, ''),
('BATSMAN', 14, 'SHARAD LUMBA', 29, 'IND', 'Player Profile/14.png', 200000, 5, 0, ''),
('BATSMAN', 15, 'ROHIT SHARMA', 31, 'IND', 'Player Profile/15.png', 1500000, 40, 173, ''),
('BATSMAN', 16, 'MONU KUMAR', 24, 'IND', 'Player Profile/16.png', 200000, 5, 0, ''),
('BATSMAN', 17, 'NITISH RANA', 24, 'IND', 'Player Profile/17.png', 500000, 15, 32, ''),
('BATSMAN', 18, 'SIDDESH LAD', 26, 'IND', 'Player Profile/18.png', 200000, 5, 0, ''),
('BATSMAN', 19, 'KARUN NAIR', 27, 'IND', 'Player Profile/19.png', 700000, 25, 68, ''),
('BATSMAN', 20, 'PAVEN DESHPANDE', 29, 'IND', 'Player Profile/20.png', 200000, 5, 0, ''),
('BATSMAN', 21, 'DAVID MILLER', 29, 'SA', 'Player Profile/21.png', 1000000, 30, 69, ''),
('BATSMAN', 22, 'MANJOT KALRA', 19, 'IND', 'Player Profile/22.png', 200000, 5, 0, ''),
('BATSMAN', 23, 'DHRUV SHOREY', 26, 'IND', 'Player Profile/23.png', 200000, 5, 1, ''),
('BATSMAN', 24, 'RICKY BHUI', 22, 'IND', 'Player Profile/24.png', 200000, 5, 1, ''),
('BATSMAN', 25, 'KSHITIZ SHARMA', 28, 'IND', 'Player Profile/25.png', 200000, 5, 0, ''),
('BATSMAN', 26, 'SHREYAS IYER', 24, 'IND', 'Player Profile/26.png', 700000, 25, 46, ''),
('BATSMAN', 27, 'CHIRS GAYLE', 39, 'WI', 'Player Profile/27.png', 1500000, 40, 112, ''),
('BATSMAN', 28, 'MURALI VIJAY', 34, 'IND', 'Player Profile/28.png', 1000000, 35, 101, ''),
('BATSMAN', 29, 'ISHAK JAGGI ', 29, 'IND', 'Player Profile/29.png', 200000, 5, 7, ''),
('BATSMAN', 30, 'KANE WILLIAMSON', 28, 'NZ', 'Player Profile/30.png', 700000, 25, 32, ''),
('BATSMAN', 31, 'COLIN MUNRO', 31, 'NZ', 'Player Profile/31.png', 200000, 5, 9, ''),
('BATSMAN', 32, 'CHAITANYA BISHNOI', 24, 'IND', 'Player Profile/32.png', 200000, 5, 0, ''),
('BATSMAN', 33, 'APPORV WANKHADE', 26, 'IND', 'Player Profile/33.png', 200000, 5, 0, ''),
('BATSMAN', 34, 'CHRIS LYNN', 28, 'AUS', 'Player Profile/34.png', 700000, 20, 28, ''),
('BATSMAN', 35, 'PRADEEP SAHU', 33, 'IND', 'Player Profile/35.png', 200000, 5, 5, ''),
('BATSMAN', 36, 'JASON ROY', 28, 'ENG', 'Player Profile/36.png', 200000, 5, 8, ''),
('BATSMAN', 37, 'MANOJ TIWARI', 33, 'IND', 'Player Profile/37.png', 1000000, 30, 98, ''),
('BATSMAN', 38, 'SHUBMAN GILL', 19, 'IND', 'Player Profile/38.png', 200000, 5, 13, ''),
('BATSMAN', 39, 'GAUTAM GAMBHIR', 37, 'IND', 'Player Profile/39.png', 1500000, 40, 154, ''),
('BATSMAN', 40, 'TANMAY AGARWAL', 23, 'IND', 'Player Profile/40.png', 200000, 5, 0, ''),
('BATSMAN', 41, 'MANAN VOHRA', 25, 'IND', 'Player Profile/41.png', 700000, 25, 49, ''),
('BATSMAN', 42, 'RINKU SINGH', 21, 'IND', 'Player Profile/42.png', 200000, 5, 5, ''),
('BATSMAN', 43, 'MANISH PANDEY', 29, 'IND', 'Player Profile/43.png', 1000000, 35, 118, ''),
('BATSMAN', 44, 'GURKEERT MANN SINGH', 28, 'IND', 'Player Profile/44.png', 500000, 10, 30, ''),
('BATSMAN', 45, 'DARCY SHORT', 28, 'AUS', 'Player Profile/45.png', 200000, 5, 7, ''),
('BATSMAN', 46, 'ALEX HALES', 29, 'ENG', 'Player Profile/46.png', 200000, 5, 6, ''),
('BATSMAN', 47, 'HEINRICH KLAASEN', 27, 'SA', 'Player Profile/47.png', 200000, 5, 4, ''),
('BATSMAN', 48, 'RAHUL TRIPATHI', 27, 'IND', 'Player Profile/48.png', 500000, 15, 26, ''),
('BATSMAN', 49, 'SHIKHAR DHAWAN', 33, 'IND', 'Player Profile/49.png', 1500000, 40, 143, ''),
('BATSMAN', 50, 'SACHIN BABY', 30, 'IND', 'Player Profile/50.png', 200000, 5, 18, ''),
('BATSMAN', 51, 'AJINKYA RAHANE', 30, 'IND', 'Player Profile/51.png', 1500000, 40, 126, ''),
('WICKET_KEEPER', 52, 'DINESH KARTIK', 33, 'IND', 'Player Profile/52.png', 1000000, 35, 168, ''),
('WICKET_KEEPER', 53, 'LOKESH RAHUL', 26, 'IND', 'Player Profile/53.png', 700000, 25, 53, ''),
('WICKET_KEEPER', 54, 'AMABATI RAYUDU', 33, 'IND', 'Player Profile/54.png', 1000000, 35, 130, ''),
('WICKET_KEEPER', 55, 'QUINTON DE KOCK', 26, 'SA', 'Player Profile/55.png', 700000, 20, 34, ''),
('WICKET_KEEPER', 56, 'ADITYA TARE', 30, 'IND', 'Player Profile/56.png', 500000, 10, 35, ''),
('WICKET_KEEPER', 57, 'JOS BUTTLER', 28, 'ENG', 'Player Profile/57.png', 700000, 25, 37, ''),
('WICKET_KEEPER', 58, 'RISHABH PANT', 21, 'IND', 'Player Profile/58.png', 700000, 25, 38, ''),
('WICKET_KEEPER', 59, 'ROBIN UTHAPPA', 33, 'IND', 'Player Profile/59.png', 1500000, 40, 165, ''),
('WICKET_KEEPER', 60, 'ISHAN KISHAN ', 20, 'IND', 'Player Profile/60.png', 500000, 15, 30, ''),
('WICKET_KEEPER', 61, 'SANJU SAMSON', 24, 'IND', 'Player Profile/61.png', 1000000, 30, 81, ''),
('WICKET_KEEPER', 62, 'NAMAN OJHA', 35, 'IND', 'Player Profile/62.png', 1000000, 30, 113, ''),
('WICKET_KEEPER', 63, 'MS DHONI', 37, 'IND', 'Player Profile/63.png', 1500000, 40, 157, ''),
('WICKET_KEEPER', 64, ' AB DE VILLIERS', 34, 'SA', 'Player Profile/64.png', 1500000, 40, 141, ''),
('WICKET_KEEPER', 65, 'WRIDDHIMAN SAHA', 34, 'IND', 'Player Profile/65.png', 1000000, 30, 115, ''),
('WICKET_KEEPER', 66, 'BRENDOM MCCULLUM', 37, 'NZ', 'Player Profile/66.png', 1000000, 35, 109, ''),
('WICKET_KEEPER', 67, 'PARTHIV PATEL', 33, 'IND', 'Player Profile/67.png', 1000000, 30, 125, ''),
('ALL_ROUNDER', 68, 'BEN CUTTING', 29, 'AUS', 'Player Profile/68.png', 500000, 10, 18, ''),
('ALL_ROUNDER', 69, 'MOOEN ALI', 31, 'ENG', 'Player Profile/69.png', 200000, 5, 5, ''),
('ALL_ROUNDER', 70, 'DAN CHRISTIAN', 35, 'AUS', 'Player Profile/70.png', 500000, 15, 40, ''),
('ALL_ROUNDER', 71, 'YUVRAJ SINGH', 37, 'IND', 'Player Profile/71.png', 1000000, 35, 128, ''),
('ALL_ROUNDER', 72, 'DWAYNE BRAVO', 35, 'WI', 'Player Profile/72.png', 1500000, 40, 122, ''),
('ALL_ROUNDER', 73, 'BEN STOKES', 27, 'ENG', 'Player Profile/73.png', 1000000, 35, 25, ''),
('ALL_ROUNDER', 74, 'RAVINDRA JADEJA', 30, 'IND', 'Player Profile/74.png', 1000000, 30, 124, ''),
('ALL_ROUNDER', 75, 'AXER PATEL', 24, 'IND', 'Player Profile/75.png', 700000, 20, 68, ''),
('ALL_ROUNDER', 76, 'KM ASIF', 25, 'IND', 'Player Profile/76.png', 200000, 5, 2, ''),
('ALL_ROUNDER', 77, 'JP DUMINY', 34, 'SA', 'Player Profile/77.png', 1000000, 35, 83, ''),
('ALL_ROUNDER', 78, 'SHANE WATSON', 37, 'AUS', 'Player Profile/78.png', 1500000, 40, 117, ''),
('ALL_ROUNDER', 79, 'KIERON POLLARD', 31, 'WI', 'Player Profile/79.png', 1000000, 35, 132, ''),
('ALL_ROUNDER', 80, 'GLENN MAXWELL', 30, 'AUS', 'Player Profile/80.png', 700000, 25, 69, ''),
('ALL_ROUNDER', 81, 'CHRIS MORRIES', 31, 'SA', 'Player Profile/81.png', 700000, 20, 52, ''),
('ALL_ROUNDER', 82, 'AKSHDEEP NATH', 25, 'IND', 'Player Profile/82.png', 200000, 5, 6, ''),
('ALL_ROUNDER', 83, 'MITCHELL SANTNER', 26, 'NZ', 'Player Profile/83.png', 200000, 5, 0, ''),
('ALL_ROUNDER', 84, 'CORY ANDERSON', 28, 'NZ', 'Player Profile/84.png', 500000, 15, 30, ''),
('ALL_ROUNDER', 85, 'VIJAY SHANKAR', 27, 'IND', 'Player Profile/85.png', 500000, 10, 18, ''),
('ALL_ROUNDER', 86, 'DAVID WILLEY', 28, 'ENG', 'Player Profile/86.png', 200000, 5, 3, ''),
('ALL_ROUNDER', 87, 'PAWAN NEGI', 35, 'IND', 'Player Profile/87.png', 500000, 15, 43, ''),
('ALL_ROUNDER', 88, 'TOM CURRAN', 33, 'ENG', 'Player Profile/88.png', 200000, 5, 5, ''),
('ALL_ROUNDER', 89, 'COLIN DE GRANDHOMME', 32, 'NZ', 'Player Profile/89.png', 200000, 5, 21, ''),
('ALL_ROUNDER', 90, 'MARCUS STOINIS ', 29, 'AUS', 'Player Profile/90.png', 500000, 10, 19, ''),
('ALL_ROUNDER', 91, 'SHAKIB AL HASSAN', 31, 'BAN', 'Player Profile/91.png', 700000, 25, 60, ''),
('ALL_ROUNDER', 92, 'CHRIS WOKES', 29, 'ENG', 'Player Profile/92.png', 500000, 15, 18, ''),
('ALL_ROUNDER', 93, 'DEEPAK HODA', 23, 'IND', 'Player Profile/93.png', 500000, 10, 50, ''),
('ALL_ROUNDER', 94, 'CARLOS BRATHWAIT', 30, 'WI', 'Player Profile/94.png', 500000, 10, 14, ''),
('BOWLER', 95, 'ANDREW TYE', 31, 'AUS', 'Player Profile/95.png', 700000, 20, 20, ''),
('BOWLER', 96, 'MUSTAFIZUR RAHMAN', 23, 'BAN', 'Player Profile/96.png', 500000, 15, 24, ''),
('BOWLER', 97, 'HARBHAJAN SINGH', 38, 'IND', 'Player Profile/97.png', 1500000, 40, 149, ''),
('BOWLER', 98, 'PRASIDH KRISHNA', 22, 'IND', 'Player Profile/98.png', 200000, 5, 7, ''),
('BOWLER', 99, 'ABHISHEKH SHARMA ', 19, 'IND', 'Player Profile/99.png', 200000, 5, 3, ''),
('BOWLER', 100, 'RAVICHANDRAN ASHWIN', 31, 'IND', 'Player Profile/100.png', 1000000, 35, 125, ''),
('BOWLER', 101, 'DEEPAK CHAHAR', 26, 'IND', 'Player Profile/101.png', 200000, 5, 17, ''),
('BOWLER', 102, 'SUNIL NARINE', 30, 'WI', 'Player Profile/102.png', 1000000, 35, 98, ''),
('BOWLER', 103, 'LIAM PLUNKETT', 33, 'ENG', 'Player Profile/103.png', 200000, 5, 7, ''),
('BOWLER', 104, 'RASHID KHAN', 19, 'AFG', 'Player Profile/104.png', 700000, 20, 31, ''),
('BOWLER', 105, 'BILLY STANLAKE', 23, 'AUS', 'Player Profile/105.png', 200000, 5, 6, ''),
('BOWLER', 106, 'DAVID WILLEY', 28, 'ENG', 'Player Profile/106.png', 200000, 5, 3, ''),
('BOWLER', 107, 'RAHUL CHAHAR', 19, 'IND', 'Player Profile/107.png', 200000, 5, 3, ''),
('BOWLER', 108, 'MITCHELL JOHNSON', 36, 'AUS', 'Player Profile/108.png', 1000000, 25, 54, ''),
('BOWLER', 109, 'SANDEEP SHARMA', 25, 'IND', 'Player Profile/109.png', 1000000, 25, 68, ''),
('BOWLER', 110, 'IMARAN TAHIR', 39, 'SA', 'Player Profile/110.png', 1000000, 25, 38, ''),
('BOWLER', 111, 'MAYANK MARKANDE', 20, 'IND', 'Player Profile/111.png', 200000, 10, 14, ''),
('BOWLER', 112, 'MURUGAN ASHWIN ', 28, 'IND', 'Player Profile/112.png', 200000, 10, 12, ''),
('BOWLER', 113, 'ANKIT RAJPOOT', 25, 'IND', 'Player Profile/113.png', 200000, 10, 19, ''),
('BOWLER', 114, 'YUZVENDRA CHAHAL', 28, 'IND', 'Player Profile/114.png', 500000, 25, 70, ''),
('BOWLER', 115, 'AVESH KHAN', 21, 'IND', 'Player Profile/115.png', 200000, 5, 7, ''),
('BOWLER', 116, 'BHUVNESHWAR KUMAR', 28, 'IND', 'Player Profile/116.png', 1500000, 40, 102, ''),
('BOWLER', 117, 'LUNGI NGIDI', 28, 'SA', 'Player Profile/117.png', 200000, 10, 7, ''),
('BOWLER', 118, 'JASPRIT BUMRAH', 24, 'IND', 'Player Profile/118.png', 1000000, 25, 61, ''),
('BOWLER', 119, 'DHAWAL KULKARNI', 30, 'IND', 'Player Profile/119.png', 1000000, 25, 80, ''),
('BOWLER', 120, 'MOHIT SHARMA', 29, 'IND', 'Player Profile/120.png', 1000000, 30, 84, ''),
('BOWLER', 121, 'BASIL THAMPI', 24, 'IND', 'Player Profile/121.png', 200000, 10, 16, ''),
('BOWLER', 122, 'MARK WOOD', 31, 'ENG', 'Player Profile/122.png', 200000, 5, 1, ''),
('BOWLER', 123, 'MOHAMMAD NABI', 33, 'AFG', 'Player Profile/123.png', 200000, 5, 5, ''),
('BOWLER', 124, 'HARSHAL PATEL', 27, 'IND', 'Player Profile/124.png', 700000, 15, 41, ''),
('BOWLER', 125, 'JUNIOR DALA', 28, 'SA', 'Player Profile/125.png', 200000, 5, 1, ''),
('BOWLER', 126, 'ADAM MILNE', 26, 'NZ', 'Player Profile/126.png', 200000, 5, 0, ''),
('BOWLER', 127, 'VINAY KUMAR', 34, 'IND', 'Player Profile/127.png', 1000000, 30, 105, ''),
('BOWLER', 128, 'BEN LAUGHLIN', 35, 'AUS', 'Player Profile/128.png', 500000, 10, 9, ''),
('BOWLER', 129, 'TRENT BOULT', 29, 'NZ', 'Player Profile/129.png', 700000, 20, 28, ''),
('BOWLER', 130, 'WASHINGTON SUNDAR', 18, 'IND', 'Player Profile/130.png', 500000, 10, 18, ''),
('BOWLER', 131, 'SIDDARTH KAUL', 28, 'IND', 'Player Profile/131.png', 500000, 15, 38, ''),
('BOWLER', 132, 'MUJEEB UR RAHMAN', 17, 'AFG', 'Player Profile/132.png', 200000, 10, 11, ''),
('BOWLER', 133, 'KULDEEP YADAV', 23, 'IND', 'Player Profile/133.png', 700000, 20, 31, ''),
('BOWLER', 134, 'SHREYAS GOPAL', 25, 'IND', 'Player Profile/134.png', 500000, 10, 17, ''),
('BOWLER', 135, 'AKILA DANANJAYA', 24, 'SL', 'Player Profile/135.png', 200000, 5, 1, ''),
('BOWLER', 136, 'BEN DWARSHUIS', 24, 'AUS', 'Player Profile/136.png', 200000, 5, 0, ''),
('BOWLER', 137, 'PIYUSH CHAWLA', 30, 'IND', 'Player Profile/137.png', 1500000, 40, 144, ''),
('BOWLER', 138, 'MOHAMMED SIRAJ', 24, 'IND', 'Player Profile/138.png', 500000, 10, 17, ''),
('BOWLER', 139, 'MARCUS STOINIS', 29, 'AUS', 'Player Profile/139.png', 500000, 10, 19, ''),
('BOWLER', 140, 'JAVON SEARLES', 31, 'WI', 'Player Profile/140.png', 200000, 5, 4, ''),
('BOWLER', 141, 'CHRIS JORDAN', 29, 'ENG', 'Player Profile/141.png', 200000, 5, 11, ''),
('BOWLER', 142, 'SHAHBAZ NADEEM', 29, 'IND', 'Player Profile/142.png', 500000, 15, 61, ''),
('BOWLER', 143, 'MITCHELL MCCLENAGHAN', 32, 'NZ', 'Player Profile/143.png', 700000, 20, 51, ''),
('BOWLER', 144, 'ANIKET CHOUDHARY', 28, 'IND', 'Player Profile/144.png', 200000, 5, 5, ''),
('BOWLER', 145, 'JAYDEV UNADKAT', 27, 'IND', 'Player Profile/145.png', 700000, 20, 62, ''),
('BOWLER', 146, 'TIM SOUTHEE', 30, 'NZ', 'Player Profile/146.png', 500000, 15, 37, ''),
('BOWLER', 147, 'UMESH YADAV', 31, 'IND', 'Player Profile/147.png', 1000000, 35, 108, ''),
('BOWLER', 148, 'ISH SODHI', 25, 'NZ', 'Player Profile/148.png', 200000, 5, 6, ''),
('BOWLER', 149, 'ANUREET SINGH', 30, 'IND', 'Player Profile/149.png', 500000, 10, 23, ''),
('BOWLER', 150, 'KRISHNAPPA GOWTHAM', 30, 'IND', 'Player Profile/150.png', 200000, 10, 15, ''),
('ALL_ROUNDER', 151, 'ANDRE RUSSELL', 30, 'WI', 'Player Profile/151.png', 1000000, 35, 50, '');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(20) NOT NULL,
  `total_player_ct` int(11) NOT NULL,
  `batsman_ct` int(11) NOT NULL,
  `wicket_keeper_ct` int(11) NOT NULL,
  `all_rounder_ct` int(11) NOT NULL,
  `bowler_ct` int(11) NOT NULL,
  `total_points` int(11) NOT NULL,
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sold_players`
--

DROP TABLE IF EXISTS `sold_players`;
CREATE TABLE IF NOT EXISTS `sold_players` (
  `role` varchar(20) DEFAULT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(50) NOT NULL,
  `base_price` bigint(20) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `team_name` varchar(20) DEFAULT NULL,
  `bid_price` bigint(20) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  KEY `player_id` (`player_id`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `balance` bigint(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `password`, `balance`, `image`) VALUES
(1, 'RCB', 'rcb123', 10000000, 'g.png'),
(2, 'CSK', 'csk123', 10000000, 'a.png'),
(3, 'RR', 'rr123', 10000000, 'f.png'),
(4, 'KXIP', 'kxip123', 10000000, 'c.png'),
(5, 'SRH', 'srh123', 10000000, 'h.png'),
(6, 'MI', 'mi123', 10000000, 'e.png'),
(7, 'KKR', 'kkr123', 10000000, 'd.png'),
(8, 'DD', 'dd123', 10000000, 'b.png');

-- --------------------------------------------------------

--
-- Table structure for table `unsold_players`
--

DROP TABLE IF EXISTS `unsold_players`;
CREATE TABLE IF NOT EXISTS `unsold_players` (
  `role` varchar(20) NOT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(50) NOT NULL,
  `points` int(11) NOT NULL,
  `base_price` bigint(20) NOT NULL,
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_team`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `view_team`;
CREATE TABLE IF NOT EXISTS `view_team` (
`role` varchar(20)
,`player_id` int(11)
,`player_name` varchar(50)
,`bid_price` bigint(20)
,`points` int(11)
,`team_name` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `wicket_keeper`
--

DROP TABLE IF EXISTS `wicket_keeper`;
CREATE TABLE IF NOT EXISTS `wicket_keeper` (
  `player_id` int(11) NOT NULL,
  `batting_style` varchar(20) NOT NULL,
  `runs` int(11) NOT NULL,
  `high_score` int(11) NOT NULL,
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wicket_keeper`
--

INSERT INTO `wicket_keeper` (`player_id`, `batting_style`, `runs`, `high_score`) VALUES
(52, 'RIGHT-HANDED', 3401, 86),
(53, 'RIGHT-HANDED', 1382, 95),
(54, 'RIGHT-HANDED', 3018, 100),
(55, 'LEFT-HANDED', 927, 108),
(56, 'RIGHT-HANDED', 339, 59),
(57, 'RIGHT-HANDED', 1075, 95),
(58, 'LEFT-HANDED', 1248, 128),
(59, 'RIGHT-HANDED', 4086, 87),
(60, 'LEFT-HANDED', 594, 62),
(61, 'RIGHT-HANDED', 1867, 102),
(62, 'RIGHT-HANDED', 1554, 94),
(63, 'RIGHT-HANDED', 4016, 79),
(64, 'RIGHT-HANDED', 3953, 133),
(65, 'RIGHT-HANDED', 1679, 115),
(66, 'RIGHT-HANDED', 2881, 158),
(67, 'LEFT-HANDED', 2475, 81);

-- --------------------------------------------------------

--
-- Structure for view `list_teams`
--
DROP TABLE IF EXISTS `list_teams`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_teams`  AS  select `teams`.`team_id` AS `team_id`,`teams`.`team_name` AS `team_name`,`teams`.`image` AS `image` from `teams` ;

-- --------------------------------------------------------

--
-- Structure for view `view_team`
--
DROP TABLE IF EXISTS `view_team`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_team`  AS  select `sold_players`.`role` AS `role`,`sold_players`.`player_id` AS `player_id`,`sold_players`.`player_name` AS `player_name`,`sold_players`.`bid_price` AS `bid_price`,`sold_players`.`points` AS `points`,`sold_players`.`team_name` AS `team_name` from `sold_players` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `all_rounder`
--
ALTER TABLE `all_rounder`
  ADD CONSTRAINT `all_rounder_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `batsman`
--
ALTER TABLE `batsman`
  ADD CONSTRAINT `batsman_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `bids_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `bowler`
--
ALTER TABLE `bowler`
  ADD CONSTRAINT `bowler_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `sold_players`
--
ALTER TABLE `sold_players`
  ADD CONSTRAINT `sold_players_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `sold_players_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `teams` (`team_id`);

--
-- Constraints for table `unsold_players`
--
ALTER TABLE `unsold_players`
  ADD CONSTRAINT `unsold_players_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `wicket_keeper`
--
ALTER TABLE `wicket_keeper`
  ADD CONSTRAINT `wicket_keeper_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
