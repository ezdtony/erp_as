-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: asteleco_personal
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
-- Table structure for table `archivos_usuarios`
--

DROP TABLE IF EXISTS `archivos_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archivos_usuarios` (
  `id_archivos_usuarios` int(11) NOT NULL AUTO_INCREMENT,
  `id_lista_personal` int(11) NOT NULL,
  `id_catalogo_archivos` int(11) NOT NULL,
  `nombre_archivo` varchar(450) DEFAULT NULL,
  `ruta_archivo` varchar(450) DEFAULT NULL,
  `fecha_carga` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_archivos_usuarios`),
  KEY `fk_archivos_usuarios_catalogo_archivos1_idx` (`id_catalogo_archivos`),
  KEY `fk_archivos_usuarios_lista_personal1_idx` (`id_lista_personal`),
  CONSTRAINT `fk_archivos_usuarios_catalogo_archivos1` FOREIGN KEY (`id_catalogo_archivos`) REFERENCES `catalogo_archivos` (`id_catalogo_archivos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_archivos_usuarios_lista_personal1` FOREIGN KEY (`id_lista_personal`) REFERENCES `lista_personal` (`id_lista_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archivos_usuarios`
--

LOCK TABLES `archivos_usuarios` WRITE;
/*!40000 ALTER TABLE `archivos_usuarios` DISABLE KEYS */;
INSERT INTO `archivos_usuarios` VALUES (1,1,2,'INE-LAGO-001-2022-03-19-1647733880','uploads/archivo_colaboradores/LAGO-001/archivos/INE-LAGO-001-2022-03-19-1647733880.pdf','2022-03-19 17:51:20',1),(2,1,3,'ACT-LAGO-001-2022-03-19-1647748716','uploads/archivo_colaboradores/LAGO-001/archivos/ACT-LAGO-001-2022-03-19-1647748716.pdf','2022-03-19 21:58:36',1),(3,1,4,NULL,NULL,NULL,NULL),(4,1,5,NULL,NULL,NULL,NULL),(5,1,6,NULL,NULL,NULL,NULL),(11,1,1,'FOT-LAGO-001-2022-03-19-1647748701','uploads/archivo_colaboradores/LAGO-001/archivos/FOT-LAGO-001-2022-03-19-1647748701.jpeg','2022-03-19 21:58:21',1),(18,6,1,'FOT-MALG-091-2022-03-20-1647758142','uploads/archivo_colaboradores/MALG-091/archivos/FOT-MALG-091-2022-03-20-1647758142.jpeg','2022-03-20 00:35:42',1),(19,6,2,'INE-MALG-091-2022-03-20-1647758291','uploads/archivo_colaboradores/MALG-091/archivos/INE-MALG-091-2022-03-20-1647758291.pdf','2022-03-20 00:38:11',1),(20,6,3,'ACT-MALG-091-2022-03-20-1647758712','uploads/archivo_colaboradores/MALG-091/archivos/ACT-MALG-091-2022-03-20-1647758712.pdf','2022-03-20 00:45:12',1),(21,6,4,NULL,NULL,NULL,NULL),(22,6,5,NULL,NULL,NULL,NULL),(23,6,6,NULL,NULL,NULL,NULL),(30,9,1,'FOT-GELM-087-2022-03-20-1647759323','uploads/archivo_colaboradores/GELM-087/archivos/FOT-GELM-087-2022-03-20-1647759323.jpeg','2022-03-20 00:55:23',1),(31,9,2,NULL,NULL,NULL,NULL),(32,9,3,NULL,NULL,NULL,NULL),(33,9,4,NULL,NULL,NULL,NULL),(34,9,5,NULL,NULL,NULL,NULL),(35,9,6,NULL,NULL,NULL,NULL),(42,11,1,NULL,NULL,NULL,NULL),(43,11,2,NULL,NULL,NULL,NULL),(44,11,3,NULL,NULL,NULL,NULL),(45,11,4,NULL,NULL,NULL,NULL),(46,11,5,NULL,NULL,NULL,NULL),(47,11,6,NULL,NULL,NULL,NULL),(48,11,7,NULL,NULL,NULL,NULL),(49,12,1,'FOT-AGGL-079-2022-04-12-1649786221','uploads/archivo_colaboradores/AGGL-079/archivos/FOT-AGGL-079-2022-04-12-1649786221.jpeg','2022-04-12 12:57:01',1),(50,12,2,'INE-AGGL-079-2022-04-12-1649786276','uploads/archivo_colaboradores/AGGL-079/archivos/INE-AGGL-079-2022-04-12-1649786276.pdf','2022-04-12 12:57:56',1),(51,12,3,NULL,NULL,NULL,NULL),(52,12,4,NULL,NULL,NULL,NULL),(53,12,5,NULL,NULL,NULL,NULL),(54,12,6,NULL,NULL,NULL,NULL),(55,12,7,NULL,NULL,NULL,NULL),(63,14,1,NULL,NULL,NULL,NULL),(64,14,2,NULL,NULL,NULL,NULL),(65,14,3,NULL,NULL,NULL,NULL),(66,14,4,NULL,NULL,NULL,NULL),(67,14,5,NULL,NULL,NULL,NULL),(68,14,6,NULL,NULL,NULL,NULL),(69,14,7,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `archivos_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id_areas` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_area` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_areas`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Administración'),(2,'Contabilidad'),(3,'Coordinación'),(4,'Operaciones'),(5,'Sistemas');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalogo_archivos`
--

DROP TABLE IF EXISTS `catalogo_archivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogo_archivos` (
  `id_catalogo_archivos` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_archivo` varchar(45) DEFAULT NULL,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `html_input_type` varchar(50) DEFAULT NULL,
  `class_css` varchar(45) DEFAULT NULL,
  `btn_class_color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_catalogo_archivos`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogo_archivos`
--

LOCK TABLES `catalogo_archivos` WRITE;
/*!40000 ALTER TABLE `catalogo_archivos` DISABLE KEYS */;
INSERT INTO `catalogo_archivos` VALUES (1,'IMAGEN','FOTOGRAFÍA','image/png,image/jpeg','mdi-image','light'),(2,'PDF','INE','application/pdf','mdi-file-pdf-box','danger'),(3,'PDF','ACTA DE NACIMIENTO','application/pdf','mdi-file-pdf-box','danger'),(4,'PDF','COMPROBANTE DE DOMICILIO','application/pdf','mdi-file-pdf-box','danger'),(5,'PDF','CURP','application/pdf','mdi-file-pdf-box','danger'),(6,'PDF','VIGENCIA IMSS','application/pdf','mdi-file-pdf-box','danger'),(7,NULL,'PASAPORTE',NULL,NULL,NULL);
/*!40000 ALTER TABLE `catalogo_archivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacto_personal`
--

DROP TABLE IF EXISTS `contacto_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacto_personal` (
  `id_contacto_personal` int(11) NOT NULL AUTO_INCREMENT,
  `telefono_principal` varchar(45) DEFAULT NULL,
  `telefono_secundario` varchar(45) DEFAULT NULL,
  `correo_electronico` varchar(45) DEFAULT NULL,
  `telefono_familiar_1` varchar(45) DEFAULT NULL,
  `telefono_familiar_2` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_contacto_personal`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto_personal`
--

LOCK TABLES `contacto_personal` WRITE;
/*!40000 ALTER TABLE `contacto_personal` DISABLE KEYS */;
INSERT INTO `contacto_personal` VALUES (1,'5517267813','5533121395','antoniogonzalez.rt@gmail.com','5539780843',NULL),(6,'455624622','5517267813','manuel.leon@astelecom.com.mx','5517267813',''),(9,'221 591 5641','','lmgger@hotmail.com','5517267813',''),(10,'5517267813','5517267813','manuel.leon@astelecom.com.mx','5517267813',''),(11,'55 2270 9728','','alejandro.aguilar@astelecom.com.mx','55 2270 9728',''),(12,'5517267813','5517267813','aguileo.gonzalez@gmail.com','5555555','555555555'),(14,'5517267813','','tania.lopez@gmail.com','5517267813','');
/*!40000 ALTER TABLE `contacto_personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones_personal`
--

DROP TABLE IF EXISTS `direcciones_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones_personal` (
  `id_direcciones_personal` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_calle` varchar(45) DEFAULT NULL,
  `direccion_numero_int` varchar(45) DEFAULT NULL,
  `direccion_numero_ext` varchar(45) DEFAULT NULL,
  `direccion_colonia` varchar(45) DEFAULT NULL,
  `direccion_municipio` varchar(45) DEFAULT NULL,
  `direccion_zipcode` varchar(45) DEFAULT NULL,
  `direccion_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_direcciones_personal`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones_personal`
--

LOCK TABLES `direcciones_personal` WRITE;
/*!40000 ALTER TABLE `direcciones_personal` DISABLE KEYS */;
INSERT INTO `direcciones_personal` VALUES (1,'Loma de Chapultepec','1','16','Francisco I. Madero','Nicolás Romero','54400','Estado de México'),(7,'Roble Mz 84 Lt','','3','Los Héroes','Carmen','53398','Campeche'),(10,'Av. Don Juan de Palafox y. Mendoza','','14','Centro histórico de Puebla','Puebla','72000','Puebla'),(11,'Roble Mz 84 Lt','','3','Los Hérores','Comondú','53398','Baja California Sur'),(12,'Av. Don Juan de Palafox y. Mendoza','','14','Centro histórico de Puebla','Puebla','72000','Puebla'),(13,'Roble Mz 84 Lt','','3','EL PARQUE','Villa del Carbón','54900','Estado de México'),(15,'Roble Mz 84 Lt','','3','EL PARQUE','Naucalpan de Juárez','54900','Estado de México');
/*!40000 ALTER TABLE `direcciones_personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lista_personal`
--

DROP TABLE IF EXISTS `lista_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lista_personal` (
  `id_lista_personal` int(11) NOT NULL AUTO_INCREMENT,
  `id_niveles_areas` int(11) NOT NULL,
  `id_niveles_academicos` int(11) NOT NULL,
  `id_direcciones_personal` int(11) NOT NULL,
  `id_contacto_personal` int(11) NOT NULL,
  `no_empleado` int(11) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellido_paterno` varchar(45) DEFAULT NULL,
  `apellido_materno` varchar(45) DEFAULT NULL,
  `codigo_usuario` varchar(45) DEFAULT NULL,
  `correo_sesion` varchar(45) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `curp` varchar(45) DEFAULT NULL,
  `rfc` varchar(45) DEFAULT NULL,
  `nss` varchar(45) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `estado_civil` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_lista_personal`),
  KEY `fk_lista_personal_niveles_areas1_idx` (`id_niveles_areas`),
  KEY `fk_lista_personal_niveles_academicos1_idx` (`id_niveles_academicos`),
  KEY `fk_lista_personal_direcciones_personal1_idx` (`id_direcciones_personal`),
  KEY `fk_lista_personal_contacto_personal1_idx` (`id_contacto_personal`),
  CONSTRAINT `fk_lista_personal_contacto_personal1` FOREIGN KEY (`id_contacto_personal`) REFERENCES `contacto_personal` (`id_contacto_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_personal_direcciones_personal1` FOREIGN KEY (`id_direcciones_personal`) REFERENCES `direcciones_personal` (`id_direcciones_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_personal_niveles_academicos1` FOREIGN KEY (`id_niveles_academicos`) REFERENCES `niveles_academicos` (`id_niveles_academicos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_personal_niveles_areas1` FOREIGN KEY (`id_niveles_areas`) REFERENCES `niveles_areas` (`id_niveles_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lista_personal`
--

LOCK TABLES `lista_personal` WRITE;
/*!40000 ALTER TABLE `lista_personal` DISABLE KEYS */;
INSERT INTO `lista_personal` VALUES (1,16,1,1,1,99,'Luis Antonio','González','Olvera','LAGO-001','antoniogonzalez.rt@gmail.com','123','1999-11-29','GOOL991129HMCNLS07','GOOL991129','04169903566',22,1,1,1),(6,14,1,7,6,NULL,'Manuel','León','González','MALG-091','manuel.leon@astelecom.com.mx','wBYwGp','2022-03-19','XXXXXXXXXXXX','53278327HGSRH','757337373',NULL,1,2,1),(9,10,3,10,9,NULL,'Gerardo','López','Martínez','GELM-087','lmgger@hotmail.com','AsNb69','2022-03-20','XXXXXXXXXXX','','',NULL,1,1,1),(11,9,1,12,11,1,'Alejandro','Aguilar','Santos','ALAS-053','alejandro.aguilar@astelecom.com.mx','99KjtE','2021-01-01','xxxxxxxxxxxxxxx','','',NULL,1,1,1),(12,14,1,13,12,NULL,'Aguileo','González','León','AGGL-079','aguileo.gonzalez@astelecom.com.mx','4VVifA','2021-01-01','XXXXXXXXXXXXXX','AAAAAAAAAA','000000000',NULL,1,1,1),(14,12,3,15,14,NULL,'Tania ','López','Sánchez','TALS-023','tania.lopez@astelecom.com.mx','z7Ppuh','1999-01-01','CCCCCCCCCC','RRRRRRRRRRR','111111111111',NULL,2,2,1);
/*!40000 ALTER TABLE `lista_personal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveles_academicos`
--

DROP TABLE IF EXISTS `niveles_academicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveles_academicos` (
  `id_niveles_academicos` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_nivel` varchar(45) DEFAULT NULL,
  `shortname_nivel` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_niveles_academicos`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveles_academicos`
--

LOCK TABLES `niveles_academicos` WRITE;
/*!40000 ALTER TABLE `niveles_academicos` DISABLE KEYS */;
INSERT INTO `niveles_academicos` VALUES (1,'Ingeniero (a)','Ing.'),(2,'Técnico Especializado','Téc. Esp.'),(3,'Licenciado','Lic.'),(4,'Arquitecto','Arq.');
/*!40000 ALTER TABLE `niveles_academicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `niveles_areas`
--

DROP TABLE IF EXISTS `niveles_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `niveles_areas` (
  `id_niveles_areas` int(11) NOT NULL AUTO_INCREMENT,
  `id_areas` int(11) NOT NULL,
  `descripcion_niveles_areas` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_niveles_areas`),
  KEY `fk_niveles_areas_areas_idx` (`id_areas`),
  CONSTRAINT `fk_niveles_areas_areas` FOREIGN KEY (`id_areas`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `niveles_areas`
--

LOCK TABLES `niveles_areas` WRITE;
/*!40000 ALTER TABLE `niveles_areas` DISABLE KEYS */;
INSERT INTO `niveles_areas` VALUES (9,1,'Director General'),(10,2,'Contador'),(11,2,'Auxiliar de Contabilidad'),(12,3,'Coordinador (a) de Proyectos'),(13,3,'Supervisor (a) de Proyectos'),(14,4,'Lider de Cuadrilla'),(15,4,'Técnico de Campo'),(16,5,'Desarrollador');
/*!40000 ALTER TABLE `niveles_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sistema_activo`
--

DROP TABLE IF EXISTS `sistema_activo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sistema_activo` (
  `id_sistema_activo` int(11) NOT NULL AUTO_INCREMENT,
  `id_status_sistema` int(11) NOT NULL,
  PRIMARY KEY (`id_sistema_activo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sistema_activo`
--

LOCK TABLES `sistema_activo` WRITE;
/*!40000 ALTER TABLE `sistema_activo` DISABLE KEYS */;
INSERT INTO `sistema_activo` VALUES (1,1);
/*!40000 ALTER TABLE `sistema_activo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-11 11:56:11
