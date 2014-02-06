-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-10-2013 a las 19:36:03
-- Versión del servidor: 5.5.33-1
-- Versión de PHP: 5.5.4-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdsi215`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ADMINISTRADOR`
--

CREATE TABLE IF NOT EXISTS `ADMINISTRADOR` (
  `IDUSUARIO` varchar(10) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '0',
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ADMINISTRADOR`
--

INSERT INTO `ADMINISTRADOR` (`IDUSUARIO`, `ESTADO`, `FECHAULTIMAMODIFICACION`) VALUES
('A1', 1, '2013-10-08 09:58:44'),
('E1', 0, '2013-10-08 09:58:29'),
('S1', 0, '2013-10-21 18:30:45'),
('USER_FL001', 1, '2013-10-21 19:21:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BITACORA`
--

CREATE TABLE IF NOT EXISTS `BITACORA` (
  `CORRELATIVO` int(11) NOT NULL AUTO_INCREMENT,
  `IDUSUARIO` varchar(10) NOT NULL,
  `EVENTO` varchar(150) NOT NULL,
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CORRELATIVO`),
  KEY `FK_REGISTRA_EN` (`IDUSUARIO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Volcado de datos para la tabla `BITACORA`
--

INSERT INTO `BITACORA` (`CORRELATIVO`, `IDUSUARIO`, `EVENTO`, `FECHAULTIMAMODIFICACION`) VALUES
(1, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-06 02:31:06'),
(2, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-06 08:55:13'),
(3, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-07 05:55:10'),
(4, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-07 06:29:25'),
(5, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-07 09:12:21'),
(6, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-08 06:57:53'),
(7, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-08 08:48:24'),
(8, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-12 20:58:18'),
(9, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-12 21:24:12'),
(10, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-16 03:42:38'),
(11, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-18 06:46:11'),
(12, 'E1', 'TIPO: ENCARGADO DE INVENTARIO, INICIO DE SESION', '2013-10-18 07:20:57'),
(13, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-18 07:21:29'),
(14, 'E1', 'TIPO: ENCARGADO DE INVENTARIO, INICIO DE SESION', '2013-10-18 07:22:41'),
(15, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-18 07:24:40'),
(16, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 04:55:25'),
(17, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 06:10:53'),
(18, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 06:39:00'),
(19, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 14:09:35'),
(20, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 14:24:00'),
(21, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 17:30:43'),
(22, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 20:33:08'),
(23, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-19 22:27:54'),
(24, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 01:10:37'),
(25, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 02:13:28'),
(26, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 03:52:29'),
(27, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 13:52:16'),
(28, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 16:54:26'),
(29, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 18:01:16'),
(30, 'A1', 'TIPO: ADMINISTRADOR, ACTUALIZAMOS USUARIO S1 A USUARIO TIPO ADMINISTRADOR ', '2013-10-20 18:01:39'),
(31, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 20:11:38'),
(32, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 20:42:36'),
(33, 'A1', 'TIPO: ADMINISTRADOR, INICIO DE SESION', '2013-10-20 23:09:28'),
(34, 'A1', 'Tipo: Administrador, Inicio de sesiÃ³n', '2013-10-21 18:28:41'),
(35, 'S1', 'Tipo: Administrador, Inicio de sesiÃ³n', '2013-10-21 18:30:14'),
(36, 'A1', 'Tipo: Administrador, Inicio de sesiÃ³n', '2013-10-21 18:30:26'),
(37, 'A1', 'Tipo: Administrador, Actualizamos usuario S1 a usuario tipo SUPERVISOR', '2013-10-21 18:30:45'),
(38, 'S1', 'Tipo: Supervisor, Inicio de sesiÃ³n', '2013-10-21 18:31:01'),
(39, 'E1', 'Tipo: Encargado de Inventario, Inicio de sesiÃ³n', '2013-10-21 18:31:37'),
(40, 'A1', 'Tipo: Administrador, Inicio de sesiÃ³n', '2013-10-21 18:47:21'),
(41, 'A1', 'Tipo: Administrador, Insertamos usuario USER_FL001', '2013-10-21 19:21:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BODEGA`
--

CREATE TABLE IF NOT EXISTS `BODEGA` (
  `IDBODEGA` varchar(10) NOT NULL,
  `IDPRODUCTO` varchar(10) NOT NULL,
  `UBICACION` varchar(150) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '1',
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDBODEGA`),
  KEY `FK_SE_ALMACENA_EN` (`IDPRODUCTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `BODEGA`
--

INSERT INTO `BODEGA` (`IDBODEGA`, `IDPRODUCTO`, `UBICACION`, `ESTADO`, `FECHAULTIMAMODIFICACION`) VALUES
('BDG0000001', 'PRD0000004', 'SUCURSAL MASFERRER', 1, '2013-10-19 15:24:12'),
('BDG0000002', 'PRD0000001', 'CASA MATRIZ', 1, '2013-10-19 15:23:51'),
('BDG0000003', 'PRD0000004', 'SUCURSAL CENTRO', 1, '2013-10-19 15:24:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ENCARGADOINVENTARIO`
--

CREATE TABLE IF NOT EXISTS `ENCARGADOINVENTARIO` (
  `IDUSUARIO` varchar(10) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '0',
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ENCARGADOINVENTARIO`
--

INSERT INTO `ENCARGADOINVENTARIO` (`IDUSUARIO`, `ESTADO`, `FECHAULTIMAMODIFICACION`) VALUES
('A1', 1, '2013-10-18 07:24:14'),
('E1', 1, '2013-10-08 10:42:12'),
('USER_FL001', 0, '2013-10-21 19:21:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INVENTARIO`
--

CREATE TABLE IF NOT EXISTS `INVENTARIO` (
  `CORRELATIVO` int(11) NOT NULL AUTO_INCREMENT,
  `IDTRANSACCION` varchar(10) NOT NULL,
  `IDPROVEEDOR` varchar(10) NOT NULL,
  `IDBODEGA` varchar(10) NOT NULL,
  `IDPRODUCTO` varchar(10) NOT NULL,
  `IDUSUARIO` varchar(10) NOT NULL,
  `NOMBREPRODUCTO` varchar(30) NOT NULL,
  `CANTIDADPRODUCTOXLOTE` int(11) NOT NULL,
  `CANTIDADLOTES` int(11) NOT NULL,
  `COSTOXLOTE` decimal(12,2) NOT NULL,
  `COSTOUNITARIOREGISTRADO` decimal(12,2) NOT NULL,
  `DESCRIPCION` varchar(150) NOT NULL,
  `FECHAINGRESOINVENTARIO` datetime NOT NULL,
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `EX` int(11) NOT NULL,
  PRIMARY KEY (`CORRELATIVO`),
  KEY `FK_GESTIONA_EN_UN` (`IDUSUARIO`),
  KEY `FK_PUEDE_ESTAR_EN` (`IDPROVEEDOR`),
  KEY `FK_ALMACENA` (`IDPRODUCTO`),
  KEY `FK_ESTA_REGISTRADO_EN` (`IDBODEGA`),
  KEY `CORRELATIVO` (`CORRELATIVO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `INVENTARIO`
--

INSERT INTO `INVENTARIO` (`CORRELATIVO`, `IDTRANSACCION`, `IDPROVEEDOR`, `IDBODEGA`, `IDPRODUCTO`, `IDUSUARIO`, `NOMBREPRODUCTO`, `CANTIDADPRODUCTOXLOTE`, `CANTIDADLOTES`, `COSTOXLOTE`, `COSTOUNITARIOREGISTRADO`, `DESCRIPCION`, `FECHAINGRESOINVENTARIO`, `FECHAULTIMAMODIFICACION`, `EX`) VALUES
(1, 'EP00000001', 'PRV0000002', 'BDG0000001', 'PRD0000004', 'E1', 'LUCES DE BAMBU', 15, 250, 50.00, 75.90, 'ENTRADA DE PRODUCTOS', '2013-09-11 00:00:00', '2013-10-08 10:39:30', 0),
(2, 'EP00000001', 'PRV0000002', 'BDG0000003', 'PRD0000003', 'E1', 'MORTEROS', 200, 200, 75.60, 0.00, 'INGRESO DE MERCADERIA A INVENTYARIO', '2013-10-25 00:00:00', '2013-10-19 04:48:42', 0),
(3, 'EP00000001', 'PRV0000002', 'BDG0000001', 'PRD0000002', 'A1', 'LUCES X', 78, 89, 96.00, 1.45, 'LALALA', '2013-10-18 00:00:00', '2013-10-19 20:37:08', 0),
(4, 'EP00000001', 'PRV0000002', 'BDG0000001', 'PRD0000001', 'A1', 'FULMINANTES', 7, 7, 7.00, 1.00, 'OOOO', '0000-00-00 00:00:00', '2013-10-19 20:37:18', 0),
(5, 'EP00000001', 'PRV0000002', 'BDG0000001', 'PRD0000003', 'A1', 'MORTEROS', 45, 5, 54.00, 1.20, 'XXXXXXXXXXXXXXXXXXXXXX', '0000-00-00 00:00:00', '2013-10-19 20:37:28', 0),
(6, 'EP00000001', 'PRV0000003', 'BDG0000001', 'PRD0000001', 'A1', 'FULMINANTES', 8, 78, 8.00, 1.00, 'ZZZZZZZZZZZZZZZZZZZZZZZZZZZZ', '2013-10-18 00:00:00', '2013-10-19 20:37:36', 0),
(7, 'EP00000002', 'PRV0000002', 'BDG0000001', 'PRD0000004', 'A1', 'LUCES DE BAMBU', 300, 250, 75.00, 200.00, 'ENTRADA PROVENIENTE DE UNA ORDEN DE COMPRA', '0000-00-00 00:00:00', '2013-10-19 20:37:49', 0),
(25, 'EP00000003', 'PRV0000002', 'BDG0000001', 'PRD0000004', 'A1', 'LUCES DE BAMBU', 300, 250, 75.00, 200.00, 'ENTRADA PROVENIENTE DE UNA ORDEN DE COMPRA', '2013-10-19 00:00:00', '2013-10-19 22:31:43', 0),
(26, 'EP00000004', 'PRV0000002', 'BDG0000001', 'PRD0000004', 'A1', 'LUCES DE BAMBU', 300, 250, 75.00, 200.00, 'ENTRADA PROVENIENTE DE UNA ORDEN DE COMPRA', '2013-10-19 00:00:00', '2013-10-19 22:50:03', 0),
(27, 'EP00000005', 'PRV0000001', 'BDG0000001', 'PRD0000001', 'A1', 'FULMINANTES', 4, 4, 45.70, 11.42, 'TTTTTTT', '2013-10-20 17:09:57', '2013-10-20 23:09:57', 4),
(28, 'EP00000006', 'PRV0000002', 'BDG0000001', 'PRD0000002', 'A1', 'VOLCANCITOS', 500, 56, 250.00, 0.50, 'ENTRADA PROVENIENTE DE UNA ORDEN DE COMPRA', '2013-10-20 17:11:15', '2013-10-20 23:11:15', 56);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ORDENDECOMPRA`
--

CREATE TABLE IF NOT EXISTS `ORDENDECOMPRA` (
  `NUMERO` int(11) NOT NULL,
  `IDORDEN` varchar(10) NOT NULL,
  `IDPRODUCTO` varchar(10) NOT NULL,
  `IDPROVEEDOR` varchar(10) NOT NULL,
  `IDUSUARIO` varchar(10) NOT NULL,
  `CANTIDADLOTES` int(11) NOT NULL,
  `COSTOPORLOTE` decimal(12,2) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '0',
  `COSTOUNITARIO` decimal(12,2) NOT NULL,
  `PRODUCTOSXLOTE` int(11) NOT NULL,
  `FECHA` date NOT NULL,
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`NUMERO`,`IDORDEN`,`IDPRODUCTO`,`IDPROVEEDOR`),
  KEY `FK_CONTIENE` (`IDPROVEEDOR`),
  KEY `FK_TIENE` (`IDPRODUCTO`),
  KEY `FK_GESTIONA` (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ORDENDECOMPRA`
--

INSERT INTO `ORDENDECOMPRA` (`NUMERO`, `IDORDEN`, `IDPRODUCTO`, `IDPROVEEDOR`, `IDUSUARIO`, `CANTIDADLOTES`, `COSTOPORLOTE`, `ESTADO`, `COSTOUNITARIO`, `PRODUCTOSXLOTE`, `FECHA`, `FECHAULTIMAMODIFICACION`) VALUES
(1, 'OR00000001', 'PRD0000001', 'PRV0000002', 'S1', 34, 4000.00, 1, 114.29, 35, '2013-07-10', '2013-10-21 18:49:30'),
(2, 'OR00000002', 'PRD0000004', 'PRV0000002', 'S1', 250, 125.00, 3, 200.00, 250, '2013-05-20', '2013-10-20 17:19:01'),
(3, 'OR00000003', 'PRD0000004', 'PRV0000003', 'S1', 200, 35.50, 2, 3757.00, 0, '2013-06-19', '2013-10-08 10:41:47'),
(4, 'OR00000004', 'PRD0000003', 'PRV0000002', 'A1', 10, 25.00, 3, 0.50, 50, '2013-10-19', '2013-10-20 21:29:55'),
(5, 'OR00000005', 'PRD0000003', 'PRV0000001', 'A1', 50, 50.00, 1, 1.00, 50, '2013-10-19', '2013-10-21 19:03:35'),
(6, 'OR00000005', 'PRD0000004', 'PRV0000002', 'A1', 75, 75.00, 3, 1.00, 75, '2013-10-19', '2013-10-21 19:03:35'),
(7, 'OR00000005', 'PRD0000002', 'PRV0000003', 'A1', 100, 100.00, 3, 1.00, 100, '2013-10-19', '2013-10-21 19:03:35'),
(8, 'OR00000006', 'PRD0000001', 'PRV0000001', 'A1', 4, 4.00, 3, 1.00, 4, '2013-10-20', '2013-10-20 18:02:57'),
(9, 'OR00000007', 'PRD0000002', 'PRV0000002', 'A1', 56, 250.00, 2, 0.50, 500, '2013-10-20', '2013-10-20 23:11:11'),
(10, 'OR00000008', 'PRD0000001', 'PRV0000001', 'A1', 7, 8.00, 1, 1.00, 8, '2013-10-20', '2013-10-20 17:42:41'),
(11, 'OR00000009', 'PRD0000001', 'PRV0000001', 'A1', 45, 54.00, 3, 2.35, 23, '2013-10-20', '2013-10-20 18:02:46'),
(12, 'OR00000010', 'PRD0000001', 'PRV0000001', 'A1', 34, 54.00, 1, 1.00, 54, '2013-10-20', '2013-10-20 17:47:48'),
(13, 'OR00000011', 'PRD0000001', 'PRV0000001', 'A1', 45, 76.00, 3, 1.41, 54, '2013-10-20', '2013-10-20 21:30:51'),
(14, 'OR00000012', 'PRD0000001', 'PRV0000001', 'A1', 45, 54.00, 1, 4.50, 12, '2013-10-20', '2013-10-20 17:49:57'),
(15, 'OR00000013', 'PRD0000001', 'PRV0000001', 'A1', 5, 5.00, 3, 1.00, 5, '2013-10-20', '2013-10-20 22:11:49'),
(16, 'OR00000014', 'PRD0000002', 'PRV0000002', 'A1', 5, 32.55, 1, 3.26, 10, '2013-10-21', '2013-10-21 18:51:51'),
(17, 'OR00000015', 'PRD0000001', 'PRV0000001', 'A1', 10, 100.00, 3, 10.00, 10, '2013-10-21', '2013-10-21 19:17:07'),
(18, 'OR00000015', 'PRD0000003', 'PRV0000001', 'A1', 20, 400.00, 3, 20.00, 20, '2013-10-21', '2013-10-21 19:17:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRODUCTOS`
--

CREATE TABLE IF NOT EXISTS `PRODUCTOS` (
  `IDPRODUCTO` varchar(10) NOT NULL,
  `IDUSUARIO` varchar(10) NOT NULL,
  `NOMBREPRODUCTO` varchar(20) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '1',
  `EXISTENCIA` decimal(12,2) NOT NULL DEFAULT '0.00',
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDPRODUCTO`),
  KEY `FK_GESTIONA_PRODUCTOS` (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PRODUCTOS`
--

INSERT INTO `PRODUCTOS` (`IDPRODUCTO`, `IDUSUARIO`, `NOMBREPRODUCTO`, `ESTADO`, `EXISTENCIA`, `FECHAULTIMAMODIFICACION`) VALUES
('PRD0000001', 'S1', 'FULMINANTES', 1, 4.00, '2013-10-20 23:09:57'),
('PRD0000002', 'S1', 'VOLCANCITOS', 1, 56.00, '2013-10-20 23:11:15'),
('PRD0000003', 'S1', 'MORTEROS', 2, 0.00, '2013-10-08 10:02:29'),
('PRD0000004', 'S1', 'LUCES DE BAMBU', 0, 1000.00, '2013-10-08 10:15:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROVEEDOR`
--

CREATE TABLE IF NOT EXISTS `PROVEEDOR` (
  `IDPROVEEDOR` varchar(10) NOT NULL,
  `IDUSUARIO` varchar(10) NOT NULL,
  `NOMBREEMPRESA` varchar(20) NOT NULL,
  `DIRECCION` varchar(20) NOT NULL,
  `TELEFONO` varchar(15) NOT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `DESCRIPCION` varchar(150) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '1',
  `FECHAINGRESO` date NOT NULL,
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDPROVEEDOR`),
  KEY `FK_GESTIONAPROVEEDOR` (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `PROVEEDOR`
--

INSERT INTO `PROVEEDOR` (`IDPROVEEDOR`, `IDUSUARIO`, `NOMBREEMPRESA`, `DIRECCION`, `TELEFONO`, `EMAIL`, `DESCRIPCION`, `ESTADO`, `FECHAINGRESO`, `FECHAULTIMAMODIFICACION`) VALUES
('PRV0000001', 'S1', 'FRIENDII INDUSTRY CO', 'B1, 4TH FLOOR, NO. 1', '222222222', 'FRIENDII@YAHOO.COM', 'LAS INSTALACIONES DEL PROVEEDOR HAN SIDO VISITADAS Y VERIFICADAS PARA ASEGURAR QUE ESTAN OPERATIVAS.', 1, '2013-10-01', '2013-10-19 14:10:46'),
('PRV0000002', 'A1', 'FABRICA MILITAR RIO ', 'MENDOZA S/N COL.RIO ', '(54)25252525', 'CONTACTO@MILITARRIOTERCERO.COM', 'LA FABRICA MILITAR RIO TERCERO FUE FUNDADA EN 1937 COMO PRODUCTORA DE MUNICION PARA ARTILLERIA. POSTERIORMENTE POR NECESIDADES INDUSTRIALES FUE IN', 1, '2013-09-02', '2013-10-21 19:00:53'),
('PRV0000003', 'A1', 'SHANGHAI JOYAL MININ', 'OFICINAS CORPORATIVA', '(51)78789856', 'PRINCIPAL@JOJALMINING.COM', 'NUESTROS PRODUCTOS SE ABARCAN PRINCIPALMENTE DE LA TRITURADORA DE MANDIBULA, LA DE CONO, LA DE IMPACTO, LA DE MARTILLO, ALIMENTADOR VIBRATORIO, CRIBA ', 1, '2013-10-04', '2013-10-11 03:21:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SUPERVISOR`
--

CREATE TABLE IF NOT EXISTS `SUPERVISOR` (
  `IDUSUARIO` varchar(10) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '0',
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `SUPERVISOR`
--

INSERT INTO `SUPERVISOR` (`IDUSUARIO`, `ESTADO`, `FECHAULTIMAMODIFICACION`) VALUES
('A1', 0, '2013-10-08 09:57:45'),
('E1', 0, '2013-10-08 09:57:45'),
('S1', 1, '2013-10-21 18:30:45'),
('USER_FL001', 0, '2013-10-21 19:21:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE IF NOT EXISTS `USUARIO` (
  `IDUSUARIO` varchar(10) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `APELLIDO` varchar(30) NOT NULL,
  `FECHANACIMIENTO` date NOT NULL,
  `PASS` varchar(32) NOT NULL,
  `ROL` int(11) NOT NULL,
  `ESTADO` int(11) NOT NULL DEFAULT '1',
  `FECHAULTIMAMODIFICACION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDUSUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`IDUSUARIO`, `NOMBRE`, `APELLIDO`, `FECHANACIMIENTO`, `PASS`, `ROL`, `ESTADO`, `FECHAULTIMAMODIFICACION`) VALUES
('A1', 'JUAN', 'PEREZ', '1980-12-25', '21232F297A57A5A743894A0E4A801FC3', 1, 1, '2013-10-06 02:29:35'),
('E1', 'MARCO', 'PEREZ', '1983-07-05', 'CB0D0277094BFFBF04ECEB3A6091CFAA', 3, 1, '2013-10-06 02:29:35'),
('S1', 'ALEJANDRA', 'PEREZ', '1975-09-12', '09348C20A019BE0318387C08DF7A783D', 2, 1, '2013-10-21 18:30:45'),
('USER_FL001', 'Francisco', 'Lopez', '1960-02-10', '912ec803b2ce49e4a541068d495ab570', 1, 1, '2013-10-21 19:21:20');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  ADD CONSTRAINT `FK_REPRESENTA` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`IDUSUARIO`);

--
-- Filtros para la tabla `BITACORA`
--
ALTER TABLE `BITACORA`
  ADD CONSTRAINT `FK_REGISTRA_EN` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`IDUSUARIO`);

--
-- Filtros para la tabla `BODEGA`
--
ALTER TABLE `BODEGA`
  ADD CONSTRAINT `FK_SE_ALMACENA_EN` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `PRODUCTOS` (`IDPRODUCTO`);

--
-- Filtros para la tabla `ENCARGADOINVENTARIO`
--
ALTER TABLE `ENCARGADOINVENTARIO`
  ADD CONSTRAINT `FK_ESTA_ASIGNADO` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`IDUSUARIO`);

--
-- Filtros para la tabla `INVENTARIO`
--
ALTER TABLE `INVENTARIO`
  ADD CONSTRAINT `FK_ALMACENA` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `PRODUCTOS` (`IDPRODUCTO`),
  ADD CONSTRAINT `FK_ESTA_REGISTRADO_EN` FOREIGN KEY (`IDBODEGA`) REFERENCES `BODEGA` (`IDBODEGA`),
  ADD CONSTRAINT `FK_GESTIONA_EN_UN` FOREIGN KEY (`IDUSUARIO`) REFERENCES `ENCARGADOINVENTARIO` (`IDUSUARIO`),
  ADD CONSTRAINT `FK_PUEDE_ESTAR_EN` FOREIGN KEY (`IDPROVEEDOR`) REFERENCES `PROVEEDOR` (`IDPROVEEDOR`);

--
-- Filtros para la tabla `ORDENDECOMPRA`
--
ALTER TABLE `ORDENDECOMPRA`
  ADD CONSTRAINT `FK_CONTIENE` FOREIGN KEY (`IDPROVEEDOR`) REFERENCES `PROVEEDOR` (`IDPROVEEDOR`),
  ADD CONSTRAINT `FK_GESTIONA` FOREIGN KEY (`IDUSUARIO`) REFERENCES `ADMINISTRADOR` (`IDUSUARIO`),
  ADD CONSTRAINT `FK_TIENE` FOREIGN KEY (`IDPRODUCTO`) REFERENCES `PRODUCTOS` (`IDPRODUCTO`);

--
-- Filtros para la tabla `PRODUCTOS`
--
ALTER TABLE `PRODUCTOS`
  ADD CONSTRAINT `FK_GESTIONA_PRODUCTOS` FOREIGN KEY (`IDUSUARIO`) REFERENCES `SUPERVISOR` (`IDUSUARIO`);

--
-- Filtros para la tabla `PROVEEDOR`
--
ALTER TABLE `PROVEEDOR`
  ADD CONSTRAINT `FK_GESTIONAPROVEEDOR` FOREIGN KEY (`IDUSUARIO`) REFERENCES `SUPERVISOR` (`IDUSUARIO`);

--
-- Filtros para la tabla `SUPERVISOR`
--
ALTER TABLE `SUPERVISOR`
  ADD CONSTRAINT `FK_PUEDE_SER` FOREIGN KEY (`IDUSUARIO`) REFERENCES `USUARIO` (`IDUSUARIO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
