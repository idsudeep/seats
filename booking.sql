-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: booking
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_number` int(11) DEFAULT NULL,
  `seat_numbers` varchar(255) DEFAULT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `booking_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking`
--

LOCK TABLES `booking` WRITE;
/*!40000 ALTER TABLE `booking` DISABLE KEYS */;
INSERT INTO `booking` VALUES (1,5796,'B3,B4','Pedro','2023-07-16 23:22:10');
/*!40000 ALTER TABLE `booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus`
--

DROP TABLE IF EXISTS `bus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_number` varchar(10) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bus_number` (`bus_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus`
--

LOCK TABLES `bus` WRITE;
/*!40000 ALTER TABLE `bus` DISABLE KEYS */;
INSERT INTO `bus` VALUES (1,'5697','2023',20);
/*!40000 ALTER TABLE `bus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat_layout`
--

DROP TABLE IF EXISTS `seat_layout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seat_layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `busno` int(11) NOT NULL,
  `rightside` varchar(10) NOT NULL,
  `leftside` varchar(10) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat_layout`
--

LOCK TABLES `seat_layout` WRITE;
/*!40000 ALTER TABLE `seat_layout` DISABLE KEYS */;
INSERT INTO `seat_layout` VALUES (1,5697,'A1','B1'),(2,5697,'A2','B2'),(3,5697,'A3','B3'),(4,5697,'A4','B4'),(5,5697,'A5','B5'),(6,5697,'A6','B6'),(7,5697,'A7','B7'),(8,5697,'A8','B8'),(9,5697,'A9','B9'),(10,5697,'A10','B10');
/*!40000 ALTER TABLE `seat_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat_status`
--

DROP TABLE IF EXISTS `seat_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seat_status` (
  `seatid` int(11) NOT NULL AUTO_INCREMENT,
  `busno` int(11) NOT NULL,
  `seatno` int(11) NOT NULL,
  `status` enum('booking','selected','available') NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`seatid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat_status`
--

LOCK TABLES `seat_status` WRITE;
/*!40000 ALTER TABLE `seat_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `seat_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seats`
--

DROP TABLE IF EXISTS `seats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_number` varchar(10) DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bus_number` (`bus_number`),
  CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`bus_number`) REFERENCES `bus` (`bus_number`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seats`
--

LOCK TABLES `seats` WRITE;
/*!40000 ALTER TABLE `seats` DISABLE KEYS */;
INSERT INTO `seats` VALUES (1,'5697','A1','2023-07-16','available'),(2,'5697','A2','2023-07-16','available'),(3,'5697','A3','2023-07-16','available'),(4,'5697','A4','2023-07-16','available'),(6,'5697','B1','2023-07-16','available'),(7,'5697','B2','2023-07-16','available'),(8,'5697','B3','2023-07-16','booked'),(9,'5697','B4','2023-07-16','booked'),(10,'5697','A5','2023-07-16','available'),(11,'5697','A6','2023-07-16','available'),(12,'5697','B5','2023-07-16','available'),(13,'5697','B6','2023-07-16','available'),(14,'5697','A7','2023-07-16','available'),(15,'5697','A8','2023-07-16','available'),(16,'5697','B7','2023-07-16','available'),(17,'5697','B8','2023-07-16','available');
/*!40000 ALTER TABLE `seats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-16 23:38:12