-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2020 a las 15:24:19
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT
= 0;
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logistica`
--
CREATE DATABASE
IF NOT EXISTS `logistica` DEFAULT CHARACTER
SET utf8
COLLATE utf8_general_ci;
USE `logistica`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

DROP TABLE IF EXISTS `almacen`;
CREATE TABLE
IF NOT EXISTS `almacen`
(`ID` int
(11) NOT NULL,
  `NOMBRE` varchar
(45) COLLATE utf8_spanish_ci NOT NULL,
  `LUGAR` varchar
(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`
ID`,`NOMBRE
`, `LUGAR`) VALUES
(1, 'SEDE CENTRAL', 'MADRID'),
(2, 'ALMACEN GETAFE', 'GETAFE'),
(3, 'ALMACEN LEGANES', 'LEGANES'),
(4, 'ALMACEN VILLAVERDE', 'MADRID'),
(5, 'ALMACEN BURGOS', 'BURGOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--
DROP TABLE IF EXISTS `productos`;
CREATE TABLE
IF NOT EXISTS `productos`
(
  `ID` int
(11) NOT NULL,
  `NOMBRE` varchar
(45) COLLATE utf8_spanish_ci NOT NULL,
  `ESTRELLA` tinyint
(1) DEFAULT NULL,
  `ALMACEN_ID` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`
ID`,`NOMBRE
`, `ESTRELLA`, `ALMACEN_ID`) VALUES
(12341, 'CAMISETA', NULL, 2),
(12342, 'CAMISETA', NULL, 2),
(12343, 'CAMISETA', NULL, 2),
(12344, 'CAMISETA', NULL, 2),
(12345, 'CAMISETA', NULL, 2),
(23451, 'JERSEY', NULL, 4),
(23452, 'JERSEY', NULL, 4),
(23453, 'JERSEY', NULL, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
ADD PRIMARY KEY
(`ID`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
ADD PRIMARY KEY
(`ID`),
ADD KEY `fk_vendedor`
(`ALMACEN_ID`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `fk_vendedor` FOREIGN KEY
(`ALMACEN_ID`) REFERENCES `almacen`
(`ID`) ON
DELETE NO ACTION ON
UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
