-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: capstone
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
-- Table structure for table `adoptions`
--

DROP TABLE IF EXISTS `adoptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adoptions` (
  `adoption_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ani_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `apprx_monthly_fee` float DEFAULT 0,
  `dewormed` tinyint(4) DEFAULT 0,
  `defleaed` tinyint(4) DEFAULT 0,
  `requirements` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Applied','Processing','Approved','Rejected','Suspended') NOT NULL DEFAULT 'Applied',
  PRIMARY KEY (`adoption_id`),
  KEY `ani_id` (`ani_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `adoptions_ibfk_1` FOREIGN KEY (`ani_id`) REFERENCES `animal_info` (`ani_id`),
  CONSTRAINT `adoptions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adoptions`
--

LOCK TABLES `adoptions` WRITE;
/*!40000 ALTER TABLE `adoptions` DISABLE KEYS */;
INSERT INTO `adoptions` VALUES (1,2,1,0,0,0,NULL,'2022-10-07 14:46:13','2022-10-07 14:46:13','Applied'),(2,3,1,0,0,0,NULL,'2022-10-07 15:04:01','2022-10-07 15:04:01','Applied');
/*!40000 ALTER TABLE `adoptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animal_img`
--

DROP TABLE IF EXISTS `animal_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animal_img` (
  `img_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ani_id` bigint(20) NOT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`img_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal_img`
--

LOCK TABLES `animal_img` WRITE;
/*!40000 ALTER TABLE `animal_img` DISABLE KEYS */;
INSERT INTO `animal_img` VALUES (1,21,'Arlo1.jpg'),(2,21,'Arlo2.jpg'),(3,21,'Arlo3.jpg'),(4,13,'Baz1.jpg'),(5,13,'Baz2.jpg'),(6,13,'Baz3.jpg'),(7,1,'Betty1.jpg'),(8,1,'Betty2.jpg'),(10,19,'Bolo1.jpg'),(11,19,'Bolo2.jpg'),(12,7,'Celine1.jpg'),(13,7,'Celine2.jpg'),(14,7,'Celine3.jpg'),(15,5,'Delilah1.jpg'),(16,5,'Delilah2.jpg'),(17,5,'Delilah3.jpg'),(18,11,'Isla1.jpg'),(19,11,'Isla2.jpg'),(20,6,'Justin1.jpg'),(21,12,'Link1.jpg'),(22,12,'Link2.jpg'),(23,14,'Lucas1.jpg'),(24,14,'Lucas2.jpg'),(25,10,'MJ1.jpg'),(26,10,'MJ2.jpg'),(27,18,'Monica1.jpg'),(28,3,'Pepper1.jpg'),(29,3,'Pepper2.jpg'),(30,2,'Puck1.jpg'),(31,9,'Rita1.jpg'),(32,9,'Rita2.jpg'),(33,17,'Shania1.jpg'),(34,17,'Shania2.jpg'),(35,16,'Snowflake1.jpg'),(36,16,'Snowflake2.jpg'),(37,20,'Sofie1.jpg'),(38,4,'Styx1.jpg'),(39,8,'Vera1.jpg'),(40,8,'Vera2.jpg'),(41,15,'Wiley1.jpg'),(42,1,'Betty3.jpg'),(55,22,'slide1.jpg'),(56,22,'slide2.jpg'),(57,22,'slide3.jpg'),(58,23,'slide1.jpg'),(59,23,'slide2.jpg'),(60,23,'slide3.jpg');
/*!40000 ALTER TABLE `animal_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animal_info`
--

DROP TABLE IF EXISTS `animal_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animal_info` (
  `ani_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gender` enum('M','F') NOT NULL DEFAULT 'M',
  `dob` date DEFAULT NULL,
  `weight` float NOT NULL DEFAULT 0,
  `height` float NOT NULL DEFAULT 0,
  `breed` varchar(255) NOT NULL,
  `has_chip` tinyint(4) NOT NULL DEFAULT 0,
  `neutered` tinyint(4) NOT NULL DEFAULT 0,
  `behaviors` varchar(255) DEFAULT NULL,
  `health` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ani_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal_info`
--

LOCK TABLES `animal_info` WRITE;
/*!40000 ALTER TABLE `animal_info` DISABLE KEYS */;
INSERT INTO `animal_info` VALUES (1,'Betty','F','2021-08-17',12.32,30.2,'Shar-Pei',1,1,'Active','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Betty.jpg',1,'2022-08-16 15:41:24','2022-10-11 20:48:17'),(2,'Puck','M','2022-01-23',15.26,45.6,'Hound',1,1,'Friendly to people','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Puck.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(3,'Pepper','F','2022-03-14',24.83,52.2,'Husky',1,1,'calm and quiet','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Pepper.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(4,'Styx','M','2019-07-14',18.14,43.3,'Australian Kelpie',1,1,'smart','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Styx.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(5,'Delilah','F','2022-06-20',8.15,20.7,'Husky',1,1,'love sleep','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Delilah.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(6,'Justin','M','2021-06-19',25.17,40.3,'German Shepherd',1,1,'like to escape','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Justin.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(7,'Celine','F','2020-01-03',23.21,42.5,'Labrador Retriever',1,1,'well mannered','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Celine.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(8,'Vera','F','2021-08-19',13.61,36.8,'German Shepherd',1,1,'shy','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Vera.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(9,'Rita','F','2021-12-23',19.96,53.6,'German Shepherd',1,1,'active','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Rita.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(10,'MJ','M','2021-09-03',25.46,55.3,'Shepherd',1,1,'very active','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','MJ.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(11,'Isla','F','2015-10-23',33.11,56.2,'Labrador Retriever',1,1,'love seeking attention','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Isla.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(12,'Link','M','2021-11-04',20.45,44.7,'Doberman Pinscher',1,1,'Friendly to people','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Link.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(13,'Baz','M','2018-03-04',24.49,44.7,'German Shepherd',1,1,'good mannered','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Baz.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(14,'Lucas','M','2017-03-12',30.39,49.6,'German Shepherd',1,1,'good mannered and shy','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Lucas.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(15,'Wiley','M','2019-02-06',34.13,39.3,'German Shepherd',1,1,'easy to nervious','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Wiley.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(16,'Snowflake','F','2021-02-27',34.17,39.3,'Shepherd',1,1,'Friendly to people','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Snowflake.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(17,'Shania','F','2020-05-27',23.13,39.3,'Labrador Retriever',1,1,'good mannered','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Shania.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(18,'Monica','F','2022-05-23',9.97,34.2,'Shepherd',1,1,'confident','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Monica.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(19,'Bolo','F','2022-02-14',31.75,47.3,'Husky',1,1,'happy','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Bolo.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(20,'Sofie','F','2021-09-30',28.98,50.8,'Husky',1,1,'playful','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Sofie.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(21,'Arlo','M','2021-11-23',34.02,47.8,'Shepherd',1,1,'love seeking attention','good condition','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','Arlo.jpg',1,'2022-08-16 15:41:24','2022-08-16 15:41:24'),(22,'DOGS','M','2022-10-12',12.3,23.4,'Shar-Pei',1,1,'Active','good condition','fsasdfasdfasdfa','logo_100.png',0,'2022-10-12 14:30:25','2022-10-12 15:02:09'),(23,'dog','F','2022-10-12',15.3,26.4,'Huskey',1,1,'Activ','good','test description','logo_50.png',0,'2022-10-12 15:24:18','2022-10-12 15:26:17');
/*!40000 ALTER TABLE `animal_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animal_info_vaccination`
--

DROP TABLE IF EXISTS `animal_info_vaccination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animal_info_vaccination` (
  `ani_id` bigint(20) NOT NULL,
  `vac_id` bigint(20) NOT NULL,
  PRIMARY KEY (`ani_id`,`vac_id`),
  KEY `vac_id` (`vac_id`),
  CONSTRAINT `animal_info_vaccination_ibfk_1` FOREIGN KEY (`ani_id`) REFERENCES `animal_info` (`ani_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `animal_info_vaccination_ibfk_2` FOREIGN KEY (`vac_id`) REFERENCES `animal_vaccination` (`vac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal_info_vaccination`
--

LOCK TABLES `animal_info_vaccination` WRITE;
/*!40000 ALTER TABLE `animal_info_vaccination` DISABLE KEYS */;
INSERT INTO `animal_info_vaccination` VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2),(2,3),(2,4),(3,1),(3,2),(3,3),(4,1),(4,2),(4,3),(4,4),(5,1),(5,2),(6,1),(6,2),(6,3),(6,4),(7,1),(7,2),(7,3),(7,4),(8,1),(8,2),(8,3),(8,4),(9,1),(9,2),(9,3),(9,4),(10,1),(10,2),(10,3),(10,4),(11,1),(11,2),(11,3),(11,4),(12,1),(12,2),(12,3),(12,4),(13,1),(13,2),(13,3),(13,4),(14,1),(14,2),(14,3),(14,4),(15,1),(15,2),(15,3),(15,4),(16,1),(16,2),(16,3),(16,4),(17,1),(17,2),(18,1),(18,2),(18,3),(19,1),(19,2),(19,3),(19,4),(20,1),(20,2),(20,3),(20,4),(22,1),(22,2),(22,3),(22,4),(23,1),(23,2),(23,3);
/*!40000 ALTER TABLE `animal_info_vaccination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `animal_vaccination`
--

DROP TABLE IF EXISTS `animal_vaccination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animal_vaccination` (
  `vac_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `species` varchar(255) NOT NULL,
  `vac_name` varchar(150) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  PRIMARY KEY (`vac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal_vaccination`
--

LOCK TABLES `animal_vaccination` WRITE;
/*!40000 ALTER TABLE `animal_vaccination` DISABLE KEYS */;
INSERT INTO `animal_vaccination` VALUES (1,'dog','Distemper','Against three diseases: feline panleukopenia (feline distemper), feline viral rhinotracheitis (feline herpes), calicivirus plus Feline leukemia virus (FeLV)'),(2,'dog','Parvovirus','Immunizes dogs against canine distemper, adenovirus type-2 (hepatitis), parainfluenza, and parvovirus.'),(3,'dog','DHPP','Prevents distemper, parvovirus, parainfluenza, and two types of adenovirus (hepatitis)'),(4,'dog','Rabies','Prevents Rabies');
/*!40000 ALTER TABLE `animal_vaccination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3177 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_comments`
--

DROP TABLE IF EXISTS `user_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ani_id` bigint(20) NOT NULL,
  `comments` text DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_comments`
--

LOCK TABLES `user_comments` WRITE;
/*!40000 ALTER TABLE `user_comments` DISABLE KEYS */;
INSERT INTO `user_comments` VALUES (1,1,2,'test',1,'2022-10-07 12:56:53','2022-10-07 12:56:53'),(2,1,2,'test2',1,'2022-10-07 13:01:01','2022-10-07 13:01:01');
/*!40000 ALTER TABLE `user_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal_code` varchar(6) NOT NULL,
  `province` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` int(10) NOT NULL,
  `login_id` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `subscribe_to_newsletter` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Tony','Chan','tony_chan1026@yahoo.com.hk','100 Bison','Winnipeg','R3T2F4','Manitoba','Canada',2045783568,'tony_chan','$2y$10$k1LlYXJw/ybgqrSXkWDsBeUqH.kjlKMPAIIm6TMImZJul3AolOrwO',0,1,1,'2022-09-30 16:36:30','2022-09-30 16:36:30'),(2,'Freddy','Lau','kristieltk@gmail.com','100 Bison','Winnipeg','R3T2F4','Manitoba','Canada',2045783568,'freddy_lau','$2y$10$9Li9xihxlKO79/tmh7NFzuE20Xs9LZfmZwWn7lowjQn02cjF60Hru',0,0,1,'2022-09-30 16:38:17','2022-09-30 16:38:17'),(3,'Freddy','Lau','freddylau@gmail.com','100 Bison','Winnipeg','R3T2F4','Manitoba','Canada',2042367840,'freddy_lau','$2y$10$6RAGO1FYEM6Y92NDrfFR/.ap3p1F3I2KipTJx5ASjcprDa10J0n8S',1,0,1,'2022-10-13 17:51:57','2022-10-13 17:51:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-13 18:38:22
