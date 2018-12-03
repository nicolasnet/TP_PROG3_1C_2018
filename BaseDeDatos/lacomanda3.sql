-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2018 a las 02:01:30
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

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
(9, 'MOZ_PEREZ.PEPE', 'usuario/', 'post', '2018-11-19 16:15:23'),
(10, 'MOZ_PEREZ.PEPE', 'usuario/', 'get', '2018-11-28 20:18:14'),
(11, 'Admin', 'usuario/', 'get', '2018-11-28 20:19:35'),
(12, 'Usuario no logueado', 'usuario/', 'get', '2018-11-28 20:20:05'),
(13, 'Admin', 'usuario/', 'get', '2018-11-28 20:20:37'),
(14, 'Admin', 'usuario/', 'get', '2018-12-01 15:23:53'),
(15, 'Admin', 'Pedido/', 'post', '2018-12-01 15:26:04'),
(16, 'Admin', 'Pedido/', 'post', '2018-12-01 15:27:01'),
(17, 'Admin', 'Pedido/', 'post', '2018-12-01 15:27:27'),
(18, 'Admin', 'Pedido/', 'post', '2018-12-01 15:28:23'),
(19, 'Admin', 'Pedido/', 'post', '2018-12-01 15:36:09'),
(20, 'Admin', 'Pedido/', 'post', '2018-12-01 15:39:17'),
(21, 'Admin', 'Pedido/', 'post', '2018-12-01 15:40:39'),
(22, 'Admin', 'Pedido/', 'post', '2018-12-01 16:32:04'),
(23, 'Admin', 'Pedido/', 'post', '2018-12-01 16:33:24'),
(24, 'Admin', 'Pedido/', 'post', '2018-12-01 16:34:04'),
(25, 'Admin', 'Pedido/', 'post', '2018-12-01 16:34:17'),
(26, 'Admin', 'Pedido/', 'post', '2018-12-01 16:35:04'),
(27, 'Admin', 'Pedido/', 'post', '2018-12-01 16:38:52'),
(28, 'Admin', 'Pedido/', 'post', '2018-12-01 16:39:13'),
(29, 'Admin', 'Pedido/', 'post', '2018-12-01 16:39:41'),
(30, 'Admin', 'Pedido/', 'post', '2018-12-01 16:41:39'),
(31, 'Admin', 'Pedido/', 'post', '2018-12-01 16:42:18'),
(32, 'Admin', 'Pedido/', 'post', '2018-12-01 16:42:39'),
(33, 'Admin', 'Pedido/', 'post', '2018-12-01 16:43:01'),
(34, 'Admin', 'Pedido/', 'post', '2018-12-01 16:43:57'),
(35, 'Admin', 'Pedido/', 'post', '2018-12-01 16:44:44'),
(36, 'Admin', 'Pedido/', 'post', '2018-12-01 16:46:11'),
(37, 'Admin', 'Pedido/', 'post', '2018-12-01 16:47:42'),
(38, 'Admin', 'Pedido/', 'post', '2018-12-01 16:48:18'),
(39, 'Admin', 'Pedido/', 'post', '2018-12-01 16:58:24'),
(40, 'Admin', 'Pedido/', 'post', '2018-12-01 16:59:46'),
(41, 'Admin', 'Pedido/', 'post', '2018-12-01 18:39:02'),
(42, 'Admin', 'Pedido/', 'post', '2018-12-01 18:40:18'),
(43, 'Admin', 'Pedido/', 'post', '2018-12-01 18:42:08'),
(44, 'Admin', 'Pedido/', 'post', '2018-12-01 18:43:57'),
(45, 'Admin', 'Pedido/', 'post', '2018-12-01 18:44:30'),
(46, 'Admin', 'usuario/', 'get', '2018-12-01 18:51:20'),
(47, 'Admin', 'Pedido/', 'post', '2018-12-01 18:55:33'),
(48, 'MOZ_PEREZ.PEPE', 'Pedido/', 'get', '2018-12-01 19:37:25'),
(49, 'MOZ_PEREZ.PEPE', 'Pedido/', 'get', '2018-12-01 19:39:09'),
(50, 'MOZ_PEREZ.PEPE', 'Pedido/', 'post', '2018-12-01 19:41:37'),
(51, 'MOZ_PEREZ.PEPE', 'Pedido/', 'get', '2018-12-01 19:42:27'),
(52, 'Admin', 'Pedido/', 'get', '2018-12-01 19:43:18'),
(53, 'Admin', 'Pedido/', 'get', '2018-12-01 19:43:42'),
(54, 'Admin', 'Pedido/', 'get', '2018-12-01 19:44:06'),
(55, 'MOZ_PEREZ.PEPE', 'Pedido/', 'get', '2018-12-02 15:57:52'),
(56, 'Admin', 'usuario/', 'get', '2018-12-02 19:24:17'),
(57, 'Usuario no logueado', 'usuario/', 'post', '2018-12-02 20:05:33'),
(58, 'Admin', 'usuario/', 'post', '2018-12-02 20:05:57'),
(59, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:18:47'),
(60, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:19:18'),
(61, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:21:05'),
(62, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:22:15'),
(63, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:23:14'),
(64, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:23:39'),
(65, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:24:40'),
(66, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:24:49'),
(67, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:25:25'),
(68, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:25:39'),
(69, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 20:28:08'),
(70, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:01:38'),
(71, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:02:59'),
(72, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:07:59'),
(73, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:08:13'),
(74, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:08:41'),
(75, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:10:19'),
(76, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:12:38'),
(77, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:12:53'),
(78, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:13:05'),
(79, 'COC_GOMEZ.SEBA', 'productos/pendientes', 'get', '2018-12-02 21:13:20'),
(80, 'MOZ_PEREZ.PEPE', 'productos/pendientes', 'get', '2018-12-02 21:29:02'),
(81, 'MOZ_PEREZ.PEPE', 'productos/pendientes', 'get', '2018-12-02 21:32:40'),
(82, 'MOZ_PEREZ.PEPE', 'productos/pendientes', 'get', '2018-12-02 21:34:09'),
(83, 'MOZ_PEREZ.PEPE', 'productos/pendientes', 'get', '2018-12-02 21:38:31'),
(84, 'Admin', 'productos/pendientes', 'get', '2018-12-02 21:40:24'),
(85, 'Admin', 'productos/pendientes', 'get', '2018-12-02 21:40:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `ptoMesa` int(2) NOT NULL,
  `ptoResto` int(2) NOT NULL,
  `ptoMozo` int(2) NOT NULL,
  `ptoCocinero` int(2) NOT NULL,
  `texto` varchar(66) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id` bigint(5) UNSIGNED ZEROFILL NOT NULL,
  `producto` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `sector` enum('cocina','barra','cerveza','candy') COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `producto`, `sector`, `precio`) VALUES
(00001, 'pizza muzarella', 'cocina', 210),
(00002, 'hamburgueza', 'cocina', 100),
(00003, 'agua chica', 'barra', 50),
(00004, 'copa helada', 'candy', 80),
(00005, 'flan', 'candy', 65),
(00006, 'cerveza negra chica', 'cerveza', 60),
(00007, 'cerveza negra grande', 'cerveza', 80),
(00008, 'cerveza rubia chica', 'cerveza', 55),
(00009, 'cerveza rubia grande', 'cerveza', 75),
(00010, 'ravioles verdura', 'cocina', 110),
(00011, 'sorrentinos', 'cocina', 120),
(00012, 'gaseosa chica', 'barra', 55),
(00013, 'fernet', 'barra', 115),
(00014, 'empanada carne', 'cocina', 35),
(00015, 'provoleta', 'cocina', 45);

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
('ME', 010, 'cerrada', 'true'),
('ME', 011, 'cerrada', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` int(3) UNSIGNED ZEROFILL NOT NULL,
  `estado` enum('pendiente','en preparacion','listo para servir','servido') COLLATE utf8_spanish2_ci NOT NULL,
  `mesa` bigint(5) UNSIGNED ZEROFILL NOT NULL,
  `precioFinal` bigint(20) DEFAULT NULL,
  `fechaInicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tiempo` int(11) DEFAULT NULL,
  `fechaTerminado` datetime DEFAULT NULL,
  `cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` mediumtext COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codigo`, `usuario`, `estado`, `mesa`, `precioFinal`, `fechaInicio`, `tiempo`, `fechaTerminado`, `cliente`, `imagen`) VALUES
('414Ma', 001, 'pendiente', 00002, NULL, '2018-12-01 15:27:27', NULL, NULL, 'Juansito Perez', NULL),
('fM7fb', 001, 'pendiente', 00001, NULL, '2018-12-01 18:55:33', NULL, NULL, 'Pochin', NULL),
('fY2zc', 001, 'pendiente', 00007, NULL, '2018-12-01 16:59:46', NULL, NULL, 'Pompini', NULL),
('iKUxm', 001, 'pendiente', 00007, NULL, '2018-12-01 16:34:17', NULL, NULL, 'Pompini', NULL),
('JwN68', 002, 'pendiente', 00003, NULL, '2018-12-01 19:41:37', NULL, NULL, 'Rosa', NULL),
('KxWN0', 001, 'pendiente', 00002, NULL, '2018-12-01 15:39:17', NULL, NULL, 'El Presi', NULL),
('MmbhV', 001, 'pendiente', 00001, NULL, '2018-12-01 18:43:57', NULL, NULL, 'ElCuli', NULL),
('VHph7', 001, 'pendiente', 00006, NULL, '2018-12-01 15:28:23', NULL, NULL, 'Alto Chori', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_producto`
--

CREATE TABLE `pedido_producto` (
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `idProducto` bigint(5) UNSIGNED ZEROFILL NOT NULL,
  `estado` enum('pendiente','en preparacion','listo para servir','servido') COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `fechaInicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tiempo` int(11) DEFAULT NULL,
  `fechaTerminado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedido_producto`
--

INSERT INTO `pedido_producto` (`codigo`, `idProducto`, `estado`, `cantidad`, `precio`, `fechaInicio`, `tiempo`, `fechaTerminado`) VALUES
('fY2zc', 00001, 'pendiente', 2, NULL, '2018-12-01 16:59:46', NULL, NULL),
('fY2zc', 00006, 'pendiente', 1, NULL, '2018-12-01 16:59:46', NULL, NULL),
('fY2zc', 00002, 'pendiente', 1, NULL, '2018-12-01 16:59:46', NULL, NULL),
('MmbhV', 00001, 'pendiente', 2, NULL, '2018-12-01 18:43:57', NULL, NULL),
('MmbhV', 00006, 'pendiente', 1, NULL, '2018-12-01 18:43:57', NULL, NULL),
('MmbhV', 00002, 'pendiente', 1, NULL, '2018-12-01 18:43:57', NULL, NULL),
('fM7fb', 00003, 'pendiente', 2, NULL, '2018-12-01 18:55:33', NULL, NULL),
('fM7fb', 00006, 'pendiente', 1, NULL, '2018-12-01 18:55:33', NULL, NULL),
('fM7fb', 00009, 'pendiente', 1, NULL, '2018-12-01 18:55:33', NULL, NULL),
('JwN68', 00001, 'en preparacion', 2, 420, '2018-12-01 19:41:37', 40, '2018-12-01 20:21:37'),
('JwN68', 00002, 'pendiente', 1, 100, '2018-12-01 19:41:37', 40, '2018-12-01 20:21:37'),
('JwN68', 00010, 'pendiente', 1, 110, '2018-12-01 19:41:37', 40, '2018-12-01 20:21:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `perfil` enum('socio','mozo','cocinero','bartender','cervecero') COLLATE utf8_spanish2_ci NOT NULL,
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
(005, 'CER_MENDEZ.AGUS', 'cervecero', 'activo', 'Agustin', 'Mendez', '456'),
(006, 'COC_GOMEZ.SEBA', 'cocinero', 'activo', 'Sebastian', 'Gomez', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_ingresos`
--
ALTER TABLE `datos_ingresos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`codigo`);

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
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codigo`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
