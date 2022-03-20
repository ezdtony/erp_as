-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2022 a las 02:03:46
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
-- Base de datos: `asteleco_personal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_usuarios`
--

CREATE TABLE `archivos_usuarios` (
  `id_archivos_usuarios` int(11) NOT NULL,
  `id_lista_personal` int(11) NOT NULL,
  `id_catalogo_archivos` int(11) NOT NULL,
  `nombre_archivo` varchar(450) DEFAULT NULL,
  `ruta_archivo` varchar(450) DEFAULT NULL,
  `fecha_carga` datetime DEFAULT NULL,
  `activo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `archivos_usuarios`
--

INSERT INTO `archivos_usuarios` (`id_archivos_usuarios`, `id_lista_personal`, `id_catalogo_archivos`, `nombre_archivo`, `ruta_archivo`, `fecha_carga`, `activo`) VALUES
(1, 1, 2, 'INE-LAGO-001-2022-03-19-1647733880', 'uploads/archivo_colaboradores/LAGO-001/archivos/INE-LAGO-001-2022-03-19-1647733880.pdf', '2022-03-19 17:51:20', 1),
(2, 1, 3, 'ACT-LAGO-001-2022-03-19-1647735021', 'uploads/archivo_colaboradores/LAGO-001/archivos/ACT-LAGO-001-2022-03-19-1647735021.pdf', '2022-03-19 18:10:21', 1),
(3, 1, 4, NULL, NULL, NULL, NULL),
(4, 1, 5, NULL, NULL, NULL, NULL),
(5, 1, 6, NULL, NULL, NULL, NULL),
(11, 1, 1, 'FOT-LAGO-001-2022-03-19-1647735701', 'uploads/archivo_colaboradores/LAGO-001/archivos/FOT-LAGO-001-2022-03-19-1647735701.jpeg', '2022-03-19 18:21:41', 1),
(12, 2, 1, NULL, NULL, NULL, NULL),
(13, 2, 2, NULL, NULL, NULL, NULL),
(14, 2, 3, NULL, NULL, NULL, NULL),
(15, 2, 4, NULL, NULL, NULL, NULL),
(16, 2, 5, NULL, NULL, NULL, NULL),
(17, 2, 6, NULL, NULL, NULL, NULL),
(18, 6, 1, NULL, NULL, NULL, NULL),
(19, 6, 2, NULL, NULL, NULL, NULL),
(20, 6, 3, NULL, NULL, NULL, NULL),
(21, 6, 4, NULL, NULL, NULL, NULL),
(22, 6, 5, NULL, NULL, NULL, NULL),
(23, 6, 6, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_areas` int(11) NOT NULL,
  `descripcion_area` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_areas`, `descripcion_area`) VALUES
(1, 'Administración'),
(2, 'Contabilidad'),
(3, 'Coordinación'),
(4, 'Operaciones'),
(5, 'Sistemas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_archivos`
--

CREATE TABLE `catalogo_archivos` (
  `id_catalogo_archivos` int(11) NOT NULL,
  `tipo_archivo` varchar(45) DEFAULT NULL,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `html_input_type` varchar(50) DEFAULT NULL,
  `class_css` varchar(45) DEFAULT NULL,
  `btn_class_color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `catalogo_archivos`
--

INSERT INTO `catalogo_archivos` (`id_catalogo_archivos`, `tipo_archivo`, `nombre_archivo`, `html_input_type`, `class_css`, `btn_class_color`) VALUES
(1, 'IMAGEN', 'FOTOGRAFÍA', 'image/png,image/jpeg', 'mdi-image', 'light'),
(2, 'PDF', 'INE', 'application/pdf', 'mdi-file-pdf-box', 'danger'),
(3, 'PDF', 'ACTA DE NACIMIENTO', 'application/pdf', 'mdi-file-pdf-box', 'danger'),
(4, 'PDF', 'COMPROBANTE DE DOMICILIO', 'application/pdf', 'mdi-file-pdf-box', 'danger'),
(5, 'PDF', 'CURP', 'application/pdf', 'mdi-file-pdf-box', 'danger'),
(6, 'PDF', 'VIGENCIA IMSS', 'application/pdf', 'mdi-file-pdf-box', 'danger');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_personal`
--

CREATE TABLE `contacto_personal` (
  `id_contacto_personal` int(11) NOT NULL,
  `telefono_principal` varchar(45) DEFAULT NULL,
  `telefono_secundario` varchar(45) DEFAULT NULL,
  `correo_electronico` varchar(45) DEFAULT NULL,
  `telefono_familiar_1` varchar(45) DEFAULT NULL,
  `telefono_familiar_2` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contacto_personal`
--

INSERT INTO `contacto_personal` (`id_contacto_personal`, `telefono_principal`, `telefono_secundario`, `correo_electronico`, `telefono_familiar_1`, `telefono_familiar_2`) VALUES
(1, '5517267813', '5533121395', 'antoniogonzalez.rt@gmail.com', '5539780843', NULL),
(2, '5517267813', '5517267813', 'a@mail.com', '5517267813', '5517267813'),
(3, '5517267813', '5517267813', 'a@mail.com', '5517267813', '5517267813'),
(4, '5517267813', '5517267813', 'a@mail.com', '5517267813', '5517267813'),
(5, '5517267813', '5517267813', 'a@mail.com', '5517267813', '5517267813'),
(6, '5517267813', '5517267813', 'a@mail.com', '5517267813', ''),
(7, '5517267813', '5517267813', 'a@mail.com', '5517267813', '5517267813'),
(8, '5517267813', '5517267813', 'a@mail.com', '5517267813', '5517267813'),
(9, '5517267813', '', 'a@mail.com', '5517267813', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_personal`
--

CREATE TABLE `direcciones_personal` (
  `id_direcciones_personal` int(11) NOT NULL,
  `direccion_calle` varchar(45) DEFAULT NULL,
  `direccion_numero_int` varchar(45) DEFAULT NULL,
  `direccion_numero_ext` varchar(45) DEFAULT NULL,
  `direccion_colonia` varchar(45) DEFAULT NULL,
  `direccion_municipio` varchar(45) DEFAULT NULL,
  `direccion_zipcode` varchar(45) DEFAULT NULL,
  `direccion_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `direcciones_personal`
--

INSERT INTO `direcciones_personal` (`id_direcciones_personal`, `direccion_calle`, `direccion_numero_int`, `direccion_numero_ext`, `direccion_colonia`, `direccion_municipio`, `direccion_zipcode`, `direccion_estado`) VALUES
(1, 'Loma de Chapultepec', '1', '16', 'Francisco I. Madero', 'Nicolás Romero', '54400', 'Estado de México'),
(3, 'Roble Mz 84 Lt', '', '3', 'EL PARQUE', 'Valle de Bravo', '54900', 'Estado de México'),
(4, 'Roble Mz 84 Lt', '', '3', 'EL PARQUE', 'Seleccione un municipio', '53398', 'Estado de México'),
(5, 'Roble Mz 84 Lt', '', '3', 'EL PARQUE', 'Acambay de Ruíz Castañeda', '53398', 'Estado de México'),
(6, 'Roble Mz 84 Lt', '', '3', 'EL PARQUE', 'Acambay de Ruíz Castañeda', '53398', 'Estado de México'),
(7, 'Roble Mz 84 Lt', '', '3', '', 'Acambay de Ruíz Castañeda', '53398', 'Estado de México'),
(8, 'Roble Mz 84 Lt', '', '3', 'EL PARQUE', 'Seleccione un municipio', '53398', 'Estado de México'),
(9, 'Roble Mz 84 Lt', '', '3', 'EL PARQUE', 'Seleccione un municipio', '53398', 'Estado de México'),
(10, 'Roble Mz 84 Lt', '', '3', 'EL PARQUE', 'Seleccione un municipio', '54900', 'Estado de México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_personal`
--

CREATE TABLE `lista_personal` (
  `id_lista_personal` int(11) NOT NULL,
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
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lista_personal`
--

INSERT INTO `lista_personal` (`id_lista_personal`, `id_niveles_areas`, `id_niveles_academicos`, `id_direcciones_personal`, `id_contacto_personal`, `no_empleado`, `nombres`, `apellido_paterno`, `apellido_materno`, `codigo_usuario`, `correo_sesion`, `password`, `fecha_nacimiento`, `curp`, `rfc`, `nss`, `edad`, `genero`, `estado_civil`, `status`) VALUES
(1, 16, 1, 1, 1, 99, 'Luis Antonio', 'González', 'Olvera', 'LAGO-001', 'antoniogonzalez.rt@gmail.com', '123', '1999-11-29', 'GOOL991129HMCNLS07', 'GOOL991129', '04169903566', 22, 1, 1, 1),
(2, 14, 1, 3, 2, NULL, 'CESAR RENE', 'ANAYA', 'MARTINEZ', 'CE-ANMA-4', 'antoniogonzalez.rt@gmail.com', 'wF6U6t', '0000-00-00', 'GOOL991129HMCNLS07', 'AFEF413513', '3515351351', NULL, 1, 2, 1),
(3, 14, 2, 4, 3, NULL, 'ANTONIO', 'ANAYA', 'GONZALEZ', 'AN-ANGO-53', 'antoniogonzalez.rt@gmail.com', 'oNAnbF', '0000-00-00', 'GOOL991129HMCNLS07', '23546424', '4252235244', NULL, 1, 2, 1),
(4, 11, 2, 5, 4, NULL, 'ANTONIO', 'GONZALEZ', 'GONZALEZ', 'AN-GOGO-65', 'antoniogonzalez.rt@gmail.com', '95BZDc', '0000-00-00', 'GOOL991129HMCNLS07', '3768765', '4666226', NULL, 2, 1, 1),
(5, 11, 2, 6, 5, NULL, 'ANTONIO', 'GONZALEZ', 'GONZALEZ', 'AN-GOGO-9', 'antoniogonzalez.rt@gmail.com', '95BZDc', '0000-00-00', 'GOOL991129HMCNLS07', '3768765', '4666226', NULL, 2, 1, 1),
(6, 9, 1, 7, 6, NULL, 'ANTONIO', 'ANAYA', 'GONZALEZ', 'AN-ANGO-2', 'antoniogonzalez.rt@gmail.com', 'KKgBWQ', '0000-00-00', 'GOOL991129HMCNLS07', '53278327HGSRH', '757337373', NULL, 1, 2, 1),
(7, 11, 2, 8, 7, NULL, 'ANTONIO', 'ANAYA', 'GONZALEZ', 'AN-ANGO-42', 'antoniogonzalez.rt@gmail.com', '3bD34d', '0000-00-00', 'GOOL991129HMCNLS07', 'rbeth35y3q', '462464632', NULL, 2, 1, 1),
(8, 11, 2, 9, 8, NULL, 'ANTONIO', 'ANAYA', 'GONZALEZ', 'AN-ANGO-90', 'antoniogonzalez.rt@gmail.com', '3bD34d', '0000-00-00', 'GOOL991129HMCNLS07', 'rbeth35y3q', '462464632', NULL, 2, 1, 1),
(9, 10, 1, 10, 9, NULL, 'Gerardo', 'Aguilar', 'Santos', 'Ge-AgSa-58', 'antoniogonzalez.rt@gmail.com', 'QbQUYr', '0000-00-00', 'GOOL991129HMCNLS07', '', '', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_academicos`
--

CREATE TABLE `niveles_academicos` (
  `id_niveles_academicos` int(11) NOT NULL,
  `descripcion_nivel` varchar(45) DEFAULT NULL,
  `shortname_nivel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `niveles_academicos`
--

INSERT INTO `niveles_academicos` (`id_niveles_academicos`, `descripcion_nivel`, `shortname_nivel`) VALUES
(1, 'Ingeniero (a)', 'Ing.'),
(2, 'Técnico Especializado', 'Téc. Esp.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_areas`
--

CREATE TABLE `niveles_areas` (
  `id_niveles_areas` int(11) NOT NULL,
  `id_areas` int(11) NOT NULL,
  `descripcion_niveles_areas` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `niveles_areas`
--

INSERT INTO `niveles_areas` (`id_niveles_areas`, `id_areas`, `descripcion_niveles_areas`) VALUES
(9, 1, 'Director General'),
(10, 2, 'Contador'),
(11, 2, 'Auxiliar de Contabilidad'),
(12, 3, 'Coordinador (a) de Proyectos'),
(13, 3, 'Supervisor (a) de Proyectos'),
(14, 4, 'Lider de Cuadrilla'),
(15, 4, 'Técnico de Campo'),
(16, 5, 'Desarrollador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sistema_activo`
--

CREATE TABLE `sistema_activo` (
  `id_sistema_activo` int(11) NOT NULL,
  `id_status_sistema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sistema_activo`
--

INSERT INTO `sistema_activo` (`id_sistema_activo`, `id_status_sistema`) VALUES
(1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos_usuarios`
--
ALTER TABLE `archivos_usuarios`
  ADD PRIMARY KEY (`id_archivos_usuarios`),
  ADD KEY `fk_archivos_usuarios_catalogo_archivos1_idx` (`id_catalogo_archivos`),
  ADD KEY `fk_archivos_usuarios_lista_personal1_idx` (`id_lista_personal`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_areas`);

--
-- Indices de la tabla `catalogo_archivos`
--
ALTER TABLE `catalogo_archivos`
  ADD PRIMARY KEY (`id_catalogo_archivos`);

--
-- Indices de la tabla `contacto_personal`
--
ALTER TABLE `contacto_personal`
  ADD PRIMARY KEY (`id_contacto_personal`);

--
-- Indices de la tabla `direcciones_personal`
--
ALTER TABLE `direcciones_personal`
  ADD PRIMARY KEY (`id_direcciones_personal`);

--
-- Indices de la tabla `lista_personal`
--
ALTER TABLE `lista_personal`
  ADD PRIMARY KEY (`id_lista_personal`),
  ADD KEY `fk_lista_personal_niveles_areas1_idx` (`id_niveles_areas`),
  ADD KEY `fk_lista_personal_niveles_academicos1_idx` (`id_niveles_academicos`),
  ADD KEY `fk_lista_personal_direcciones_personal1_idx` (`id_direcciones_personal`),
  ADD KEY `fk_lista_personal_contacto_personal1_idx` (`id_contacto_personal`);

--
-- Indices de la tabla `niveles_academicos`
--
ALTER TABLE `niveles_academicos`
  ADD PRIMARY KEY (`id_niveles_academicos`);

--
-- Indices de la tabla `niveles_areas`
--
ALTER TABLE `niveles_areas`
  ADD PRIMARY KEY (`id_niveles_areas`),
  ADD KEY `fk_niveles_areas_areas_idx` (`id_areas`);

--
-- Indices de la tabla `sistema_activo`
--
ALTER TABLE `sistema_activo`
  ADD PRIMARY KEY (`id_sistema_activo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos_usuarios`
--
ALTER TABLE `archivos_usuarios`
  MODIFY `id_archivos_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `catalogo_archivos`
--
ALTER TABLE `catalogo_archivos`
  MODIFY `id_catalogo_archivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `contacto_personal`
--
ALTER TABLE `contacto_personal`
  MODIFY `id_contacto_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `direcciones_personal`
--
ALTER TABLE `direcciones_personal`
  MODIFY `id_direcciones_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `lista_personal`
--
ALTER TABLE `lista_personal`
  MODIFY `id_lista_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `niveles_academicos`
--
ALTER TABLE `niveles_academicos`
  MODIFY `id_niveles_academicos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `niveles_areas`
--
ALTER TABLE `niveles_areas`
  MODIFY `id_niveles_areas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `sistema_activo`
--
ALTER TABLE `sistema_activo`
  MODIFY `id_sistema_activo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_usuarios`
--
ALTER TABLE `archivos_usuarios`
  ADD CONSTRAINT `fk_archivos_usuarios_catalogo_archivos1` FOREIGN KEY (`id_catalogo_archivos`) REFERENCES `catalogo_archivos` (`id_catalogo_archivos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_archivos_usuarios_lista_personal1` FOREIGN KEY (`id_lista_personal`) REFERENCES `lista_personal` (`id_lista_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lista_personal`
--
ALTER TABLE `lista_personal`
  ADD CONSTRAINT `fk_lista_personal_contacto_personal1` FOREIGN KEY (`id_contacto_personal`) REFERENCES `contacto_personal` (`id_contacto_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lista_personal_direcciones_personal1` FOREIGN KEY (`id_direcciones_personal`) REFERENCES `direcciones_personal` (`id_direcciones_personal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lista_personal_niveles_academicos1` FOREIGN KEY (`id_niveles_academicos`) REFERENCES `niveles_academicos` (`id_niveles_academicos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lista_personal_niveles_areas1` FOREIGN KEY (`id_niveles_areas`) REFERENCES `niveles_areas` (`id_niveles_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `niveles_areas`
--
ALTER TABLE `niveles_areas`
  ADD CONSTRAINT `fk_niveles_areas_areas` FOREIGN KEY (`id_areas`) REFERENCES `areas` (`id_areas`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
