-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2023 a las 17:37:58
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `catalogo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_padre`
--

CREATE TABLE `menu_padre` (
  `id_menu_padre` int(100) NOT NULL,
  `nombre_menu_padre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `menu_padre`
--

INSERT INTO `menu_padre` (`id_menu_padre`, `nombre_menu_padre`) VALUES
(7, 'Catalogos'),
(11, 'Marcas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `nombre_sub_menu` varchar(250) NOT NULL,
  `id_menu_padre` int(100) NOT NULL,
  `descripcion_sub_menu` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sub_menu`
--

INSERT INTO `sub_menu` (`id_sub_menu`, `nombre_sub_menu`, `id_menu_padre`, `descripcion_sub_menu`) VALUES
(4, 'SEAT', 7, 'Marca BMW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu_padre`
--
ALTER TABLE `menu_padre`
  ADD PRIMARY KEY (`id_menu_padre`);

--
-- Indices de la tabla `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu_padre` (`id_menu_padre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menu_padre`
--
ALTER TABLE `menu_padre`
  MODIFY `id_menu_padre` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `sub_menu_ibfk_1` FOREIGN KEY (`id_menu_padre`) REFERENCES `menu_padre` (`id_menu_padre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
