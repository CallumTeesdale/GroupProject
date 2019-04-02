-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: v.je    Database: database
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.37-MariaDB

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
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_firstname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_surname` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_dob` date DEFAULT NULL,
  `payment_method` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deliveries` (
  `delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_address_1` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_address_2` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_city` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_postcode` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `deliveriescol` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliveries`
--

LOCK TABLES `deliveries` WRITE;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `game_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_title` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `game_description` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_rating` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `platform` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publisher` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `developer` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `metacritic_score` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `game_image` longblob,
  `trailer_link` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,'Devil May Cry 5',NULL,'18+',0,'PS4','Capcom','Capcom','2019-03-07','87',5,NULL,'https://www.youtube.com/watch?v=MWxlbnI9mpU'),(2,'Sekiro: Shadows die twice',NULL,'18+',0,'PS4','Activision','From Software','2019-03-22','90',4,NULL,'https://www.youtube.com/watch?v=enBDsP5XXXA'),(3,'Resident Evil 2',NULL,'18+',0,'Xbox 1','Capcom','Capcom','2019-01-25','93',7,NULL,'https://www.youtube.com/watch?v=a-lEnz5QKuM'),(4,'Super Smash Bros. ultimate',NULL,'10+',0,'Nintendo Switch','Nintendo','Nintendo','2018-12-07','93',3,NULL,'https://www.youtube.com/watch?v=WShCN-AYHqA'),(5,'No Man\'s Sky',NULL,'7+',0,'PC','Hello Games','Hello Games','2016-08-12','71',2,NULL,'https://www.youtube.com/watch?v=nLtmEjqzg7M'),(6,'Tom Clancy\'s The Division 2',NULL,'18+',0,'PS4','Ubisoft','Massive entertainment','2019-03-15','82',4,NULL,'https://www.youtube.com/watch?v=sli7AbX2bEk'),(7,'For Honor',NULL,'18+',0,'PC','Ubisoft','Ubisoft','2017-02-14','78',3,NULL,'https://www.youtube.com/watch?v=y1HkuGUaNBY'),(8,'God of War','','18+',0,'PS4','Sony','SIE Santa Monica Studio','2018-04-20','94',2,NULL,'https://www.youtube.com/watch?v=K0u_kAWLJOA'),(9,'Battlefield 5',NULL,'16+',0,'Xbox 1','Electronic Arts','EA DICE','2018-11-20','73',2,NULL,'https://www.youtube.com/watch?v=a7ZpQadiyqs'),(10,'Red Dead Redemption 2','','18+',0,'PS4','Rockstar Games','Rockstar Studios','2018-10-26','97',4,NULL,'https://www.youtube.com/watch?v=tl6GmG5166s'),(11,'hitman 2',NULL,'18+',0,'Xbox 1','Warner Bros','IO Interactive','2018-11-13','84',4,NULL,'https://www.youtube.com/watch?v=QQppbn_Siow'),(12,'Crash Team Racing Nitro-Fueled',NULL,'7+',0,'Nintendo Switch','Nintendo','Nintendo','2019-06-21','n/a',0,NULL,'https://www.youtube.com/watch?v=WgwA1gYDb5Q');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-02 21:52:27
