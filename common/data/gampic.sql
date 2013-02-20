DROP DATABASE IF EXISTS `gampic`;
CREATE DATABASE  IF NOT EXISTS `gampic` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gampic`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: localhost    Database: gampic
-- ------------------------------------------------------
-- Server version	5.5.28-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_content` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`,`image_id`),
  KEY `user_id` (`user_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `tbl_image` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comment`
--

LOCK TABLES `tbl_comment` WRITE;
/*!40000 ALTER TABLE `tbl_comment` DISABLE KEYS */;
INSERT INTO `tbl_comment` VALUES (0,34,'2013-02-08 11:52:06','comment 1',1),(1,34,'2013-02-08 11:55:00','comment 2',1),(2,34,'2013-02-08 11:55:06','comment 3',1),(3,34,'2013-02-08 11:55:11','comment 4',1),(4,34,'2013-02-08 11:55:16','comment 5',1);
/*!40000 ALTER TABLE `tbl_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_image`
--

DROP TABLE IF EXISTS `tbl_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_title` varchar(127) COLLATE utf8_bin NOT NULL,
  `image_extension` varchar(7) COLLATE utf8_bin NOT NULL,
  `image_category` int(8) NOT NULL,
  `image_thumb_height` int(11) NOT NULL DEFAULT '0',
  `image_likes` int(11) NOT NULL DEFAULT '0',
  `image_upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_image`
--

LOCK TABLES `tbl_image` WRITE;
/*!40000 ALTER TABLE `tbl_image` DISABLE KEYS */;
INSERT INTO `tbl_image` VALUES (1,'all legendary gear!!!','jpeg',3,119,0,'2013-01-25 19:37:47',1),(2,'what a scene!!!','jpeg',2,143,0,'2013-01-25 19:41:28',1),(3,'check out what i got~','png',3,154,0,'2013-01-25 19:41:59',1),(4,'this is nice','jpeg',2,143,0,'2013-01-25 19:42:16',1),(5,'cool wings','jpeg',3,139,0,'2013-01-25 19:42:36',1),(6,'who is this?','jpeg',1,256,0,'2013-01-25 19:43:07',1),(7,'blizzard','jpeg',1,115,0,'2013-01-25 19:43:42',1),(8,'a bunch of monsters','jpeg',3,142,0,'2013-01-25 19:44:35',1),(9,'intense battle','jpeg',2,131,0,'2013-01-25 19:48:45',1),(10,'what a monster!','jpeg',3,154,0,'2013-01-25 19:49:34',1),(11,'this is my barb~','jpeg',3,108,0,'2013-01-25 19:50:26',1),(12,'paragon system started','png',3,113,0,'2013-01-25 19:51:00',1),(13,'cool pic!','jpeg',3,120,0,'2013-01-25 19:51:38',1),(14,'nice poster!','jpeg',2,128,0,'2013-01-25 19:52:12',1),(15,'this is typical','jpeg',1,144,0,'2013-01-25 19:52:45',1),(16,'dota allstars','jpeg',1,127,0,'2013-01-27 02:31:28',1),(17,'new undying tombstone','jpeg',1,264,0,'2013-01-27 02:32:53',1),(18,'starcraft 1 human','png',2,144,0,'2013-01-27 02:35:26',1),(19,'this is classic','jpeg',1,275,0,'2013-02-01 07:27:27',1),(20,'a random search','jpeg',1,153,0,'2013-02-01 07:29:46',1),(21,'check this out','jpeg',1,204,0,'2013-02-01 07:31:35',1),(22,'this guy looks cool!','png',1,192,0,'2013-02-01 07:33:02',1),(23,'awesome image!','jpeg',1,108,0,'2013-02-01 07:33:52',1),(24,'one of my favourite charactors','png',1,288,0,'2013-02-01 07:35:13',1),(25,'what is this?','jpeg',1,144,0,'2013-02-01 07:36:55',1),(26,'warcraft mouse!','jpeg',1,145,0,'2013-02-01 07:38:38',1),(27,'dota is also warcraft!!!','jpeg',1,153,0,'2013-02-01 07:39:46',1),(28,'great wall paper','jpeg',1,120,0,'2013-02-01 07:41:34',1),(29,'dota 2 rocks!','jpeg',1,120,0,'2013-02-01 07:43:25',1),(30,'so looking forward for dota2!','jpeg',1,108,0,'2013-02-01 07:44:14',1),(31,'roshan! you are going to die!','jpeg',1,103,0,'2013-02-01 07:45:28',1),(32,'so want to play starcraft 2!','jpeg',2,144,0,'2013-02-01 22:44:00',1),(33,'i love this game!','jpeg',2,108,0,'2013-02-01 22:55:01',1),(34,'blizzard 20 years','jpeg',4,141,0,'2013-02-05 03:41:46',1),(35,'pretty nice!','jpeg',2,112,0,'2013-02-09 23:29:24',1);
/*!40000 ALTER TABLE `tbl_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_like`
--

DROP TABLE IF EXISTS `tbl_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_like` (
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`image_id`),
  KEY `user_id` (`user_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `like_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `like_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `tbl_image` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_like`
--

LOCK TABLES `tbl_like` WRITE;
/*!40000 ALTER TABLE `tbl_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_lookup`
--

DROP TABLE IF EXISTS `tbl_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_bin NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lookup`
--

LOCK TABLES `tbl_lookup` WRITE;
/*!40000 ALTER TABLE `tbl_lookup` DISABLE KEYS */;
INSERT INTO `tbl_lookup` VALUES (1,'Warcraft',1,'ImageCategory',1),(2,'Starcraft',2,'ImageCategory',2),(3,'Diablo',3,'ImageCategory',3),(4,'Other',4,'ImageCategory',4),(5,'Male',0,'Gender',1),(6,'Female',1,'Gender',2),(7,'Unspecified',2,'Gender',3);
/*!40000 ALTER TABLE `tbl_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tag`
--

DROP TABLE IF EXISTS `tbl_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_bin NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tag`
--

LOCK TABLES `tbl_tag` WRITE;
/*!40000 ALTER TABLE `tbl_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `active` int(2) NOT NULL DEFAULT '1',
  `user_name` varchar(25) COLLATE utf8_bin NOT NULL DEFAULT 'Gamer',
  `user_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_avatar` varchar(127) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,1,'zill','2013-01-16 18:00:34','http://www.gravatar.com/avatar/b24cbc7aa65df505f98c08dc3786e27a?s=100'),(2,1,'zillding','2013-02-19 14:45:08','https://api.twitter.com/1/users/profile_image?screen_name=ZillDing&size=bigger'),(3,1,'zeyu','2013-02-19 14:46:26','https://graph.facebook.com/zeyu.ding.1/picture?width=100&height=100');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_email`
--

DROP TABLE IF EXISTS `tbl_user_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_email` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `email_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_email`
--

LOCK TABLES `tbl_user_email` WRITE;
/*!40000 ALTER TABLE `tbl_user_email` DISABLE KEYS */;
INSERT INTO `tbl_user_email` VALUES (1,'zilld@hotmail.com');
/*!40000 ALTER TABLE `tbl_user_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_facebook`
--

DROP TABLE IF EXISTS `tbl_user_facebook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_facebook` (
  `user_id` int(11) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '1',
  `facebook_id` bigint(30) NOT NULL,
  `access_token` varchar(127) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `facebook_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_facebook`
--

LOCK TABLES `tbl_user_facebook` WRITE;
/*!40000 ALTER TABLE `tbl_user_facebook` DISABLE KEYS */;
INSERT INTO `tbl_user_facebook` VALUES (3,1,100000136341114,'AAAGTq98iuwQBAHUaqhkMe1ZAMsyYFJcRWYaY4HThRnPmgZBrl1MqlyupWiUpEOndIJjPSXk6m7hV9UaDlspzhATQSrHweNvb4XSjNp2gZDZD');
/*!40000 ALTER TABLE `tbl_user_facebook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_gampic`
--

DROP TABLE IF EXISTS `tbl_user_gampic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_gampic` (
  `user_id` int(11) NOT NULL,
  `user_password` varchar(40) COLLATE utf8_bin NOT NULL,
  `salt` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `gampic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_gampic`
--

LOCK TABLES `tbl_user_gampic` WRITE;
/*!40000 ALTER TABLE `tbl_user_gampic` DISABLE KEYS */;
INSERT INTO `tbl_user_gampic` VALUES (1,'6bfa73731232546c59147acaa715bc4857393882','50f75b42cebab');
/*!40000 ALTER TABLE `tbl_user_gampic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_twitter`
--

DROP TABLE IF EXISTS `tbl_user_twitter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_twitter` (
  `user_id` int(11) NOT NULL,
  `active` int(2) NOT NULL DEFAULT '1',
  `twitter_id` bigint(30) NOT NULL,
  `oauth_token` varchar(127) COLLATE utf8_bin NOT NULL,
  `oauth_secret` varchar(127) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `twitter_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_twitter`
--

LOCK TABLES `tbl_user_twitter` WRITE;
/*!40000 ALTER TABLE `tbl_user_twitter` DISABLE KEYS */;
INSERT INTO `tbl_user_twitter` VALUES (2,1,422370197,'422370197-5qHnRHu2Lejxw1dblHuxaAfwnEqajKRgTofcGA0k','h41lyAthMaTidJvEwHCRWCp6dxZcpGTX49bEMuv3jk');
/*!40000 ALTER TABLE `tbl_user_twitter` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-20 16:05:33
