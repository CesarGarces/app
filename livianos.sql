-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2014 a las 23:04:58
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `livianos`
--
CREATE DATABASE IF NOT EXISTS `livianos` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `livianos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE IF NOT EXISTS `bodega` (
  `codigo` int(10) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `unidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `especificacion_1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `especificacion_2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` tinyint(4) DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `imagen` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bodega`
--

INSERT INTO `bodega` (`codigo`, `nombre`, `unidad`, `tipo`, `especificacion_1`, `especificacion_2`, `cantidad`, `valor`, `imagen`) VALUES
(1, 'placa', 'U/N', 'drywall', 'driwall123', '', 10, 15000, '../bodega/img/2013-08-27 07.05.51.jpg'),
(2, 'prueba', 'unidad', 'tipo', 'espec1', '', 10, 1000, NULL),
(44, 'PLACA', 'U/N', 'DRYWALL', '12"', '', 5, 1500, NULL),
(441, 'PLACA', 'U/N', 'DRYWALL1', '12"1', 'CASA BLANCA', 10, 1800, NULL),
(2255, 'fgg', 'ggg', 'ggg', 'ggg', 'ggg', 14, 111, '../bodega/img/2013-08-27 07.02.43.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE IF NOT EXISTS `cotizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_cliente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `asunto` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `obra` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cod_obra` int(11) NOT NULL,
  `producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cod_prod_cot` int(11) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `unidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor_unidad` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`id`, `nombre_cliente`, `empresa_cliente`, `asunto`, `obra`, `cod_obra`, `producto`, `cod_prod_cot`, `descripcion`, `unidad`, `cantidad`, `valor_unidad`, `total`) VALUES
(1, 'cesar', 'alicanr', 'cambio de muro', 'atillar', 300, 'drywall', 1, 'cambio de artillador trifilar a 45% de 3"', 'U/N', 5, 1500, 7000),
(2, 'cesar', 'alicanr', 'cambio de muro', 'atillar', 300, 'drywall', 1, 'cambio de artillador trifilar a 45% de 3"', 'U/N', 5, 1500, 7000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `idCustomer` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCust` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `cedNit` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Tel` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCustomer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`idCustomer`, `nombreCust`, `cedNit`, `direccion`, `Tel`) VALUES
(1, 'carlos', '1548977', 'alle 123', '3104589654'),
(2, 'cesar', '34578944', 'floresta', '30145874554');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `idmodule` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeModule` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nameModule` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descModule` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `dateModule` date NOT NULL,
  `statusModu` set('Enabled','Disabled') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idmodule`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mod_profile`
--

CREATE TABLE IF NOT EXISTS `mod_profile` (
  `idmod_prof` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idmodule` int(11) DEFAULT NULL,
  `idProfile` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmod_prof`),
  KEY `fk1` (`idmodule`),
  KEY `fk2` (`idProfile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `idProfile` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeProfi` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nameProfi` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descProfi` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `dateProfi` date NOT NULL,
  `statusPro` set('Enabled','Disabled') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idProfile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`idProfile`, `codeProfi`, `nameProfi`, `descProfi`, `dateProfi`, `statusPro`) VALUES
(2, '01', 'Admin', 'Super usuario administrador de aplicacion', '2014-01-15', 'Enabled'),
(3, '02', 'Gerente', 'Cotizaciones , cartera y verificación de funciones de los otros usuarios.', '2014-01-16', 'Enabled'),
(4, '03', 'Administrador', 'Analisis de mercado, compras, despacho de materiales, pago de materiales', '2014-01-17', 'Enabled'),
(5, '04', 'Obras', 'Revisión de cotizaciones, control de entrega de material y despachos.', '2014-01-19', 'Enabled'),
(6, '05', 'Bodega', 'Manejo de inventariós, y despachos y entradas a bodega.', '2014-01-20', 'Enabled'),
(7, '06', 'visita', 'es un visitante', '2014-01-28', 'Enabled'),
(8, 'nada', 'aaaa', 'aaa', '2014-01-31', 'Enabled');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `idRole` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeRole` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nameRole` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `descRole` longtext COLLATE utf8_spanish_ci NOT NULL,
  `statRole` set('Enabled','Disabled') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRole`, `codeRole`, `nameRole`, `descRole`, `statRole`) VALUES
(2, '01admin', 'admin', 'operador super usuario', 'Enabled'),
(3, '02gerente', 'gerente', 'operador gerente', 'Enabled');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `idRolUs` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsers` int(11) NOT NULL,
  `idRole` int(11) NOT NULL,
  PRIMARY KEY (`idRolUs`),
  KEY `fk1` (`idUsers`),
  KEY `fk2` (`idRole`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`idRolUs`, `idUsers`, `idRole`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUsers` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `loginUsers` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `passUsers` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `idprofile` int(11) NOT NULL,
  `emailUser` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `idActiveCode` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` longtext COLLATE utf8_spanish_ci,
  `idexistindb` int(11) NOT NULL,
  `nameProfi` enum('admin','gerente') COLLATE utf8_spanish_ci DEFAULT NULL,
  `statusUsers` enum('enabled','disabled') COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idUsers`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUsers`, `loginUsers`, `passUsers`, `idprofile`, `emailUser`, `idActiveCode`, `imagen`, `idexistindb`, `nameProfi`, `statusUsers`) VALUES
(1, 'admin', 'admin', 3, '', '1', '../user/img/avatar.jpg', 0, 'admin', 'enabled'),
(2, 'diego.marin', 'diego', 3, 'livianos@hotmail.com', '1', '../user/img/IMG-20140202-WA0000.jpg', 0, 'admin', 'enabled'),
(3, 'cesar.garces', '123', 2, 'cesargarce@gmail.com', '1', '../user/img/2013-08-27 07.09.20.jpg', 0, 'admin', 'enabled'),
(5, 'sas', 'asa', 4, 'asa', '1', '../user/img/2013-08-27 07.07.55.jpg', 0, 'admin', 'enabled'),
(6, 'bodega', 'bodega', 6, 'aaa', '1', '../user/img/2013-11-29 12.05.01.jpg', 0, 'admin', 'enabled'),
(10, 'santiago', 'santi', 8, '', '1', '../user/img/2013-08-25 01.08.18.jpg', 1, 'admin', 'enabled');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_pro`
--

CREATE TABLE IF NOT EXISTS `user_pro` (
  `idUserPro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProfile` int(11) NOT NULL,
  `idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idUserPro`),
  KEY `fk1` (`idProfile`),
  KEY `fk2` (`idUsers`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `user_pro`
--

INSERT INTO `user_pro` (`idUserPro`, `idProfile`, `idUsers`) VALUES
(39, 3, 2),
(47, 4, 3),
(46, 3, 3),
(45, 2, 3),
(48, 4, 5),
(44, 8, 10),
(51, 6, 6),
(50, 3, 6),
(49, 2, 6),
(38, 3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
