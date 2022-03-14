-- phpMyAdmin SQL Dump
-- version 5.2.0-rc1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2022 a las 23:07:55
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
-- Base de datos: `asteleco_viaticos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones_proyectos`
--

CREATE TABLE `asignaciones_proyectos` (
  `id_asignaciones_proyectos` int(11) NOT NULL,
  `id_proyecto` int(11) DEFAULT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `asignado_por` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depositos`
--

CREATE TABLE `depositos` (
  `id_depositos` int(11) NOT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `id_asignacion_proyecto` int(11) DEFAULT NULL,
  `cantidad` varchar(45) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `origen` varchar(45) DEFAULT NULL,
  `ruta_img` int(11) DEFAULT NULL,
  `ruta_pdf` int(11) DEFAULT NULL,
  `ruta_xml` int(11) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formas_pago`
--

CREATE TABLE `formas_pago` (
  `id_formas_pago` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `nombre_corto` varchar(45) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id_gastos` int(11) NOT NULL,
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
  `log_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reposiciones`
--

CREATE TABLE `reposiciones` (
  `id_reposiciones` int(11) NOT NULL,
  `id_tipos_gasto` int(11) NOT NULL,
  `id_formas_pago` int(11) NOT NULL,
  `id_status_type` int(11) NOT NULL,
  `id_asignaciones_proyectos` int(11) NOT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL,
  `importe` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas_archivos`
--

CREATE TABLE `rutas_archivos` (
  `id_rutas_archivos` int(11) NOT NULL,
  `nombre_archivo` varchar(45) DEFAULT NULL,
  `tipo_archivo` varchar(45) DEFAULT NULL,
  `activo` varchar(45) DEFAULT NULL,
  `fecha_subido` date DEFAULT NULL,
  `log_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldos`
--

CREATE TABLE `saldos` (
  `id_saldos` int(11) NOT NULL,
  `id_personal` int(11) DEFAULT NULL,
  `saldo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_type`
--

CREATE TABLE `status_type` (
  `id_status_type` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `descripcion_corta` varchar(45) DEFAULT NULL,
  `color_html` varchar(45) DEFAULT NULL,
  `clase_css` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_gasto`
--

CREATE TABLE `tipos_gasto` (
  `id_tipos_gasto` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `descr_corta` varchar(45) DEFAULT NULL,
  `comentario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignaciones_proyectos`
--
ALTER TABLE `asignaciones_proyectos`
  ADD PRIMARY KEY (`id_asignaciones_proyectos`);

--
-- Indices de la tabla `depositos`
--
ALTER TABLE `depositos`
  ADD PRIMARY KEY (`id_depositos`);

--
-- Indices de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  ADD PRIMARY KEY (`id_formas_pago`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id_gastos`),
  ADD KEY `fk_gastos_formas_pago_idx` (`id_formas_pago`),
  ADD KEY `fk_gastos_asignaciones_proyectos1_idx` (`id_asignaciones_proyectos`),
  ADD KEY `fk_gastos_status_type1_idx` (`id_status_type`),
  ADD KEY `fk_gastos_tipos_gasto1_idx` (`id_tipos_gasto`);

--
-- Indices de la tabla `reposiciones`
--
ALTER TABLE `reposiciones`
  ADD PRIMARY KEY (`id_reposiciones`),
  ADD KEY `fk_reposiciones_tipos_gasto1_idx` (`id_tipos_gasto`),
  ADD KEY `fk_reposiciones_formas_pago1_idx` (`id_formas_pago`),
  ADD KEY `fk_reposiciones_status_type1_idx` (`id_status_type`),
  ADD KEY `fk_reposiciones_asignaciones_proyectos1_idx` (`id_asignaciones_proyectos`);

--
-- Indices de la tabla `rutas_archivos`
--
ALTER TABLE `rutas_archivos`
  ADD PRIMARY KEY (`id_rutas_archivos`);

--
-- Indices de la tabla `saldos`
--
ALTER TABLE `saldos`
  ADD PRIMARY KEY (`id_saldos`);

--
-- Indices de la tabla `status_type`
--
ALTER TABLE `status_type`
  ADD PRIMARY KEY (`id_status_type`);

--
-- Indices de la tabla `tipos_gasto`
--
ALTER TABLE `tipos_gasto`
  ADD PRIMARY KEY (`id_tipos_gasto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignaciones_proyectos`
--
ALTER TABLE `asignaciones_proyectos`
  MODIFY `id_asignaciones_proyectos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `depositos`
--
ALTER TABLE `depositos`
  MODIFY `id_depositos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `formas_pago`
--
ALTER TABLE `formas_pago`
  MODIFY `id_formas_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id_gastos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reposiciones`
--
ALTER TABLE `reposiciones`
  MODIFY `id_reposiciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutas_archivos`
--
ALTER TABLE `rutas_archivos`
  MODIFY `id_rutas_archivos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `saldos`
--
ALTER TABLE `saldos`
  MODIFY `id_saldos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status_type`
--
ALTER TABLE `status_type`
  MODIFY `id_status_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_gasto`
--
ALTER TABLE `tipos_gasto`
  MODIFY `id_tipos_gasto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `fk_gastos_asignaciones_proyectos1` FOREIGN KEY (`id_asignaciones_proyectos`) REFERENCES `asignaciones_proyectos` (`id_asignaciones_proyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gastos_formas_pago` FOREIGN KEY (`id_formas_pago`) REFERENCES `formas_pago` (`id_formas_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gastos_status_type1` FOREIGN KEY (`id_status_type`) REFERENCES `status_type` (`id_status_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_gastos_tipos_gasto1` FOREIGN KEY (`id_tipos_gasto`) REFERENCES `tipos_gasto` (`id_tipos_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reposiciones`
--
ALTER TABLE `reposiciones`
  ADD CONSTRAINT `fk_reposiciones_asignaciones_proyectos1` FOREIGN KEY (`id_asignaciones_proyectos`) REFERENCES `asignaciones_proyectos` (`id_asignaciones_proyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposiciones_formas_pago1` FOREIGN KEY (`id_formas_pago`) REFERENCES `formas_pago` (`id_formas_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposiciones_status_type1` FOREIGN KEY (`id_status_type`) REFERENCES `status_type` (`id_status_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reposiciones_tipos_gasto1` FOREIGN KEY (`id_tipos_gasto`) REFERENCES `tipos_gasto` (`id_tipos_gasto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
