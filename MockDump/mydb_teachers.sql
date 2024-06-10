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
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `teacher_id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `qualifications_qualification_id` int NOT NULL,
  `schools_school_id` int NOT NULL,
  `grades_grade_id` int NOT NULL,
  `subjects_subject_id` int NOT NULL,
  `subjects_list` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`,`qualifications_qualification_id`,`schools_school_id`,`grades_grade_id`,`subjects_subject_id`),
  KEY `fk_teachers_qualifications1_idx` (`qualifications_qualification_id`),
  KEY `fk_teachers_schools1_idx` (`schools_school_id`),
  KEY `fk_teachers_grades1_idx` (`grades_grade_id`),
  KEY `fk_teachers_subjects1_idx` (`subjects_subject_id`),
  CONSTRAINT `fk_teachers_grades1` FOREIGN KEY (`grades_grade_id`) REFERENCES `grades` (`grade_id`),
  CONSTRAINT `fk_teachers_qualifications1` FOREIGN KEY (`qualifications_qualification_id`) REFERENCES `qualifications` (`qualification_id`),
  CONSTRAINT `fk_teachers_schools1` FOREIGN KEY (`schools_school_id`) REFERENCES `schools` (`school_id`),
  CONSTRAINT `fk_teachers_subjects1` FOREIGN KEY (`subjects_subject_id`) REFERENCES `subjects` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (2,'Paul White','paul.white@example.com',2,1,2,2,'Science, History'),(3,'Linda Black','linda.black@example.com',3,2,3,3,'History, Geography'),(4,'James Blue','james.blue@example.com',4,2,4,4,'Geography, Art'),(5,'Patricia Yellow','patricia.yellow@example.com',5,3,5,5,'Art, Math');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
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
