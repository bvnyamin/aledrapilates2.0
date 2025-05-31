-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2025 a las 03:48:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aledrapilates_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradora`
--

CREATE TABLE `administradora` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `biografia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cupoMaximo` int(11) NOT NULL,
  `cuposDisponibles` int(11) NOT NULL,
  `id_instructora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `tipo`, `fecha`, `hora`, `cupoMaximo`, `cuposDisponibles`, `id_instructora`) VALUES
(33, 'Clase de Pilates', '2025-05-09', '17:00:00', 6, 6, 1),
(34, 'Clase de Pilates', '2025-09-19', '16:00:00', 6, 6, 2),
(35, 'Clase de Pilates', '2025-05-08', '17:00:00', 6, 0, 1),
(36, 'Clase de Pilates', '2025-05-17', '10:00:00', 6, 0, 2),
(37, 'Clase de Pilates', '2025-05-14', '08:00:00', 6, 0, 1),
(38, 'Clase de Pilates', '2025-05-14', '18:00:00', 6, 0, 1),
(39, 'Clase de Pilates', '2025-05-17', '18:00:00', 6, 0, 1),
(40, 'Clase de Pilates', '2025-05-17', '18:00:00', 6, 0, 2),
(41, 'Clase de Pilates', '2025-05-15', '17:00:00', 6, 0, 2),
(42, 'Clase de Pilates', '2025-05-16', '19:00:00', 6, 0, 2),
(43, 'Clase de Pilates', '2025-05-07', '19:00:00', 6, 0, 2),
(44, 'Clase de Pilates', '2025-05-03', '09:00:00', 6, 0, 1),
(45, 'Clase de Pilates', '2025-08-22', '11:00:00', 6, 0, 1),
(46, 'Clase de Pilates', '2025-07-03', '20:00:00', 6, 0, 2),
(47, 'Clase de Pilates', '2026-03-13', '08:00:00', 6, 0, 1),
(48, 'Clase de Pilates', '2026-03-13', '19:00:00', 6, 0, 1),
(49, 'Clase de Pilates', '2026-04-10', '17:00:00', 6, 0, 1),
(50, 'Clase de Pilates', '2025-05-15', '19:00:00', 6, 0, 2),
(51, 'Clase de Pilates', '2025-06-07', '19:00:00', 6, 0, 2),
(52, 'Clase de Pilates', '2025-07-11', '10:00:00', 6, 0, 2),
(53, 'Clase de Pilates', '2025-07-05', '17:00:00', 6, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructora`
--

CREATE TABLE `instructora` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `biografia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructora`
--

INSERT INTO `instructora` (`id`, `nombre`, `especialidad`, `biografia`) VALUES
(1, 'Alejandra Villagran', '', ''),
(2, 'Carla Fuentes', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `id` int(11) NOT NULL,
  `mensaje` varchar(100) NOT NULL,
  `fechaEnvio` date NOT NULL,
  `usurio_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `duracion_dias` int(11) NOT NULL,
  `hora_valle` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`id`, `nombre`, `descripcion`, `precio`, `duracion_dias`, `hora_valle`) VALUES
(1, 'Plan Trimestral', 'Incluye acceso por 3 meses', 180000, 90, 0),
(2, 'Plan Anual', 'Acceso por un año completo', 600000, 365, 0),
(3, 'Plan Semestral', 'Acceso durante 6 meses', 330000, 180, 0),
(4, 'Plan Hora Valle', 'Clases en horario de baja afluencia', 75000, 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id` int(11) UNSIGNED NOT NULL,
  `descripcion` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion_cliente`
--

CREATE TABLE `promocion_cliente` (
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `promocion_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacionpassword`
--

CREATE TABLE `recuperacionpassword` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `fechaExpiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuperacionpassword`
--

INSERT INTO `recuperacionpassword` (`id`, `email`, `token`, `fechaExpiracion`) VALUES
(1, 'nvillagran.vp@gmail.com', '421387448dd1086416ea87f33896368e', '2025-05-06 02:44:09'),
(4, 'ola@gmail.com', 'f89d383adeb3490f78c9fcb2ec9ef4c1', '2025-05-06 05:04:23'),
(5, 'ola@gmail.com', '8e60b9a082b039939e76d6034e3a8f90', '2025-05-06 05:05:54'),
(6, 'ola@gmail.com', '0c2ef638eae1f696123d7e24ff4a721d', '2025-05-06 05:06:05'),
(7, 'nvillagran.vp@gmail.com', '74993241fe091f6d480ae7b97ba0ca97', '2025-05-06 05:16:55'),
(8, 'root@gmail.com', '16db5926d92aa0d520aee3f0eeca58b5', '2025-05-06 06:35:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `fechaReserva` date NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cliente_id` int(11) UNSIGNED NOT NULL,
  `clase_id` int(11) NOT NULL,
  `plan_id` int(11) UNSIGNED NOT NULL,
  `usuario_id` int(11) UNSIGNED NOT NULL,
  `horaReserva` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `fechaReserva`, `estado`, `cliente_id`, `clase_id`, `plan_id`, `usuario_id`, `horaReserva`) VALUES
(26, '2025-05-28', 'cancelada', 0, 33, 1, 9, NULL),
(27, '2025-09-19', 'cancelada', 0, 34, 1, 9, '16:00:00'),
(45, '2025-05-16', 'cancelada', 10, 42, 1, 10, '19:00:00'),
(46, '2025-05-16', 'cancelada', 10, 42, 1, 10, '19:00:00'),
(47, '2025-05-16', 'cancelada', 10, 42, 1, 10, '19:00:00'),
(48, '2025-05-16', 'confirmada', 10, 42, 1, 10, '19:00:00'),
(49, '2025-05-16', 'confirmada', 10, 42, 1, 10, '19:00:00'),
(50, '2025-05-16', 'confirmada', 10, 42, 1, 10, '19:00:00'),
(51, '2025-05-07', 'cancelada', 10, 43, 1, 10, '19:00:00'),
(52, '2025-05-07', 'cancelada', 10, 43, 1, 10, '19:00:00'),
(53, '2025-05-07', 'cancelada', 10, 43, 1, 10, '19:00:00'),
(54, '2025-05-07', 'cancelada', 10, 43, 1, 10, '19:00:00'),
(55, '2025-05-07', 'cancelada', 10, 43, 1, 10, '19:00:00'),
(56, '2025-05-07', 'cancelada', 0, 43, 1, 10, '19:00:00'),
(57, '2025-05-03', 'cancelada', 0, 44, 2, 10, '09:00:00'),
(58, '2025-05-03', 'cancelada', 0, 44, 2, 10, '09:00:00'),
(59, '2025-05-03', 'cancelada', 0, 44, 2, 10, '09:00:00'),
(60, '2025-05-03', 'cancelada', 0, 44, 2, 10, '09:00:00'),
(61, '2025-05-03', 'cancelada', 0, 44, 2, 10, '09:00:00'),
(62, '2025-05-03', 'cancelada', 0, 44, 2, 10, '09:00:00'),
(63, '2025-08-22', 'confirmada', 0, 45, 3, 10, '11:00:00'),
(64, '2025-07-03', 'confirmada', 0, 46, 3, 10, '20:00:00'),
(65, '2025-07-03', 'confirmada', 0, 46, 3, 10, '20:00:00'),
(66, '2025-07-03', 'confirmada', 0, 46, 3, 10, '20:00:00'),
(67, '2025-07-03', 'confirmada', 0, 46, 3, 10, '20:00:00'),
(68, '2025-07-03', 'confirmada', 0, 46, 3, 10, '20:00:00'),
(69, '2025-07-03', 'confirmada', 0, 46, 3, 10, '20:00:00'),
(70, '2026-03-13', 'confirmada', 0, 47, 4, 10, '08:00:00'),
(71, '2026-03-13', 'confirmada', 0, 47, 4, 10, '08:00:00'),
(72, '2026-03-13', 'cancelada', 0, 47, 4, 10, '08:00:00'),
(73, '2026-03-13', 'confirmada', 0, 47, 4, 10, '08:00:00'),
(74, '2026-03-13', 'cancelada', 0, 47, 4, 10, '08:00:00'),
(75, '2026-03-13', 'cancelada', 0, 47, 4, 10, '08:00:00'),
(76, '2026-03-13', 'cancelada', 0, 48, 1, 10, '19:00:00'),
(77, '2026-04-10', 'cancelada', 0, 49, 3, 10, '17:00:00'),
(78, '2025-05-15', 'cancelada', 0, 50, 1, 10, '19:00:00'),
(79, '2025-06-07', 'confirmada', 0, 51, 2, 10, '19:00:00'),
(80, '2025-07-11', 'confirmada', 0, 52, 2, 10, '10:00:00'),
(81, '2025-07-11', 'confirmada', 0, 52, 1, 10, '10:00:00'),
(82, '2025-07-11', 'confirmada', 0, 52, 1, 10, '10:00:00'),
(83, '2025-07-05', 'confirmada', 0, 53, 3, 10, '17:00:00'),
(84, '2025-07-05', 'confirmada', 0, 53, 3, 10, '17:00:00'),
(85, '2025-07-05', 'confirmada', 0, 53, 3, 10, '17:00:00'),
(86, '2025-07-05', 'confirmada', 0, 53, 3, 10, '17:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('cliente','administrador') NOT NULL DEFAULT 'cliente',
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `contrasena`, `rol`, `telefono`) VALUES
(1, 'alejandra', 'root@gmail.com', '$2y$10$ZbjVc2nR.bcMew.fkLj3kON.TBCC1xHq0J6ae1DX8uVmgzm7mIM3y', 'cliente', ''),
(2, 'hla', 'ola@gmail.com', '$2y$10$bL0duy37PNQIJ.70PyKareg0z0gSf90WmxKF3QStzbgEoy5gZRVcy', 'cliente', ''),
(3, 'Nicolas Villagran', 'nvillagran.vp@mgail.com', '$2y$10$3coG3ijgx9KVgQxL3s5jK.XUcJw84TFl8JEtIPfgiSrgQGdnTNlgC', 'cliente', ''),
(4, 'Benjamin Peña', 'nvillagran.vp@gmail.com', '$2y$10$onR3qq7Ppkmg.w6n/iImz.TccCEAHSf/xVPfeJ6Zspe8BxqGsUxIu', 'cliente', ''),
(5, 'mane', 'jamaica123@outlook.es', '$2y$10$Ae0jLY3HckDC86xy.bGj5.KTWHpbGHhPpJsuUIXAzRWMowrlbU6Xu', 'cliente', ''),
(6, 'admin', 'aledra.nails@gmail.com', '$2y$10$diRyDdbsrE4nqtHy8mcU5uaQKIQZ7A5FNmJXAF0u.DaPA3XzLcdAy', 'administrador', ''),
(7, 'Prueba', 'aaaa@gmail.com', '$2y$10$92WejrH2KDgwgZG9Gfl0ZOUb99klEq82DFBpiKmrjioc9KIVofwVG', 'cliente', ''),
(8, 'mister', 'nvillagran.vp@eee.com', '$2y$10$xs5w0cT6XHXbjhILloN6EO4Bc19pBSXlipcGLt9rqJ0Mjl6zBXP2.', 'cliente', ''),
(9, 'carlos', 'carlos@123.com', '$2y$10$ptlLGIslnknG1FpZcaJpdO84KikLMZ6tyx7x.VIW9Ja/feLvGBODq', 'cliente', ''),
(10, 'Nicolas Peña', 'nicolas@gmail.com', '$2y$10$IWOdxWzKlbH3WQy45fUcVezv5ipAjR6cS2fR2P9GBFplx.hdoSqJe', 'cliente', '+56 953145901');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradora`
--
ALTER TABLE `administradora`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructora_id` (`id_instructora`);

--
-- Indices de la tabla `instructora`
--
ALTER TABLE `instructora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usurio_id` (`usurio_id`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promocion_cliente`
--
ALTER TABLE `promocion_cliente`
  ADD PRIMARY KEY (`cliente_id`,`promocion_id`),
  ADD KEY `promocion_id` (`promocion_id`);

--
-- Indices de la tabla `recuperacionpassword`
--
ALTER TABLE `recuperacionpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`cliente_id`),
  ADD KEY `id_2` (`id`,`clase_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `fk_plan` (`plan_id`),
  ADD KEY `fk_usuario` (`usuario_id`),
  ADD KEY `fk_clase` (`clase_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `instructora`
--
ALTER TABLE `instructora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recuperacionpassword`
--
ALTER TABLE `recuperacionpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradora`
--
ALTER TABLE `administradora`
  ADD CONSTRAINT `administradora_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`id_instructora`) REFERENCES `instructora` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `notificacion_ibfk_1` FOREIGN KEY (`usurio_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `promocion_cliente`
--
ALTER TABLE `promocion_cliente`
  ADD CONSTRAINT `promocion_cliente_ibfk_2` FOREIGN KEY (`promocion_id`) REFERENCES `promocion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_clase` FOREIGN KEY (`clase_id`) REFERENCES `clase` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_plan` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`clase_id`) REFERENCES `clase` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
