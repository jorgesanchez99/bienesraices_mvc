-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedores_idx` (`vendedores_id`),
  CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (27,' Otra Propiedad papu',89999.00,'1bc0770eb820836feee0fbf4ac2c9648.jpg','Casa Nueva',9,9,9,'2025-01-24',2),(29,'codocodocodco',90900.00,'3f7bfb3a291368ca40cfc24dee1bce48.jpg','Casa Nueva',1,1,1,'2025-01-25',1),(31,'Aguila Biotecnologica',88888.00,'8cdde4e82ace0f2f22e157bb5f24dae5.jpg','Casa Nueva',1,3,2,'2025-01-25',1),(32,'Nuevo titulo tuneado - Actualizado con MVC',88888.00,'8cdde4e82ace0f2f22e157bb5f24dae5.jpg','Casa Nueva Nuevo titulo tuneado - Actualizado con MVCNuevo titulo tuneado - Actualizado con MVC',8,7,6,'2025-01-25',2),(33,' Casa con los papus desde MVC',121122.00,'7664645da45c96033bbc1be312ccc606.jpg','Casa con los papus desde MVCCasa con los papus desde MVCCasa con los papus desde MVCCasa con los papus desde MVC',3,2,1,'2025-01-26',11),(34,' Casa tuneada',12999.00,'6a0c6034fac3aa7b635c7917cb9e29ed.jpg','Casa tuneadaCasa tuneadaCasa tuneadaCasa tuneadaCasa tuneada',8,8,8,'2025-01-26',3),(35,' Mi jato',8888.00,'a7eb1a0325c1bd115666d34036e21940.jpg','Mi jatoMi jatoMi jatoMi jatoMi jatoMi jatoMi jato',7,7,7,'2025-01-26',4),(36,' Nueva casita papu',66666.00,'d1f67dbd5794a0e7c3e1a22ea745f469.jpg','Nueva casita papuNueva casita papuNueva casita papuNueva casita papu',3,2,1,'2025-01-26',2);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (25,'correo@correo.com','$2y$10$yz.FYWL26GFypYvCw7qyIezVvZNlks6acbI8XfuycFpEEjIRe1TZu');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Jorge','Sanchez','123456789'),(2,'Ibito','Huaman','987654321'),(3,'Samuel','Huaman','987654321'),(4,'Josalo','Huaman','987654321'),(9,' pepe','peralta','12312 '),(11,' Ana ','Ana','777777777');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-27  0:33:47
