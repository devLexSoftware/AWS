-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: workshopstudio
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.29-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `fechCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechCreado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuCreacion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `rfc` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `calle` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `numExt` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `numInt` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `colonia` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cp` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ciudad` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `municipio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `empresa` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `movil` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nota` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `fechCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechCreado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuCreacion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `frente` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `semana` varchar(45) DEFAULT NULL,
  `numero` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `unidad` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `factura` varchar(45) DEFAULT NULL,
  `costo` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cantidad` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `importe` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comentario` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `fk_proveedor` int(11) NOT NULL,
  `fk_obra` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_proveedor` (`fk_proveedor`),
  KEY `fk_obra` (`fk_obra`),
  CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`fk_proveedor`) REFERENCES `proveedores` (`id`),
  CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`fk_obra`) REFERENCES `obras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detalles_obras`
--

DROP TABLE IF EXISTS `detalles_obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalles_obras` (
  `fechCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechCreado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuCreacion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `avance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comentario` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `fk_obra` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_obra` (`fk_obra`),
  CONSTRAINT `detalles_obras_ibfk_1` FOREIGN KEY (`fk_obra`) REFERENCES `obras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `obras`
--

DROP TABLE IF EXISTS `obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `obras` (
  `fechCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechCreado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuCreacion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `calle` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `numExt` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `numInt` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `colonia` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cp` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `ciudad` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `municipio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fechInicio` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fechFin` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `avance` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `comentario` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `fk_clientes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clientes` (`fk_clientes`),
  CONSTRAINT `obras_ibfk_1` FOREIGN KEY (`fk_clientes`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `fechCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechCreado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuCreacion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `empresa` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `rfc` varchar(45) DEFAULT NULL,
  `importe` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `unidad` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contacto1` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `contacto2` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `comentario` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `fechCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechCreado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuCreacion` varchar(100) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-27 18:35:27
