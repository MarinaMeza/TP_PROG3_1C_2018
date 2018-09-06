-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-09-2018 a las 19:54:10
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
-- Base de datos: `comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `idEncuesta` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `mesaPuntuacion` int(1) NOT NULL,
  `restaurantPuntuacion` int(1) NOT NULL,
  `mozoPuntuacion` int(1) NOT NULL,
  `cocineroPuntuacion` int(1) NOT NULL,
  `comentario` varchar(66) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `idEstado` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`idEstado`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'En preparación'),
(3, 'Listo para servir'),
(4, 'Pendiente'),
(5, 'Con clientes esperando pedido'),
(6, 'Con clientes comiendo'),
(7, 'Con clientes pagando'),
(8, 'Cerrada'),
(9, 'Auxuliar'),
(10, 'Trabajando'),
(11, 'De vacaciones'),
(12, 'Enfermo'),
(13, 'Suspendido'),
(14, 'Despedido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas_login`
--

CREATE TABLE `fechas_login` (
  `idFechaLogin` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fechaLogin` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `idFoto` int(11) NOT NULL,
  `ubicacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

CREATE TABLE `funciones` (
  `idFuncion` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`idFuncion`, `nombre`) VALUES
(1, 'Socio'),
(2, 'Mozo'),
(3, 'Cocinero'),
(4, 'Bartender'),
(5, 'Cervecero'),
(6, 'Limpieza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_pedido`
--

CREATE TABLE `items_pedido` (
  `idItemPedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logins`
--

CREATE TABLE `logins` (
  `idLogin` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `idMesa` int(11) NOT NULL,
  `codigoMesa` varchar(5) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`idMesa`, `codigoMesa`) VALUES
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
-- Estructura de tabla para la tabla `mesas_pedido`
--

CREATE TABLE `mesas_pedido` (
  `idMesaPedido` int(11) NOT NULL,
  `idMesa` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idFoto` int(11) NOT NULL,
  `codigoCliente` varchar(5) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idMesaPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `tiempoInicio` int(10) UNSIGNED NOT NULL,
  `tiempoEstimado` int(10) UNSIGNED NOT NULL,
  `tiempoEntrega` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `idSector` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `idSector`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 'Cabernet Sauvignon', 230, 0),
(2, 1, 'Malbec', 200, 0),
(3, 2, 'IPA', 150, 0),
(4, 2, 'Stout', 130, 0),
(5, 3, 'Pappardelle con Hongos', 350, 0),
(6, 3, 'Gnocchi de Papa con Tomate y Albahaca', 300, 0),
(7, 4, 'Volcán de Chocolate', 250, 0),
(8, 4, 'Crème Brulé', 280, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `idSector` int(11) NOT NULL,
  `nombre` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`idSector`, `nombre`) VALUES
(1, 'Bar'),
(2, 'Barra'),
(3, 'Cocina'),
(4, 'Candy Bar'),
(5, 'Salón 1'),
(6, 'Salón 2'),
(7, 'Salón 3'),
(8, 'Patio 1'),
(9, 'Patio 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `idTicket` int(11) NOT NULL,
  `fechaHora` int(10) UNSIGNED NOT NULL,
  `costoTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `idSector` int(11) NOT NULL,
  `idFuncion` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidadOperaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`idEncuesta`,`idTicket`) USING BTREE,
  ADD KEY `idTicket` (`idTicket`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `fechas_login`
--
ALTER TABLE `fechas_login`
  ADD PRIMARY KEY (`idFechaLogin`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`idFoto`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`idFuncion`);

--
-- Indices de la tabla `items_pedido`
--
ALTER TABLE `items_pedido`
  ADD PRIMARY KEY (`idItemPedido`,`idPedido`,`idProducto`,`idEstado`,`idUsuario`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`idLogin`,`idUsuario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`idMesa`);

--
-- Indices de la tabla `mesas_pedido`
--
ALTER TABLE `mesas_pedido`
  ADD PRIMARY KEY (`idMesaPedido`,`idMesa`,`idEstado`,`idFoto`),
  ADD KEY `idMesa` (`idMesa`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idFoto` (`idFoto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`,`idEstado`,`idCliente`,`idMesaPedido`,`idUsuario`,`idTicket`) USING BTREE,
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idMesaPedido` (`idMesaPedido`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idTicket` (`idTicket`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`,`idSector`),
  ADD KEY `idSector` (`idSector`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`idSector`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idTicket`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`,`idSector`,`idFuncion`,`idEstado`) USING BTREE,
  ADD KEY `idSector` (`idSector`),
  ADD KEY `idFuncion` (`idFuncion`),
  ADD KEY `idEstado` (`idEstado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `idEncuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `fechas_login`
--
ALTER TABLE `fechas_login`
  MODIFY `idFechaLogin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `idFuncion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `items_pedido`
--
ALTER TABLE `items_pedido`
  MODIFY `idItemPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logins`
--
ALTER TABLE `logins`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `idMesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `mesas_pedido`
--
ALTER TABLE `mesas_pedido`
  MODIFY `idMesaPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `idSector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD CONSTRAINT `encuestas_ibfk_1` FOREIGN KEY (`idTicket`) REFERENCES `tickets` (`idTicket`);

--
-- Filtros para la tabla `fechas_login`
--
ALTER TABLE `fechas_login`
  ADD CONSTRAINT `fechas_login_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `items_pedido`
--
ALTER TABLE `items_pedido`
  ADD CONSTRAINT `items_pesdido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`),
  ADD CONSTRAINT `items_pesdido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `items_pesdido_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`),
  ADD CONSTRAINT `items_pesdido_ibfk_4` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `logins`
--
ALTER TABLE `logins`
  ADD CONSTRAINT `logins_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `mesas_pedido`
--
ALTER TABLE `mesas_pedido`
  ADD CONSTRAINT `mesas_pedido_ibfk_1` FOREIGN KEY (`idMesa`) REFERENCES `mesas` (`idMesa`),
  ADD CONSTRAINT `mesas_pedido_ibfk_2` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`),
  ADD CONSTRAINT `mesas_pedido_ibfk_3` FOREIGN KEY (`idFoto`) REFERENCES `fotos` (`idFoto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idMesaPedido`) REFERENCES `mesas_pedido` (`idMesaPedido`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_5` FOREIGN KEY (`idTicket`) REFERENCES `tickets` (`idTicket`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`idSector`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idSector`) REFERENCES `sectores` (`idSector`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idFuncion`) REFERENCES `funciones` (`idFuncion`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estados` (`idEstado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
