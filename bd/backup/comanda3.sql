-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2018 a las 22:03:30
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(11) NOT NULL,
  `mesa` int(1) NOT NULL,
  `restaurant` int(1) NOT NULL,
  `mozo` int(1) NOT NULL,
  `cocinero` int(1) NOT NULL,
  `comentario` varchar(66) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'En preparación'),
(3, 'Listo para servir'),
(4, 'Pendiente'),
(5, 'Con clientes esperando pedido'),
(6, 'Con clientes comiendo'),
(7, 'Con clientes pagando'),
(8, 'Cerrada'),
(9, 'Trabajando'),
(10, 'De vacaciones'),
(11, 'Enfermo'),
(12, 'Suspendido'),
(13, 'Despedido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itempedido`
--

CREATE TABLE `itempedido` (
  `id` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesapedido`
--

CREATE TABLE `mesapedido` (
  `id` int(11) NOT NULL,
  `idMesa` int(11) NOT NULL,
  `idFoto` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `codigoCliente` varchar(5) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `codigoMesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `codigoMesa`) VALUES
(1, '10101'),
(2, '10102'),
(3, '10103'),
(4, '10104'),
(5, '10105'),
(6, '10106'),
(7, '10107'),
(8, '10201'),
(9, '10202'),
(10, '10203'),
(11, '10204'),
(12, '10205'),
(13, '10206'),
(14, '10207'),
(15, '10301'),
(16, '10302'),
(17, '10303'),
(18, '10304'),
(19, '10305'),
(20, '10306'),
(21, '20101'),
(22, '20102'),
(23, '20103'),
(24, '20104'),
(25, '20105'),
(26, '20106'),
(27, '20201'),
(28, '20202'),
(29, '20203'),
(30, '20204'),
(31, '20205'),
(32, '20206');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idMesaPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `tiempoInicio` int(2) NOT NULL,
  `tiempoEstimado` datetime NOT NULL,
  `tiempoEntrega` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `idSector` int(11) NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`id`, `nombre`) VALUES
(1, 'Bar'),
(2, 'Barra'),
(3, 'Cocina'),
(4, 'Candy Bar'),
(5, 'Salón 1'),
(6, 'Salón 2'),
(7, 'Salón 3'),
(8, 'Patio 1'),
(9, 'Patio 2'),
(10, 'Socio'),
(11, 'Mozo'),
(12, 'Cocinero'),
(13, 'Bartender'),
(14, 'Cervecero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL,
  `costoTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `idFuncion` int(11) NOT NULL,
  `idSector` int(11) NOT NULL,
  `fechaLogin` int(11) NOT NULL,
  `cantidadOperaciones` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `itempedido`
--
ALTER TABLE `itempedido`
  ADD PRIMARY KEY (`id`,`idPedido`,`idProducto`,`idEstado`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `mesapedido`
--
ALTER TABLE `mesapedido`
  ADD PRIMARY KEY (`id`,`idMesa`,`idFoto`,`idEstado`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idMesa` (`idMesa`),
  ADD KEY `idFoto` (`idFoto`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`,`idEstado`,`idCliente`,`idUsuario`,`idMesaPedido`) USING BTREE,
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idMesaPedido` (`idMesaPedido`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`,`idSector`),
  ADD KEY `idSector` (`idSector`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`,`idPedido`,`idUsuario`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`,`idFuncion`,`idSector`,`idEstado`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idSector` (`idSector`),
  ADD KEY `idFuncion` (`idFuncion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `itempedido`
--
ALTER TABLE `itempedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesapedido`
--
ALTER TABLE `mesapedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `itempedido`
--
ALTER TABLE `itempedido`
  ADD CONSTRAINT `itempedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `itempedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `itempedido_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `mesapedido`
--
ALTER TABLE `mesapedido`
  ADD CONSTRAINT `mesapedido_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `mesapedido_ibfk_2` FOREIGN KEY (`idMesa`) REFERENCES `mesas` (`id`),
  ADD CONSTRAINT `mesapedido_ibfk_3` FOREIGN KEY (`idFoto`) REFERENCES `fotos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idMesaPedido`) REFERENCES `mesapedido` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`id`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`id`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idFuncion`) REFERENCES `funciones` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
