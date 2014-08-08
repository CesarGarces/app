-- Dump de la Base de Datos
-- Fecha: viernes 09 mayo 2014 - 18:04:32
--
-- Version: 1.1.1, del 18 de Marzo de 2014, https://twitter.com/cesar_garces
-- Soporte y Updaters: https://twitter.com/cesar_garces
--
-- Host: `localhost`    Database: `livianos`
-- ------------------------------------------------------
-- Server version	5.5.32

--
-- Table structure for table `bodega`
--

DROP TABLE IF EXISTS bodega;
CREATE TABLE `bodega` (
  `codigo` int(10) NOT NULL,
  `nombre` longtext COLLATE utf8_spanish_ci NOT NULL,
  `unidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `especificacion_1` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `especificacion_2` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valor` int(11) NOT NULL,
  `imagen` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `minimo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `bodega`
--

LOCK TABLES bodega WRITE;
INSERT INTO bodega VALUES('1', 'placa', 'U/N', '', '', '', '50', '0', '../bodega/img/', '50');
INSERT INTO bodega VALUES('2', 'prueba', 'unidad', '', '', '', '68', '0', '../bodega/img/', '67');
INSERT INTO bodega VALUES('44', 'PLACA', 'U/N', '', '', '', '5', '0', NULL, '67');
INSERT INTO bodega VALUES('46', 'hjl', 'xcvb', '', '', '', '50', '0', '../bodega/img/', '10');
INSERT INTO bodega VALUES('87', 'f', 'f', '', '', '', '500', '0', '../bodega/img/526518_451503031550486_1291795265_n.jpg', '300');
INSERT INTO bodega VALUES('111', 'l', ',', '', '', '', '200', '0', '../bodega/img/', '100');
INSERT INTO bodega VALUES('200', 'Acustifibra de 1 1/2 pul x 1.22m x 2.44m', 'un', '', '', '', '100', '22313', '../bodega/img/', '127');
INSERT INTO bodega VALUES('441', 'Acustifibra de  1 pulg  x 1.22m x 2.44m', 'U/N', '', '', '', '200', '15000', '../bodega/img/', '87');
INSERT INTO bodega VALUES('654', 'vbn', 'cvbn', '', '', '', '80', '0', '../bodega/img/2013-01-25 11.55.19.jpg', '54');
UNLOCK TABLES;


--
-- Table structure for table `cotizacion`
--

DROP TABLE IF EXISTS cotizacion;
CREATE TABLE `cotizacion` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `cotizacion`
--

LOCK TABLES cotizacion WRITE;
INSERT INTO cotizacion VALUES('1', 'cesar', 'alicanr', 'cambio de muro', 'atillar', '300', 'drywall', '1', 'cambio de artillador trifilar a 45% de 3\"', 'U/N', '5', '1500', '7000');
INSERT INTO cotizacion VALUES('2', 'cesar', 'alicanr', 'cambio de muro', 'atillar', '300', 'drywall', '1', 'cambio de artillador trifilar a 45% de 3\"', 'U/N', '5', '1500', '7000');
UNLOCK TABLES;


--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS customer;
CREATE TABLE `customer` (
  `idCustomer` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCust` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `cedNit` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `Tel` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCustomer`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `customer`
--

LOCK TABLES customer WRITE;
INSERT INTO customer VALUES('1', 'carlos', '1548977', 'alle 123', '3104589654');
INSERT INTO customer VALUES('2', 'cesar', '34578944', 'floresta', '30145874554');
UNLOCK TABLES;


--
-- Table structure for table `entrada`
--

DROP TABLE IF EXISTS entrada;
CREATE TABLE `entrada` (
  `codentr` int(11) NOT NULL AUTO_INCREMENT,
  `prov` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codprov` int(11) NOT NULL,
  `obra` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codobra` int(11) NOT NULL,
  `nfac` int(11) NOT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codmat` int(11) NOT NULL,
  `descrip` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `unidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `cantmat` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`codentr`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `entrada`
--

LOCK TABLES entrada WRITE;
INSERT INTO entrada VALUES('1', 'cielotek', '23', 'cinemart', '230', '12345', '25/03/25013', '200', '', '', '22313', '50', '0');
INSERT INTO entrada VALUES('2', 'cielotek', '23', 'cinemart', '230', '333', '25/3/2013', '200', 'Acustifibra de  1 1/2 pul x 1.22m x 2.44m', 'un', '22313', '10', '223130');
INSERT INTO entrada VALUES('3', 'cielotek', '23', 'cinemart', '230', '333', '22/03/2013', '441', 'Acustifibra de  1 pulg  x 1.22m x 2.44m', 'un', '15000', '10', '150000');
INSERT INTO entrada VALUES('4', 'cielotek', '23', 'cinemart', '230', '555', '22/03/2013', '200', '', '', '22313', '10', '0');
INSERT INTO entrada VALUES('6', '123', '312', '123', '123', '126', '123', '123', '', '', '12', '13', '156');
INSERT INTO entrada VALUES('7', 'cieloteck', '23', 'cinemat', '230', '22', '25/02/2014', '200', 'Acustifibra de  1 1/2 pul x 1.22m x 2.44m', 'un', '22313', '56', '1249528');
INSERT INTO entrada VALUES('9', 'cielotek', '23', 'cinemart', '230', '22', '25/02/2014', '441', 'Acustifibra de  1 pulg  x 1.22m x 2.44m', 'un', '22313', '80', '1785040');
INSERT INTO entrada VALUES('10', '', '0', '', '0', '65438', '03/07/2013', '400', '', '', '23700', '82', '1943400');
INSERT INTO entrada VALUES('11', '', '0', '', '0', '0', '', '1', '', '', '200', '6', '1200');
INSERT INTO entrada VALUES('13', '0000', '0', '000', '0', '0', '000', '0', '', '', '0', '0', '0');
UNLOCK TABLES;


--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS material;
CREATE TABLE `material` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `unidad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio_unidad` int(11) NOT NULL,
  `proov` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cod_proov` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_costo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `material`
--

LOCK TABLES material WRITE;
INSERT INTO material VALUES('200', 'Acustifibra de  1 1/2 pul x 1.22m x 2.44m', 'un', '22313', 'cielotek', '23', '25/02/2014', '../bodega/img/mat/2013-01-25 03.10.23.jpg');
INSERT INTO material VALUES('400', 'placa 245', '', '0', '', '', '', NULL);
INSERT INTO material VALUES('401', 'placa2', '', '0', '', '', '', NULL);
INSERT INTO material VALUES('441', 'Acustifibra de  1 pulg  x 1.22m x 2.44m', 'un', '15000', 'cielotek', '23', '25/02/2014', NULL);
INSERT INTO material VALUES('600', 'pintura', 'un', '20000', '', '', '', NULL);
INSERT INTO material VALUES('700', 'tornillo 2/2', '', '0', '', '', '', NULL);
INSERT INTO material VALUES('50000', 'bonbilla 5w', 'un', '2000', 'cinemart', '2000', '19/03/2013', '../bodega/img/mat/');
UNLOCK TABLES;


--
-- Table structure for table `mod_profile`
--

DROP TABLE IF EXISTS mod_profile;
CREATE TABLE `mod_profile` (
  `idmod_prof` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idmodule` int(11) DEFAULT NULL,
  `idProfile` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmod_prof`),
  KEY `fk1` (`idmodule`),
  KEY `fk2` (`idProfile`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `mod_profile`
--

LOCK TABLES mod_profile WRITE;
UNLOCK TABLES;


--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS modules;
CREATE TABLE `modules` (
  `idmodule` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeModule` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nameModule` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descModule` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `dateModule` date NOT NULL,
  `statusModu` set('Enabled','Disabled') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idmodule`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `modules`
--

LOCK TABLES modules WRITE;
UNLOCK TABLES;


--
-- Table structure for table `obra`
--

DROP TABLE IF EXISTS obra;
CREATE TABLE `obra` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `responsable` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `obra`
--

LOCK TABLES obra WRITE;
INSERT INTO obra VALUES('200', 'ciruelas', 'diana', '4587845', '456789');
INSERT INTO obra VALUES('230', 'cinemart', 'Carlos', '5487954', '30254587');
UNLOCK TABLES;


--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS profiles;
CREATE TABLE `profiles` (
  `idProfile` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeProfi` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nameProfi` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descProfi` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `dateProfi` date NOT NULL,
  `statusPro` set('Enabled','Disabled') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idProfile`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `profiles`
--

LOCK TABLES profiles WRITE;
INSERT INTO profiles VALUES('2', '01', 'Admin', 'Super usuario administrador de aplicacion', '2014-01-15', 'Enabled');
INSERT INTO profiles VALUES('3', '02', 'Gerente', 'Cotizaciones , cartera y verificación de funciones de los otros usuarios.', '2014-01-16', 'Enabled');
INSERT INTO profiles VALUES('4', '03', 'Administrador', 'Analisis de mercado, compras, despacho de materiales, pago de materiales', '2014-01-17', 'Enabled');
INSERT INTO profiles VALUES('5', '04', 'Obras', 'Revisión de cotizaciones, control de entrega de material y despachos.', '2014-01-19', 'Enabled');
INSERT INTO profiles VALUES('6', '05', 'Bodega', 'Manejo de inventariós, y despachos y entradas a bodega.', '2014-01-20', 'Enabled');
INSERT INTO profiles VALUES('7', '06', 'visita', 'es un visitante', '2014-01-28', 'Enabled');
INSERT INTO profiles VALUES('8', 'nada', 'aaaa', 'aaa', '2014-01-31', 'Enabled');
UNLOCK TABLES;


--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS proveedor;
CREATE TABLE `proveedor` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `contacto` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES proveedor WRITE;
INSERT INTO proveedor VALUES('23', 'cielotek', 'Juan kano', '5147898', '30145879', 'coelotek@hotmail.com');
UNLOCK TABLES;


--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS role_user;
CREATE TABLE `role_user` (
  `idRolUs` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsers` int(11) NOT NULL,
  `idRole` int(11) NOT NULL,
  PRIMARY KEY (`idRolUs`),
  KEY `fk1` (`idUsers`),
  KEY `fk2` (`idRole`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `role_user`
--

LOCK TABLES role_user WRITE;
INSERT INTO role_user VALUES('2', '1', '1');
UNLOCK TABLES;


--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS roles;
CREATE TABLE `roles` (
  `idRole` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codeRole` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `nameRole` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `descRole` longtext COLLATE utf8_spanish_ci NOT NULL,
  `statRole` set('Enabled','Disabled') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `roles`
--

LOCK TABLES roles WRITE;
INSERT INTO roles VALUES('2', '01admin', 'admin', 'operador super usuario', 'Enabled');
INSERT INTO roles VALUES('3', '02gerente', 'gerente', 'operador gerente', 'Enabled');
UNLOCK TABLES;


--
-- Table structure for table `salida`
--

DROP TABLE IF EXISTS salida;
CREATE TABLE `salida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orden` int(11) NOT NULL,
  `obra` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codobra` int(11) NOT NULL,
  `despacho` int(11) NOT NULL,
  `fecha` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `codmat` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `cantmat` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `salida`
--

LOCK TABLES salida WRITE;
INSERT INTO salida VALUES('1', '1', 'cinemart', '230', '1', '10/03/2013', '200', '22313', '27', '602451');
INSERT INTO salida VALUES('2', '1', 'cinemart', '230', '1', '10/03/2013', '441', '15000', '10', '150000');
INSERT INTO salida VALUES('3', '2', 'cinemart', '230', '2', '10/03/2013', '441', '15000', '10', '150000');
INSERT INTO salida VALUES('4', '3', 'cinemart', '230', '3', '12/03/2013', '441', '15000', '30', '450000');
UNLOCK TABLES;


--
-- Table structure for table `user_pro`
--

DROP TABLE IF EXISTS user_pro;
CREATE TABLE `user_pro` (
  `idUserPro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProfile` int(11) NOT NULL,
  `idUsers` int(11) NOT NULL,
  PRIMARY KEY (`idUserPro`),
  KEY `fk1` (`idProfile`),
  KEY `fk2` (`idUsers`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `user_pro`
--

LOCK TABLES user_pro WRITE;
INSERT INTO user_pro VALUES('39', '3', '2');
INSERT INTO user_pro VALUES('48', '4', '5');
INSERT INTO user_pro VALUES('44', '8', '10');
INSERT INTO user_pro VALUES('51', '6', '6');
INSERT INTO user_pro VALUES('50', '3', '6');
INSERT INTO user_pro VALUES('49', '2', '6');
INSERT INTO user_pro VALUES('55', '2', '1');
UNLOCK TABLES;


--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `users`
--

LOCK TABLES users WRITE;
INSERT INTO users VALUES('1', 'admin', 'admin', '2', '', '1', '../user/img/favicon.png', '0', 'admin', 'enabled');
INSERT INTO users VALUES('2', 'diego.marin', 'diego', '3', 'livianos@hotmail.com', '1', '../user/img/IMG-20140202-WA0000.jpg', '0', 'admin', 'enabled');
INSERT INTO users VALUES('5', 'sas', 'asa', '4', 'asa', '1', '../user/img/2013-08-27 07.07.55.jpg', '0', 'admin', 'enabled');
INSERT INTO users VALUES('6', 'bodega', 'bodega', '6', 'aaa', '1', '../user/img/2013-11-29 12.05.01.jpg', '0', 'admin', 'enabled');
INSERT INTO users VALUES('10', 'santiago', 'santi', '8', '', '1', '../user/img/2013-08-25 01.08.18.jpg', '1', 'admin', 'enabled');
UNLOCK TABLES;



-- Dump de la Base de Datos Completo.