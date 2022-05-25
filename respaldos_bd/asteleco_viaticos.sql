-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: asteleco_viaticos
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `depositos`
--

LOCK TABLES `depositos` WRITE;
/*!40000 ALTER TABLE `depositos` DISABLE KEYS */;
INSERT INTO `depositos` VALUES (8,1,4,1,11,'Coapa','500.00','2022-04-21',NULL,NULL,NULL,NULL,'2022-04-21 16:44:53'),(9,1,4,1,11,'PRUEBAS','4000.00','2022-05-11',NULL,NULL,NULL,NULL,'2022-05-11 13:11:36'),(10,1,4,2,11,'PRUEBAS','1500.00','2022-05-11',NULL,NULL,NULL,NULL,'2022-05-11 13:13:11'),(11,1,4,2,11,'CDMX','150.00','2022-05-24',NULL,NULL,NULL,NULL,'2022-05-24 15:50:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formas_pago`
--

LOCK TABLES `formas_pago` WRITE;
/*!40000 ALTER TABLE `formas_pago` DISABLE KEYS */;
INSERT INTO `formas_pago` VALUES (1,'Efectivo','EF',NULL),(2,'Tarjeta de Débito','TDD',NULL),(3,'Tarjeta de Crédito','TDC',NULL);
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
  `ap_coordinacion` int(11) NOT NULL DEFAULT 0,
  `ap_contabilidad` int(11) NOT NULL DEFAULT 0,
  `folio_fiscal` varchar(45) DEFAULT NULL,
  `comentarios_usuario` varchar(45) DEFAULT NULL,
  `comentarios_administrador` varchar(45) DEFAULT NULL,
  `id_ruta_img` int(11) DEFAULT NULL,
  `id_ruta_pdf` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_gastos`),
  KEY `fk_gastos_formas_pago_idx` (`id_formas_pago`),
  KEY `fk_gastos_status_type1_idx` (`id_status_type`),
  KEY `fk_gastos_tipos_gasto1_idx` (`id_tipos_gasto`),
  CONSTRAINT `fk_gastos_formas_pago` FOREIGN KEY (`id_formas_pago`) REFERENCES `formas_pago` (`id_formas_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gastos_status_type1` FOREIGN KEY (`id_status_type`) REFERENCES `status_type` (`id_status_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gastos_tipos_gasto1` FOREIGN KEY (`id_tipos_gasto`) REFERENCES `tipos_gasto` (`id_tipos_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastos`
--

LOCK TABLES `gastos` WRITE;
/*!40000 ALTER TABLE `gastos` DISABLE KEYS */;
INSERT INTO `gastos` VALUES (14,1,0,6,1,'1',NULL,'300.00','2022-05-11',2,NULL,NULL,'PRUEBA DE GASTO SIN FACTURA V.2',NULL,NULL,0,0,NULL,NULL,NULL,NULL,NULL,'2022-05-11 13:36:16'),(16,1,6,4,2,'1',NULL,'340.00','2022-05-11',2,NULL,NULL,'PRUEBA DE GASTO DEDUCIBLE SIN FACTURA',NULL,NULL,1,1,'EFNWVR21',NULL,NULL,23,26,'2022-05-11 13:38:35');
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
  `ruta_archivo` varchar(500) DEFAULT NULL,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `tipo_archivo` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT '1',
  `fecha_subido` date DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rutas_archivos`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas_archivos`
--

LOCK TABLES `rutas_archivos` WRITE;
/*!40000 ALTER TABLE `rutas_archivos` DISABLE KEYS */;
INSERT INTO `rutas_archivos` VALUES (1,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652285883.png','ast_img_2022_05_11-1652285883','png','1','2022-05-11','2022-05-11 11:18:03'),(2,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652285918.jpeg','ast_img_2022_05_11-1652285918','jpeg','1','2022-05-11','2022-05-11 11:18:38'),(3,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652285961.jpeg','ast_img_2022_05_11-1652285961','jpeg','1','2022-05-11','2022-05-11 11:19:21'),(4,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652285961.pdf','ast_doc_2022_05_11-1652285961','pdf','1','2022-05-11','2022-05-11 11:19:21'),(5,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652287389.jpeg','ast_img_2022_05_11-1652287389','jpeg','1','2022-05-11','2022-05-11 11:43:09'),(6,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652287389.pdf','ast_doc_2022_05_11-1652287389','pdf','1','2022-05-11','2022-05-11 11:43:09'),(7,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652290438.pdf','ast_doc_2022_05_11-1652290438','pdf','1','2022-05-11','2022-05-11 12:33:58'),(8,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652292868.jpeg','ast_img_2022_05_11-1652292868','jpeg','1','2022-05-11','2022-05-11 13:14:28'),(9,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652292958.jpeg','ast_img_2022_05_11-1652292958','jpeg','1','2022-05-11','2022-05-11 13:15:58'),(10,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652293743.jpeg','ast_img_2022_05_11-1652293743','jpeg','1','2022-05-11','2022-05-11 13:29:03'),(11,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652293794.jpeg','ast_img_2022_05_11-1652293794','jpeg','1','2022-05-11','2022-05-11 13:29:54'),(12,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652293836.jpeg','ast_img_2022_05_11-1652293836','jpeg','1','2022-05-11','2022-05-11 13:30:36'),(13,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652293879.jpeg','ast_img_2022_05_11-1652293879','jpeg','1','2022-05-11','2022-05-11 13:31:19'),(14,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652293879.pdf','ast_doc_2022_05_11-1652293879','pdf','1','2022-05-11','2022-05-11 13:31:19'),(15,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652293901.pdf','ast_doc_2022_05_11-1652293901','pdf','1','2022-05-11','2022-05-11 13:31:41'),(16,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652293955.pdf','ast_doc_2022_05_11-1652293955','pdf','1','2022-05-11','2022-05-11 13:32:35'),(17,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652294040.jpeg','ast_img_2022_05_11-1652294040','jpeg','1','2022-05-11','2022-05-11 13:34:00'),(18,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652294082.pdf','ast_doc_2022_05_11-1652294082','pdf','1','2022-05-11','2022-05-11 13:34:42'),(19,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652294082.jpeg','ast_img_2022_05_11-1652294082','jpeg','1','2022-05-11','2022-05-11 13:34:42'),(20,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652294123.pdf','ast_doc_2022_05_11-1652294123','pdf','1','2022-05-11','2022-05-11 13:35:23'),(21,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652294123.jpeg','ast_img_2022_05_11-1652294123','jpeg','1','2022-05-11','2022-05-11 13:35:23'),(22,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652294289.jpeg','ast_img_2022_05_11-1652294289','jpeg','1','2022-05-11','2022-05-11 13:38:09'),(23,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652294315.jpeg','ast_img_2022_05_11-1652294315','jpeg','1','2022-05-11','2022-05-11 13:38:35'),(24,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652294351.pdf','ast_doc_2022_05_11-1652294351','pdf','1','2022-05-11','2022-05-11 13:39:11'),(25,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/TICKETS_COMPRA/ast_img_2022_05_11-1652294351.jpeg','ast_img_2022_05_11-1652294351','jpeg','1','2022-05-11','2022-05-11 13:39:11'),(26,'uploads/Luis_Antonio_González_Olvera/Acc-AccR2-8yvR2_-_Accesos_Xochimilco/FACTURAS/ast_doc_2022_05_11-1652294402.pdf','ast_doc_2022_05_11-1652294402','pdf','1','2022-05-11','2022-05-11 13:40:02');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saldos`
--

LOCK TABLES `saldos` WRITE;
/*!40000 ALTER TABLE `saldos` DISABLE KEYS */;
INSERT INTO `saldos` VALUES (1,1,'5100'),(2,11,'0'),(3,9,'0');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_type`
--

LOCK TABLES `status_type` WRITE;
/*!40000 ALTER TABLE `status_type` DISABLE KEYS */;
INSERT INTO `status_type` VALUES (1,'Requiere aprobación ',NULL,NULL,'warning'),(2,'Requiere aprobación contabilidad',NULL,NULL,'warning'),(3,'Requiere aprobación coordinación',NULL,NULL,'warning'),(4,'Aprobado',NULL,NULL,'success'),(5,'Rechazado',NULL,NULL,'danger'),(6,'Factura pendiente',NULL,NULL,'danger');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_gasto`
--

LOCK TABLES `tipos_gasto` WRITE;
/*!40000 ALTER TABLE `tipos_gasto` DISABLE KEYS */;
INSERT INTO `tipos_gasto` VALUES (1,1,'Alimentación',NULL,NULL),(2,1,'Hospedaje',NULL,NULL),(4,2,'Herramienta',NULL,NULL);
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

-- Dump completed on 2022-05-25 11:25:14
