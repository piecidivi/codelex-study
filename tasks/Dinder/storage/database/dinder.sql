-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: dinderdb
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
-- Table structure for table `History`
--

DROP TABLE IF EXISTS `History`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `History` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `checked_id` int NOT NULL,
  `checked_name` varchar(30) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `liked` varchar(3) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `History`
--

LOCK TABLES `History` WRITE;
/*!40000 ALTER TABLE `History` DISABLE KEYS */;
INSERT INTO `History` VALUES (89,25,28,'Jenny','yes','2021-04-27 22:58:42'),(100,26,25,'James','no','2021-04-27 23:00:03'),(101,26,27,'Jim','no','2021-04-27 23:00:04'),(102,26,34,'Jakob','yes','2021-04-27 23:00:06'),(103,28,25,'James','yes','2021-04-27 23:00:45'),(104,28,27,'Jim','no','2021-04-27 23:00:46'),(105,28,34,'Jakob','yes','2021-04-27 23:02:41'),(110,34,26,'Ellen','yes','2021-04-27 23:09:04'),(111,34,28,'Jenny','yes','2021-04-27 23:09:08'),(112,34,29,'Mila','yes','2021-04-27 23:09:09'),(113,34,32,'Lana','yes','2021-04-27 23:09:10'),(114,34,36,'Tina','yes','2021-04-27 23:09:12'),(117,35,26,'Ellen','yes','2021-04-27 23:10:12'),(118,33,26,'Ellen','yes','2021-04-27 23:10:47'),(119,33,28,'Jenny','yes','2021-04-27 23:10:50'),(120,33,29,'Mila','yes','2021-04-27 23:10:51'),(121,33,30,'Ed','yes','2021-04-27 23:11:01'),(122,33,31,'Mike','yes','2021-04-27 23:11:07'),(123,33,32,'Lana','no','2021-04-27 23:11:08'),(145,29,25,'James','yes','2021-04-28 00:07:30'),(146,29,27,'Jim','yes','2021-04-28 00:07:31'),(147,29,30,'Ed','no','2021-04-28 00:07:32'),(148,29,33,'Theo','yes','2021-04-28 00:07:33'),(149,29,34,'Jakob','yes','2021-04-28 00:07:34');
/*!40000 ALTER TABLE `History` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `preference` char(1) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `original_image_name` varchar(255) COLLATE utf8mb4_0900_as_ci NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (25,'james@james.com','$2y$10$onWF/C.T/8Wy9IDtcagjsu0Bra4Y08r4ME/tTcp6N92O.9EzbgFPC','James','M','F','pictures/608/859/608859e7e0fd3.jpg','ayo-ogunseinde-2-unsplash.jpg','2021-04-27 18:36:29'),(26,'ellen@ellen.com','$2y$10$d0llKmA/U8FkN/757oNbpeCvMY2tDWeMjjmGn8h/048dzh4QgWRpO','Ellen','F','A','pictures/608/85a/60885a3fb54b6.jpg','ayo-ogunseinde-unsplash.jpg','2021-04-27 18:38:14'),(27,'jim@jim.com','$2y$10$f1PflloTftwymMe/Ko61k.fsw2vG.1.e0M/RngBLxEOawG77YuTZS','Jim','M','F','pictures/608/85a/60885ada1c02a.jpg','albert-dera-unsplash.jpg','2021-04-27 18:40:51'),(28,'jenny@jenny.com','$2y$10$PqPIrJO/TmSf/fZ3W7Ep1ujLetF9FZ8a/qnwQaOVd1qVa.GjPBKeW','Jenny','F','M','pictures/608/897/608897be7410d.jpg','ayo-ogunseinde-5-unsplash.jpg','2021-04-27 18:41:58'),(29,'mila@mila.com','$2y$10$w2z14xVfBocbZxTv.C42hOsTuwYpIyyUaWA0Nj.5VqEmmCu6n1QKq','Mila','F','M','pictures/608/85b/60885b6f0851f.jpg','alexandru-zdrobau-unsplash.jpg','2021-04-27 18:43:15'),(30,'ed@ed.com','$2y$10$m7sWUbRxREAc4PFQPFRz5uvWY33DkyXJW4mhVPrKq2ZmXj69MVQfi','Ed','M','A','pictures/608/85c/60885c5cc1263.jpg','drew-hays-unsplash.jpg','2021-04-27 18:47:24'),(31,'mike@mike.com','$2y$10$lM5RGxUCQ2zkvKaN1MuQVeMCq29ZsBcEcngkdoOaJ4vlPL3.YMIKC','Mike','M','M','pictures/608/85c/60885c8496959.jpg','erik-lucatero-unsplash.jpg','2021-04-27 18:48:18'),(32,'lana@lana.com','$2y$10$Kp8A.Friu6lA5H3qqF2jBO.qfEjg5DLmf3jOUJV0LB15ZBmdAnbTy','Lana','F','A','pictures/608/85c/60885cb7e7543.jpg','gabriel-silverio-unsplash.jpg','2021-04-27 18:49:06'),(33,'theo@theo.com','$2y$10$v/KRT1QR..HRqkakcsWxqOXZgOgwkDIeJi3nSjZqms6/SXlhh.AaC','Theo','M','A','pictures/608/85c/60885ce2183c4.jpg','ivana-cajina-unsplash.jpg','2021-04-27 18:49:48'),(34,'jakob@jakob.com','$2y$10$C8LXJLM0zYH7bRJmuytdzO8NdMsgwzbIUb3/5HKgLnumTVMe/RK66','Jakob','M','F','pictures/608/85d/60885d082217e.jpg','jakob-owens-unsplash.jpg','2021-04-27 18:50:29'),(35,'michaela@michaela.com','$2y$10$pqg0WVGsSkH9Yr91OqF8Fe.btNzI2tXv7/7omKaAgRhaGlwAFZaIq','Michaela','F','F','pictures/608/85d/60885d31a299d.jpg','michael-dam-unsplash.jpg','2021-04-27 18:51:08'),(36,'tina@tina','$2y$10$icv1BKqI088zHooqrnLOGuQkEAva3C2JBmTPH8bsWok59Cq1/U/ue','Tina','F','M','pictures/608/85d/60885d616a0fd.jpg','milan-gurung-unsplash.jpg','2021-04-27 18:51:47'),(37,'tom@tom.com','$2y$10$bvEZxirvIgUvCVCooYGSeu9Z7AjqZh.DPVp/HSH7cAi/fOZ22ngD6','Tom','M','F','pictures/608/85d/60885d8351edf.jpg','mubariz-mehdizadeh-unsplash.jpg','2021-04-27 18:52:31'),(38,'stefy@stefy.com','$2y$10$PaazzjVFUQ9ceQFmkFVaVOtrL6tBC.wJgpOkBmxLnUI8JeHT7tVLO','Stefy','F','M','pictures/608/85d/60885da824da5.jpg','stefan-stefancik-unsplash.jpg','2021-04-27 18:53:10');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-28  3:10:35
