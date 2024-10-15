-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2024 a las 02:12:58
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
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `students`
--

CREATE TABLE `students` (
  `id` int(6) UNSIGNED NOT NULL,
  `NombreAlum` varchar(30) NOT NULL,
  `ApellidoAlum` varchar(30) NOT NULL,
  `CursoAlum` varchar(30) NOT NULL,
  `NombreLib` varchar(30) NOT NULL,
  `Cantidad` int(6) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`id`, `NombreAlum`, `ApellidoAlum`, `CursoAlum`, `NombreLib`, `Cantidad`, `fecha`, `hora`) VALUES
(1, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(2, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(3, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(4, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(5, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(6, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(7, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(8, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00'),
(9, 'JERE', 'PALACIO', '4 5', 'ANASHE', 1, '2024-09-23', '21:03:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `students`
--
ALTER TABLE `students`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
