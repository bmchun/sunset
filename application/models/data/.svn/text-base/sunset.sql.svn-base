-- MySQL dump 10.13  Distrib 5.6.24, for osx10.10 (x86_64)
--
-- Host: localhost    Database: sunset
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `iteminfo`
--

DROP TABLE IF EXISTS `iteminfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iteminfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(45) NOT NULL,
  `itemPrice` double NOT NULL DEFAULT '0',
  `itemDiscount` double DEFAULT NULL,
  `stockNum` int(11) NOT NULL DEFAULT '0',
  `describe` varchar(255) DEFAULT NULL,
  `itemPic` varchar(45) DEFAULT NULL,
  `collectNum` int(11) DEFAULT '0',
  `soldNum` int(11) DEFAULT '0',
  `itemGender` int(1) DEFAULT NULL,
  `itemDate` datetime DEFAULT NULL,
  `isRecommend` int(1) DEFAULT '0',
  `relatedItems` varchar(255) DEFAULT 'null',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iteminfo`
--

LOCK TABLES `iteminfo` WRITE;
/*!40000 ALTER TABLE `iteminfo` DISABLE KEYS */;
INSERT INTO `iteminfo` VALUES (1,'物品1',100,100,4,'物品1的描述','',1,9,1,'2015-07-01 00:00:00',1,'2'),(2,'男物品2',100,100,4,'男物品1的描述  不推荐','',1,9,1,'2015-06-30 00:00:00',0,'3,1'),(3,'女物品3',100,100,4,'物品的描述','',1,9,0,'2015-07-01 00:00:00',1,'2'),(4,'物品4',100,100,4,'物品的描述','',1,9,0,'2015-07-01 00:00:00',1,'2'),(5,'物品5',100,100,4,'物品的描述','',1,9,1,'2015-07-01 00:00:00',1,'2'),(6,'物品6',100,100,4,'物品的描述','',1,9,0,'2015-07-01 00:00:00',1,'2'),(7,'物品7',100,100,4,'物品的描述','',1,9,0,'2015-07-01 00:00:00',1,'2'),(8,'物品8',100,100,4,'物品的描述','',1,9,1,'2015-07-01 00:00:00',1,'2'),(9,'物品9',100,100,4,'物品的描述','',1,9,1,'2015-07-01 00:00:00',1,'2'),(10,'物品10',100,100,4,'物品的描述','',1,9,1,'2015-07-01 00:00:00',1,'2'),(11,'物品11',100,100,4,'物品的描述','',1,9,1,'2015-07-01 00:00:00',1,'2'),(12,'物品12',100,100,4,'物品的描述','',1,9,1,'2015-07-01 00:00:00',1,'2');
/*!40000 ALTER TABLE `iteminfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword` (
  `id` int(11) NOT NULL,
  `keyword` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword`
--

LOCK TABLES `keyword` WRITE;
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
INSERT INTO `keyword` VALUES (1,'ho1'),(2,'ho2'),(3,'ho3'),(4,'ho4'),(5,'ho5'),(6,'ho6'),(7,'ho7'),(8,'ho8'),(9,'ho9'),(10,'ho10');
/*!40000 ALTER TABLE `keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parentinfo`
--

DROP TABLE IF EXISTS `parentinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parentinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `childID` varchar(45) NOT NULL,
  `pName` varchar(45) DEFAULT NULL,
  `pTel` varchar(45) DEFAULT NULL,
  `pAdd` varchar(45) DEFAULT NULL,
  `pProvice` varchar(45) DEFAULT NULL,
  `isMum` binary(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid_idx` (`childID`),
  CONSTRAINT `uid` FOREIGN KEY (`childID`) REFERENCES `userinfo` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parentinfo`
--

LOCK TABLES `parentinfo` WRITE;
/*!40000 ALTER TABLE `parentinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `parentinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `uid` varchar(16) NOT NULL,
  `tel` varchar(11) NOT NULL,
  `nickname` varchar(45) NOT NULL,
  `gender` binary(1) NOT NULL DEFAULT '1',
  `age` int(11) DEFAULT '0',
  `idCard` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `recipients` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `provice` varchar(45) DEFAULT NULL,
  `zipCode` varchar(45) DEFAULT NULL,
  `realName` varchar(45) DEFAULT NULL,
  `registerDate` date DEFAULT NULL,
  PRIMARY KEY (`uid`,`tel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` VALUES ('1','110','uid 1','1',11,'111',NULL,'2323','22','辽宁','10000','张三','0000-00-00'),('15','2','','1',0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlike`
--

DROP TABLE IF EXISTS `userlike`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlike` (
  `userid` varchar(20) NOT NULL,
  `items` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlike`
--

LOCK TABLES `userlike` WRITE;
/*!40000 ALTER TABLE `userlike` DISABLE KEYS */;
INSERT INTO `userlike` VALUES ('1','2');
/*!40000 ALTER TABLE `userlike` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-04  0:09:22
