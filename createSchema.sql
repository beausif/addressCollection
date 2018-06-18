CREATE DATABASE `addresscollection` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `addresscollection`;

CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateAdded` datetime NOT NULL,
  `address1` varchar(75) NOT NULL,
  `address2` varchar(75) DEFAULT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip5` varchar(5) NOT NULL,
  `zip4` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `address_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE `errorlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateAdded` datetime NOT NULL,
  `error` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;