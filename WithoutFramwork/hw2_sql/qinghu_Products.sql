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
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `productid` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL,
  `productname` varchar(45) NOT NULL,
  `productdesc` text,
  `productimage` varchar(45) DEFAULT NULL,
  `productprice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`productid`),
  KEY `categoryid_idx` (`categoryid`),
  CONSTRAINT `categoryid` FOREIGN KEY (`categoryid`) REFERENCES `Category` (`categoryid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,1,'The Principle of Uncertainty','This art book is excellent, it tells us many things and principles.','images/art1.jpeg',18.88),(2,1,'The Art Forger','The Art Forger is a thrilling novel about seeing—and not seeing—the secrets that lie beneath the canvas. ','images/art2.jpeg',8.35),(3,1,'The Art of How to Train Your Dragon 2','The Art of How to Train Your Dragon 2 includes more than 300 concept sketches, preliminary drawings, architectural plans, and digital artwork that reveal how teams of artists bring the Dragon and Viki','images/art3.jpeg',25.32),(4,1,'The Art OF Happiness','In this book, there are many stories and tells us how be happiness and the art of hapiness.','images/art4.jpeg',15.00),(5,2,'MBA master','This book is mainly about the how to become MBA.','images/business1.jpeg',22.00),(6,2,'The Power of Habit: Why We Do What We Do in L','The Power of Habit, Pulitzer Prize–winning business reporter Charles Duhigg takes us to the thrilling edge of scientific discoveries that explain why habits exist and how they can be changed. Distil','images/business2.jpeg',34.00),(7,2,'Street Smarts The Business of Life: 5 Princip','Street Smarts contains a series of proven principles and insights I’ve gathered through the years I spent living in the streets. These principles helped me go from being homeless to becoming a success','images/business3.jpeg',8.55),(8,2,'The Business Book (Big Ideas Simply Explained','The Business Book is the perfect primer to key theories of business and management, covering inspirational business ideas, business strategy and alternative business models. One hundred key quotations','images/business4.jpeg',44.00),(9,3,'Technology In Action, Complete','The Tenth Edition of Technology in Action is an extensive revision that brings the content fully in line with 21st century technology and students. The content has been updated and revised, the struct','images/t1.jpeg',134.00),(10,3,'Scholastic Discover More: Technology','This book investigates the science behind technology, taking readers on a journey of discovery that they will never forget. It uncovers the smart tech of mobile phones, wi-fi, and GPS, as well as the ','images/t2.jpeg',13.00),(11,3,'Technology and the Future','Written by technology critics and enthusiasts, the essays take you beyond definitions and descriptions and into the minds of some of the field\'s most respected thought leaders. Thoroughly covering the','images/t3.jpeg',93.00),(12,3,'Eyewitness: Technology','See how the strength of different materials is measured, the structure of a suspension bridge, how keyhole surgery works, what astronauts eat in space, and how milk bottles have changed shape. Learn w','images/t4.jpeg',35.00),(13,4,'How Children Succeed','How Children Succeed introduces us to a new generation of researchers and educators, who, for the first time, are using the tools of science to peel back the mysteries of character. Through their stor','images/e1.jpeg',15.00),(14,4,'The Smartest Kids in the World','A journalistic tour de force, The Smartest Kids in the World is a book about building resilience in a new world—as told by the young Americans who have the most at stake.','images/e2.jpeg',22.99),(15,4,'This Is Not A Test','Jose Vilson writes about race, class, and education through stories from the classroom and researched essays. His rise from rookie math teacher to prominent teacher leader takes a twist when he takes ','images/e3.jpeg',33.22),(16,4,'Teach Like a Champion!','Teach Like a Champion offers effective teaching techniques to help teachers, especially those in their first few years, become champions in the classroom. These powerful techniques are concrete, speci','images/e4.jpeg',20.00);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
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
