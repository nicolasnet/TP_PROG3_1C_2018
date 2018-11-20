-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2018 a las 02:26:15
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lacomanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_ingresos`
--

CREATE TABLE `datos_ingresos` (
  `id` bigint(20) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `ruta` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `metodo` varchar(10) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `datos_ingresos`
--

INSERT INTO `datos_ingresos` (`id`, `usuario`, `ruta`, `metodo`, `fecha`) VALUES
(1, 'nicolas', '/usuario', 'post', '2018-11-19 12:59:37'),
(2, 'prueba', 'prueba', 'prueba', '2018-11-19 15:01:09'),
(3, 'Admin', 'usuario/', 'post', '2018-11-19 15:51:20'),
(4, 'Admin', 'usuario/', 'post', '2018-11-19 15:56:11'),
(5, 'Admin', 'usuario/', 'post', '2018-11-19 16:01:29'),
(6, 'Admin', 'usuario/', 'post', '2018-11-19 16:09:39'),
(7, 'Admin', 'usuario/', 'get', '2018-11-19 16:11:13'),
(8, 'MOZ_PEREZ.PEPE', 'usuario/', 'get', '2018-11-19 16:15:12'),
(9, 'MOZ_PEREZ.PEPE', 'usuario/', 'post', '2018-11-19 16:15:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `producto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `sector` enum('cocina','barra','cerveza','candy') COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `prefijo` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'ME',
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `estado` enum('cerrada','con clientes esperando pedido','con clientes comiendo','con clientes pagando') COLLATE utf8_spanish2_ci NOT NULL,
  `limpia` enum('true','false') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`prefijo`, `id`, `estado`, `limpia`) VALUES
('ME', 001, 'cerrada', 'true'),
('ME', 002, 'cerrada', 'true'),
('ME', 003, 'cerrada', 'true'),
('ME', 004, 'cerrada', 'true'),
('ME', 005, 'cerrada', 'true'),
('ME', 006, 'cerrada', 'true'),
('ME', 007, 'cerrada', 'true'),
('ME', 008, 'cerrada', 'true'),
('ME', 009, 'cerrada', 'true'),
('ME', 010, 'cerrada', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` enum('activo','suspendido','eliminado','') COLLATE utf8_spanish2_ci DEFAULT 'activo',
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `perfil`, `estado`, `nombre`, `apellido`, `clave`) VALUES
(001, 'Admin', 'socio', 'activo', 'Nicolas', 'Gomez', '123'),
(002, 'MOZ_PEREZ.PEPE', 'mozo', 'activo', 'Pepe', 'Perez', '123'),
(003, 'COC_DOMINGUEZ.JOSE', 'cocinero', 'activo', 'Jose', 'Dominguez', '456'),
(004, 'BAR_COMELLI.MICA', 'bartender', 'activo', 'Micaela', 'Comelli', '456'),
(005, 'CER_MENDEZ.AGUS', 'cervecero', 'activo', 'Agustin', 'Mendez', '456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_ingresos`
--
ALTER TABLE `datos_ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_ingresos`
--
ALTER TABLE `datos_ingresos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
