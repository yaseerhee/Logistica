-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2020 a las 20:28:57
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen`
(
  `ID` int
(11) NOT NULL,
  `NOMBRE` varchar
(45) CHARACTER
SET utf8
COLLATE utf8_spanish_ci NOT NULL,
  `LUGAR` varchar
(11) CHARACTER
SET utf8
COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`
ID`,
`NOMBRE
`, `LUGAR`) VALUES
(1, 'SEDE CENTRAL', 'MADRID'),
(2, 'MOBILIARIO', 'GETAFE'),
(3, 'BEBIDAS', 'LEGANES'),
(4, 'MAQUILLAJE', 'MADRID'),
(5, 'TECNOLOGIA', 'BURGOS'),
(20, 'ROPA', 'ITALIA'),
(25, 'JOYAS', 'PARIS'),
(26, 'MERCAMADRID', 'MADRID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos`
(
  `ID` int
(11) NOT NULL,
  `NOMBRE` varchar
(45) CHARACTER
SET utf8
COLLATE utf8_spanish_ci NOT NULL,
  `ESTADO` tinyint
(1) DEFAULT NULL,
  `ALMACEN_ID` int
(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`
ID`,
`NOMBRE
`, `ESTADO`, `ALMACEN_ID`) VALUES
(1, 'CAMISETA', 1, 20),
(2, 'CAMISA', 1, 20),
(3, 'TECLADO', 1, 5),
(4, 'CARGADOR', 0, 5),
(5, 'SOBREMESA', 0, 5),
(7, 'PINCELES', 0, 1),
(9, 'PINTALABIOS', 0, 4),
(10, 'DIAMANTE', 1, 25),
(11, 'MANZANAS', 0, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users`
(
  `id` int
(11) NOT NULL,
  `email` varchar
(200) NOT NULL,
  `usuario` varchar
(20) NOT NULL,
  `password` varchar
(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`
id`,
`email
`, `usuario`, `password`) VALUES
(1, 'user@user.com', 'user', '$2y$10$52zDgj02HNyTC.TyQUhYNuP0AepEYV5rAlYJnBT5hUC6NyLZIhZeG'),
(2, 'admin@admin.com', 'admin', '$2y$10$.UaXeX1cNKQkPdnRkUji/ubk5nb9WKyPd.9jk0AlsMIpfSd8W5XO2'),
(3, 'yaser@yaser.com', 'yaser', '$2y$10$Iz5g/.DzvghnZP70lguHtOwhVrdhL.t4pGK0w/z7sCOooLqjpq6Jm'),
(4, 'alain@alain.com', 'alain', '$2y$10$Xeig2.wv5MUkn2YHGlVs8evH8qSNg9If5nw8xZ6OjC3e5o5/9I7A.');

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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY
(`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `ID` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23455;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int
(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
