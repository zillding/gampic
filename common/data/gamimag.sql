CREATE DATABASE  IF NOT EXISTS `gamimag` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gamimag`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: localhost    Database: gamimag
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
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_content` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `user_id` (`user_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `tbl_image` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comment`
--

LOCK TABLES `tbl_comment` WRITE;
/*!40000 ALTER TABLE `tbl_comment` DISABLE KEYS */;
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
  `image_title` varchar(127) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_extension` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image_category` enum('warcraft','starcraft','diablo') NOT NULL,
  `image_thumb_height` int(11) NOT NULL DEFAULT '0',
  `image_likes` int(11) NOT NULL DEFAULT '0',
  `image_upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `image_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_image`
--

LOCK TABLES `tbl_image` WRITE;
/*!40000 ALTER TABLE `tbl_image` DISABLE KEYS */;
INSERT INTO `tbl_image` VALUES (1,'all legendary gear!!!','jpeg','diablo',119,0,'2013-01-25 19:37:47',1),(2,'what a scene!!!','jpeg','starcraft',143,0,'2013-01-25 19:41:28',1),(3,'check out what i got~','png','diablo',154,0,'2013-01-25 19:41:59',1),(4,'this is nice','jpeg','starcraft',143,0,'2013-01-25 19:42:16',1),(5,'cool wings','jpeg','diablo',139,0,'2013-01-25 19:42:36',1),(6,'who is this?','jpeg','warcraft',256,0,'2013-01-25 19:43:07',1),(7,'blizzard','jpeg','warcraft',115,0,'2013-01-25 19:43:42',1),(8,'a bunch of monsters','jpeg','diablo',142,0,'2013-01-25 19:44:35',1),(9,'intense battle','jpeg','starcraft',131,0,'2013-01-25 19:48:45',1),(10,'what a monster!','jpeg','diablo',154,0,'2013-01-25 19:49:34',1),(11,'this is my barb~','jpeg','diablo',108,0,'2013-01-25 19:50:26',1),(12,'paragon system started','png','diablo',113,0,'2013-01-25 19:51:00',1),(13,'cool pic!','jpeg','diablo',120,0,'2013-01-25 19:51:38',1),(14,'nice poster!','jpeg','starcraft',128,0,'2013-01-25 19:52:12',1),(15,'this is typical','jpeg','warcraft',144,0,'2013-01-25 19:52:45',1),(16,'dota allstars','jpeg','warcraft',127,0,'2013-01-27 02:31:28',1),(17,'new undying tombstone','jpeg','warcraft',264,0,'2013-01-27 02:32:53',1),(18,'starcraft 1 human','png','starcraft',144,0,'2013-01-27 02:35:26',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_lookup`
--

LOCK TABLES `tbl_lookup` WRITE;
/*!40000 ALTER TABLE `tbl_lookup` DISABLE KEYS */;
INSERT INTO `tbl_lookup` VALUES (1,'Warcraft',1,'ImageCategory',1),(2,'Starcraft',2,'ImageCategory',2),(3,'Diablo',3,'ImageCategory',3);
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
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `frequency` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  `user_provider` enum('gamimag','facebook','twitter') NOT NULL DEFAULT 'gamimag',
  `user_authid` int(11) NOT NULL,
  `user_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Gamer',
  `user_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'gamimag',1,'zill','zilld@hotmail.com','6bfa73731232546c59147acaa715bc4857393882','50f75b42cebab','2013-01-16 18:00:34');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-27 18:36:59
