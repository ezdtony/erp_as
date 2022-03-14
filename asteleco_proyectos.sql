-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2022 a las 23:07:48
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
-- Base de datos: `asteleco_proyectos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones_proyecto`
--

CREATE TABLE `direcciones_proyecto` (
  `id_direcciones_proyecto` int(11) NOT NULL,
  `direccion_calle` varchar(45) DEFAULT NULL,
  `direccion_numero_int` varchar(45) DEFAULT NULL,
  `direccion_numero_ext` varchar(45) DEFAULT NULL,
  `direccion_colonia` varchar(45) DEFAULT NULL,
  `direccion_municipio` varchar(45) DEFAULT NULL,
  `direccion_zipcode` varchar(45) DEFAULT NULL,
  `direccion_estado` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `direcciones_proyecto`
--

INSERT INTO `direcciones_proyecto` (`id_direcciones_proyecto`, `direccion_calle`, `direccion_numero_int`, `direccion_numero_ext`, `direccion_colonia`, `direccion_municipio`, `direccion_zipcode`, `direccion_estado`) VALUES
(1, 'Loma de Chapultepec', NULL, '16', 'Francisco I. Madero', 'Nicolás Romero', '54400', 'Estado de México'),
(2, '', '', '', '', 'Los Cabos', '', 'Baja California Sur'),
(3, 'AV PRINCIPAL', '1', '12', 'DEL VALLE', 'Azcapotzalco', '5400', 'Ciudad de México'),
(4, 'AV PRINCIPAL', '1', '12', 'DEL VALLE', 'Azcapotzalco', '5400', 'Ciudad de México'),
(5, 'AV PRINCIPAL', '141', '13', 'DEL VALLE', 'Mexicali', '5400', 'Baja California'),
(6, 'AV PRINCIPAL', '1', '12', 'DEL VALLE', 'Palizada', '5400', 'Campeche');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `id_proyectos` int(11) NOT NULL,
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
  `log_creacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyectos`, `id_tipos_proyecto`, `id_direcciones_proyecto`, `id_regiones`, `codigo_proyecto`, `nombre_proyecto`, `nombre_corto`, `descripcion`, `id_personal_creador`, `id_personal_cerrado`, `status`, `fecha_inicio`, `fecha_proyectada_cierre`, `fecha_cierre_real`, `log_creacion`) VALUES
(4, 1, 4, 2, 'Acc-AccR2-8yvR2', 'Accesos Xochimilco', NULL, 'PRUEBA 2', '1', NULL, '1', '2022-03-23', '0000-00-00', NULL, '2022-03-10 08:39:17'),
(5, 1, 5, 3, 'Acc-TolR3-wsr', 'Accesos Tollocan', NULL, 'QEVWRVBWEVRE', '1', NULL, '1', '2022-03-31', '0000-00-00', NULL, '2022-03-10 08:42:30'),
(6, 1, 6, 9, 'Acc-EcaR9-iwr', 'Accesos Ecatepec', NULL, '', '1', NULL, '1', '2022-03-22', '0000-00-00', NULL, '2022-03-10 09:42:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `id_regiones` int(11) NOT NULL,
  `nombre_region` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id_regiones`, `nombre_region`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_proyecto`
--

CREATE TABLE `tipos_proyecto` (
  `id_tipos_proyecto` int(11) NOT NULL,
  `descripcion_tipo` varchar(45) DEFAULT NULL,
  `descripcion_corta` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipos_proyecto`
--

INSERT INTO `tipos_proyecto` (`id_tipos_proyecto`, `descripcion_tipo`, `descripcion_corta`) VALUES
(1, 'Accesos', 'ACC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `direcciones_proyecto`
--
ALTER TABLE `direcciones_proyecto`
  ADD PRIMARY KEY (`id_direcciones_proyecto`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`id_proyectos`),
  ADD KEY `fk_proyectos_direcciones_proyecto_idx` (`id_direcciones_proyecto`),
  ADD KEY `fk_proyectos_tipos_proyecto1_idx` (`id_tipos_proyecto`),
  ADD KEY `fk_proyectos_regiones1_idx` (`id_regiones`);

--
-- Indices de la tabla `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id_regiones`);

--
-- Indices de la tabla `tipos_proyecto`
--
ALTER TABLE `tipos_proyecto`
  ADD PRIMARY KEY (`id_tipos_proyecto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `direcciones_proyecto`
--
ALTER TABLE `direcciones_proyecto`
  MODIFY `id_direcciones_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `id_proyectos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id_regiones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipos_proyecto`
--
ALTER TABLE `tipos_proyecto`
  MODIFY `id_tipos_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_proyectos_direcciones_proyecto` FOREIGN KEY (`id_direcciones_proyecto`) REFERENCES `direcciones_proyecto` (`id_direcciones_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyectos_regiones1` FOREIGN KEY (`id_regiones`) REFERENCES `regiones` (`id_regiones`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyectos_tipos_proyecto1` FOREIGN KEY (`id_tipos_proyecto`) REFERENCES `tipos_proyecto` (`id_tipos_proyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
