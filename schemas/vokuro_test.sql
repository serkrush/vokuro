-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: vokuro
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `email_confirmations`
--

DROP TABLE IF EXISTS `email_confirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_confirmations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usersId` int(10) unsigned NOT NULL,
  `code` char(32) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  `modifiedAt` int(10) unsigned DEFAULT NULL,
  `confirmed` char(1) DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_confirmations`
--

LOCK TABLES `email_confirmations` WRITE;
/*!40000 ALTER TABLE `email_confirmations` DISABLE KEYS */;
INSERT INTO `email_confirmations` VALUES (1,5,'eMd1Lhs3e9Cp4FiCOHnidoszRQjQKalV',1505119847,NULL,'N'),(2,6,'ux5Kh79ze3tQq0gJJwnF1nagZscG2My',1505119992,NULL,'N'),(3,7,'oA7Xtspz1FMTG2fsjARIkXUbhovZ4sM',1505120095,NULL,'N');
/*!40000 ALTER TABLE `email_confirmations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_logins`
--

DROP TABLE IF EXISTS `failed_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usersId` int(10) unsigned DEFAULT NULL,
  `ipAddress` char(15) NOT NULL,
  `attempted` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_logins`
--

LOCK TABLES `failed_logins` WRITE;
/*!40000 ALTER TABLE `failed_logins` DISABLE KEYS */;
INSERT INTO `failed_logins` VALUES (1,6,'127.0.0.1',1505120052),(2,0,'127.0.0.1',1505372205),(3,0,'127.0.0.1',1505372211),(4,7,'91.218.99.68',1505394757),(5,0,'176.24.244.72',1505456318),(6,7,'176.24.244.72',1505456348);
/*!40000 ALTER TABLE `failed_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_changes`
--

DROP TABLE IF EXISTS `password_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_changes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usersId` int(10) unsigned NOT NULL,
  `ipAddress` char(15) NOT NULL,
  `userAgent` text NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_changes`
--

LOCK TABLES `password_changes` WRITE;
/*!40000 ALTER TABLE `password_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profilesId` int(10) unsigned NOT NULL,
  `resource` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profilesId` (`profilesId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,3,'users','index'),(2,3,'users','search'),(3,3,'profiles','index'),(4,3,'profiles','search'),(5,1,'users','index'),(6,1,'users','search'),(7,1,'users','edit'),(8,1,'users','create'),(9,1,'users','delete'),(10,1,'users','changePassword'),(11,1,'profiles','index'),(12,1,'profiles','search'),(13,1,'profiles','edit'),(14,1,'profiles','create'),(15,1,'profiles','delete'),(16,1,'permissions','index'),(17,2,'users','index'),(18,2,'users','search'),(19,2,'users','edit'),(20,2,'users','create'),(21,2,'profiles','index'),(22,2,'profiles','search'),(23,2,'packages','index'),(24,1,'packages','index'),(25,3,'packages','index'),(26,1,'packages','export'),(27,2,'packages','export'),(28,3,'packages','export'),(29,1,'packages','typehead'),(30,2,'packages','typehead'),(31,3,'packages','typehead'),(35,1,'packages','validate'),(36,2,'packages','validate'),(37,3,'packages','validate');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `active` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,'Administrators','Y'),(2,'Users','Y'),(3,'Read-Only','Y');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remember_tokens`
--

DROP TABLE IF EXISTS `remember_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `remember_tokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usersId` int(10) unsigned NOT NULL,
  `token` char(32) NOT NULL,
  `userAgent` text NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remember_tokens`
--

LOCK TABLES `remember_tokens` WRITE;
/*!40000 ALTER TABLE `remember_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `remember_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_passwords`
--

DROP TABLE IF EXISTS `reset_passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_passwords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usersId` int(10) unsigned NOT NULL,
  `code` varchar(48) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  `modifiedAt` int(10) unsigned DEFAULT NULL,
  `reset` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_passwords`
--

LOCK TABLES `reset_passwords` WRITE;
/*!40000 ALTER TABLE `reset_passwords` DISABLE KEYS */;
/*!40000 ALTER TABLE `reset_passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `success_logins`
--

DROP TABLE IF EXISTS `success_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `success_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usersId` int(10) unsigned NOT NULL,
  `ipAddress` char(15) NOT NULL,
  `userAgent` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`usersId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `success_logins`
--

LOCK TABLES `success_logins` WRITE;
/*!40000 ALTER TABLE `success_logins` DISABLE KEYS */;
INSERT INTO `success_logins` VALUES (1,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(2,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(3,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(4,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(5,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(6,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(7,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(8,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(9,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(10,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(11,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(12,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(13,7,'91.218.99.68','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(14,7,'91.218.99.68','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(15,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(16,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(17,7,'176.24.244.72','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 Mobile/14G60 Safari/602.1'),(18,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(19,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(20,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(21,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(22,7,'89.150.21.177','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8'),(23,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(24,7,'89.150.21.177','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8'),(25,7,'89.150.21.177','Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_3 like Mac OS X) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.0 Mobile/14G60 Safari/602.1'),(26,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(27,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36'),(28,7,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36');
/*!40000 ALTER TABLE `success_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `mustChangePassword` char(1) DEFAULT NULL,
  `profilesId` int(10) unsigned NOT NULL,
  `banned` char(1) NOT NULL,
  `suspended` char(1) NOT NULL,
  `active` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profilesId` (`profilesId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Bob Burnquist','bob@phalconphp.com','$2a$08$Lx1577KNhPa9lzFYKssadetmbhaveRtCoVaOnoXXxUIhrqlCJYWCW','N',1,'N','N','Y'),(2,'Erik','erik@phalconphp.com','$2a$08$f4llgFQQnhPKzpGmY1sOuuu23nYfXYM/EVOpnjjvAmbxxDxG3pbX.','N',1,'Y','Y','Y'),(3,'Veronica','veronica@phalconphp.com','$2a$08$NQjrh9fKdMHSdpzhMj0xcOSwJQwMfpuDMzgtRyA89ADKUbsFZ94C2','N',1,'N','N','Y'),(4,'Yukimi Nagano','yukimi@phalconphp.com','$2a$08$cxxpy4Jvt6Q3xGKgMWIILuf75RQDSroenvoB7L..GlXoGkVEMoSr.','N',1,'Y','Y','Y'),(7,'Max','kalin.mv@gmail.com','$2y$08$cWM5N05UanRJS2VIcFN6bu2.2PDXtBNAz5VcBbgjTQqBbmzgrZrTO','N',1,'N','N','Y');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vk_main_table`
--

DROP TABLE IF EXISTS `vk_main_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vk_main_table` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`did`),
  KEY `fk_vk_main_table_1_idx` (`user_id`),
  CONSTRAINT `fk_vk_main_table_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vk_main_table`
--

LOCK TABLES `vk_main_table` WRITE;
/*!40000 ALTER TABLE `vk_main_table` DISABLE KEYS */;
INSERT INTO `vk_main_table` VALUES (1,1),(3,1),(4,1),(5,2),(6,2),(12,2),(13,2),(7,3),(8,4),(9,4),(2,7),(10,7),(11,7);
/*!40000 ALTER TABLE `vk_main_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vk_table_1`
--

DROP TABLE IF EXISTS `vk_table_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vk_table_1` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `did` int(10) DEFAULT NULL,
  `package_id` varchar(32) DEFAULT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `sure_name` varchar(128) DEFAULT NULL,
  `created_at` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vk_table_1_1_idx` (`did`),
  CONSTRAINT `fk_vk_table_1_1` FOREIGN KEY (`did`) REFERENCES `vk_main_table` (`did`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vk_table_1`
--

LOCK TABLES `vk_table_1` WRITE;
/*!40000 ALTER TABLE `vk_table_1` DISABLE KEYS */;
INSERT INTO `vk_table_1` VALUES (1,1,'PKG_12_A','Bob','Burnquist',1505032897),(2,2,'PKG_16_B','Max','Kalin',1505375747),(3,3,'PKG_17_B','Bob','Burnquist',1505378142),(4,4,'PKG_18_B','Bob','Burnquist',1505378549),(5,5,'P_432_AC','Erik',NULL,1505012834),(6,6,'P_432_AB','Erik',NULL,1505015834),(7,7,'P_329_BC','Veronica',NULL,1505002839),(8,8,'P_29_DC','Yukimi','Nagano',1505034839),(9,9,'P_30_DC','Yukimi ','Nagano',1505035835),(10,10,'P_432_AC','Max','Kalin',1504266863),(11,11,'P_432_AB','Max','Kalin',1504353263),(12,12,'P_432_AC','Erik',NULL,1503353263),(13,13,'P_432_AC','Erik',NULL,1503153263);
/*!40000 ALTER TABLE `vk_table_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vk_table_2`
--

DROP TABLE IF EXISTS `vk_table_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vk_table_2` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `did` int(10) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `postcode` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vk_table_2_1_idx` (`did`),
  CONSTRAINT `fk_vk_table_2_1` FOREIGN KEY (`did`) REFERENCES `vk_main_table` (`did`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vk_table_2`
--

LOCK TABLES `vk_table_2` WRITE;
/*!40000 ALTER TABLE `vk_table_2` DISABLE KEYS */;
INSERT INTO `vk_table_2` VALUES (1,1,'Cecilia Chapman 711-2880 Nulla St.Mankato Mississippi',NULL,'96522'),(2,2,'Iris Watson P.O. Box 283 8562 Fusce Rd. Frederick Nebraska',NULL,'20620'),(3,3,'Theodore Lowe Sit Rd. Azusa New York','','39531'),(4,4,'Calista Wise 7292 Dictum Av. San Antonio',NULL,'47096'),(5,5,'Kyla Olsen Sodales Av. Tamuning PA',NULL,'10855'),(6,6,'Forrest Ray 191-103 Integer Rd.Corona New Mexico',NULL,'08219'),(7,7,'Hiroko Potter P.O. Box 887 2508 Dolor. Av.Muskegon KY',NULL,'12482'),(8,8,'Nyssa Vazquez 511-5762 At Rd.Chelsea MI',NULL,'67708'),(9,9,'Lawrence Moreno 935-9940 Tortor. Street Santa Rosa MN',NULL,'98804'),(10,10,'Cecilia Chapman 711-2880 Nulla St.Mankato Mississippi',NULL,'12482'),(11,11,'Nyssa Vazquez 511-5762 At Rd.Chelsea MI',NULL,'98804'),(12,12,'Kyla Olsen Sodales Av. Tamuning PA',NULL,'10855'),(13,13,'Iris Watson P.O. Box 283 8562 Fusce Rd. Frederick Nebraska',NULL,'20620');
/*!40000 ALTER TABLE `vk_table_2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vk_table_3`
--

DROP TABLE IF EXISTS `vk_table_3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vk_table_3` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `did` int(10) DEFAULT NULL,
  `email` char(1) NOT NULL DEFAULT 'N',
  `sms` char(1) NOT NULL DEFAULT 'N',
  `txt` char(1) NOT NULL DEFAULT 'N',
  `mail` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `fk_vk_table_3_1_idx` (`did`),
  CONSTRAINT `fk_vk_table_3_1` FOREIGN KEY (`did`) REFERENCES `vk_main_table` (`did`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vk_table_3`
--

LOCK TABLES `vk_table_3` WRITE;
/*!40000 ALTER TABLE `vk_table_3` DISABLE KEYS */;
INSERT INTO `vk_table_3` VALUES (1,1,'Y','N','Y','Y'),(2,2,'N','Y','Y','N'),(3,3,'Y','N','Y','N'),(4,4,'N','N','Y','N'),(5,7,'Y','Y','Y','Y'),(6,8,'Y','N','N','Y'),(7,9,'N','Y','Y','N'),(8,10,'Y','N','Y','N'),(9,11,'N','Y','N','Y'),(10,13,'Y','Y','Y','Y');
/*!40000 ALTER TABLE `vk_table_3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vk_table_4`
--

DROP TABLE IF EXISTS `vk_table_4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vk_table_4` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `did` int(10) DEFAULT NULL,
  `transaction_id` int(10) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `field_1` varchar(255) DEFAULT NULL,
  `field_2` varchar(255) DEFAULT NULL,
  `field_3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vk_table_4_1_idx` (`did`),
  CONSTRAINT `fk_vk_table_4_1` FOREIGN KEY (`did`) REFERENCES `vk_main_table` (`did`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vk_table_4`
--

LOCK TABLES `vk_table_4` WRITE;
/*!40000 ALTER TABLE `vk_table_4` DISABLE KEYS */;
INSERT INTO `vk_table_4` VALUES (1,1,12348939,1234,NULL,NULL,NULL),(2,3,75291203,43,NULL,NULL,NULL),(3,4,56372944,983,NULL,NULL,NULL),(4,5,43204059,7463,NULL,NULL,NULL),(5,7,64539204,12,NULL,NULL,NULL),(6,8,43589314,76778,NULL,NULL,NULL),(7,9,43589319,12389,NULL,NULL,NULL),(8,10,96763251,313,NULL,NULL,NULL),(9,11,95934234,23,NULL,NULL,NULL),(10,12,45761835,59834,NULL,NULL,NULL);
/*!40000 ALTER TABLE `vk_table_4` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-16 15:27:31
