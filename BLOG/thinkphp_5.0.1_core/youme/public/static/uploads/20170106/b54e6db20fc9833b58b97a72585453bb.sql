-- MySQL dump 10.13  Distrib 5.5.33, for Win32 (x86)
--
-- Host: localhost    Database: dark2009
-- ------------------------------------------------------
-- Server version	5.5.33

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
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `card_id` varchar(18) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `test` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card`
--

LOCK TABLES `card` WRITE;
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` VALUES (1,'a','q','a'),(2,'','q','a');
/*!40000 ALTER TABLE `card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newmedia`
--

DROP TABLE IF EXISTS `newmedia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newmedia` (
  `staffid` int(11) NOT NULL DEFAULT '0',
  `leadership` varchar(20) NOT NULL,
  `boss` blob NOT NULL,
  `equipment` varchar(30) NOT NULL,
  `dataid` varchar(10) NOT NULL,
  PRIMARY KEY (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newmedia`
--

LOCK TABLES `newmedia` WRITE;
/*!40000 ALTER TABLE `newmedia` DISABLE KEYS */;
INSERT INTO `newmedia` VALUES (1,'common','L','PC','2'),(3,'common','L','PC','4'),(4,'common','L','PC','5'),(5,'UNKNOW','UNKNOW','SHE','3'),(6,'UNKNOW','UNKNOW','SHE','3'),(8,'LOV','4Õ','NO','NO'),(9,'a','Ót','rr','wq'),(12,'SHIT','a','a','a');
/*!40000 ALTER TABLE `newmedia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newmedia_data`
--

DROP TABLE IF EXISTS `newmedia_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newmedia_data` (
  `data_staffid` int(11) NOT NULL,
  `dataid` int(11) DEFAULT '9527',
  `dataname` varchar(20) NOT NULL,
  `datainformation` tinytext,
  `dataother` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`data_staffid`),
  CONSTRAINT `newmedia_data_ibfk_2` FOREIGN KEY (`data_staffid`) REFERENCES `newmedia` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `newmedia_data_ibfk_1` FOREIGN KEY (`data_staffid`) REFERENCES `newmedia` (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newmedia_data`
--

LOCK TABLES `newmedia_data` WRITE;
/*!40000 ALTER TABLE `newmedia_data` DISABLE KEYS */;
INSERT INTO `newmedia_data` VALUES (1,1,'G','NO',NULL),(3,3,'A',NULL,NULL),(4,4,'Kirk','Double Bass',NULL),(6,6,'LO','no',NULL);
/*!40000 ALTER TABLE `newmedia_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newmedia_equipment`
--

DROP TABLE IF EXISTS `newmedia_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newmedia_equipment` (
  `equipment_staffid` int(11) NOT NULL,
  `equipmentname` varchar(20) NOT NULL,
  `equipmentcount` int(11) NOT NULL DEFAULT '0',
  `equipmentprice` int(11) NOT NULL DEFAULT '0',
  `equipmentattribute` varchar(100) DEFAULT NULL,
  `equipmentother` tinytext,
  KEY `equipment_staffid` (`equipment_staffid`),
  CONSTRAINT `newmedia_equipment_ibfk_2` FOREIGN KEY (`equipment_staffid`) REFERENCES `newmedia` (`staffid`) ON UPDATE CASCADE,
  CONSTRAINT `fk_ID` FOREIGN KEY (`equipment_staffid`) REFERENCES `newmedia` (`staffid`) ON DELETE CASCADE,
  CONSTRAINT `fk_If` FOREIGN KEY (`equipment_staffid`) REFERENCES `newmedia` (`staffid`) ON UPDATE CASCADE,
  CONSTRAINT `newmedia_equipment_ibfk_1` FOREIGN KEY (`equipment_staffid`) REFERENCES `newmedia` (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newmedia_equipment`
--

LOCK TABLES `newmedia_equipment` WRITE;
/*!40000 ALTER TABLE `newmedia_equipment` DISABLE KEYS */;
INSERT INTO `newmedia_equipment` VALUES (1,'L',0,0,NULL,NULL),(3,'O',9,0,NULL,NULL),(5,'H',10,300,NULL,NULL);
/*!40000 ALTER TABLE `newmedia_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newmedia_leadership`
--

DROP TABLE IF EXISTS `newmedia_leadership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newmedia_leadership` (
  `leadership_staffid` int(11) NOT NULL,
  `leadership_name` varchar(20) NOT NULL,
  `leadership_sex` smallint(6) DEFAULT '0',
  `leadership_age` int(10) unsigned DEFAULT '28',
  `leadership_salary` int(10) unsigned NOT NULL DEFAULT '9527',
  `leadership_information` tinytext,
  `leadership_other` varchar(50) DEFAULT NULL,
  KEY `leadership_staffid` (`leadership_staffid`),
  CONSTRAINT `newmedia_leadership_ibfk_2` FOREIGN KEY (`leadership_staffid`) REFERENCES `newmedia` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `newmedia_leadership_ibfk_1` FOREIGN KEY (`leadership_staffid`) REFERENCES `newmedia` (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newmedia_leadership`
--

LOCK TABLES `newmedia_leadership` WRITE;
/*!40000 ALTER TABLE `newmedia_leadership` DISABLE KEYS */;
/*!40000 ALTER TABLE `newmedia_leadership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newmedia_secret`
--

DROP TABLE IF EXISTS `newmedia_secret`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newmedia_secret` (
  `secret_staffid` int(11) NOT NULL,
  `secret_staffsex` smallint(6) NOT NULL DEFAULT '0',
  `secret_staffage` int(11) DEFAULT '28',
  `secret_name` blob,
  `secret_salary` int(11) NOT NULL,
  KEY `fk_Ia` (`secret_staffid`),
  CONSTRAINT `fk_Ia` FOREIGN KEY (`secret_staffid`) REFERENCES `newmedia` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `newmedia_secret_ibfk_1` FOREIGN KEY (`secret_staffid`) REFERENCES `newmedia` (`staffid`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newmedia_secret`
--

LOCK TABLES `newmedia_secret` WRITE;
/*!40000 ALTER TABLE `newmedia_secret` DISABLE KEYS */;
INSERT INTO `newmedia_secret` VALUES (1,1,NULL,'K',6000),(3,0,NULL,'O',9000);
/*!40000 ALTER TABLE `newmedia_secret` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newmedia_staff`
--

DROP TABLE IF EXISTS `newmedia_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newmedia_staff` (
  `staffid` int(11) NOT NULL,
  `staffname` varchar(20) NOT NULL,
  `staffsex` smallint(5) unsigned NOT NULL DEFAULT '0',
  `staffadress` varchar(50) DEFAULT NULL,
  `staffsalary` int(11) NOT NULL DEFAULT '0',
  `staffother` tinytext,
  PRIMARY KEY (`staffid`),
  CONSTRAINT `newmedia_staff_ibfk_4` FOREIGN KEY (`staffid`) REFERENCES `newmedia` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `newmedia_staff_ibfk_1` FOREIGN KEY (`staffid`) REFERENCES `newmedia` (`staffid`),
  CONSTRAINT `newmedia_staff_ibfk_2` FOREIGN KEY (`staffid`) REFERENCES `newmedia` (`staffid`),
  CONSTRAINT `newmedia_staff_ibfk_3` FOREIGN KEY (`staffid`) REFERENCES `newmedia` (`staffid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newmedia_staff`
--

LOCK TABLES `newmedia_staff` WRITE;
/*!40000 ALTER TABLE `newmedia_staff` DISABLE KEYS */;
INSERT INTO `newmedia_staff` VALUES (1,'L',1,NULL,6000,NULL),(3,'O',0,NULL,8000,NULL);
/*!40000 ALTER TABLE `newmedia_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t1`
--

DROP TABLE IF EXISTS `t1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(10) NOT NULL,
  `sex` smallint(6) NOT NULL DEFAULT '0',
  `adress` varchar(20) NOT NULL,
  `picture` char(200) DEFAULT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `t1_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t1`
--

LOCK TABLES `t1` WRITE;
/*!40000 ALTER TABLE `t1` DISABLE KEYS */;
INSERT INTO `t1` VALUES (2,'Kai',1,'unknow',NULL,0),(3,'Ming',1,'null',NULL,0),(4,'I',0,'HERE',NULL,0),(5,'YOU',1,'where',NULL,0),(6,'WHO',1,'everywhere',NULL,0),(7,'He',0,'null',NULL,0),(8,'H',1,'unknow','null',20),(9,'J',1,'unknow','null',30),(10,'K',1,'unknow','null',300),(19,'ii',1,'here',NULL,10),(20,'ii',1,'here',NULL,10);
/*!40000 ALTER TABLE `t1` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = gb2312 */ ;
/*!50003 SET character_set_results = gb2312 */ ;
/*!50003 SET collation_connection  = gb2312_chinese_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger t1_insert before insert on t1 for each row update t2 set age=age+1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = gb2312 */ ;
/*!50003 SET character_set_results = gb2312 */ ;
/*!50003 SET collation_connection  = gb2312_chinese_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger t1_update before update on t1 for each row
update t1 set score=100 where sex=0; */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t11`
--

DROP TABLE IF EXISTS `t11`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t11` (
  `id11` int(11) NOT NULL,
  `scores` int(11) NOT NULL,
  `other` varchar(50) DEFAULT NULL,
  `xf` int(11) DEFAULT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `id11` (`id11`),
  CONSTRAINT `t11_ibfk_1` FOREIGN KEY (`id11`) REFERENCES `t1` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t11`
--

LOCK TABLES `t11` WRITE;
/*!40000 ALTER TABLE `t11` DISABLE KEYS */;
/*!40000 ALTER TABLE `t11` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t2`
--

DROP TABLE IF EXISTS `t2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t2` (
  `username` varchar(10) NOT NULL,
  `sex` smallint(6) DEFAULT '1',
  `age` int(11) DEFAULT '30',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t2`
--

LOCK TABLES `t2` WRITE;
/*!40000 ALTER TABLE `t2` DISABLE KEYS */;
INSERT INTO `t2` VALUES ('baffer',NULL,3),('batter',NULL,NULL);
/*!40000 ALTER TABLE `t2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t3`
--

DROP TABLE IF EXISTS `t3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t3` (
  `tusername` varchar(10) DEFAULT NULL,
  `tinfo` blob NOT NULL,
  `tid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t3`
--

LOCK TABLES `t3` WRITE;
/*!40000 ALTER TABLE `t3` DISABLE KEYS */;
INSERT INTO `t3` VALUES ('JC','¶',0),('JC','o€ôÎ#_',0),('JC','Ke',0),('wagena','aa',0),('JC','a',0),('wagena','aa',0);
/*!40000 ALTER TABLE `t3` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = gb2312 */ ;
/*!50003 SET character_set_results = gb2312 */ ;
/*!50003 SET collation_connection  = gb2312_chinese_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger t3_delete after delete on t3 for each row set @a=1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `test1`
--

DROP TABLE IF EXISTS `test1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test1` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test1`
--

LOCK TABLES `test1` WRITE;
/*!40000 ALTER TABLE `test1` DISABLE KEYS */;
INSERT INTO `test1` VALUES (1,'a'),(2,'a'),(3,'a');
/*!40000 ALTER TABLE `test1` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = gb2312 */ ;
/*!50003 SET character_set_results = gb2312 */ ;
/*!50003 SET collation_connection  = gb2312_chinese_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger `num` BEFORE INSERT on `test1`
for each row update test2 set num = num + 1 */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `test2`
--

DROP TABLE IF EXISTS `test2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test2` (
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=gb2312;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test2`
--

LOCK TABLES `test2` WRITE;
/*!40000 ALTER TABLE `test2` DISABLE KEYS */;
INSERT INTO `test2` VALUES (5);
/*!40000 ALTER TABLE `test2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tet`
--

DROP TABLE IF EXISTS `tet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tet` (
  `title` blob,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tet`
--

LOCK TABLES `tet` WRITE;
/*!40000 ALTER TABLE `tet` DISABLE KEYS */;
INSERT INTO `tet` VALUES ('∏êÎ¸ÅüQ„ElÒu',1);
/*!40000 ALTER TABLE `tet` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-10 17:33:50
