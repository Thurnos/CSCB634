-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `roles_role_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`roles_role_id`),
  KEY `fk_users_roles1_idx` (`roles_role_id`),
  CONSTRAINT `fk_users_roles1` FOREIGN KEY (`roles_role_id`) REFERENCES `roles` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'S.Antonov','c822a0abf4ef0a5fc2a4c2010ed111e16af3ae95cee462a55e7877b8623ade36','email@gmail.com',1),(2,'new_username','00b9e6622317a2fb628d5514b866d4e7c52b5b149027825645ae3fd72827e84e','new_email@example.com',1),(3,'student1','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','student1@example.com',3),(4,'parent1','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','parent1@example.com',4),(5,'teacher2','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','teacher2@example.com',2),(6,'student2','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','student2@example.com',3),(7,'parent2','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','parent2@example.com',4),(8,'teacher3','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','teacher3@example.com',2),(9,'student3','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','student3@example.com',3),(10,'parent3','ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','parent3@example.com',4);
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

-- Dump completed on 2024-06-11  0:32:40
