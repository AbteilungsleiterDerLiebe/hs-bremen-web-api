-- MySQL dump 10.16  Distrib 10.1.14-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: web_api
-- ------------------------------------------------------
-- Server version	10.1.14-MariaDB-1~trusty

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
-- Table structure for table `asset_tags`
--

DROP TABLE IF EXISTS `asset_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_tags` (
  `tag_id` int(11) NOT NULL,
  `assetid` int(11) NOT NULL,
  KEY `asset_tags_tag_id_fk` (`tag_id`),
  KEY `asset_tags_assetid_fk` (`assetid`),
  CONSTRAINT `asset_tags_assetid_fk` FOREIGN KEY (`assetid`) REFERENCES `assetpool` (`assetid`),
  CONSTRAINT `asset_tags_tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_tags`
--

LOCK TABLES `asset_tags` WRITE;
/*!40000 ALTER TABLE `asset_tags` DISABLE KEYS */;
INSERT INTO `asset_tags` VALUES (1,1),(1,2),(2,3),(2,4),(1,3);
/*!40000 ALTER TABLE `asset_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assetpool`
--

DROP TABLE IF EXISTS `assetpool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assetpool` (
  `assetid` int(11) NOT NULL AUTO_INCREMENT,
  `assetname` varchar(30) NOT NULL,
  `path` varchar(200) NOT NULL,
  PRIMARY KEY (`assetid`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assetpool`
--

LOCK TABLES `assetpool` WRITE;
/*!40000 ALTER TABLE `assetpool` DISABLE KEYS */;
INSERT INTO `assetpool` VALUES (1,'singlehouse1','/houses/singlehouse/'),(2,'singlehouse2','/houses/singlehouse/'),(3,'familyhouse1','/houses/familyhouse/'),(4,'familyhouse2','/houses/familyhouse/'),(25,'defaultname','defaultpath'),(26,'asd','asdqwq'),(27,'123123123123','1231231231231'),(28,'3123','3gsd');
/*!40000 ALTER TABLE `assetpool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'Doe'),(2,'pete');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(30) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'single'),(2,'family'),(3,'german bight');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-07-30 10:20:56
