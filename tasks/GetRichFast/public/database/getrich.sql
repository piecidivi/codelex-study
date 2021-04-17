-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: getrichdb
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Bankroll`
--

DROP TABLE IF EXISTS `Bankroll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Bankroll` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `bankroll` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bankroll`
--

LOCK TABLES `Bankroll` WRITE;
/*!40000 ALTER TABLE `Bankroll` DISABLE KEYS */;
INSERT INTO `Bankroll` VALUES (1,'Secret bankroll',70710);
/*!40000 ALTER TABLE `Bankroll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Shares`
--

DROP TABLE IF EXISTS `Shares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Shares` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `symbol` varchar(15) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `amount` int NOT NULL,
  `priceOne` int NOT NULL,
  `quote` int NOT NULL,
  `project` int NOT NULL,
  `purchase_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `profitState` varchar(15) COLLATE utf8mb4_0900_as_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shares`
--

LOCK TABLES `Shares` WRITE;
/*!40000 ALTER TABLE `Shares` DISABLE KEYS */;
INSERT INTO `Shares` VALUES (33,'PINS',2,7622,7622,0,'2021-04-16 23:50:19','closed','gray'),(34,'EDIT',5,3467,0,0,'2021-04-16 23:50:53','open','gray'),(35,'MSFT',2,26074,26074,0,'2021-04-16 23:51:15','closed','gray'),(36,'MILE',15,797,0,0,'2021-04-16 23:52:26','open','gray');
/*!40000 ALTER TABLE `Shares` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-17  2:58:21
