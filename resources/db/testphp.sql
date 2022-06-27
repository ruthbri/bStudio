-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2022 a las 08:15:36
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `testphp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `idEvent` int(11) NOT NULL,
  `title` varchar(120) DEFAULT NULL,
  `dateinfo` datetime DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT 0,
  `evtType` varchar(45) DEFAULT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `events`
--

INSERT INTO `events` (`idEvent`, `title`, `dateinfo`, `enabled`, `evtType`, `idUser`) VALUES
(2, 'Ice cream competition', '2022-05-12 22:30:00', 1, 'other', 1),
(3, 'zoom call', '2022-05-20 22:31:09', 1, 'zoom', 2),
(4, 'week planning', '2022-05-02 15:00:00', 1, 'google-meet', 2),
(5, 'week planning', '2022-05-09 15:00:00', 1, 'google-meet', 2),
(6, 'week planning', '2022-05-16 15:00:00', 0, 'google-meet', 2),
(7, 'week planning', '2022-05-23 15:00:00', 1, 'google-meet', 2),
(8, 'week planning', '2022-05-30 15:00:00', 1, 'google-meet', 2),
(9, 'zoom call', '2022-05-11 22:31:09', 1, 'zoom', 1),
(10, 'zoom call', '2022-05-20 22:31:09', 1, 'zoom', 1),
(11, 'Product checkout', '2022-05-09 22:31:09', 1, 'office', 1),
(12, 'test event calendar', '2022-05-26 22:30:00', 1, 'other', 1),
(13, 'week planning', '2022-06-06 15:00:00', 1, 'google-meet', 2),
(14, 'week planning', '2022-04-25 15:00:00', 1, 'google-meet', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `salt` char(8) DEFAULT NULL,
  `avatar` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUser`, `name`, `email`, `username`, `password`, `salt`, `avatar`) VALUES
(1, 'Richard', 'richard@php.test', 'richard', '$2y$10$xiqDa5klw1jVziVE7vO75uGPHrEaZ006D3oZ3JrsIaLHF6WKFc1ke', 'xzy1233', 'avatar02.jpg'),
(2, 'Tanya', 'tanya@php.test', 'tanya', '$2y$10$iiXsptIn5awTwA3A/SMC5edVxmyak37IO.qHsFIxkPrXhuDCyG2Vm', 'abc9877', 'new.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `fk_events_users_idx` (`idUser`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `idEvent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_events_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
