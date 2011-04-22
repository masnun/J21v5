-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2010 at 12:36 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `masnun_comments`
--

CREATE TABLE IF NOT EXISTS `masnun_comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `4mu` varchar(255) NOT NULL,
  `tou` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_forums`
--

CREATE TABLE IF NOT EXISTS `masnun_forums` (
  `forumid` bigint(200) NOT NULL AUTO_INCREMENT,
  `forumname` text,
  PRIMARY KEY (`forumid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_forums`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_ip`
--

CREATE TABLE IF NOT EXISTS `masnun_ip` (
  `uid` bigint(255) NOT NULL AUTO_INCREMENT,
  `ua` text,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_ip`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_online`
--

CREATE TABLE IF NOT EXISTS `masnun_online` (
  `nothing` bigint(255) NOT NULL AUTO_INCREMENT,
  `login` text,
  `lastonline` bigint(20) DEFAULT NULL,
  `lastlocation` text,
  `sessionid` text,
  `status` text,
  PRIMARY KEY (`nothing`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `masnun_online`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_pm`
--

CREATE TABLE IF NOT EXISTS `masnun_pm` (
  `pmid` bigint(200) NOT NULL AUTO_INCREMENT,
  `4mu` longtext,
  `tou` longtext,
  `rustatus` longtext,
  `msg` longtext,
  `date` text,
  PRIMARY KEY (`pmid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `masnun_pm`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_post`
--

CREATE TABLE IF NOT EXISTS `masnun_post` (
  `postid` bigint(200) NOT NULL AUTO_INCREMENT,
  `topicid` bigint(200) DEFAULT NULL,
  `forumid` bigint(200) DEFAULT NULL,
  `post` text,
  `date` text,
  `postuser` text,
  PRIMARY KEY (`postid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `masnun_post`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_settings`
--

CREATE TABLE IF NOT EXISTS `masnun_settings` (
  `name` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masnun_settings`
--

INSERT INTO `masnun_settings` (`name`, `value`) VALUES
('msg', 'Okaad');

-- --------------------------------------------------------

--
-- Table structure for table `masnun_shout`
--

CREATE TABLE IF NOT EXISTS `masnun_shout` (
  `shoutid` bigint(255) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`shoutid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_shout`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_text_captcha`
--

CREATE TABLE IF NOT EXISTS `masnun_text_captcha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `captcha` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_text_captcha`
--

INSERT INTO `masnun_text_captcha` (`id`, `captcha`, `time`) VALUES
(143, '18056', 1274611346);

-- --------------------------------------------------------

--
-- Table structure for table `masnun_topic`
--

CREATE TABLE IF NOT EXISTS `masnun_topic` (
  `topicid` bigint(255) NOT NULL AUTO_INCREMENT,
  `forumid` bigint(255) DEFAULT NULL,
  `topictitle` text,
  `topictext` text,
  `topicstatus` int(200) DEFAULT NULL,
  `topicdate` text,
  `topicuser` text,
  `lastactive` varchar(255) DEFAULT NULL,
  `pp` varchar(255) DEFAULT '1',
  PRIMARY KEY (`topicid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_topic`
--


-- --------------------------------------------------------

--
-- Table structure for table `masnun_user`
--

CREATE TABLE IF NOT EXISTS `masnun_user` (
  `uid` bigint(255) NOT NULL AUTO_INCREMENT,
  `login` text,
  `pwd` text,
  `status` text,
  `points` bigint(255) DEFAULT '0',
  `ua` text,
  `shield` bigint(1) DEFAULT NULL,
  `ts` blob,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `staff` varchar(255) NOT NULL,
  `banned` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_user`
--

INSERT INTO `masnun_user` (`uid`, `login`, `pwd`, `status`, `points`, `ua`, `shield`, `ts`, `age`, `sex`, `location`, `email`, `fullname`, `about`, `staff`, `banned`, `photo`) VALUES
(1, 'masnun', 'masnun', 'masnun', 0, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; WOW64; en-US; rv:2.0b1) Gecko/20100630 Firefox/4.0b1', NULL, 0x3064636632333964646465343430336266663034623164323936383135633337, '', '', '', '', '', '', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `masnun_verification`
--

CREATE TABLE IF NOT EXISTS `masnun_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `the_key` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1  ;

--
-- Dumping data for table `masnun_verification`
--

