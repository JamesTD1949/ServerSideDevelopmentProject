-- MariaDB dump 10.17  Distrib 10.4.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: veterinary
-- ------------------------------------------------------
-- Server version	10.4.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointments` (
  `date` date NOT NULL,
  `time` char(5) NOT NULL,
  `petid` int(11) NOT NULL,
  `procedureid` int(11) NOT NULL,
  `paymentStatus` char(1) NOT NULL,
  PRIMARY KEY (`date`,`time`),
  KEY `fk_petid` (`petid`),
  KEY `fk_procedureid` (`procedureid`),
  CONSTRAINT `fk_petid` FOREIGN KEY (`petid`) REFERENCES `pets` (`petid`),
  CONSTRAINT `fk_procedureid` FOREIGN KEY (`procedureid`) REFERENCES `procedures` (`procedureID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES ('2017-12-20','16:30',1,1,'P'),('2018-09-09','11:30',4,1,'P'),('2019-12-11','10:30',2,3,'U'),('2019-12-12','11:00',1,4,'U'),('2019-12-18','10:30',2,2,'U'),('2019-12-19','09:00',1,1,'U'),('2019-12-19','10:30',2,3,'U'),('2019-12-19','11:30',1,1,'U'),('2019-12-19','13:30',1,1,'U'),('2019-12-19','15:00',1,1,'U'),('2019-12-19','16:30',1,1,'U'),('2019-12-25','09:30',1,1,'U');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owners`
--

DROP TABLE IF EXISTS `owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owners` (
  `OwnerID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` char(30) NOT NULL,
  `phone` char(10) NOT NULL,
  `eircode` char(8) NOT NULL,
  `email` char(30) NOT NULL,
  `username` char(15) NOT NULL,
  `password` char(15) NOT NULL,
  PRIMARY KEY (`OwnerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owners`
--

LOCK TABLES `owners` WRITE;
/*!40000 ALTER TABLE `owners` DISABLE KEYS */;
INSERT INTO `owners` VALUES (1,'James Downing','0871234567','dfd 1234','james@email.com','JamesTD1949','admin1?'),(2,'Namey Nameson','0871444567','dfa 1234','name123@email.com','nameTD1949','Name1?'),(3,'Connor Hartigan','0871433567','dha 1234','connor123@email.com','connorTD1949','Connor1?'),(4,'Steven Gerrard','0871434444','dha 4434','StevenG@email.com','stevenG1949','stevenG8?'),(5,'Delete ME','0871434444','dha 4434','StevenG@email.com','stevenG1949','stevenG8?');
/*!40000 ALTER TABLE `owners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pets` (
  `petid` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(15) NOT NULL,
  `animalType` char(15) NOT NULL,
  `dob` date NOT NULL,
  `OwnerID` int(11) NOT NULL,
  PRIMARY KEY (`petid`),
  KEY `fk_ownerid` (`OwnerID`),
  CONSTRAINT `fk_ownerid` FOREIGN KEY (`OwnerID`) REFERENCES `owners` (`OwnerID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pets`
--

LOCK TABLES `pets` WRITE;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
INSERT INTO `pets` VALUES (1,'Peach','Dog','2017-11-17',1),(2,'Toby','Dog','2005-10-10',1),(4,'Joe','Cat','2010-10-10',3),(5,'Henry','Pig','2010-10-10',4),(6,'Oscar','cat','2010-11-17',1),(15,'Bird','bird','2019-11-26',1);
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `procedures`
--

DROP TABLE IF EXISTS `procedures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `procedures` (
  `procedureID` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(15) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`procedureID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `procedures`
--

LOCK TABLES `procedures` WRITE;
/*!40000 ALTER TABLE `procedures` DISABLE KEYS */;
INSERT INTO `procedures` VALUES (1,'Vaccinations',35),(2,'Grooming',20),(3,'Check Up',50),(4,'Surgery',200);
/*!40000 ALTER TABLE `procedures` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-09 21:03:38
