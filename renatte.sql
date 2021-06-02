-- phpMyAdmin SQL Dump
-- version 2.9.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 14, 2010 at 03:16 PM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `renatte`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admin`
-- 

CREATE TABLE `admin` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(60) NOT NULL,
  `pass` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `admin`
-- 

INSERT INTO `admin` VALUES (1, 'admin', '9f493754197ec0141d32e1823dbf002b');

-- --------------------------------------------------------

-- 
-- Table structure for table `art`
-- 

CREATE TABLE `art` (
  `id` int(11) NOT NULL auto_increment,
  `nume` varchar(60) NOT NULL,
  `poza` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `art`
-- 

INSERT INTO `art` VALUES (4, '1', '1.jpg');
INSERT INTO `art` VALUES (5, '2', '2.jpg');
INSERT INTO `art` VALUES (6, '3', '3.jpg');

-- --------------------------------------------------------

-- 
-- Table structure for table `portofoliu`
-- 

CREATE TABLE `portofoliu` (
  `id` int(11) NOT NULL auto_increment,
  `nume` varchar(60) NOT NULL,
  `poza` varchar(200) NOT NULL,
  `cat` varchar(60) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- Dumping data for table `portofoliu`
-- 

INSERT INTO `portofoliu` VALUES (6, '1', '1.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (7, '2', '2.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (8, '3', '3.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (9, '4', '4.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (10, '5', '5.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (11, '6', '6.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (12, '7', '7.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (13, '8', '8.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (14, '9', '9.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (15, '10', '10.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (16, '11', '11.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (17, '12', '12.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (18, '13', '13.jpg', 'porti');
INSERT INTO `portofoliu` VALUES (24, 'dsgshsad', 'dsgshsad.jpg', 'balustrade');
INSERT INTO `portofoliu` VALUES (26, 'qwqrlkdgs', 'qwqrlkdgs.jpg', 'balustrade');
INSERT INTO `portofoliu` VALUES (27, 'altceva', 'altceva.jpg', 'garduri');
