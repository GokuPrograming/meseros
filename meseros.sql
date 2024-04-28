-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2024 a las 05:28:44
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `meseros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canasta`
--

CREATE TABLE `canasta` (
  `id_camasta` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canasta`
--

INSERT INTO `canasta` (`id_camasta`, `id_producto`, `cantidad`, `id_usuario`) VALUES
(66, 3, 4, 26),
(67, 1, 4, 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canasta_pedido`
--

CREATE TABLE `canasta_pedido` (
  `id_canasta_pedido` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canasta_pedido`
--

INSERT INTO `canasta_pedido` (`id_canasta_pedido`, `id_producto`, `id_usuario`, `id_pedido`, `cantidad`) VALUES
(50, 1, 27, 36, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'Comida'),
(2, 'Desechables'),
(3, 'Bebidas'),
(4, 'Meseros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `id_usuario`) VALUES
(20, 'Elsa \"Patito\" Mojado ', 22),
(21, 'Alberto \"El moreno\" Prieto', 23),
(22, 'Armando \"El Carrito\" Mojado', 24),
(23, 'Mario \"El descabellado\" Barba', 25),
(24, 'Miguel sdasdas vera franco', 26),
(25, 'Miguel Vera Franco salu2!! jsjsjs,', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadonecesitomesero`
--

CREATE TABLE `estadonecesitomesero` (
  `id_estadoNecesitoMesero` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

CREATE TABLE `estado_pedido` (
  `id_estado_pedido` int(11) NOT NULL,
  `estado` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_pedido`
--

INSERT INTO `estado_pedido` (`id_estado_pedido`, `estado`) VALUES
(1, 'Disponible'),
(2, 'En preparacion'),
(3, 'En camino'),
(4, 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `necesitomesero`
--

CREATE TABLE `necesitomesero` (
  `id_necesitoMesero` int(11) NOT NULL,
  `asunto` varchar(10000) DEFAULT NULL,
  `mesa` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `necesitomeseroatendido`
--

CREATE TABLE `necesitomeseroatendido` (
  `id_necesitoMeseroAtendido` int(11) NOT NULL,
  `id_mesero` int(11) DEFAULT NULL,
  `id_estadoNecesitoMesero` int(11) DEFAULT NULL,
  `id_necesitoMesero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `no_mesa` int(11) DEFAULT NULL,
  `id_estado_pedido` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario`, `no_mesa`, `id_estado_pedido`, `fecha`) VALUES
(36, 27, 3, 4, '2024-04-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_atendido`
--

CREATE TABLE `pedido_atendido` (
  `id_pedido_atendido` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_usuario_mesero` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido_atendido`
--

INSERT INTO `pedido_atendido` (`id_pedido_atendido`, `id_pedido`, `id_usuario_mesero`, `status`) VALUES
(29, 36, 22, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `producto_nombre` varchar(100) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `imagen` varchar(1000) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `producto_nombre`, `id_categoria`, `imagen`, `descripcion`) VALUES
(1, 'coca cola 600 ml', 3, 'coca600.jpg', 'coca de 600 ml fria'),
(2, 'platillo de mole', 1, 'mole.jpg', 'contiene pollo, mole y arroz'),
(3, 'vasos 250ml', 2, 'vaso.jpg', 'vasos de 150 ml'),
(4, 'amburguesa', 1, 'amburguesa.jpg', 'amburguesa con mucho queso'),
(5, 'caballito 600ml cerbeza de raiz', 3, 'caballito_600ml_cerbeza_raiz.jpg', 'caballito cerveza de raiz'),
(6, 'caballito 600ml piña', 3, 'caballito_600ml_piña.jpg', 'caballito de piña, para la niña'),
(7, 'cuchara', 2, 'cuchara.jpeg', 'Cuchara de plastico'),
(8, 'fajitas', 1, 'fajitas.jpg', 'Una orden de 2 fajitas '),
(9, 'sushi', 1, 'sushi.jpg', 'Es sushi del bueno'),
(11, 'Agua mineral ', 3, 'aguamineral.jpg', 'Agua mineral 1.5L'),
(12, 'Manzanita Sol', 3, 'manzanita.jpg', 'Manzanita Sol de 2L'),
(13, 'Sangria Casera', 3, 'sangria.jpg', 'Sangria de 2L'),
(14, 'Agua natural', 3, 'agua5l.jpg', 'Garrafon de 5L'),
(15, 'Agua Natural', 3, 'agua500ml.jpg', 'Botella de agua 500 ml'),
(16, 'Plato', 2, 'plato.jpg', 'Es un plato desechable'),
(17, 'Servilletas', 2, 'servilleta.jpg', 'Paquete de 200 servilletas'),
(18, 'Kit de cubiertos', 2, 'kit.jpg', '1 cuchara,1 tenedor y 1 cuchillo'),
(19, 'Bolsa de Hielo', 2, 'hielo.jpg', '1 bolsa de hielo de 5Kg'),
(20, 'Chetos', 1, 'chetos.jpg', 'Bolsa de chetos 170 gr'),
(21, 'Churros \"Rines\"', 1, 'rines.jpg', 'Bolsa de churros rines');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'administrador'),
(2, 'mesero'),
(3, 'cliente'),
(4, 'cocina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `password`, `id_rol`) VALUES
(22, 'mesero1@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(23, 'mesero2@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(24, 'mesero3@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(25, 'mesero4@gmail.com', '202cb962ac59075b964b07152d234b70', 2),
(26, 'verafrancomiguel1d@gmail.com', '202cb962ac59075b964b07152d234b70', 3),
(27, '19031725@itcelaya.edu.mx', '202cb962ac59075b964b07152d234b70', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canasta`
--
ALTER TABLE `canasta`
  ADD PRIMARY KEY (`id_camasta`),
  ADD KEY `canasta_producto_fk` (`id_producto`),
  ADD KEY `canasta_usuario_fk` (`id_usuario`);

--
-- Indices de la tabla `canasta_pedido`
--
ALTER TABLE `canasta_pedido`
  ADD PRIMARY KEY (`id_canasta_pedido`),
  ADD KEY `canastaPedido_produdcto_fk` (`id_producto`),
  ADD KEY `canastaPedido_usuario_fk` (`id_usuario`),
  ADD KEY `canastaPedido_pedido_fk` (`id_pedido`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `cliente_usuario_fk` (`id_usuario`);

--
-- Indices de la tabla `estadonecesitomesero`
--
ALTER TABLE `estadonecesitomesero`
  ADD PRIMARY KEY (`id_estadoNecesitoMesero`);

--
-- Indices de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indices de la tabla `necesitomesero`
--
ALTER TABLE `necesitomesero`
  ADD PRIMARY KEY (`id_necesitoMesero`),
  ADD KEY `necesitoMesero_usuario_fk` (`id_usuario`);

--
-- Indices de la tabla `necesitomeseroatendido`
--
ALTER TABLE `necesitomeseroatendido`
  ADD PRIMARY KEY (`id_necesitoMeseroAtendido`),
  ADD KEY `necesito_estadoNecesito_fk` (`id_estadoNecesitoMesero`),
  ADD KEY `necesito_usuario_fk` (`id_mesero`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pedido_usuario_User_fk` (`id_usuario`),
  ADD KEY `pedido_estado_fk` (`id_estado_pedido`);

--
-- Indices de la tabla `pedido_atendido`
--
ALTER TABLE `pedido_atendido`
  ADD PRIMARY KEY (`id_pedido_atendido`),
  ADD KEY `pedido_atendido_usuario_Mesero_fk` (`id_usuario_mesero`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `producto_categoria_fk` (`id_categoria`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `usuario_rol_fk` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canasta`
--
ALTER TABLE `canasta`
  MODIFY `id_camasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `canasta_pedido`
--
ALTER TABLE `canasta_pedido`
  MODIFY `id_canasta_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `estadonecesitomesero`
--
ALTER TABLE `estadonecesitomesero`
  MODIFY `id_estadoNecesitoMesero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  MODIFY `id_estado_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `necesitomesero`
--
ALTER TABLE `necesitomesero`
  MODIFY `id_necesitoMesero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `necesitomeseroatendido`
--
ALTER TABLE `necesitomeseroatendido`
  MODIFY `id_necesitoMeseroAtendido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `pedido_atendido`
--
ALTER TABLE `pedido_atendido`
  MODIFY `id_pedido_atendido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canasta`
--
ALTER TABLE `canasta`
  ADD CONSTRAINT `canasta_producto_fk` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `canasta_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `canasta_pedido`
--
ALTER TABLE `canasta_pedido`
  ADD CONSTRAINT `canastaPedido_pedido_fk` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `canastaPedido_produdcto_fk` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`),
  ADD CONSTRAINT `canastaPedido_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `necesitomesero`
--
ALTER TABLE `necesitomesero`
  ADD CONSTRAINT `necesitoMesero_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `necesitomeseroatendido`
--
ALTER TABLE `necesitomeseroatendido`
  ADD CONSTRAINT `necesitoAtendido_necesito_fk` FOREIGN KEY (`id_estadoNecesitoMesero`) REFERENCES `necesitomesero` (`id_necesitoMesero`),
  ADD CONSTRAINT `necesito_estadoNecesito_fk` FOREIGN KEY (`id_estadoNecesitoMesero`) REFERENCES `estadonecesitomesero` (`id_estadoNecesitoMesero`),
  ADD CONSTRAINT `necesito_usuario_fk` FOREIGN KEY (`id_mesero`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_estado_fk` FOREIGN KEY (`id_estado_pedido`) REFERENCES `estado_pedido` (`id_estado_pedido`),
  ADD CONSTRAINT `pedido_usuario_User_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `pedido_atendido`
--
ALTER TABLE `pedido_atendido`
  ADD CONSTRAINT `pedido_atendido_usuario_Mesero_fk` FOREIGN KEY (`id_usuario_mesero`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_categoria_fk` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_rol_fk` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
