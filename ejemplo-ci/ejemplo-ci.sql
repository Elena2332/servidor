-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 16, 2021 at 09:17 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ejemplo-ci`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(35) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(35) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `promedio` tinyint(4) DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_nombreApellidoFecha` (`nombre`,`apellidos`,`nacimiento`),
  KEY `nombre` (`nombre`(10),`apellidos`(20))
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellidos`, `nacimiento`, `promedio`, `sexo`) VALUES
(1, 'Adrian Jesus', 'Aceves Garcia', '1998-12-02', 5, 'M'),
(3, 'Alejandro', 'Aceves Lopez de Nava', '1999-09-06', 9, 'M'),
(4, 'Alejandro', 'Acosta Garcia', '1995-08-08', 4, 'M'),
(5, 'Alicia', 'Acosta Baeza', '1991-07-10', 6, 'F'),
(6, 'Alicia Maria', 'Acosta Garcia', '1980-06-12', 8, 'F'),
(7, 'Ana Lilia', 'Acuna Gallareta', '1978-05-11', 10, 'F'),
(8, 'Arturo', 'Adame Gomez', '1984-04-09', 5, 'M'),
(9, 'Benjamin', 'Aguado Medina', '1998-04-07', 7, 'M'),
(10, 'Blanca Araceli', 'Aguario Albarran', '1995-03-06', 9, 'M'),
(11, 'Carmen Julieta', 'Aguilar Tellez', '1993-02-06', 4, 'F'),
(12, 'Diana', 'Aguilar Casillas', '1991-03-05', 6, 'F'),
(13, 'Edgar', 'Aguilar Flores', '1989-04-03', 8, 'M'),
(14, 'Edmundo Rafael', 'Aguilar Galvan', '1970-06-02', 10, 'M'),
(15, 'Elvira', 'Aguilar De Llano', '1989-07-04', 5, 'F'),
(16, 'Erika', 'Aguilar Castro', '1988-09-07', 7, 'F'),
(17, 'Fernanda', 'Aguilar Ramirez', '1978-07-09', 9, 'F'),
(18, 'Francisco Alejandro', 'Escobar Diaz', '1999-11-01', 4, 'M'),
(19, 'Gabriel', 'Acevedo Hernandez', '1997-12-03', 6, 'M'),
(20, 'Hector', 'Aceves Pulido', '1993-11-05', 8, 'M'),
(21, 'Irais', 'Aceves Alvarado', '1994-09-07', 10, 'F'),
(22, 'Jose Luis', 'Acosta Gonzalez', '1992-08-09', 5, 'M'),
(23, 'Jose Maria', 'Acosta Moctezuma', '1990-07-11', 7, 'M'),
(24, 'Josefina', 'Acosta Aguirre', '1981-06-12', 9, 'F'),
(25, 'Juan Jesus', 'Adame Garcia', '1979-05-10', 4, 'M'),
(26, 'Julio Cesar', 'Adams Huitron', '1978-04-08', 6, 'M'),
(27, 'Laura Patricia', 'Aguado ', '1996-05-05', 8, 'F'),
(28, 'Monica', 'Aguayo Labastida', '1994-03-07', 10, 'F'),
(29, 'Monica', 'Aguilar Ochoa', '1992-02-07', 5, 'F'),
(30, 'Nora Karina', 'Aguilar Ramirez', '1989-03-04', 7, 'F'),
(31, 'Pavel Alfonso', 'Aguilar Rendon', '1979-05-02', 9, 'M'),
(32, 'Roberto Carlos', 'Aguilar Gomez Tagle', '1988-05-03', 4, 'M'),
(33, 'Tania Gabriela', 'Aguilar Pedrero', '1977-08-06', 6, 'F'),
(34, 'Victoria Eugenia', 'Aguilar Sanchez', '1989-07-08', 8, 'F'),
(35, 'Virginia', 'Aguilar Flores', '1998-11-10', 10, 'F'),
(36, 'Akaitz', 'Gallastegi Garcia', '1990-08-11', 8, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `nombre`) VALUES
(1, 'agallastegi@prueba.com', '$2y$10$nInUrtftWnPutmuSGvqV0uqNIk1OYs1kSRBNvsBoL1VtDJYQOTD1y', 'Akaitz Gallastegi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
