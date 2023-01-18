-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2021 a las 09:23:25
-- Versión del servidor: 5.7.14
-- Versión de PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdtienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `codigopostal` varchar(10) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `password`, `domicilio`, `codigopostal`, `telefono`, `email`) VALUES
(2, 'Juan Gil', '123', 'C/Alava 39 Vitoria-Gasteiz', '01007', '945241090', 'juangi@gmail.com'),
(3, 'Ana Maria Paulova', '123', 'C/Luis Power 36 Bilbao', '48014', '944321485', 'paulovaam@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `nombre`, `precio`) VALUES
(1, 'Hombre de Vitrubio', 10),
(2, 'Bailarinas de Degas', 20),
(3, 'Delacroix', 30),
(4, 'Autorretrato de Van Gogh', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaspedido`
--

CREATE TABLE `lineaspedido` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL,
  `iditem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` datetime NOT NULL,
  `idcliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `iditem` (`iditem`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcliente` (`idcliente`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineaspedido`
--
ALTER TABLE `lineaspedido`
  ADD CONSTRAINT `lineaspedido_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `lineaspedido_ibfk_2` FOREIGN KEY (`iditem`) REFERENCES `items` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
