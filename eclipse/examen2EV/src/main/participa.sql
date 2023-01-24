-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-01-2023 a las 10:52:21
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdactividad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participa`
--

DROP TABLE IF EXISTS `participa`;
CREATE TABLE IF NOT EXISTS `participa` (
  `actividad_id` int(11) NOT NULL,
  `alumno_dni` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `ultima_asistencia` date DEFAULT NULL,
  PRIMARY KEY (`actividad_id`,`alumno_dni`),
  KEY `alumno_dni` (`alumno_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `participa`
--

INSERT INTO `participa` (`actividad_id`, `alumno_dni`, `ultima_asistencia`) VALUES
(1, '12125651M', '2021-10-25'),
(1, '12345678Z', '2021-10-11'),
(1, '25036543P', '2021-12-18'),
(1, '31123456V', '2021-09-03'),
(2, '25036543P', '2022-01-03'),
(2, '31123456V', '2021-07-22'),
(3, '20812344N', '2021-12-08'),
(3, '31812304S', '2021-10-25'),
(4, '12125651M', '2021-11-26'),
(4, '16003888J', '2021-12-06'),
(4, '16200324A', '2021-12-06'),
(4, '16546788D', '2021-10-03'),
(4, '20812344N', '2021-12-06'),
(4, '25036543P', '2021-12-21'),
(4, '31071234M', '2021-12-14'),
(4, '31839938A', '2021-12-06'),
(5, '12125651M', '2022-01-08'),
(5, '12345678Z', '2021-08-13'),
(5, '16200324A', '2023-01-24'),
(5, '25036543P', '2022-01-03'),
(5, '31123456V', '2021-04-12'),
(6, '20812344N', '2021-10-09'),
(6, '25036543P', '2021-11-16'),
(6, '31123456V', '2021-09-20'),
(7, '16546788D', '2021-12-05'),
(7, '18320558G', '2021-12-15'),
(7, '18438062H', '2021-10-19'),
(7, '20812344N', '2021-12-16'),
(8, '16003888J', '2021-12-02'),
(8, '16200324A', '2023-01-24'),
(9, '16200324A', '2023-01-24'),
(10, '16200324A', '2023-01-24'),
(11, '12345678Z', '2021-11-08'),
(11, '16200324A', '2023-01-24'),
(11, '18100234P', '2021-09-11'),
(11, '18320558G', '2021-12-02'),
(14, '16200324A', '2023-01-24'),
(14, '18100234P', '2021-12-02'),
(14, '18234290H', '2021-12-12'),
(14, '18438062H', '2021-08-13'),
(14, '20812344N', '2021-12-13'),
(14, '25036543P', '2021-12-07'),
(14, '31839938A', '2021-08-07'),
(15, '16200324A', '2021-12-06'),
(15, '18234290H', '2021-12-06');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `participa`
--
ALTER TABLE `participa`
  ADD CONSTRAINT `participa_ibfk_1` FOREIGN KEY (`actividad_id`) REFERENCES `actividad` (`id`),
  ADD CONSTRAINT `participa_ibfk_2` FOREIGN KEY (`alumno_dni`) REFERENCES `alumno` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
