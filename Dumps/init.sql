-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: ditech
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `horario` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
INSERT INTO `horarios` VALUES (1,'08:00'),(2,'09:00'),(3,'10:00'),(4,'11:00'),(5,'12:00'),(6,'13:00'),(7,'14:00'),(8,'15:00'),(9,'16:00'),(10,'17:00'),(11,'18:00'),(12,'19:00'),(13,'20:00');
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salas`
--

DROP TABLE IF EXISTS `salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sala` varchar(86) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salas`
--

LOCK TABLES `salas` WRITE;
/*!40000 ALTER TABLE `salas` DISABLE KEYS */;
INSERT INTO `salas` VALUES (1,'Sala 000914',1,'2016-12-19 22:09:30',0),(2,'Sala 00011',1,'2016-12-18 15:52:31',1);
/*!40000 ALTER TABLE `salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salas_reserva`
--

DROP TABLE IF EXISTS `salas_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salas_reserva` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `inicio` time NOT NULL,
  `fim` time NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salas_reserva`
--

LOCK TABLES `salas_reserva` WRITE;
/*!40000 ALTER TABLE `salas_reserva` DISABLE KEYS */;
INSERT INTO `salas_reserva` VALUES (3,4,1,'11:00:00','12:00:00',1,'2016-12-19 23:05:56');
/*!40000 ALTER TABLE `salas_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(99) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `nome_extenso` varchar(199) NOT NULL,
  `id_setor` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'vitor','07917207','Vitor Dorneles',1,1,1,'0000-00-00 00:00:00'),(2,'ditechguy','ditechguy','Ditech',1,1,1,'2016-12-18 02:10:15'),(3,'ditech.comum','ditech_comum','Ditech Comum',1,0,1,'2016-12-18 02:13:53'),(4,'teste','1234','teste',1,0,1,'2016-12-18 02:15:51'),(5,'teste2','qweqweqweqwe','teste 22222',1,0,1,'2016-12-18 02:30:28'),(6,'vitor.pimentel','ertertert','viittrtrt',1,0,1,'2016-12-18 15:07:23');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_setores`
--

DROP TABLE IF EXISTS `usuarios_setores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_setores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setor` varchar(89) NOT NULL,
  `status` int(11) NOT NULL,
  `data_ultima_alteracao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_setores`
--

LOCK TABLES `usuarios_setores` WRITE;
/*!40000 ALTER TABLE `usuarios_setores` DISABLE KEYS */;
INSERT INTO `usuarios_setores` VALUES (1,'TI',1,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `usuarios_setores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-19 22:46:14
