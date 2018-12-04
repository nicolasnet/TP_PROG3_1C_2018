-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-12-2018 a las 06:00:52
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
(1, 'Admin', 'usuario/', 'post', '2018-12-04 02:00:05');

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

--
-- Volcado de datos para la tabla `encuesta`
--

INSERT INTO `encuesta` (`codigo`, `ptoMesa`, `ptoResto`, `ptoMozo`, `ptoCocinero`, `texto`, `fecha`) VALUES
('fM7fb', 9, 6, 7, 8, 'Muy buen servicio, recomendable, buenos precios', '2018-12-04 01:14:19');

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
  `id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `estado` enum('cerrada','con clientes esperando pedido','con clientes comiendo','con clientes pagando') COLLATE utf8_spanish2_ci NOT NULL,
  `limpia` enum('true','false') COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `estado`, `limpia`) VALUES
(00001, 'cerrada', 'true'),
(00002, 'cerrada', 'true'),
(00003, 'cerrada', 'true'),
(00004, 'cerrada', 'true'),
(00005, 'cerrada', 'true'),
(00006, 'cerrada', 'true'),
(00007, 'cerrada', 'true'),
(00008, 'cerrada', 'true'),
(00009, 'cerrada', 'true'),
(00010, 'cerrada', 'true'),
(00011, 'cerrada', 'true'),
(00012, 'cerrada', 'true');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` int(3) UNSIGNED ZEROFILL NOT NULL,
  `estado` enum('pendiente','en preparacion','listo para servir','servido','pagado') COLLATE utf8_spanish2_ci NOT NULL,
  `mesa` bigint(5) UNSIGNED ZEROFILL NOT NULL,
  `precioFinal` bigint(20) DEFAULT NULL,
  `fechaInicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tiempo` int(11) DEFAULT '0',
  `fechaTerminado` datetime DEFAULT NULL,
  `cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` mediumtext COLLATE utf8_spanish2_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codigo`, `usuario`, `estado`, `mesa`, `precioFinal`, `fechaInicio`, `tiempo`, `fechaTerminado`, `cliente`, `imagen`) VALUES
('fM7fb', 001, 'pagado', 00011, 235, '2018-12-01 18:55:33', 47, '2018-12-01 19:42:33', 'Pochin', NULL),
('MmbhV', 001, 'servido', 00001, 580, '2018-12-01 18:43:57', 30, '2018-12-01 18:48:57', 'ElCuli', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_producto`
--

CREATE TABLE `pedido_producto` (
  `id` bigint(20) NOT NULL,
  `codigo` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `idProducto` bigint(5) UNSIGNED ZEROFILL NOT NULL,
  `estado` enum('pendiente','en preparacion','listo para servir','servido') COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `fechaInicio` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tiempo` int(11) DEFAULT NULL,
  `fechaTerminado` datetime DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedido_producto`
--

INSERT INTO `pedido_producto` (`id`, `codigo`, `idProducto`, `estado`, `cantidad`, `precio`, `fechaInicio`, `tiempo`, `fechaTerminado`, `usuario`) VALUES
(4, 'MmbhV', 00001, 'servido', 2, 420, '2018-12-01 18:43:57', 30, '2018-12-01 19:13:57', 6),
(5, 'MmbhV', 00006, 'servido', 1, 60, '2018-12-01 18:43:57', 5, '2018-12-01 18:48:57', 5),
(6, 'MmbhV', 00002, 'servido', 1, 100, '2018-12-01 18:43:57', 10, '2018-12-01 18:53:57', 6),
(7, 'fM7fb', 00003, 'servido', 2, 100, '2018-12-01 18:55:33', 32, '2018-12-01 19:27:33', 5),
(8, 'fM7fb', 00006, 'servido', 1, 60, '2018-12-01 18:55:33', 5, '2018-12-01 19:00:33', 5),
(9, 'fM7fb', 00009, 'servido', 1, 75, '2018-12-01 18:55:33', 47, '2018-12-01 19:42:33', 5);

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
(002, 'MOZ_PEREZ.PEPE', 'mozo', 'eliminado', 'Pepe', 'Perez', '123'),
(003, 'COC_DOMINGUEZ.JOSE', 'cocinero', 'activo', 'Jose', 'Dominguez', '456'),
(004, 'BAR_COMELLI.MICA', 'bartender', 'activo', 'Micaela', 'Comelli', '456'),
(005, 'CER_MENDEZ.AGUS', 'cervecero', 'activo', 'Agustin', 'Mendez', '456'),
(006, 'COC_GOMEZ.SEBA', 'cocinero', 'activo', 'Sebastian', 'Gomez', '123'),
(007, 'MOZ_PIRULO.JOSE', 'mozo', 'activo', 'Jose', 'Pirulo', '123');

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
-- Indices de la tabla `pedido_producto`
--
ALTER TABLE `pedido_producto`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido_producto`
--
ALTER TABLE `pedido_producto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
