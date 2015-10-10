CREATE DATABASE  IF NOT EXISTS `qinghu` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `qinghu`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: qinghu
-- ------------------------------------------------------
-- Server version	5.5.34

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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` varchar(45) NOT NULL,
  `nowtime` datetime DEFAULT NULL,
  `billingaddress` varchar(45) DEFAULT NULL,
  `shippingaddress` varchar(45) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`orderid`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (9,'3','2014-07-06 19:36:48','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',56.00),(10,'3','2014-07-06 19:53:01','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',59.00),(11,'3','2014-07-07 00:00:44','1208,30th street, Los Angeles, CA, USA 90007','1338,20th street, Los Angeles, CA, USA 90007',33.87),(12,'3','2014-07-07 00:01:01','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',93.00),(13,'3','2014-07-07 00:01:19','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',28.55),(14,'3','2014-07-07 00:01:47','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',33.22),(15,'3','2014-07-07 00:55:15','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',66.00),(16,'3','2014-07-09 04:14:26','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',8.35),(17,'3','2014-07-10 02:43:33','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',15.00),(18,'3','2014-07-10 06:07:27','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',45.88),(19,'3','2014-07-10 06:30:48','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',16.70),(20,'4','2014-07-10 23:21:49','30th street, ls, shang ci, USA 90007','30th street, ls, shang ci, USA 90007',15.00),(21,'4','2014-07-10 23:27:01','30th street, ls, shang ci, USA 90007','30th street, ls, shang ci, USA 90007',126.22),(22,'4','2014-07-11 01:33:10','30th street, ls, shang ci, USA 90007','30th street, ls, shang ci, USA 90007',12.00),(23,'3','2014-07-11 06:23:13','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',13.00),(24,'4','2014-07-12 02:28:45','30th street, ls, shang ci, USA 90007','30th street, ls, shang ci, USA 90007',22.99),(25,'4','2014-07-12 02:29:25','30th street, ls, shang ci, USA 90007','30th street, ls, shang ci, USA 90007',55.00),(26,'4','2014-07-12 02:29:41','30th street, ls, shang ci, USA 90007','30th street, ls, shang ci, USA 90007',20.00),(27,'5','2014-07-12 02:32:19','1207 th , LOS anageles, xinghu , usa 90007','1207 th , LOS anageles, xinghu , usa 90007',63.00),(28,'5','2014-07-12 02:57:49','1207 th , LOS anageles, xinghu , usa 90007','1207 th , LOS anageles, xinghu , usa 90007',26.00),(29,'5','2014-07-12 02:58:24','1207 th , LOS anageles, xinghu , usa 90007','1207 th , LOS anageles, xinghu , usa 90007',25.00),(30,'5','2014-07-12 02:58:51','1207 th , LOS anageles, xinghu , usa 90007','1207 th , LOS anageles, xinghu , usa 90007',63.55),(31,'5','2014-07-12 02:59:24','1207 th , LOS anageles, xinghu , usa 90007','1207 th , LOS anageles, xinghu , usa 90007',28.00),(32,'5','2014-07-12 02:59:43','1207 th , LOS anageles, xinghu , usa 90007','1207 th , LOS anageles, xinghu , usa 90007',33.22),(33,'5','2014-07-12 03:00:31','1207 th , LOS anageles, xinghu , usa 90007','1207 th , LOS anageles, xinghu , usa 90007',210.77),(34,'3','2014-07-14 05:29:48','1208,30th street, Los Angeles, CA, USA 91117','1208,30th street, Los Angeles, CA, USA 91117',86.00),(35,'3','2014-07-14 06:22:38','1208,30th street, Los Angeles, CA, USA 90007','1208,30th street, Los Angeles, CA, USA 90007',88.57),(36,'3','2014-07-14 18:23:34','1208,30th street, Los Angeles, CA, USA, 90007','1208,30th street, Los Angeles, CA, USA, 90007',28.00),(40,'4','2014-07-14 18:53:33','30th street, ls, shang ci, USA, 90007','30th street, ls, shang ci, USA, 90007',182.00),(41,'4','2014-07-14 19:00:34','30th street, ls, shang ci, USA, 90007','30th street, ls, shang ci, USA, 90007',56.99),(42,'4','2014-07-14 19:11:48','30th street, ls, shang ci, USA, 90007','30th street, ls, shang ci, USA, 90007',42.35),(43,'4','2014-07-14 19:16:30','30th street, ls, shang ci, USA, 90007','30th street, ls, shang ci, USA, 90007',55.00),(44,'4','2014-07-14 19:21:58','30th street, ls, shang ci, USA, 90007','30th street, ls, shang ci, USA, 90007',78.00),(45,'4','2014-07-14 19:22:48','30th street, ls, shang ci, USA, 90007','30th street, ls, shang ci, USA, 90007',35.00),(46,'3','2014-07-15 00:02:40','1208,30th street, Los Angeles, CA, USA, 90007','1208,30th street, Los Angeles, CA, USA, 90007',8.00),(47,'3','2014-07-15 00:03:47','1208,30th street, Los Angeles, CA, USA, 90007','1208,30th street, Los Angeles, CA, USA, 90007',63.55);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-14 15:44:00
