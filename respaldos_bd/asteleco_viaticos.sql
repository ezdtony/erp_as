-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: asteleco_viaticos
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
  `id_proyecto` int(11) DEFAULT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `asignado_por` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_asignaciones_proyectos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asignaciones_proyectos`
--

LOCK TABLES `asignaciones_proyectos` WRITE;
/*!40000 ALTER TABLE `asignaciones_proyectos` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignaciones_proyectos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clases_gasto`
--

DROP TABLE IF EXISTS `clases_gasto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clases_gasto` (
  `id_clases_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id_clases_gasto`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clases_gasto`
--

LOCK TABLES `clases_gasto` WRITE;
/*!40000 ALTER TABLE `clases_gasto` DISABLE KEYS */;
INSERT INTO `clases_gasto` VALUES (1,'Viáticos'),(2,'Herramienta y Material'),(3,'Otros');
/*!40000 ALTER TABLE `clases_gasto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `depositos`
--

DROP TABLE IF EXISTS `depositos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `depositos` (
  `id_depositos` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) DEFAULT NULL,
  `id_asignacion_proyecto` int(11) DEFAULT NULL,
  `id_tipos_gasto` int(11) NOT NULL,
  `id_personal_registro` int(11) NOT NULL,
  `sitio` varchar(100) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `origen` varchar(45) DEFAULT NULL,
  `ruta_img` int(11) DEFAULT NULL,
  `ruta_pdf` int(11) DEFAULT NULL,
  `ruta_xml` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_depositos`),
  KEY `id_tipos_gasto` (`id_tipos_gasto`),
  CONSTRAINT `id_tipos_gasto` FOREIGN KEY (`id_tipos_gasto`) REFERENCES `tipos_gasto` (`id_tipos_gasto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depositos`
--

LOCK TABLES `depositos` WRITE;
/*!40000 ALTER TABLE `depositos` DISABLE KEYS */;
INSERT INTO `depositos` VALUES (1,1,4,1,11,'Calzada del Hueso','100.00','2022-04-11',NULL,NULL,NULL,NULL,'2022-04-11 00:00:00'),(2,6,4,1,11,'Autopista México-Puebla','80.50','2022-04-11',NULL,NULL,NULL,NULL,'2022-04-11 00:42:49'),(3,6,4,2,11,'Calzada del Hueso','48.40','2022-04-10',NULL,NULL,NULL,NULL,'2022-04-11 00:52:38'),(4,1,4,1,11,'ECATEPEC','100.00','2022-04-11',NULL,NULL,NULL,NULL,'2022-04-11 01:49:34'),(5,12,4,2,11,'','85.00','2022-04-01',NULL,NULL,NULL,NULL,'2022-04-12 13:15:22');
/*!40000 ALTER TABLE `depositos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formas_pago`
--

DROP TABLE IF EXISTS `formas_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formas_pago` (
  `id_formas_pago` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `nombre_corto` varchar(45) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_formas_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formas_pago`
--

LOCK TABLES `formas_pago` WRITE;
/*!40000 ALTER TABLE `formas_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `formas_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gastos`
--

DROP TABLE IF EXISTS `gastos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastos` (
  `id_gastos` int(11) NOT NULL AUTO_INCREMENT,
  `id_formas_pago` int(11) NOT NULL,
  `id_asignaciones_proyectos` int(11) NOT NULL,
  `id_status_type` int(11) NOT NULL,
  `id_tipos_gasto` int(11) NOT NULL,
  `id_personal` varchar(45) DEFAULT NULL,
  `tipo_gasto_manual` varchar(45) DEFAULT NULL,
  `importe` varchar(45) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `clasificacion` int(11) DEFAULT NULL,
  `id_estado` varchar(45) DEFAULT NULL,
  `id_municipio` varchar(45) DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `coordenadas` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `folio_fiscal` varchar(45) DEFAULT NULL,
  `comentarios_usuario` varchar(45) DEFAULT NULL,
  `comentarios_administrador` varchar(45) DEFAULT NULL,
  `id_ruta_img` int(11) DEFAULT NULL,
  `id_ruta_pdf` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_gastos`),
  KEY `fk_gastos_formas_pago_idx` (`id_formas_pago`),
  KEY `fk_gastos_asignaciones_proyectos1_idx` (`id_asignaciones_proyectos`),
  KEY `fk_gastos_status_type1_idx` (`id_status_type`),
  KEY `fk_gastos_tipos_gasto1_idx` (`id_tipos_gasto`),
  CONSTRAINT `fk_gastos_asignaciones_proyectos1` FOREIGN KEY (`id_asignaciones_proyectos`) REFERENCES `asignaciones_proyectos` (`id_asignaciones_proyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gastos_formas_pago` FOREIGN KEY (`id_formas_pago`) REFERENCES `formas_pago` (`id_formas_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gastos_status_type1` FOREIGN KEY (`id_status_type`) REFERENCES `status_type` (`id_status_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gastos_tipos_gasto1` FOREIGN KEY (`id_tipos_gasto`) REFERENCES `tipos_gasto` (`id_tipos_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
/*!40000 ALTER TABLE `gastos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reposiciones`
--

DROP TABLE IF EXISTS `reposiciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reposiciones` (
  `id_reposiciones` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipos_gasto` int(11) NOT NULL,
  `id_formas_pago` int(11) NOT NULL,
  `id_status_type` int(11) NOT NULL,
  `id_asignaciones_proyectos` int(11) NOT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  `importe` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_reposiciones`),
  KEY `fk_reposiciones_tipos_gasto1_idx` (`id_tipos_gasto`),
  KEY `fk_reposiciones_formas_pago1_idx` (`id_formas_pago`),
  KEY `fk_reposiciones_status_type1_idx` (`id_status_type`),
  KEY `fk_reposiciones_asignaciones_proyectos1_idx` (`id_asignaciones_proyectos`),
  CONSTRAINT `fk_reposiciones_asignaciones_proyectos1` FOREIGN KEY (`id_asignaciones_proyectos`) REFERENCES `asignaciones_proyectos` (`id_asignaciones_proyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reposiciones_formas_pago1` FOREIGN KEY (`id_formas_pago`) REFERENCES `formas_pago` (`id_formas_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reposiciones_status_type1` FOREIGN KEY (`id_status_type`) REFERENCES `status_type` (`id_status_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reposiciones_tipos_gasto1` FOREIGN KEY (`id_tipos_gasto`) REFERENCES `tipos_gasto` (`id_tipos_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reposiciones`
--

LOCK TABLES `reposiciones` WRITE;
/*!40000 ALTER TABLE `reposiciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `reposiciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutas_archivos`
--

DROP TABLE IF EXISTS `rutas_archivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutas_archivos` (
  `id_rutas_archivos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `tipo_archivo` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  `fecha_subido` date DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rutas_archivos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas_archivos`
--

LOCK TABLES `rutas_archivos` WRITE;
/*!40000 ALTER TABLE `rutas_archivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `rutas_archivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saldos`
--

DROP TABLE IF EXISTS `saldos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saldos` (
  `id_saldos` int(11) NOT NULL AUTO_INCREMENT,
  `id_personal` int(11) DEFAULT NULL,
  `saldo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_saldos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saldos`
--

LOCK TABLES `saldos` WRITE;
/*!40000 ALTER TABLE `saldos` DISABLE KEYS */;
INSERT INTO `saldos` VALUES (1,1,'700');
/*!40000 ALTER TABLE `saldos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_type`
--

DROP TABLE IF EXISTS `status_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_type` (
  `id_status_type` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `descripcion_corta` varchar(45) DEFAULT NULL,
  `color_html` varchar(45) DEFAULT NULL,
  `clase_css` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_status_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_type`
--

LOCK TABLES `status_type` WRITE;
/*!40000 ALTER TABLE `status_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_gasto`
--

DROP TABLE IF EXISTS `tipos_gasto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_gasto` (
  `id_tipos_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `id_clases_gasto` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `descr_corta` varchar(45) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipos_gasto`),
  KEY `id_clases_gasto` (`id_clases_gasto`),
  CONSTRAINT `id_clases_gasto` FOREIGN KEY (`id_clases_gasto`) REFERENCES `clases_gasto` (`id_clases_gasto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_gasto`
--

LOCK TABLES `tipos_gasto` WRITE;
/*!40000 ALTER TABLE `tipos_gasto` DISABLE KEYS */;
INSERT INTO `tipos_gasto` VALUES (1,1,'Alimentación',NULL,NULL),(2,1,'Hospedaje',NULL,NULL);
/*!40000 ALTER TABLE `tipos_gasto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-13 11:56:10
