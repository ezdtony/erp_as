-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: asteleco_accesos
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
-- Table structure for table `accesos`
--

DROP TABLE IF EXISTS `accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesos` (
  `id_accesos` int(11) NOT NULL AUTO_INCREMENT,
  `id_sitios` int(11) NOT NULL,
  `tipos_limpieza_id_tipos_limpieza` int(11) NOT NULL,
  `id_tipos_fallas` int(11) NOT NULL,
  `id_tipos_limpieza` int(11) NOT NULL,
  `id_tipos_vandalismo` int(11) NOT NULL,
  `id_tipos_status` int(11) NOT NULL,
  `id_personal_as` int(11) DEFAULT NULL,
  `empresa` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  `actividad` varchar(45) DEFAULT NULL,
  `lider_cuadrilla` varchar(45) DEFAULT NULL,
  `status_acceso` varchar(45) DEFAULT NULL,
  `breaker_principal` varchar(45) DEFAULT NULL,
  `at_torre` varchar(45) DEFAULT NULL,
  `at_escalerilla` varchar(45) DEFAULT NULL,
  `at_centro_carga` varchar(45) DEFAULT NULL,
  `breakers_existentes` int(11) DEFAULT NULL,
  `comentarios` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_accesos`,`id_sitios`,`tipos_limpieza_id_tipos_limpieza`),
  KEY `fk_accesos_sitios1_idx` (`id_sitios`),
  KEY `fk_accesos_tipos_fallas1_idx` (`id_tipos_fallas`),
  KEY `fk_accesos_tipos_limpieza1_idx` (`id_tipos_limpieza`),
  KEY `fk_accesos_tipos_vandalismo1_idx` (`id_tipos_vandalismo`),
  KEY `fk_accesos_tipos_status1_idx` (`id_tipos_status`),
  CONSTRAINT `fk_accesos_sitios1` FOREIGN KEY (`id_sitios`) REFERENCES `sitios` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_accesos_tipos_fallas1` FOREIGN KEY (`id_tipos_fallas`) REFERENCES `tipos_fallas` (`id_tipos_fallas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_accesos_tipos_limpieza1` FOREIGN KEY (`id_tipos_limpieza`) REFERENCES `tipos_limpieza` (`id_tipos_limpieza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_accesos_tipos_status1` FOREIGN KEY (`id_tipos_status`) REFERENCES `tipos_status` (`id_tipos_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_accesos_tipos_vandalismo1` FOREIGN KEY (`id_tipos_vandalismo`) REFERENCES `tipos_vandalismo` (`id_tipos_vandalismo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centrales`
--

DROP TABLE IF EXISTS `centrales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centrales` (
  `id_centrales` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_central` varchar(45) DEFAULT NULL,
  `short_name_central` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_centrales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centrales`
--

LOCK TABLES `centrales` WRITE;
/*!40000 ALTER TABLE `centrales` DISABLE KEYS */;
/*!40000 ALTER TABLE `centrales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cerraduras_sitios`
--

DROP TABLE IF EXISTS `cerraduras_sitios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cerraduras_sitios` (
  `id_cerraduras_sitios` int(11) NOT NULL AUTO_INCREMENT,
  `id_sitios` int(11) NOT NULL,
  `id_tipos_cerraduras` int(11) NOT NULL,
  `id_puertas_de_acceso` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_cerraduras_sitios`),
  KEY `fk_cerraduras_sitios_sitios1_idx` (`id_sitios`),
  KEY `fk_cerraduras_sitios_tipos_cerraduras1_idx` (`id_tipos_cerraduras`),
  KEY `fk_cerraduras_sitios_puertas_de_acceso1_idx` (`id_puertas_de_acceso`),
  CONSTRAINT `fk_cerraduras_sitios_puertas_de_acceso1` FOREIGN KEY (`id_puertas_de_acceso`) REFERENCES `puertas_de_acceso` (`id_puertas_de_acceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cerraduras_sitios_sitios1` FOREIGN KEY (`id_sitios`) REFERENCES `sitios` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cerraduras_sitios_tipos_cerraduras1` FOREIGN KEY (`id_tipos_cerraduras`) REFERENCES `tipos_cerraduras` (`id_tipos_cerraduras`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cerraduras_sitios`
--

LOCK TABLES `cerraduras_sitios` WRITE;
/*!40000 ALTER TABLE `cerraduras_sitios` DISABLE KEYS */;
/*!40000 ALTER TABLE `cerraduras_sitios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactos_empresas`
--

DROP TABLE IF EXISTS `contactos_empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactos_empresas` (
  `id_contactos_empresas` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_contacto` varchar(45) DEFAULT NULL,
  `telefono_prinicipal` varchar(45) DEFAULT NULL,
  `telefono_secundario` varchar(45) DEFAULT NULL,
  `correo_electronico` varchar(45) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `empresas_accesos_id_empresas_accesos` int(11) NOT NULL,
  PRIMARY KEY (`id_contactos_empresas`),
  KEY `fk_contactos_empresas_empresas_accesos1_idx` (`empresas_accesos_id_empresas_accesos`),
  CONSTRAINT `fk_contactos_empresas_empresas_accesos1` FOREIGN KEY (`empresas_accesos_id_empresas_accesos`) REFERENCES `empresas_accesos` (`id_empresas_accesos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos_empresas`
--

LOCK TABLES `contactos_empresas` WRITE;
/*!40000 ALTER TABLE `contactos_empresas` DISABLE KEYS */;
/*!40000 ALTER TABLE `contactos_empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direcciones_accesos`
--

DROP TABLE IF EXISTS `direcciones_accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direcciones_accesos` (
  `id_direcciones_accesos` int(11) NOT NULL AUTO_INCREMENT,
  `direccion_calle` varchar(45) DEFAULT NULL,
  `direccion_num_interno` varchar(45) DEFAULT NULL,
  `direccion_num_externo` varchar(45) DEFAULT NULL,
  `direccion_colonia` varchar(45) DEFAULT NULL,
  `direccion_municipio` varchar(45) DEFAULT NULL,
  `direccion_estado` varchar(45) DEFAULT NULL,
  `direccion_zipcode` varchar(45) DEFAULT NULL,
  `direccion_referencias` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id_direcciones_accesos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direcciones_accesos`
--

LOCK TABLES `direcciones_accesos` WRITE;
/*!40000 ALTER TABLE `direcciones_accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `direcciones_accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas_accesos`
--

DROP TABLE IF EXISTS `empresas_accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas_accesos` (
  `id_empresas_accesos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_empresas_accesos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas_accesos`
--

LOCK TABLES `empresas_accesos` WRITE;
/*!40000 ALTER TABLE `empresas_accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresas_accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gabinetes`
--

DROP TABLE IF EXISTS `gabinetes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gabinetes` (
  `id_gabinetes` int(11) NOT NULL AUTO_INCREMENT,
  `id_sitios` int(11) NOT NULL,
  `id_tipos_cerraduras` int(11) NOT NULL,
  `tipo_gabinete` int(11) DEFAULT NULL,
  `nombre_gabinete` varchar(45) DEFAULT NULL,
  `baterias_gabinete` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_gabinetes`),
  KEY `fk_gabinetes_accesos1_idx` (`id_sitios`),
  KEY `fk_gabinetes_tipos_cerraduras1_idx` (`id_tipos_cerraduras`),
  CONSTRAINT `fk_gabinetes_accesos1` FOREIGN KEY (`id_sitios`) REFERENCES `accesos` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gabinetes_tipos_cerraduras1` FOREIGN KEY (`id_tipos_cerraduras`) REFERENCES `tipos_cerraduras` (`id_tipos_cerraduras`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gabinetes`
--

LOCK TABLES `gabinetes` WRITE;
/*!40000 ALTER TABLE `gabinetes` DISABLE KEYS */;
/*!40000 ALTER TABLE `gabinetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programacion_accesos`
--

DROP TABLE IF EXISTS `programacion_accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programacion_accesos` (
  `id_programacion_accesos` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresas_accesos` int(11) NOT NULL,
  `id_status_operaciones` int(11) NOT NULL,
  `id_sitios` int(11) NOT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `actividad` varchar(45) DEFAULT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  `telefono_repsonsable` varchar(45) DEFAULT NULL,
  `correo_responsable` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_programacion_accesos`),
  KEY `fk_programacion_accesos_empresas_accesos1_idx` (`id_empresas_accesos`),
  KEY `fk_programacion_accesos_status_operaciones1_idx` (`id_status_operaciones`),
  KEY `fk_programacion_accesos_sitios1_idx` (`id_sitios`),
  CONSTRAINT `fk_programacion_accesos_empresas_accesos1` FOREIGN KEY (`id_empresas_accesos`) REFERENCES `empresas_accesos` (`id_empresas_accesos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_programacion_accesos_sitios1` FOREIGN KEY (`id_sitios`) REFERENCES `sitios` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_programacion_accesos_status_operaciones1` FOREIGN KEY (`id_status_operaciones`) REFERENCES `status_operaciones` (`id_status_operaciones`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programacion_accesos`
--

LOCK TABLES `programacion_accesos` WRITE;
/*!40000 ALTER TABLE `programacion_accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `programacion_accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propietarios`
--

DROP TABLE IF EXISTS `propietarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propietarios` (
  `id_propietarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `numero_telefonico` varchar(45) DEFAULT NULL,
  `numero_alternativo` varchar(45) DEFAULT NULL,
  `correo_electronico` varchar(45) DEFAULT NULL,
  `id_direccion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_propietarios`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propietarios`
--

LOCK TABLES `propietarios` WRITE;
/*!40000 ALTER TABLE `propietarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `propietarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puertas_de_acceso`
--

DROP TABLE IF EXISTS `puertas_de_acceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puertas_de_acceso` (
  `id_puertas_de_acceso` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_puertas_de_acceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puertas_de_acceso`
--

LOCK TABLES `puertas_de_acceso` WRITE;
/*!40000 ALTER TABLE `puertas_de_acceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `puertas_de_acceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutas_archivos_accesos`
--

DROP TABLE IF EXISTS `rutas_archivos_accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutas_archivos_accesos` (
  `id_rutas_archivos_accesos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `tipo_archivo` varchar(45) DEFAULT NULL,
  `ruta_archivo` varchar(450) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `log_fecha_registro` datetime DEFAULT NULL,
  `accesos_id_accesos` int(11) NOT NULL,
  `accesos_id_sitios` int(11) NOT NULL,
  `accesos_tipos_limpieza_id_tipos_limpieza` int(11) NOT NULL,
  `vandalismos_id_vandalismos` int(11) NOT NULL,
  PRIMARY KEY (`id_rutas_archivos_accesos`),
  KEY `fk_rutas_archivos_accesos_accesos1_idx` (`accesos_id_accesos`,`accesos_id_sitios`,`accesos_tipos_limpieza_id_tipos_limpieza`),
  KEY `fk_rutas_archivos_accesos_vandalismos1_idx` (`vandalismos_id_vandalismos`),
  CONSTRAINT `fk_rutas_archivos_accesos_accesos1` FOREIGN KEY (`accesos_id_accesos`, `accesos_id_sitios`, `accesos_tipos_limpieza_id_tipos_limpieza`) REFERENCES `accesos` (`id_accesos`, `id_sitios`, `tipos_limpieza_id_tipos_limpieza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rutas_archivos_accesos_vandalismos1` FOREIGN KEY (`vandalismos_id_vandalismos`) REFERENCES `vandalismos` (`id_vandalismos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas_archivos_accesos`
--

LOCK TABLES `rutas_archivos_accesos` WRITE;
/*!40000 ALTER TABLE `rutas_archivos_accesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `rutas_archivos_accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitios`
--

DROP TABLE IF EXISTS `sitios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitios` (
  `id_sitios` int(11) NOT NULL AUTO_INCREMENT,
  `id_centrales` int(11) NOT NULL,
  `id_direcciones_accesos` int(11) NOT NULL,
  `id_propietarios` int(11) NOT NULL,
  `id_tipo_perimetro` int(11) NOT NULL,
  `id_tipos_sitio` int(11) NOT NULL,
  `empresa_responsable` varchar(45) DEFAULT NULL,
  `codigo_sitio` varchar(45) DEFAULT NULL,
  `nombre_sitio` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `breaker_principal` varchar(45) DEFAULT NULL,
  `at_torre` int(11) DEFAULT NULL,
  `at_centro_carga` int(11) DEFAULT NULL,
  `at_escalerilla` int(11) DEFAULT NULL,
  `perimetro` int(11) DEFAULT NULL,
  `limpieza` int(11) DEFAULT NULL,
  `comentarios` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id_sitios`),
  KEY `fk_sitios_centrales_idx` (`id_centrales`),
  KEY `fk_sitios_direcciones_accesos1_idx` (`id_direcciones_accesos`),
  KEY `fk_sitios_propietarios1_idx` (`id_propietarios`),
  KEY `fk_sitios_tipo_perimetro1_idx` (`id_tipo_perimetro`),
  KEY `fk_sitios_tipos_sitio1_idx` (`id_tipos_sitio`),
  CONSTRAINT `fk_sitios_centrales` FOREIGN KEY (`id_centrales`) REFERENCES `centrales` (`id_centrales`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sitios_direcciones_accesos1` FOREIGN KEY (`id_direcciones_accesos`) REFERENCES `direcciones_accesos` (`id_direcciones_accesos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sitios_propietarios1` FOREIGN KEY (`id_propietarios`) REFERENCES `propietarios` (`id_propietarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sitios_tipo_perimetro1` FOREIGN KEY (`id_tipo_perimetro`) REFERENCES `tipo_perimetro` (`id_tipo_perimetro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sitios_tipos_sitio1` FOREIGN KEY (`id_tipos_sitio`) REFERENCES `tipos_sitio` (`id_tipos_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitios`
--

LOCK TABLES `sitios` WRITE;
/*!40000 ALTER TABLE `sitios` DISABLE KEYS */;
/*!40000 ALTER TABLE `sitios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_operaciones`
--

DROP TABLE IF EXISTS `status_operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_operaciones` (
  `id_status_operaciones` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `descripcion_corta` varchar(45) DEFAULT NULL,
  `color_html` varchar(45) DEFAULT NULL,
  `clase_css` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_status_operaciones`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_operaciones`
--

LOCK TABLES `status_operaciones` WRITE;
/*!40000 ALTER TABLE `status_operaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `status_operaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_perimetro`
--

DROP TABLE IF EXISTS `tipo_perimetro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_perimetro` (
  `id_tipo_perimetro` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_perimetro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_perimetro`
--

LOCK TABLES `tipo_perimetro` WRITE;
/*!40000 ALTER TABLE `tipo_perimetro` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_perimetro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_cerraduras`
--

DROP TABLE IF EXISTS `tipos_cerraduras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_cerraduras` (
  `id_tipos_cerraduras` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipos_cerraduras`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_cerraduras`
--

LOCK TABLES `tipos_cerraduras` WRITE;
/*!40000 ALTER TABLE `tipos_cerraduras` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_cerraduras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_fallas`
--

DROP TABLE IF EXISTS `tipos_fallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_fallas` (
  `id_tipos_fallas` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipos_fallas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_fallas`
--

LOCK TABLES `tipos_fallas` WRITE;
/*!40000 ALTER TABLE `tipos_fallas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_fallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_limpieza`
--

DROP TABLE IF EXISTS `tipos_limpieza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_limpieza` (
  `id_tipos_limpieza` int(11) NOT NULL AUTO_INCREMENT,
  `tipos_limpiezacol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipos_limpieza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_limpieza`
--

LOCK TABLES `tipos_limpieza` WRITE;
/*!40000 ALTER TABLE `tipos_limpieza` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_limpieza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_sitio`
--

DROP TABLE IF EXISTS `tipos_sitio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_sitio` (
  `id_tipos_sitio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipos_sitio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_sitio`
--

LOCK TABLES `tipos_sitio` WRITE;
/*!40000 ALTER TABLE `tipos_sitio` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_sitio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_status`
--

DROP TABLE IF EXISTS `tipos_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_status` (
  `id_tipos_status` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_tipos_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_status`
--

LOCK TABLES `tipos_status` WRITE;
/*!40000 ALTER TABLE `tipos_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_vandalismo`
--

DROP TABLE IF EXISTS `tipos_vandalismo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_vandalismo` (
  `id_tipos_vandalismo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `vandalismos_id_vandalismos` int(11) NOT NULL,
  PRIMARY KEY (`id_tipos_vandalismo`),
  KEY `fk_tipos_vandalismo_vandalismos1_idx` (`vandalismos_id_vandalismos`),
  CONSTRAINT `fk_tipos_vandalismo_vandalismos1` FOREIGN KEY (`vandalismos_id_vandalismos`) REFERENCES `vandalismos` (`id_vandalismos`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_vandalismo`
--

LOCK TABLES `tipos_vandalismo` WRITE;
/*!40000 ALTER TABLE `tipos_vandalismo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipos_vandalismo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vandalismos`
--

DROP TABLE IF EXISTS `vandalismos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vandalismos` (
  `id_vandalismos` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_vandalismo` datetime DEFAULT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `accesos_id_accesos` int(11) NOT NULL,
  `accesos_id_sitios` int(11) NOT NULL,
  `accesos_tipos_limpieza_id_tipos_limpieza` int(11) NOT NULL,
  `status_operaciones_id_status_operaciones` int(11) NOT NULL,
  PRIMARY KEY (`id_vandalismos`),
  KEY `fk_vandalismos_accesos1_idx` (`accesos_id_accesos`,`accesos_id_sitios`,`accesos_tipos_limpieza_id_tipos_limpieza`),
  KEY `fk_vandalismos_status_operaciones1_idx` (`status_operaciones_id_status_operaciones`),
  CONSTRAINT `fk_vandalismos_accesos1` FOREIGN KEY (`accesos_id_accesos`, `accesos_id_sitios`, `accesos_tipos_limpieza_id_tipos_limpieza`) REFERENCES `accesos` (`id_accesos`, `id_sitios`, `tipos_limpieza_id_tipos_limpieza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vandalismos_status_operaciones1` FOREIGN KEY (`status_operaciones_id_status_operaciones`) REFERENCES `status_operaciones` (`id_status_operaciones`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vandalismos`
--

LOCK TABLES `vandalismos` WRITE;
/*!40000 ALTER TABLE `vandalismos` DISABLE KEYS */;
/*!40000 ALTER TABLE `vandalismos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-19 10:59:52
