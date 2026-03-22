-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2024 a las 22:54:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_rodriguez_priscila`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `activo` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `activo`) VALUES
(1, 'Mates', 1),
(2, 'Bombillas', 1),
(3, 'Combos', 1),
(4, 'Termos', 0),
(5, 'Accesorios', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` varchar(250) NOT NULL,
  `consulta` varchar(2) NOT NULL,
  `respondido` varchar(2) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `nombre`, `email`, `telefono`, `asunto`, `mensaje`, `consulta`, `respondido`) VALUES
(1, 'Priscila', 'rodriguezpris10@gmail.com', '', '2', 'Prueba de contacto', '', 'SI'),
(2, 'Juan', '1234@gmail.com', NULL, '4', 'Prueba desde login', '', 'SI'),
(3, 'Juan', 'juanlopez@gmail.com', NULL, '1', 'Prueba de consulta desde perfil cliente', 'SI', 'SI'),
(4, 'Paula', 'priscila@hotmail.com', NULL, '3', 'Prueba consulta desde usuario cliente 2', 'SI', 'NO'),
(5, 'Francisco', 'francis@gmail.com', '3794667802', '1', 'Quisiera saber si como nuevo usuario tengo beneficios?', 'SI', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id_perfil` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `descripcion`) VALUES
(1, 'administrador'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `url_imagen` varchar(200) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precio_venta` float(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_min` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `eliminado` varchar(10) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `url_imagen`, `categoria_id`, `precio`, `precio_venta`, `stock`, `stock_min`, `descripcion`, `eliminado`) VALUES
(1, 'Bombilla pico de loro', '1717542250_057e3f4fcc9cb6b93526.jpeg', 2, 8000.00, 9000.00, 47, 1, 'Bombilla pico de loro acero inoxidable. Con filtro de pala y pico curvo. Medida: 19 cm', 'NO'),
(2, 'Combo matero 2024', '1716936694_d1c8b8244907db477201.jpeg', 3, 150000.00, 155690.00, 65, 1, 'El combo ideal para tus viajes! Termo acero inoxidable + mate de calabaza, forrado en cuero vacuno.', 'NO'),
(3, 'Bombilla alpaca', '1716936828_a4fff2f4c8131bf9020a.jpeg', 2, 10000.00, 11550.00, 49, 1, 'Bombilla pico de loro alpaca. Con filtro de pala, pico curvó y soldado en plata. Medida: 18 cm', 'NO'),
(4, 'Combo viajero', '1717002727_92c1945dd0ddc15562c0.jpeg', 3, 55000.00, 60000.00, 46, 1, 'Este combo incluye: Mate imperial botas y bolitas, bombilla alpaca y porta mate para auto.', 'NO'),
(5, 'Canasta matera', '1717002797_c6c2a0ffce53540b30f0.jpeg', 5, 55000.00, 60000.00, 19, 1, 'Canasta premium confeccionada en cuero. Hecho a mano. Con capacidad para termo, mate y yerba/yerbera.', 'NO'),
(6, 'Mate argento', '1717002847_0fe2bf9f10edb28d5e03.jpeg', 1, 100000.00, 120000.00, 29, 1, 'Mate de calabaza. Forrado en cuero vacuno. Base de 4 patas reforzadas. Apliques de bronce soldados en plata.', 'NO'),
(7, 'Mate imperial croco', '1717002909_7e8f0253494f9d1d0cce.jpeg', 1, 80000.00, 85000.00, 35, 1, 'Mate de calabaza. Forrado en cuero vacuno. Base de 4 patas reforzadas.', 'NO'),
(8, 'Bombillon pico de loro cincelada', '1717722761_6f73c0d62c9886f26cfc.jpeg', 2, 30000.00, 35000.00, 85, 1, 'Bombillón pico de loro cincelada. Con filtro de pala y pico de bronce. Medida aprox 18/19cm', 'NO'),
(9, 'Bombillon pico de loro corona', '1717722914_ccf67118c39c8ac9028b.jpeg', 2, 15000.00, 17500.00, 97, 1, 'Bombillón pico de loro corona. Con filtro de pala, soldadura en plata y pico curvo. Medida aprox 18/19cm', 'NO'),
(10, 'Bombillon messi', '1717723136_2797229b7f4acd1ddcb9.jpeg', 2, 45000.00, 50000.00, 20, 1, 'Bombillón Messi. Edición limitada del nuevo bombillón de Leo Messi. Esta pieza exclusiva está conformada por 4 apliques en bronce, caño de alpaca y pico de cobre. Medida: 18 cm', 'NO'),
(11, 'Bombillon egipcio', '1717723326_8a2c94e844d204a8d983.jpeg', 2, 65300.00, 67000.00, 29, 1, 'Bombillón egipcio. Una pieza exclusiva de alpaca con detalles en bronce. Medida aprox 19cm', 'NO'),
(12, 'Mate imperial cuero', '1717723529_1cd2ab438618468f9d5e.jpg', 1, 30000.00, 35500.00, 109, 1, 'Mate de calabaza. Forrado en cuero vacuno. Base de 4 patas. Fleje y virola de alpaca.', 'NO'),
(13, 'Mate Camionero eco', '1717723706_4c38b95579501b1e1877.jpg', 1, 20000.00, 22550.00, 60, 1, 'Mate de calabaza brasilera. Forrado en cuero vacuno. Base de 4 patas. Virola de acero inoxidable.', 'NO'),
(14, 'Mate imperial deluxe', '1717724136_7cc08a0edf72552c35dd.jpeg', 1, 45670.00, 47590.00, 66, 1, 'Interior de acero inoxidable. Anti hongos. Virola de acero inox. Fleje de bronce/alpaca cincelado. Forrado en cuero vacuno legítimo natural. Producto 100% artesanal. Base reforzada de 4 patas firme.', 'NO'),
(15, 'Mate river plate', '1717724271_a7389f9c3b2098c45b17.jpeg', 1, 85000.00, 90067.00, 23, 1, 'Mate de calabaza brasilera. Forrado en cuero vacuno. Base de 4 patas reforzadas. Flejes y virola de alpaca. Apliques de bronce soldados en plata.', 'NO'),
(16, 'Box camionero', '1717724602_8a75d69bf2033e17f1e5.jpeg', 3, 40890.00, 45700.00, 44, 1, 'El box camionero grabado incluye los siguientes productos: Mate camionero personalizado + Bombilla pico de loro acero + Caja de regalo', 'NO'),
(17, 'Box dia del padre', '1717724758_ebc7b131ea98d5a5b452.jpeg', 3, 55789.00, 58000.00, 24, 1, 'El box día del padre incluye los siguientes productos: Mate imperial personalizado (podes elegir de color marrón o negro) + Bombilla pico de loro acero + Caja de regalo ', 'NO'),
(18, 'Box imperial grabado', '1717724917_b77be428bf611d4f428a.jpeg', 3, 45320.00, 47800.00, 34, 1, 'El box imperial grabado incluye los siguientes productos: Mate imperial personalizado + Bombilla pico de loro acero + Caja de regalo', 'NO'),
(19, 'Box imperial eco', '1717725022_be87d639f0afac753a2d.jpeg', 3, 40900.00, 45000.00, 55, 1, 'El box imperial grabado incluye los siguientes productos: Mate imperial eco personalizado + Bombilla pico de loro acero + Caja de regalo', 'NO'),
(20, 'Tapamate', '1717725756_a7247e62580ebc8ec148.jpg', 5, 5000.00, 5670.00, 17, 1, 'Lleva tu mate con yerba sin usar o usada para cualquier lado adentró de la mochi, bolso, matera o donde quieras con la tranquilidad de no manchar nada!', 'NO'),
(21, 'Porta mate', '1717725847_89d5f06231f7b474c456.jpeg', 5, 18900.00, 20000.00, 23, 1, 'PORTA MATE PARA EL AUTO. REALIZADA A MANO. CAPACIDAD PARA ALMACENAR MATE 11CM DIAMETRO.', 'NO'),
(22, 'Yerbero negro', '1717725931_35a72c5250cbed6b06dd.jpeg', 5, 5500.00, 7000.00, 28, 1, 'Yerbero de cuero vaqueta en color negro. Cierre en parte superior. Capacidad 500g.', 'NO'),
(23, 'Termo media manija', '1717726021_6ed2ccc6be689dc037c7.jpeg', 5, 25000.00, 28900.00, 27, 1, 'Termo media manija acero. Pico cebador. Rinde 1 Lt', 'NO'),
(24, 'Caja de regalo', '1717726121_f06da9b5685798288f25.jpeg', 5, 5000.00, 5500.00, 50, 1, 'Estuche para regalo con espacio para mate y bombilla. Este modelo se vende únicamente con la compra de nuestros mates.', 'NO'),
(25, 'Mate torpedo ', '1717726339_430da2b1a62df00f1593.jpeg', 1, 45600.00, 50000.00, 15, 1, 'Mate de calabaza brasilera. Forrado en cuero vacuno. Base calada a mano. Virola cincelada de alpaca.', 'SI'),
(26, 'Mate imperial botas labrado', '1718484348_d1feefef65e447fdc233.jpeg', 1, 55780.00, 60800.00, 50, 1, 'Mate de calabaza. Forrado en cuero vacuno. Base de 4 patas. Fleje y virola de alpaca.', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `baja` varchar(2) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `nombre_usuario`, `email`, `telefono`, `contrasenia`, `perfil_id`, `baja`) VALUES
(1, 'Priscila', 'Rodriguez', 'admin', 'admin@gmail.com', '', '$2y$10$aA6zbian9IOzGAvkDbkSGOHuEJ.1OW4fYkI4Z/8NUZaXgczqlQsmC', 1, 'NO'),
(2, 'Juan', 'Lopez', 'Juanlopez', 'juanlopez@gmail.com', '3794123467', '$2y$10$t45pSMgDSXQZtocaEfj1Eu6SBXQZ9r8AYN18KPbl0xB/9suq6nBSK', 2, 'NO'),
(3, 'Magali', 'Lopez', 'magalopez', 'magali@gmail.com', '', '$2y$10$jdCc6hvC73.V9sP8nvmYWOLpouvuYoQm0Nz1gtIeKDSrn8DrPkgvO', 2, 'NO'),
(4, 'Paula', 'Lopez', 'pau100', 'priscila@hotmail.com', '', '$2y$10$CJ3/2xnTPo2Jk9iZ.s9KfOQx8z.V5iXp/tEtNZxcnWlvx4XUukwYu', 2, 'NO'),
(5, 'Micaela', 'Gomez', 'admin2', 'micaela@gmail.com', '', '$2y$10$S9QHwDxYPCE.one/8EJ8qOa311MrbCqUdCJhFEaMP6ss7qrlU0fty', 1, 'NO'),
(6, 'Francisco', 'Herrera', 'francis', 'francis@gmail.com', '3794667802', '$2y$10$oGGIgprNR2YyZnfFiwOR7u3WCKcCB.ND5BakRFIjP8snbKLMu8esO', 2, 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_cabecera`
--

CREATE TABLE `ventas_cabecera` (
  `id_ventas` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total_venta` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_cabecera`
--

INSERT INTO `ventas_cabecera` (`id_ventas`, `fecha`, `usuario_id`, `total_venta`) VALUES
(1, '2024-06-11 23:01:01', 4, 183960.00),
(2, '2024-06-11 23:05:23', 2, 357665.69),
(3, '2024-06-11 23:06:32', 2, 120000.00),
(4, '2024-06-15 18:08:06', 4, 242590.00),
(5, '2024-06-15 20:41:02', 6, 75855.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_detalle`
--

CREATE TABLE `ventas_detalle` (
  `id_detalle` int(11) NOT NULL,
  `venta_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas_detalle`
--

INSERT INTO `ventas_detalle` (`id_detalle`, `venta_id`, `producto_id`, `cantidad`, `precio`) VALUES
(1, 1, 8, 1, 35000.00),
(2, 1, 2, 1, 155690.00),
(3, 1, 22, 1, 7000.00),
(4, 1, 14, 1, 47590.00),
(5, 2, 7, 1, 85000.00),
(6, 2, 12, 1, 35500.00),
(7, 2, 15, 2, 90067.00),
(8, 2, 21, 2, 20000.00),
(9, 3, 4, 2, 60000.00),
(10, 4, 23, 1, 28900.00),
(11, 4, 17, 1, 58000.00),
(12, 4, 2, 1, 155690.00),
(13, 5, 8, 1, 35000.00),
(14, 5, 18, 1, 47800.00),
(15, 5, 22, 1, 7000.00),
(16, 5, 20, 2, 5670.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- Indices de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `venta_id` (`venta_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `ventas_cabecera`
--
ALTER TABLE `ventas_cabecera`
  ADD CONSTRAINT `ventas_cabecera_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `ventas_detalle`
--
ALTER TABLE `ventas_detalle`
  ADD CONSTRAINT `ventas_detalle_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas_cabecera` (`id_ventas`),
  ADD CONSTRAINT `ventas_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
