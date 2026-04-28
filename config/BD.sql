-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2026 a las 00:13:43
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
-- Base de datos: `fiscalia_flagrancia_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carpetas`
--

CREATE TABLE `carpetas` (
  `id` int(11) NOT NULL,
  `nro_carpeta` varchar(50) DEFAULT NULL,
  `denunciante` varchar(100) DEFAULT NULL,
  `agraviado` varchar(100) DEFAULT NULL,
  `delito` varchar(100) DEFAULT NULL,
  `fecha_hecho` date DEFAULT NULL,
  `fiscal_responsable` varchar(100) DEFAULT NULL,
  `fiscalia` varchar(100) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carpetas`
--

INSERT INTO `carpetas` (`id`, `nro_carpeta`, `denunciante`, `agraviado`, `delito`, `fecha_hecho`, `fiscal_responsable`, `fiscalia`, `estado`) VALUES
(1, '150-2026', 'MIGUEL', 'ANGEL', 'ROBO', '2026-04-17', '3RA FISCALIA', 'GFGF', 'formalizado'),
(2, 'fgbfgb', 'bffdb', 'dbsfdfdfbfb', 'fbfbfbfbfgb', '2026-04-24', '3RA FISCALIA', 'JUAN PEREZ', 'formalizado'),
(3, 'fgbfgb', 'bffdb', 'dbsfdfdfbfb', 'fbfbfbfbfgb', '2026-04-24', '3RA FISCALIA', 'JUAN PEREZ', 'formalizado'),
(4, '', '', '', '', '0000-00-00', '', '', 'archivado'),
(5, '150-2026', 'fdfd', 'fddfdf', 'dffdfd', '2026-04-30', 'dfdfd', 'dfdffd', 'formalizado'),
(6, '20-2323', 'dsdsds', 'dsdssd', 'dssdds', '2026-04-24', 'GFGF', 'dsdds', 'formalizado'),
(7, 'sddds', 'sdds', 'dssdds', 'sdsdds', '2026-04-25', 'fdfd', 'fdfd', 'archivado'),
(8, '152-2026', 'MIGUEL ANGEL', 'JUAN PEREZ', 'ROBO ', '2026-04-22', '3RA FISCALIA', 'MARITA', 'archivado'),
(9, 'EW', 'EW', 'EW', 'EW', '0000-00-00', 'WEE', 'MARITA', 'archivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `clave`, `rol`) VALUES
(1, 'admin', '$2y$10$k/sX10Q3fMsGVh6hi594JODfoArD5H3E/C/Mv6BR9vAgTDrgdW6zS', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carpetas`
--
ALTER TABLE `carpetas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carpetas`
--
ALTER TABLE `carpetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
