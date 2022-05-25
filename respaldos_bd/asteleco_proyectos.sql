-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: asteleco_proyectos
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `asignaciones_proyectos`
--

DROP TABLE IF EXISTS `asignaciones_proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asignaciones_proyectos` (
  `id_asignaciones_proyectos` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyectos` int(11) NOT NULL,
  `id_lista_personal` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_asignaciones_proyectos`),
  KEY `fk_asignaciones_proyectos_proyectos1_idx` (`id_proyectos`),
  CONSTRAINT `fk_asignaciones_proyectos_proyectos1` FOREIGN KEY (`id_proyectos`) REFERENCES `proyectos` (`id_proyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignaciones_proyectos`
--

LOCK TABLES `asignaciones_proyectos` WRITE;
/*!40000 ALTER TABLE `asignaciones_proyectos` DISABLE KEYS */;
INSERT INTO `asignaciones_proyectos` VALUES (1,4,6,0),(2,4,2,0),(3,4,3,0),(4,4,2,0),(5,4,6,0),(6,4,1,1),(7,4,12,1),(8,4,14,1),(9,6,14,1);
/*!40000 ALTER TABLE `asignaciones_proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones_proyecto`
--

DROP TABLE IF EXISTS `direcciones_proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones_proyecto` (
  `id_direcciones_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_calle` varchar(45) DEFAULT NULL,
  `direccion_numero_int` varchar(45) DEFAULT NULL,
  `direccion_numero_ext` varchar(45) DEFAULT NULL,
  `direccion_colonia` varchar(45) DEFAULT NULL,
  `direccion_municipio` varchar(45) DEFAULT NULL,
  `direccion_zipcode` varchar(45) DEFAULT NULL,
  `direccion_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_direcciones_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones_proyecto`
--

LOCK TABLES `direcciones_proyecto` WRITE;
/*!40000 ALTER TABLE `direcciones_proyecto` DISABLE KEYS */;
INSERT INTO `direcciones_proyecto` VALUES (1,'Loma de Chapultepec',NULL,'16','Francisco I. Madero','Nicolás Romero','54400','Estado de México'),(2,'','','','','Los Cabos','','Baja California Sur'),(3,'AV PRINCIPAL','1','12','DEL VALLE','Azcapotzalco','5400','Ciudad de México'),(4,'AV PRINCIPAL','1','12','DEL VALLE','Azcapotzalco','5400','Ciudad de México'),(5,'AV PRINCIPAL','141','13','DEL VALLE','Mexicali','5400','Baja California'),(6,'AV PRINCIPAL','1','12','DEL VALLE','Palizada','5400','Campeche'),(7,'AV PRINCIPAL','','12','DEL VALLE','Huaniqueo','5400','Michoacán de Ocampo');
/*!40000 ALTER TABLE `direcciones_proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyectos`
--

DROP TABLE IF EXISTS `proyectos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyectos` (
  `id_proyectos` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipos_proyecto` int(11) NOT NULL,
  `id_direcciones_proyecto` int(11) NOT NULL,
  `id_regiones` int(11) NOT NULL,
  `codigo_proyecto` varchar(45) DEFAULT NULL,
  `nombre_proyecto` varchar(250) DEFAULT NULL,
  `nombre_corto` varchar(45) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `id_personal_creador` varchar(45) DEFAULT NULL,
  `id_personal_cerrado` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_proyectada_cierre` date DEFAULT NULL,
  `fecha_cierre_real` date DEFAULT NULL,
  `log_creacion` datetime DEFAULT NULL,
  `show_proyect` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_proyectos`),
  KEY `fk_proyectos_direcciones_proyecto_idx` (`id_direcciones_proyecto`),
  KEY `fk_proyectos_tipos_proyecto1_idx` (`id_tipos_proyecto`),
  KEY `fk_proyectos_regiones1_idx` (`id_regiones`),
  CONSTRAINT `fk_proyectos_direcciones_proyecto` FOREIGN KEY (`id_direcciones_proyecto`) REFERENCES `direcciones_proyecto` (`id_direcciones_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyectos_regiones1` FOREIGN KEY (`id_regiones`) REFERENCES `regiones` (`id_regiones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proyectos_tipos_proyecto1` FOREIGN KEY (`id_tipos_proyecto`) REFERENCES `tipos_proyecto` (`id_tipos_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyectos`
--

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` VALUES (4,1,4,2,'Acc-AccR2-8yvR2','Accesos Xochimilco',NULL,'PRUEBA 2','1',NULL,'1','2022-03-23','0000-00-00',NULL,'2022-03-10 08:39:17',1),(5,1,5,3,'Acc-TolR3-wsr','Accesos Tollocan',NULL,'QEVWRVBWEVRE','1',NULL,'0','2022-03-31','0000-00-00',NULL,'2022-03-10 08:42:30',1),(6,1,6,9,'Acc-EcaR9-iwr','Accesos Ecatepec',NULL,'','1',NULL,'1','2022-03-22','0000-00-00',NULL,'2022-03-10 09:42:58',1),(7,2,7,6,'Des-deR6-a93','Desmontaje de equipo',NULL,'Desmontaje realziado para TELCEL a través de Radiomóvil DIPSA S.A. DE C.V.','11',NULL,'1','2022-03-01','0000-00-00',NULL,'2022-03-23 12:53:32',0);
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regiones`
--

DROP TABLE IF EXISTS `regiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regiones` (
  `id_regiones` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_region` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_regiones`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regiones`
--

LOCK TABLES `regiones` WRITE;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;
INSERT INTO `regiones` VALUES (1,'1'),(2,'2'),(3,'3'),(4,'4'),(5,'5'),(6,'6'),(7,'7'),(8,'8'),(9,'9');
/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_proyecto`
--

DROP TABLE IF EXISTS `tipos_proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_proyecto` (
  `id_tipos_proyecto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_tipo` varchar(45) DEFAULT NULL,
  `descripcion_corta` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipos_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_proyecto`
--

LOCK TABLES `tipos_proyecto` WRITE;
/*!40000 ALTER TABLE `tipos_proyecto` DISABLE KEYS */;
INSERT INTO `tipos_proyecto` VALUES (1,'Accesos','ACC'),(2,'Desmontajes','DES');
/*!40000 ALTER TABLE `tipos_proyecto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-25 11:25:14
