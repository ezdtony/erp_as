-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-08-2022 a las 14:54:13
-- Versión del servidor: 10.3.35-MariaDB-cll-lve
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(1, 8, 1, NULL, NULL, NULL, NULL),
(2, 8, 2, NULL, NULL, NULL, NULL),
(3, 8, 3, NULL, NULL, NULL, NULL),
(4, 8, 4, NULL, NULL, NULL, NULL),
(5, 8, 5, NULL, NULL, NULL, NULL),
(6, 8, 6, NULL, NULL, NULL, NULL),
(7, 8, 7, NULL, NULL, NULL, NULL),
(8, 41, 1, NULL, NULL, NULL, NULL),
(9, 41, 2, NULL, NULL, NULL, NULL),
(10, 41, 3, NULL, NULL, NULL, NULL),
(11, 41, 4, NULL, NULL, NULL, NULL),
(12, 41, 5, NULL, NULL, NULL, NULL),
(13, 41, 6, NULL, NULL, NULL, NULL),
(14, 41, 7, NULL, NULL, NULL, NULL),
(15, 42, 1, NULL, NULL, NULL, NULL),
(16, 42, 2, NULL, NULL, NULL, NULL),
(17, 42, 3, NULL, NULL, NULL, NULL),
(18, 42, 4, NULL, NULL, NULL, NULL),
(19, 42, 5, NULL, NULL, NULL, NULL),
(20, 42, 6, NULL, NULL, NULL, NULL),
(21, 42, 7, NULL, NULL, NULL, NULL),
(22, 43, 1, NULL, NULL, NULL, NULL),
(23, 43, 2, NULL, NULL, NULL, NULL),
(24, 43, 3, NULL, NULL, NULL, NULL),
(25, 43, 4, NULL, NULL, NULL, NULL),
(26, 43, 5, NULL, NULL, NULL, NULL),
(27, 43, 6, NULL, NULL, NULL, NULL),
(28, 43, 7, NULL, NULL, NULL, NULL);

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
(6, 'PDF', 'VIGENCIA IMSS', 'application/pdf', 'mdi-file-pdf-box', 'danger'),
(7, NULL, 'PASAPORTE', NULL, NULL, NULL);

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
(1, '55-5357-4888', NULL, 'antoniogonzalez.rt@gmail.com', '55-5357-4888', NULL),
(2, '5517267813', '', 'a@mail.com', '5517267813', ''),
(3, '5525161609', '', 'angeles.ugalde02@gmail.com', '5939183413', ''),
(4, '7771612411', '', 'luisangelolivaresrojas984@gmail.com', '7771975198', '5544843806');

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
(1, 'Loma de Chapultepec', '1', '1', 'El Parque', 'Naucalpan de Juárez', '53538', 'Estado de México'),
(21, 'Roble Mz 84 Lt', '', '3', 'Los Reyes', 'Nicolás Romero', '54900', 'Estado de México'),
(22, 'LA RIVERA', '', '31', 'CENTRO HUEHUETOCA', 'Huehuetoca', '54680', 'Estado de México'),
(23, 'Avenida Aeropuerto', '', '6', 'Nueva Morelos', 'Xochitepec', '62790', 'Morelos');

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
(1, 16, 1, 1, 1, NULL, 'Luis Antonio', 'González', 'Olvera', 'LAGO-001', 'antoniogonzalez.rt@gmail.com', '123', '1999-11-29', 'GOOL991129HMCNLS07', 'GOOL991129', '04169903566', 22, 1, 1, 1),
(2, 9, 1, 1, 1, NULL, 'Alejandro', 'Aguilar', 'Santos', 'ALAS-053', 'alejandro.aguilar@astelecom.com.mx', '99KjtE', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 10, 3, 1, 1, NULL, 'Gerardo', 'López', 'Martínez', 'GELM-087', 'lmgger@hotmail.com', 'AsNb69', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 12, 3, 1, 1, NULL, 'Nancy A.', 'Ferreira', 'Mendoza', 'NAFM-026', 'nancy.ferreira@astelecom.com.mx', '5jQbRf', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 12, 4, 1, 1, NULL, 'Karina', 'Valdez', 'Sánchez', 'KAVS-080', 'karina.valdez@astelecom.com.mx', 'wKGwbk', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 12, 3, 1, 1, NULL, 'Tania', 'López', 'Solorzano', 'TALS-079', 'tania.lopez@astelecom.com.mx', 'WXnMe7', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(7, 17, 3, 1, 1, NULL, 'Tatiana', 'Sanchez', 'Sanchez', 'TASS-039', 'tatiana.sanchez@astelecom.com.mx', 'LR9wjA', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 15, 2, 1, 1, NULL, 'Aguileo', 'González', 'León', 'AGGL-016', 'aguileo.gonzalez@astelecom.com.mx', '3gq71j', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(9, 15, 2, 1, 1, NULL, 'Anuar', 'Nava', 'Flores', 'ANNF-042', 'anuar.nava@astelecom.com.mx', 'ep8Yi9', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(10, 15, 2, 1, 1, NULL, 'Arturo Brandon', 'Olivares', 'Cruz', 'AROC-089', 'arturobrandon.olivares@astelecom.com.mx', 'bM5Wry', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(11, 15, 2, 1, 1, NULL, 'Carlos Felipe', 'Alvear', 'Alonso', 'CAAA-075', 'carlosfelipe.alvear@astelecom.com.mx', 'wtWDgM', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(12, 15, 2, 1, 1, NULL, 'Carlos', 'Mireles', 'Medina', 'CAMM-029', 'carlos.mireles@astelecom.com.mx', '6GBQes', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(13, 15, 2, 1, 1, NULL, 'Cayetano Emiliano', 'González', 'León ', 'CAGL-079', 'cayetanoemiliano.gonzalez@astelecom.com.mx', 'IyTw8r', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(14, 15, 2, 1, 1, NULL, 'Crescencio', 'León', 'González', 'CRLG-085', 'crescencio.leon@astelecom.com.mx', 'Rdz90m', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(15, 15, 2, 1, 1, NULL, 'David Iván', 'Rodríguez', 'Vela ', 'DARV-041', 'davidivan.rodriguez@astelecom.com.mx', 'Ubfc48', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(16, 15, 2, 1, 1, NULL, 'Diego', 'Aguilar', 'Santos', 'DIAS-065', 'diego.aguilar@astelecom.com.mx', 'ORfq6n', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, 15, 2, 1, 1, NULL, 'Enrique', 'Esquivel', 'Vargas', 'ENEV-090', 'enrique.esquivel@astelecom.com.mx', 'fdfsh9', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(18, 15, 2, 1, 1, NULL, 'Isaac', 'Bautista', 'Villanueva', 'ISBV-058', 'isaac.bautista@astelecom.com.mx', 'BCcyCW', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(19, 15, 2, 1, 1, NULL, 'Jesus Eduardo', 'Luna', 'Rodarte', 'JELR-087', 'jesuseduardo.luna@astelecom.com.mx', '3uwahe', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(20, 15, 2, 1, 1, NULL, 'Jonathan Victorino', 'Arias', 'Olascoaga', 'JOAO-047', 'jonathanvictorino.arias@astelecom.com.mx', 'D8Nty3', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(21, 15, 2, 1, 1, NULL, 'Jose Rafael', 'Carmona', 'Félix', 'JOCF-023', 'joserafael.carmona@astelecom.com.mx', '7bAesA', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(22, 15, 2, 1, 1, NULL, 'José Arturo', 'Berber', 'Pimentel', 'JOBP-059', 'josearturo.berber@astelecom.com.mx', 'knEdhx', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(23, 15, 2, 1, 1, NULL, 'José Jorge', 'Silva', 'Luna', 'JOSL-044', 'josejorge.silva@astelecom.com.mx', 'PzfJ3d', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(24, 15, 2, 1, 1, NULL, 'José Luis', 'Solache', 'González', 'JOSG-034', 'joseluis.solache@astelecom.com.mx', 'e4ib3f', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(25, 15, 2, 1, 1, NULL, 'Levy Geovanni', 'De', 'Gabriel Bautista', 'LEDG-056', 'levygeovanni.de@astelecom.com.mx', 'ThJCr6', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(26, 15, 2, 1, 1, NULL, 'Manuel', 'León', 'González', 'MALG-083', 'manuel.leon@astelecom.com.mx', 'YXzR6g', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(27, 15, 2, 1, 1, NULL, 'Miguel', 'Antonio', 'Félix', 'MIAF-040', 'miguel.antonio@astelecom.com.mx', 'IGAxhF', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(28, 15, 2, 1, 1, NULL, 'Miguel Antonio', 'Félix', 'Muñoz', 'MIFM-061', 'miguelantonio.felix@astelecom.com.mx', 'CUTjbi', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(29, 15, 2, 1, 1, NULL, 'Miguel Ángel', 'Rivera', 'Noche', 'MIRN-064', 'miguelangel.rivera@astelecom.com.mx', 'EWKKSH', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, 15, 2, 1, 1, NULL, 'Miguel Ángel', 'Zavala', 'Ortega ', 'MIZO-098', 'miguelangel.zavala@astelecom.com.mx', 'vb0btg', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(31, 15, 2, 1, 1, NULL, 'Oscar Enrique', 'Reyes', 'Silva', 'OSRS-039', 'oscarenrique.reyes@astelecom.com.mx', 'TUgENK', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(32, 15, 2, 1, 1, NULL, 'Oscar', 'García', 'Silva', 'OSGS-044', 'oscar.garcia@astelecom.com.mx', '963SIm', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(33, 15, 2, 1, 1, NULL, 'Pedro', 'Flores', 'Becerril', 'PEFB-081', 'pedro.flores@astelecom.com.mx', 'DrPUHA', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(34, 15, 2, 1, 1, NULL, 'Primo', 'Salinas', 'Martinez', 'PRSM-035', 'primo.salinas@astelecom.com.mx', 'jxDprU', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, 15, 2, 1, 1, NULL, 'Ricardo', 'Montoya', 'Chávez', 'RIMC-085', 'ricardo.montoya@astelecom.com.mx', 'GrjaJb', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(36, 15, 2, 1, 1, NULL, 'Roberto', 'Carbajal', 'Sanjuan', 'ROCS-042', 'roberto.carbajal@astelecom.com.mx', 'p8p5yv', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, 15, 2, 1, 1, NULL, 'Roberto Irving', 'Cleto', 'Solis', 'ROCS-045', 'robertoirving.cleto@astelecom.com.mx', 'OSMu8U', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(38, 15, 2, 1, 1, NULL, 'Rubén Santiago', 'Cervera', 'Reyes', 'RUCR-017', 'rubensantiago.cervera@astelecom.com.mx', 'KQhSp6', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(39, 15, 2, 1, 1, NULL, 'Usuario', 'de', 'Pruebas', 'USdP-079', 'usuario.de@astelecom.com.mx', 'rq30j5', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(40, 15, 2, 1, 1, NULL, 'Victor Luis', 'Miguel', 'Muñoz', 'VIMM-050', 'victorluis.miguel@astelecom.com.mx', 'Q15LPv', '1999-01-01', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(41, 14, 2, 21, 2, NULL, 'Usuario', 'de Pruebas', 'Funiconamiento', 'USdF-021', 'usuario.pruebas@astelecom.com.mx', 's7GTA0', '2022-08-22', 'UPRFU00099999', '', '', NULL, 1, 2, 1),
(42, 12, 3, 22, 3, NULL, 'María de los Ángeles', 'Ugalde', 'Sierra', 'MAUS-064', 'angeles.ugalde02@gmail.com', 'su5bMU', '1996-02-08', 'UASA960802MMCGRN05', 'UASA960802GG3', '', NULL, 2, 2, 1),
(43, 15, 2, 23, 4, NULL, 'Luís Ángel', 'Olivares', 'Rojas', 'LUOR-044', 'luisangelolivaresrojas984@gmail.com', 'LuaDAd', '1983-08-07', 'OIRL830708HMSLJS09', 'OIRL8307084X0', '15018323152', NULL, 1, 1, 1);

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
(2, 'Técnico Especializado', 'Téc. Esp.'),
(3, 'Licenciado', 'Lic.'),
(4, 'Arquitecto', 'Arq.');

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
(16, 5, 'Desarrollador'),
(17, 3, 'Coordinación de Compras');

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
  MODIFY `id_archivos_usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_areas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `catalogo_archivos`
--
ALTER TABLE `catalogo_archivos`
  MODIFY `id_catalogo_archivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `contacto_personal`
--
ALTER TABLE `contacto_personal`
  MODIFY `id_contacto_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `direcciones_personal`
--
ALTER TABLE `direcciones_personal`
  MODIFY `id_direcciones_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `lista_personal`
--
ALTER TABLE `lista_personal`
  MODIFY `id_lista_personal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `niveles_academicos`
--
ALTER TABLE `niveles_academicos`
  MODIFY `id_niveles_academicos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `niveles_areas`
--
ALTER TABLE `niveles_areas`
  MODIFY `id_niveles_areas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
