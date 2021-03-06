-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table login.calculator
CREATE TABLE IF NOT EXISTS `calculator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `estimateText` text NOT NULL,
  `heading` varchar(250) NOT NULL,
  `calculatorText` text NOT NULL,
  `button` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `backgroundColor` varchar(50) NOT NULL DEFAULT '0',
  `color` varchar(50) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `optionStatus` set('0','1') NOT NULL DEFAULT '0',
  `archived` set('0','1') NOT NULL DEFAULT '0',
  `defaultCalculators` set('0','1') NOT NULL DEFAULT '0',
  `contactForm` text NOT NULL,
  `includeContactForm` set('0','1') NOT NULL DEFAULT '0',
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_calculator_user` (`userId`),
  CONSTRAINT `FK_calculator_user` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table login.calculator: ~0 rows (approximately)
/*!40000 ALTER TABLE `calculator` DISABLE KEYS */;
/*!40000 ALTER TABLE `calculator` ENABLE KEYS */;

-- Dumping structure for table login.calculatoruser
CREATE TABLE IF NOT EXISTS `calculatoruser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `userName` varchar(70) DEFAULT NULL,
  `calculatorId` int(11) NOT NULL DEFAULT '0',
  `choosenOptions` varchar(150) NOT NULL DEFAULT '0',
  `form` set('0','1') NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table login.calculatoruser: ~9 rows (approximately)
/*!40000 ALTER TABLE `calculatoruser` DISABLE KEYS */;
INSERT INTO `calculatoruser` (`id`, `userId`, `userName`, `calculatorId`, `choosenOptions`, `form`, `email`, `text`, `date`) VALUES
	(26, 8, NULL, 14, '64', '0', '', '', '2021-02-16 13:21:21'),
	(27, 8, 'Nikola JokiÄ‡', 14, '64', '1', 'ml@gms.com', 'LOREM IPSUM DOLORLOREM IPSUM DOLOR LOREM IPSUM DOLOR', '2021-02-16 13:21:30'),
	(28, 0, NULL, 14, '63', '0', '', '', '2021-02-16 13:23:09'),
	(29, 0, 'Mirko IvanoviÄ‡', 14, '64', '1', 'mladen@mladen.co.uk', 'LOREM IPSUM DOLOR LOREM IPSUM DOLOR', '2021-02-16 13:23:16'),
	(30, 8, 'Nikola JokiÄ‡', 14, '64', '1', 'ml@gm.com', 'lorem', '2021-02-16 13:26:26'),
	(31, 8, 'Mladen ÄokoviÄ‡', 14, '64', '1', 'mldnmldn@gmail.com', 'Bla bla bla', '2021-02-16 14:03:41');
/*!40000 ALTER TABLE `calculatoruser` ENABLE KEYS */;

-- Dumping structure for table login.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `price` varchar(150) NOT NULL DEFAULT '0',
  `image` varchar(250) NOT NULL DEFAULT '0',
  `optionStatus` set('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stepId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_options_step` (`stepId`),
  CONSTRAINT `FK_options_step` FOREIGN KEY (`stepId`) REFERENCES `step` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

-- Dumping data for table login.options: ~7 rows (approximately)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;

-- Dumping structure for table login.step
CREATE TABLE IF NOT EXISTS `step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `stepStatus` set('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `calculatorId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `calculator` (`calculatorId`),
  CONSTRAINT `calculator` FOREIGN KEY (`calculatorId`) REFERENCES `calculator` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table login.step: ~2 rows (approximately)
/*!40000 ALTER TABLE `step` DISABLE KEYS */;
/*!40000 ALTER TABLE `step` ENABLE KEYS */;

-- Dumping structure for table login.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `email` varchar(150) NOT NULL DEFAULT '0',
  `password` varchar(150) NOT NULL DEFAULT '0',
  `userStatus` set('0','1') NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table login.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
