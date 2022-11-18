-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-11-2022 a las 07:18:18
-- Versión del servidor: 8.0.27
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE IF NOT EXISTS `aulas` (
  `ID_AULA` int NOT NULL AUTO_INCREMENT,
  `ID_EDIFICIO` varchar(11) NOT NULL,
  `NUMERO` int NOT NULL,
  `CAPACIDAD` int NOT NULL,
  PRIMARY KEY (`ID_AULA`),
  KEY `FK_AULA_EDIFICIO` (`ID_EDIFICIO`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`ID_AULA`, `ID_EDIFICIO`, `NUMERO`, `CAPACIDAD`) VALUES
(1, 'CSUR03', 1, 50),
(2, 'CSUR03', 2, 30),
(3, 'CSUR03', 3, 100),
(4, 'MUN01', 1, 100),
(5, 'MUN01', 2, 75),
(6, 'MUN01', 3, 28),
(7, 'MUN01', 4, 15),
(8, 'PATR01', 1, 110),
(9, 'PATR01', 2, 100),
(10, 'PATR01', 3, 60),
(11, 'PATR01', 4, 40),
(12, 'TOR02', 1, 24),
(13, 'TOR02', 2, 15),
(14, 'TOR02', 3, 45),
(15, 'TOR02', 4, 70),
(16, 'TOR02', 5, 90);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `ID_CURSO` int NOT NULL AUTO_INCREMENT,
  `ID_AULA` int NOT NULL,
  `DIA` date NOT NULL,
  `HORA` time NOT NULL,
  `ID_TEMA` varchar(11) NOT NULL,
  `ASISTENTES` int DEFAULT NULL,
  `PRECIO` float NOT NULL,
  PRIMARY KEY (`ID_CURSO`),
  KEY `FK_CURSO_TEMA` (`ID_TEMA`),
  KEY `FK_CURSO_AULA` (`ID_AULA`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`ID_CURSO`, `ID_AULA`, `DIA`, `HORA`, `ID_TEMA`, `ASISTENTES`, `PRECIO`) VALUES
(1, 10, '2022-05-29', '17:00:00', 'T00001', 8, 40860800),
(2, 8, '2021-12-12', '21:00:00', 'T00002', 0, 20),
(3, 8, '2022-11-18', '17:00:00', 'T00001', 10, 247273),
(4, 8, '2022-11-17', '11:00:00', 'T00002', 0, 18.5),
(5, 8, '2022-05-29', '15:00:00', 'T00011', 1, 140),
(7, 8, '2022-05-28', '17:00:00', 'T00007', 22, 713443),
(8, 8, '2022-05-28', '10:00:00', 'T00009', 12, 80.5),
(9, 8, '2022-11-17', '21:00:00', 'T00009', 1, 65),
(11, 9, '2021-11-21', '19:00:00', 'T00001', 110, 324292),
(12, 9, '2022-05-29', '09:00:00', 'T00002', 15, 19),
(13, 9, '2022-05-29', '19:00:00', 'T00001', 20, 490492),
(14, 9, '2022-05-29', '17:00:00', 'T00002', 10, 18),
(15, 9, '2021-11-29', '15:00:00', 'T00011', 0, 99),
(16, 9, '2022-05-29', '08:00:00', 'T00007', 11, 745873),
(17, 9, '2022-11-18', '19:00:00', 'T00009', 0, 83.5),
(18, 9, '2022-05-29', '10:00:00', 'T00009', 6, 55),
(20, 10, '2022-11-18', '17:00:00', 'T00008', 9, 21.5),
(21, 10, '2022-05-29', '21:00:00', 'T00010', 13, 66),
(22, 10, '2022-05-29', '13:00:00', 'T00010', 14, 110),
(23, 10, '2022-05-29', '15:00:00', 'T00011', 3, 130),
(24, 10, '2022-02-05', '17:00:00', 'T00007', 0, 599941),
(25, 11, '2022-05-29', '10:00:00', 'T00008', 10, 24),
(26, 11, '2021-11-21', '21:00:00', 'T00010', 0, 79),
(27, 11, '2021-11-22', '21:00:00', 'T00010', 0, 68.5),
(28, 11, '2022-11-18', '15:00:00', 'T00011', 5, 75.5),
(29, 11, '2022-05-29', '19:00:00', 'T00007', 10, 664799),
(30, 12, '2021-11-18', '15:00:00', 'T00010', 4, 80),
(31, 12, '2022-05-29', '17:00:00', 'T00003', 12, 320239),
(32, 15, '2022-05-29', '17:00:00', 'T00003', 1, 437795),
(33, 12, '2022-11-17', '08:00:00', 'T00005', 2, 77.5),
(34, 14, '2022-11-18', '17:00:00', 'T00005', 10, 66),
(35, 12, '2022-11-17', '17:00:00', 'T00009', 0, 60),
(36, 12, '2021-12-13', '17:00:00', 'T00009', 0, 77.4),
(41, 3, '2022-05-29', '17:00:00', 'T00001', 10, 405366),
(42, 1, '2021-11-22', '17:00:00', 'T00001', 53, 449956),
(43, 1, '2021-11-28', '17:00:00', 'T00003', 0, 308078),
(44, 1, '2021-11-18', '17:00:00', 'T00003', 15, 364829),
(45, 1, '2022-05-29', '17:00:00', 'T00006', 4, 75),
(46, 1, '2022-05-29', '18:00:00', 'T00007', 9, 685068),
(47, 1, '2022-11-18', '21:00:00', 'T00006', 2, 69),
(48, 1, '2022-02-06', '21:00:00', 'T00007', 0, 729658),
(53, 5, '2022-05-29', '17:00:00', 'T00001', 5, 405366),
(54, 4, '2022-05-29', '17:00:00', 'T00004', 23, 989092),
(55, 4, '2021-11-29', '13:00:00', 'T00004', 0, 972877),
(58, 5, '2022-05-29', '18:00:00', 'T00001', 8, 713443),
(59, 6, '2021-11-18', '17:00:00', 'T00008', 18, 13),
(61, 7, '2022-05-29', '17:00:00', 'T00008', 7, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificios`
--

DROP TABLE IF EXISTS `edificios`;
CREATE TABLE IF NOT EXISTS `edificios` (
  `ID_EDIFICIO` varchar(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_EDIFICIO`),
  UNIQUE KEY `AK_EDIFICIO` (`NOMBRE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `edificios`
--

INSERT INTO `edificios` (`ID_EDIFICIO`, `NOMBRE`) VALUES
('CSUR03', 'Centro de Congresos Sur'),
('MUN01', 'Centro Municipal'),
('PATR01', 'Palacio Atrium'),
('TOR02', 'Torre Picasso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

DROP TABLE IF EXISTS `temas`;
CREATE TABLE IF NOT EXISTS `temas` (
  `ID_TEMA` varchar(11) NOT NULL,
  `TEMA` varchar(50) NOT NULL,
  `CATEGORIA` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_TEMA`),
  UNIQUE KEY `AK_TEMA` (`TEMA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`ID_TEMA`, `TEMA`, `CATEGORIA`) VALUES
('T00001', 'Seguridad En Redes IP', 'Redes'),
('T00002', 'AJAX, jQuery, HTML5 y CSS3', 'Programación'),
('T00003', 'Protocolos de enrutamiento', 'Redes'),
('T00004', 'Redes Wireless', 'Redes'),
('T00005', 'Excel 2013', 'Ofimática'),
('T00006', 'Auditoria de cuentas', 'Finanzas'),
('T00007', 'Cableado estructurado', 'Redes'),
('T00008', 'SAP R/3', 'Finanzas'),
('T00009', 'JQuery Mobile', 'Programación'),
('T00010', 'Gestion de tesoreria', 'Finanzas'),
('T00011', 'Enterprise Javabeans', 'Programación');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `FK_AULA_EDIFICIO` FOREIGN KEY (`ID_EDIFICIO`) REFERENCES `edificios` (`ID_EDIFICIO`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `FK_CURSO_AULA` FOREIGN KEY (`ID_AULA`) REFERENCES `aulas` (`ID_AULA`),
  ADD CONSTRAINT `FK_CURSO_TEMA` FOREIGN KEY (`ID_TEMA`) REFERENCES `temas` (`ID_TEMA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
