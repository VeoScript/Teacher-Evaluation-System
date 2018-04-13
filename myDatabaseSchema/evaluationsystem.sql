-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2018 at 12:07 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluationsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `Fullname` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`Fullname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Fullname`, `Username`, `Password`) VALUES
('Jayson Mendez', 'mendez', '$2y$10$GGXJurHh7RCqi4Ch6ea7H.b2O7ovOe1yfrXKrqUzG4gW9IZT5VaWe'),
('Florentino Gozo', 'gozo', '$2y$10$aA/2sqwoT8vKWWpkicHtp.4Wb6E8DyqP0WDmQQR4E2/tb1OoCtVbC'),
('Jerome Joseph R. Villaruel', 'jeromevillaruel', '$2y$10$dtFYfyLJF6uCAwLg00JqC.vicIJ2R3CEi3BhmROFmphG5TeQffgmW');

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

DROP TABLE IF EXISTS `login_tokens`;
CREATE TABLE IF NOT EXISTS `login_tokens` (
  `token` char(64) DEFAULT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`token`, `user_id`) VALUES
('234o235hkhlkj12323', 'jerome'),
('c063092d76bac8f7f8f7048273926b74d2d60067', 'jeromevillaruel'),
('ad0f3da2ec7dae8091b7144f6270923e8355107c', 'jeromevillaruel'),
('713fc037e36bc91094a10731175f654e6d4a3e3c', 'jeromevillaruel'),
('4eab173b34778e9a5f2bed32837fee383dbe952b', 'jeromevillaruel'),
('8e81ef934f556235b1154b6101006e91b3b1bf15', 'jeromevillaruel'),
('290847a3ecc6ab3efad5e10d03954d4d1287dc09', 'Dedar Elorde'),
('b6073eeb9433f867079e402a5a8e3e2ca0f98a09', 'Jerome Joseph R. Villaruel');

-- --------------------------------------------------------

--
-- Table structure for table `question_registration`
--

DROP TABLE IF EXISTS `question_registration`;
CREATE TABLE IF NOT EXISTS `question_registration` (
  `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `SchoolYear` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_registration`
--

INSERT INTO `question_registration` (`id`, `question`, `SchoolYear`) VALUES
(22, 'namsbdf,amf', '2018-2019'),
(21, 'lkjsdhflkjsadf', '2018-2019'),
(20, 'asdfkasjdfh', '2018-2019'),
(19, 'lkjsdf', '2018-2019'),
(18, 'daslkfjdshalkfj', '2018-2019');

-- --------------------------------------------------------

--
-- Table structure for table `student_account`
--

DROP TABLE IF EXISTS `student_account`;
CREATE TABLE IF NOT EXISTS `student_account` (
  `IdNumber` varchar(100) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Course` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`IdNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_account`
--

INSERT INTO `student_account` (`IdNumber`, `Fullname`, `Gender`, `Course`, `Password`) VALUES
('1510399-1', 'Jerome Villaruel', 'Male', 'BS InfoTech', '$2y$10$Yd3OOo01cgVIHketVkj0au9jMrWPe2BdljqNiv8QeE55OVaAfEf6e'),
('1510010-1', 'Dedar Elorde', 'Male', 'BS InfoTech', '$2y$10$R6Sy8LSiml3u7adgvFUUmeKWCmmHD8n/RkmPV9.HpS9QU2hWVUd4G'),
('1510013-2', 'Vina Calibud', 'Female', 'BS InfoTech', '$2y$10$tL8Jy3kA7B1cP9Um40Jv0eP83xEUsozK1e0LPeCheYfu7lb/pyUcC'),
('1510692-2', 'Stephanie Alba', 'Female', 'BS InfoTech', '$2y$10$GbUvwm8pvD2Yq20b3dhzGOaQ6XFiZkuKtH6TSt7oRYZh6sBptO9Be'),
('1510300-1', 'James Joshua R. Villaruel', 'Male', 'BS InfoTech', '$2y$10$klGWZRiUpt2Mf4pmS4vuMO3o9ky1T9VzuDcI7swqYxNf9zaU.K866'),
('1510085-1', 'Jey Rexon Libato', 'Male', 'BS InfoTech', '$2y$10$NWFdYDmPGCAy6Jak6X6GGuC5SiSD9U8ZgpsXUiZx13.MxYuqsFuum');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_registration`
--

DROP TABLE IF EXISTS `teacher_registration`;
CREATE TABLE IF NOT EXISTS `teacher_registration` (
  `TeacherID` varchar(100) DEFAULT NULL,
  `Fullname` varchar(100) DEFAULT NULL,
  `Age` int(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Department` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Student` varchar(255) DEFAULT NULL,
  `Ratings` int(100) DEFAULT NULL,
  `FinalRatings` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_registration`
--

INSERT INTO `teacher_registration` (`TeacherID`, `Fullname`, `Age`, `Address`, `Department`, `Password`, `Student`, `Ratings`, `FinalRatings`) VALUES
('1', 'Alba', 20, 'Bato', 'College of Computer Studies and Information Technology', '$2y$10$4OyM24qq0S44DIZnkpICee03IuEXaeZtl9Au8KQ2mPNSrIE/erzZu', NULL, NULL, NULL),
('1', NULL, NULL, NULL, NULL, NULL, 'Jerome Villaruel', 15, 'GOOD');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
