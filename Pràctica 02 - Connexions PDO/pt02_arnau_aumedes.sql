-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2025 a las 18:10:12
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
-- Base de datos: `pt02_arnau_aumedes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `titol` varchar(150) NOT NULL,
  `cos` text NOT NULL,
  `dni` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `titol`, `cos`, `dni`, `created_at`, `updated_at`) VALUES
(8, 'afdfdfs', 'dsfdsfsfds', 'csfdsaf', '2025-10-15 13:10:04', '2025-10-15 13:10:04'),
(9, 'eqwewqeqw', 'qwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweewqwewqeqweew', 'dddwqeqwe', '2025-10-15 14:04:07', '2025-10-15 14:04:07'),
(10, '555435345', 'sfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfasfasfaffsfa', 'dsasdasdsa', '2025-10-15 14:06:55', '2025-10-15 14:06:55'),
(11, 'dadsadada', 'egfrg gregwe gqergregrgergebe', '33123123', '2025-10-15 14:06:56', '2025-10-20 15:57:07'),
(13, '42141242', 'qwrqwrqefwrwr', 'e123', '2025-10-20 15:50:06', '2025-10-20 15:50:06'),
(14, 'e', 'e', 'e', '2025-10-20 16:05:36', '2025-10-20 16:05:36');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_articles_dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
