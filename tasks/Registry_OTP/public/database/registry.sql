-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: registrydb
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
-- Table structure for table `Person`
--

DROP TABLE IF EXISTS `Person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Person` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `personal_code` char(11) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `age` varchar(3) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_0900_as_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_code` (`personal_code`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Person`
--

LOCK TABLES `Person` WRITE;
/*!40000 ALTER TABLE `Person` DISABLE KEYS */;
INSERT INTO `Person` VALUES (72,'59246111111','Maija','Krastiņa','26','Priežu iela 15, Skaistkalne','Twig tests.'),(73,'12345612345','Ieva','Svīriņa','27','Pastaigas iela 6, Ventspils','Šorīt bija sniegs.'),(74,'29496713324','Gvate Mala','Hondu-Rasa','25','Rūpniecības iela 17, Gulbene','Rīt pabraukāsimies.'),(75,'28459374951','Iveta','Antarktīda','45','Liepkalnu iela 27, Rūjiena','Kaut kāds aprakstiņš!'),(76,'28504258904','Laima','Okeānija','33','Karstgalvju prospekts 45, Jēkabpils','Kaut ko ierakstīsim arī šeit.'),(77,'24590724634','Ilze Mētra','Sviesta-Beka','28','Stirnu gatve 12, Kuldīga','Nekad nav būts Kuldīgā.'),(79,'45742533029','Monta','Pīlādze','22','\"Jāņogas\", Madona','Ir jau manāms progress.'),(83,'28459270951','Baiba Elīna Madara','Lauksaimniece','25','Stāvgrūdas, Liepziedu aleja 16, Bauska','Feins aprakstiņš.');
/*!40000 ALTER TABLE `Person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tokens`
--

DROP TABLE IF EXISTS `Tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Tokens` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `personal_code` char(11) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `expiry_time` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tokens`
--

LOCK TABLES `Tokens` WRITE;
/*!40000 ALTER TABLE `Tokens` DISABLE KEYS */;
INSERT INTO `Tokens` VALUES (27,'59246111111','592461111111617980505',1617980505),(28,'59246111111','592461111111617980666',1617980666),(31,'45742533029','457425330291617981166',1617981166),(32,'45742533029','457425330291617981282',1617981282),(33,'28504258904','285042589041617982074',1617982074),(34,'28459374951','284593749511617983421',1617983421),(35,'29496713324','294967133241617984330',1617984330),(36,'28504258904','285042589041617984778',1617984778),(37,'28459374951','284593749511617984787',1617984787),(38,'29496713324','294967133241617985391',1617985391);
/*!40000 ALTER TABLE `Tokens` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-09 19:11:47
