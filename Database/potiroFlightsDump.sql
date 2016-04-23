-- MySQL dump 10.13  Distrib 5.5.37, for solaris10 (sparc)
--
-- Host: rerun    Database: poti
-- ------------------------------------------------------
-- Server version	5.5.37

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
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flights` (
  `route_no` int(5) NOT NULL AUTO_INCREMENT,
  `from_city` varchar(20) DEFAULT NULL,
  `to_city` varchar(20) DEFAULT NULL,
  `price` float(8,2) DEFAULT NULL,
  PRIMARY KEY (`route_no`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flights`
--

LOCK TABLES `flights` WRITE;
/*!40000 ALTER TABLE `flights` DISABLE KEYS */;
INSERT INTO `flights` VALUES (1,'Sydney','Melbourne',180.00),(2,'Sydney','Brisbane',170.00),(3,'Sydney','Canberra',120.00),(4,'Canberra','Sydney',120.00),(5,'Sydney','Newcastle',90.00),(6,'Newcastle','Sydney',90.00),(7,'Sydney','Broken Hill',130.00),(8,'Broken Hill','Sydney',130.00),(9,'Melbourne','Sydney',180.00),(10,'Melbourne','Canberra',140.00),(11,'Canberra','Melbourne',140.00),(12,'Melbourne','Adelaide',175.00),(13,'Melbourne','Hobart',130.00),(14,'Melbourne','Bendigo',70.00),(16,'Bendigo','Melbourne',70.00),(17,'Melbourne','Launceston',100.00),(18,'Adelaide','Melbourne',175.00),(19,'Adelaide','Broken Hill',100.00),(20,'Broken Hill','Adelaide',100.00),(21,'Adelaide','Perth',220.00),(22,'Adelaide','Darwin',230.00),(23,'Darwin','Adelaide',230.00),(24,'Darwin','Alice Springs',120.00),(25,'Alice Springs','Darwin',120.00),(26,'Perth','Adelaide',220.00),(27,'Perth','Albany',100.00),(28,'Perth','Kalgoorlie',80.00),(29,'Perth','Broome',90.00),(30,'Albany','Perth',100.00),(31,'Kalgoorlie','Perth',80.00),(32,'Broome','Perth',90.00),(33,'Launceston','Melbourne',100.00),(34,'Launceston','Hobart',80.00),(35,'Hobart','Melbourne',130.00),(36,'Hobart','Launceston',80.00),(37,'Brisbane','Sydney',170.00),(38,'Brisbane','Mt Isa',170.00),(39,'Brisbane','Rockhampton',180.00),(40,'Brisbane','Cairns',230.00),(41,'Brisbane','Darwin',240.00),(42,'Mt Isa','Brisbane',170.00),(43,'Rockhampton','Brisbane',180.00),(44,'Cairns','Brisbane',230.00),(45,'Darwin','Brisbane',240.00),(46,'Mt Isa','Darwin',120.00),(47,'Darwin','Mt Isa',120.00),(48,'Adelaide','Pt Augusta',50.00),(49,'Pt Augusta','Adelaide',50.00);
/*!40000 ALTER TABLE `flights` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-23 14:54:43
