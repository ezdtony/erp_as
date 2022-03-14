-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2022 a las 23:07:29
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asteleco_accesos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `id_accesos` int(11) NOT NULL,
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
  `comentarios` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centrales`
--

CREATE TABLE `centrales` (
  `id_centrales` int(11) NOT NULL,
  `nombre_central` varchar(45) DEFAULT NULL,
  `short_name_central` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cerraduras_sitios`
--

CREATE TABLE `cerraduras_sitios` (
  `id_cerraduras_sitios` int(11) NOT NULL,
  `id_sitios` int(11) NOT NULL,
  `id_tipos_cerraduras` int(11) NOT NULL,
  `id_puertas_de_acceso` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_empresas`
--

CREATE TABLE `contactos_empresas` (
  `id_contactos_empresas` int(11) NOT NULL,
  `nombre_contacto` varchar(45) DEFAULT NULL,
  `telefono_prinicipal` varchar(45) DEFAULT NULL,
  `telefono_secundario` varchar(45) DEFAULT NULL,
  `correo_electronico` varchar(45) DEFAULT NULL,
  `puesto` varchar(45) DEFAULT NULL,
  `empresas_accesos_id_empresas_accesos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_accesos`
--

CREATE TABLE `direcciones_accesos` (
  `id_direcciones_accesos` int(11) NOT NULL,
  `direccion_calle` varchar(45) DEFAULT NULL,
  `direccion_num_interno` varchar(45) DEFAULT NULL,
  `direccion_num_externo` varchar(45) DEFAULT NULL,
  `direccion_colonia` varchar(45) DEFAULT NULL,
  `direccion_municipio` varchar(45) DEFAULT NULL,
  `direccion_estado` varchar(45) DEFAULT NULL,
  `direccion_zipcode` varchar(45) DEFAULT NULL,
  `direccion_referencias` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas_accesos`
--

CREATE TABLE `empresas_accesos` (
  `id_empresas_accesos` int(11) NOT NULL,
  `nombre_empresa` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gabinetes`
--

CREATE TABLE `gabinetes` (
  `id_gabinetes` int(11) NOT NULL,
  `id_sitios` int(11) NOT NULL,
  `id_tipos_cerraduras` int(11) NOT NULL,
  `tipo_gabinete` int(11) DEFAULT NULL,
  `nombre_gabinete` varchar(45) DEFAULT NULL,
  `baterias_gabinete` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_accesos`
--

CREATE TABLE `programacion_accesos` (
  `id_programacion_accesos` int(11) NOT NULL,
  `id_empresas_accesos` int(11) NOT NULL,
  `id_status_operaciones` int(11) NOT NULL,
  `id_sitios` int(11) NOT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `actividad` varchar(45) DEFAULT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  `telefono_repsonsable` varchar(45) DEFAULT NULL,
  `correo_responsable` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `id_propietarios` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `numero_telefonico` varchar(45) DEFAULT NULL,
  `numero_alternativo` varchar(45) DEFAULT NULL,
  `correo_electronico` varchar(45) DEFAULT NULL,
  `id_direccion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puertas_de_acceso`
--

CREATE TABLE `puertas_de_acceso` (
  `id_puertas_de_acceso` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas_archivos_accesos`
--

CREATE TABLE `rutas_archivos_accesos` (
  `id_rutas_archivos_accesos` int(11) NOT NULL,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `tipo_archivo` varchar(45) DEFAULT NULL,
  `ruta_archivo` varchar(450) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `log_fecha_registro` datetime DEFAULT NULL,
  `accesos_id_accesos` int(11) NOT NULL,
  `accesos_id_sitios` int(11) NOT NULL,
  `accesos_tipos_limpieza_id_tipos_limpieza` int(11) NOT NULL,
  `vandalismos_id_vandalismos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE `sitios` (
  `id_sitios` int(11) NOT NULL,
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
  `comentarios` varchar(450) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_operaciones`
--

CREATE TABLE `status_operaciones` (
  `id_status_operaciones` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `descripcion_corta` varchar(45) DEFAULT NULL,
  `color_html` varchar(45) DEFAULT NULL,
  `clase_css` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_cerraduras`
--

CREATE TABLE `tipos_cerraduras` (
  `id_tipos_cerraduras` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_fallas`
--

CREATE TABLE `tipos_fallas` (
  `id_tipos_fallas` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_limpieza`
--

CREATE TABLE `tipos_limpieza` (
  `id_tipos_limpieza` int(11) NOT NULL,
  `tipos_limpiezacol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_sitio`
--

CREATE TABLE `tipos_sitio` (
  `id_tipos_sitio` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_status`
--

CREATE TABLE `tipos_status` (
  `id_tipos_status` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_vandalismo`
--

CREATE TABLE `tipos_vandalismo` (
  `id_tipos_vandalismo` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `vandalismos_id_vandalismos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_perimetro`
--

CREATE TABLE `tipo_perimetro` (
  `id_tipo_perimetro` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vandalismos`
--

CREATE TABLE `vandalismos` (
  `id_vandalismos` int(11) NOT NULL,
  `fecha_vandalismo` datetime DEFAULT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `accesos_id_accesos` int(11) NOT NULL,
  `accesos_id_sitios` int(11) NOT NULL,
  `accesos_tipos_limpieza_id_tipos_limpieza` int(11) NOT NULL,
  `status_operaciones_id_status_operaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`id_accesos`,`id_sitios`,`tipos_limpieza_id_tipos_limpieza`),
  ADD KEY `fk_accesos_sitios1_idx` (`id_sitios`),
  ADD KEY `fk_accesos_tipos_fallas1_idx` (`id_tipos_fallas`),
  ADD KEY `fk_accesos_tipos_limpieza1_idx` (`id_tipos_limpieza`),
  ADD KEY `fk_accesos_tipos_vandalismo1_idx` (`id_tipos_vandalismo`),
  ADD KEY `fk_accesos_tipos_status1_idx` (`id_tipos_status`);

--
-- Indices de la tabla `centrales`
--
ALTER TABLE `centrales`
  ADD PRIMARY KEY (`id_centrales`);

--
-- Indices de la tabla `cerraduras_sitios`
--
ALTER TABLE `cerraduras_sitios`
  ADD PRIMARY KEY (`id_cerraduras_sitios`),
  ADD KEY `fk_cerraduras_sitios_sitios1_idx` (`id_sitios`),
  ADD KEY `fk_cerraduras_sitios_tipos_cerraduras1_idx` (`id_tipos_cerraduras`),
  ADD KEY `fk_cerraduras_sitios_puertas_de_acceso1_idx` (`id_puertas_de_acceso`);

--
-- Indices de la tabla `contactos_empresas`
--
ALTER TABLE `contactos_empresas`
  ADD PRIMARY KEY (`id_contactos_empresas`),
  ADD KEY `fk_contactos_empresas_empresas_accesos1_idx` (`empresas_accesos_id_empresas_accesos`);

--
-- Indices de la tabla `direcciones_accesos`
--
ALTER TABLE `direcciones_accesos`
  ADD PRIMARY KEY (`id_direcciones_accesos`);

--
-- Indices de la tabla `empresas_accesos`
--
ALTER TABLE `empresas_accesos`
  ADD PRIMARY KEY (`id_empresas_accesos`);

--
-- Indices de la tabla `gabinetes`
--
ALTER TABLE `gabinetes`
  ADD PRIMARY KEY (`id_gabinetes`),
  ADD KEY `fk_gabinetes_accesos1_idx` (`id_sitios`),
  ADD KEY `fk_gabinetes_tipos_cerraduras1_idx` (`id_tipos_cerraduras`);

--
-- Indices de la tabla `programacion_accesos`
--
ALTER TABLE `programacion_accesos`
  ADD PRIMARY KEY (`id_programacion_accesos`),
  ADD KEY `fk_programacion_accesos_empresas_accesos1_idx` (`id_empresas_accesos`),
  ADD KEY `fk_programacion_accesos_status_operaciones1_idx` (`id_status_operaciones`),
  ADD KEY `fk_programacion_accesos_sitios1_idx` (`id_sitios`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id_propietarios`);

--
-- Indices de la tabla `puertas_de_acceso`
--
ALTER TABLE `puertas_de_acceso`
  ADD PRIMARY KEY (`id_puertas_de_acceso`);

--
-- Indices de la tabla `rutas_archivos_accesos`
--
ALTER TABLE `rutas_archivos_accesos`
  ADD PRIMARY KEY (`id_rutas_archivos_accesos`),
  ADD KEY `fk_rutas_archivos_accesos_accesos1_idx` (`accesos_id_accesos`,`accesos_id_sitios`,`accesos_tipos_limpieza_id_tipos_limpieza`),
  ADD KEY `fk_rutas_archivos_accesos_vandalismos1_idx` (`vandalismos_id_vandalismos`);

--
-- Indices de la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD PRIMARY KEY (`id_sitios`),
  ADD KEY `fk_sitios_centrales_idx` (`id_centrales`),
  ADD KEY `fk_sitios_direcciones_accesos1_idx` (`id_direcciones_accesos`),
  ADD KEY `fk_sitios_propietarios1_idx` (`id_propietarios`),
  ADD KEY `fk_sitios_tipo_perimetro1_idx` (`id_tipo_perimetro`),
  ADD KEY `fk_sitios_tipos_sitio1_idx` (`id_tipos_sitio`);

--
-- Indices de la tabla `status_operaciones`
--
ALTER TABLE `status_operaciones`
  ADD PRIMARY KEY (`id_status_operaciones`);

--
-- Indices de la tabla `tipos_cerraduras`
--
ALTER TABLE `tipos_cerraduras`
  ADD PRIMARY KEY (`id_tipos_cerraduras`);

--
-- Indices de la tabla `tipos_fallas`
--
ALTER TABLE `tipos_fallas`
  ADD PRIMARY KEY (`id_tipos_fallas`);

--
-- Indices de la tabla `tipos_limpieza`
--
ALTER TABLE `tipos_limpieza`
  ADD PRIMARY KEY (`id_tipos_limpieza`);

--
-- Indices de la tabla `tipos_sitio`
--
ALTER TABLE `tipos_sitio`
  ADD PRIMARY KEY (`id_tipos_sitio`);

--
-- Indices de la tabla `tipos_status`
--
ALTER TABLE `tipos_status`
  ADD PRIMARY KEY (`id_tipos_status`);

--
-- Indices de la tabla `tipos_vandalismo`
--
ALTER TABLE `tipos_vandalismo`
  ADD PRIMARY KEY (`id_tipos_vandalismo`),
  ADD KEY `fk_tipos_vandalismo_vandalismos1_idx` (`vandalismos_id_vandalismos`);

--
-- Indices de la tabla `tipo_perimetro`
--
ALTER TABLE `tipo_perimetro`
  ADD PRIMARY KEY (`id_tipo_perimetro`);

--
-- Indices de la tabla `vandalismos`
--
ALTER TABLE `vandalismos`
  ADD PRIMARY KEY (`id_vandalismos`),
  ADD KEY `fk_vandalismos_accesos1_idx` (`accesos_id_accesos`,`accesos_id_sitios`,`accesos_tipos_limpieza_id_tipos_limpieza`),
  ADD KEY `fk_vandalismos_status_operaciones1_idx` (`status_operaciones_id_status_operaciones`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `id_accesos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centrales`
--
ALTER TABLE `centrales`
  MODIFY `id_centrales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cerraduras_sitios`
--
ALTER TABLE `cerraduras_sitios`
  MODIFY `id_cerraduras_sitios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactos_empresas`
--
ALTER TABLE `contactos_empresas`
  MODIFY `id_contactos_empresas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direcciones_accesos`
--
ALTER TABLE `direcciones_accesos`
  MODIFY `id_direcciones_accesos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas_accesos`
--
ALTER TABLE `empresas_accesos`
  MODIFY `id_empresas_accesos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gabinetes`
--
ALTER TABLE `gabinetes`
  MODIFY `id_gabinetes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programacion_accesos`
--
ALTER TABLE `programacion_accesos`
  MODIFY `id_programacion_accesos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  MODIFY `id_propietarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `puertas_de_acceso`
--
ALTER TABLE `puertas_de_acceso`
  MODIFY `id_puertas_de_acceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutas_archivos_accesos`
--
ALTER TABLE `rutas_archivos_accesos`
  MODIFY `id_rutas_archivos_accesos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sitios`
--
ALTER TABLE `sitios`
  MODIFY `id_sitios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status_operaciones`
--
ALTER TABLE `status_operaciones`
  MODIFY `id_status_operaciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_cerraduras`
--
ALTER TABLE `tipos_cerraduras`
  MODIFY `id_tipos_cerraduras` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_fallas`
--
ALTER TABLE `tipos_fallas`
  MODIFY `id_tipos_fallas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_limpieza`
--
ALTER TABLE `tipos_limpieza`
  MODIFY `id_tipos_limpieza` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_sitio`
--
ALTER TABLE `tipos_sitio`
  MODIFY `id_tipos_sitio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_status`
--
ALTER TABLE `tipos_status`
  MODIFY `id_tipos_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_vandalismo`
--
ALTER TABLE `tipos_vandalismo`
  MODIFY `id_tipos_vandalismo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_perimetro`
--
ALTER TABLE `tipo_perimetro`
  MODIFY `id_tipo_perimetro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vandalismos`
--
ALTER TABLE `vandalismos`
  MODIFY `id_vandalismos` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD CONSTRAINT `fk_accesos_sitios1` FOREIGN KEY (`id_sitios`) REFERENCES `sitios` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_accesos_tipos_fallas1` FOREIGN KEY (`id_tipos_fallas`) REFERENCES `tipos_fallas` (`id_tipos_fallas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_accesos_tipos_limpieza1` FOREIGN KEY (`id_tipos_limpieza`) REFERENCES `tipos_limpieza` (`id_tipos_limpieza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_accesos_tipos_status1` FOREIGN KEY (`id_tipos_status`) REFERENCES `tipos_status` (`id_tipos_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_accesos_tipos_vandalismo1` FOREIGN KEY (`id_tipos_vandalismo`) REFERENCES `tipos_vandalismo` (`id_tipos_vandalismo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cerraduras_sitios`
--
ALTER TABLE `cerraduras_sitios`
  ADD CONSTRAINT `fk_cerraduras_sitios_puertas_de_acceso1` FOREIGN KEY (`id_puertas_de_acceso`) REFERENCES `puertas_de_acceso` (`id_puertas_de_acceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cerraduras_sitios_sitios1` FOREIGN KEY (`id_sitios`) REFERENCES `sitios` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cerraduras_sitios_tipos_cerraduras1` FOREIGN KEY (`id_tipos_cerraduras`) REFERENCES `tipos_cerraduras` (`id_tipos_cerraduras`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contactos_empresas`
--
ALTER TABLE `contactos_empresas`
  ADD CONSTRAINT `fk_contactos_empresas_empresas_accesos1` FOREIGN KEY (`empresas_accesos_id_empresas_accesos`) REFERENCES `empresas_accesos` (`id_empresas_accesos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `gabinetes`
--
ALTER TABLE `gabinetes`
  ADD CONSTRAINT `fk_gabinetes_accesos1` FOREIGN KEY (`id_sitios`) REFERENCES `accesos` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gabinetes_tipos_cerraduras1` FOREIGN KEY (`id_tipos_cerraduras`) REFERENCES `tipos_cerraduras` (`id_tipos_cerraduras`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `programacion_accesos`
--
ALTER TABLE `programacion_accesos`
  ADD CONSTRAINT `fk_programacion_accesos_empresas_accesos1` FOREIGN KEY (`id_empresas_accesos`) REFERENCES `empresas_accesos` (`id_empresas_accesos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_programacion_accesos_sitios1` FOREIGN KEY (`id_sitios`) REFERENCES `sitios` (`id_sitios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_programacion_accesos_status_operaciones1` FOREIGN KEY (`id_status_operaciones`) REFERENCES `status_operaciones` (`id_status_operaciones`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rutas_archivos_accesos`
--
ALTER TABLE `rutas_archivos_accesos`
  ADD CONSTRAINT `fk_rutas_archivos_accesos_accesos1` FOREIGN KEY (`accesos_id_accesos`,`accesos_id_sitios`,`accesos_tipos_limpieza_id_tipos_limpieza`) REFERENCES `accesos` (`id_accesos`, `id_sitios`, `tipos_limpieza_id_tipos_limpieza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rutas_archivos_accesos_vandalismos1` FOREIGN KEY (`vandalismos_id_vandalismos`) REFERENCES `vandalismos` (`id_vandalismos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sitios`
--
ALTER TABLE `sitios`
  ADD CONSTRAINT `fk_sitios_centrales` FOREIGN KEY (`id_centrales`) REFERENCES `centrales` (`id_centrales`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sitios_direcciones_accesos1` FOREIGN KEY (`id_direcciones_accesos`) REFERENCES `direcciones_accesos` (`id_direcciones_accesos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sitios_propietarios1` FOREIGN KEY (`id_propietarios`) REFERENCES `propietarios` (`id_propietarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sitios_tipo_perimetro1` FOREIGN KEY (`id_tipo_perimetro`) REFERENCES `tipo_perimetro` (`id_tipo_perimetro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sitios_tipos_sitio1` FOREIGN KEY (`id_tipos_sitio`) REFERENCES `tipos_sitio` (`id_tipos_sitio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipos_vandalismo`
--
ALTER TABLE `tipos_vandalismo`
  ADD CONSTRAINT `fk_tipos_vandalismo_vandalismos1` FOREIGN KEY (`vandalismos_id_vandalismos`) REFERENCES `vandalismos` (`id_vandalismos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vandalismos`
--
ALTER TABLE `vandalismos`
  ADD CONSTRAINT `fk_vandalismos_accesos1` FOREIGN KEY (`accesos_id_accesos`,`accesos_id_sitios`,`accesos_tipos_limpieza_id_tipos_limpieza`) REFERENCES `accesos` (`id_accesos`, `id_sitios`, `tipos_limpieza_id_tipos_limpieza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vandalismos_status_operaciones1` FOREIGN KEY (`status_operaciones_id_status_operaciones`) REFERENCES `status_operaciones` (`id_status_operaciones`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
