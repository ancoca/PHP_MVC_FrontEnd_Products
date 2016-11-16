CREATE DATABASE  IF NOT EXISTS `Framework` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `Framework`;
-- MySQL dump 10.13  Distrib 5.7.12, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: Framework
-- ------------------------------------------------------
-- Server version	5.7.16-0ubuntu0.16.04.1

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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `barcode` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `explicacion` varchar(500) NOT NULL,
  `cost` float NOT NULL,
  `stock` tinyint(1) NOT NULL,
  `made_in_country` varchar(50) NOT NULL,
  `made_in_province` varchar(50) NOT NULL,
  `made_in_city` varchar(50) NOT NULL,
  `electrodomestico` tinyint(1) NOT NULL,
  `informatica` tinyint(1) NOT NULL,
  `aire_acondicionado` tinyint(1) NOT NULL,
  `cocina` tinyint(1) NOT NULL,
  `promotion_start` varchar(30) NOT NULL,
  `promotion_end` varchar(30) NOT NULL,
  PRIMARY KEY (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (123456,'ProductoUno','media/1665607218-calavera one piece.jpg','Primer producto',1,1,'ES','46','Ontinyent',1,0,0,0,'01/11/2016','15/11/2016'),(234567,'ProductoDos','media/1661769938-calavera one piece.jpg','Producto Dos',2,1,'ES','46','Ontinyent',0,1,0,0,'21/11/2016','29/11/2016'),(345678,'ProductoTres','media/2079495989-calavera one piece.jpg','Producto Tres',3,1,'ES','46','Ontinyent',0,0,1,0,'07/11/2016','23/11/2016'),(456789,'ProductoCuatro','media/365176561-calavera one piece.jpg','Producto Cuatro',4,1,'ES','46','Ontinyent',0,0,0,1,'16/11/2016','30/11/2016');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-08 18:51:11
