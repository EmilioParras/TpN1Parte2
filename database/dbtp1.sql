-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2022 a las 20:56:06
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbtp1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombreCategoria` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombreCategoria`, `descripcion`) VALUES
(1, 'Urbana', 'Zapatillas urbanas para el dia a dia.'),
(2, 'Deportiva', 'Zapatillas deportivas ideales para todo tipo de actividad.'),
(3, 'Montaña', 'Zapatillas ideales para un paseo por las montañas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('usuario','administrador') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `rol`) VALUES
(1, 'email@gmail.com', '$2a$12$hTjElN81AfdHXgdkoM8oieKl7jAlP3t/Pq308IsDrmEVRx9XSNrwO', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zapatillas`
--

CREATE TABLE `zapatillas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `precio` int(200) NOT NULL,
  `talle` varchar(200) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `id_categoria_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zapatillas`
--

INSERT INTO `zapatillas` (`id`, `nombre`, `marca`, `precio`, `talle`, `imagen`, `id_categoria_fk`) VALUES
(1, 'Nike Air Force 1', 'Nike', 25000, '39-40-41-41.5', './imagenes/ZapatillasUrbanas/NikeAirForce1.jpg', 1),
(2, 'Adidas Breaknet', 'Adidas', 25000, '39-40-41 ', './imagenes/ZapatillasUrbanas/AdidasBreaknet.jpg', 1),
(3, 'Vans U Old Skool', 'Vans', 15000, '39-40-41-41.5-42', './imagenes/ZapatillasUrbanas/VansUOldSkool.jpg', 1),
(4, 'Jhon Foos Claw Black', 'Jhon Foos', 25000, '40-41-42', './imagenes/ZapatillasUrbanas/JhonFoosClawBlack.jpg', 1),
(117, 'Zapatillas Air Max Sc', 'Nike', 30000, '39-40-41', 'imagenes/634da1a1d99a3.jpg.jpeg.png', 2),
(119, 'Zapatillas Adidas Coreracer', 'Adidas', 23000, '40-41', 'imagenes/634da23858b5f.jpg.jpeg.png', 2),
(120, 'Zapatillas Nike Air Max Ap', 'Nike', 20000, '39-40-41', 'imagenes/634da2bfcb4e7.jpg.jpeg.png', 2),
(121, 'Zapatillas Salomon X Crest', 'Salomon', 40000, '40-41-42', 'imagenes/634da305f0ba7.jpg.jpeg.png', 3),
(122, 'Zapatillas Salomon Patrol', 'Salomon', 35000, '39-40', 'imagenes/634da333a7011.jpg.jpeg.png', 3),
(123, 'Zapatillas Salomon Daintree Mid Gore Tex M', 'Salomon', 41000, '39-39.5-40-41-42', 'imagenes/634da371d0375.jpg.jpeg.png', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria_fk` (`id_categoria_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `zapatillas`
--
ALTER TABLE `zapatillas`
  ADD CONSTRAINT `zapatillas_ibfk_1` FOREIGN KEY (`id_categoria_fk`) REFERENCES `categoria` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
