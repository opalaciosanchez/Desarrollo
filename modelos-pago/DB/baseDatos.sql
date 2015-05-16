-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 27-01-2015 a las 19:14:17
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.6.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `teparatodos.com`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teteras`
--

CREATE TABLE `teteras` (
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `teteras`
--

INSERT INTO `teteras` (`nombre`, `imagen`, `descripcion`, `precio`) VALUES
('Tetera Fung Ling', 'tetera-fung-ling.jpg', 'Tetera de ceramica con filtro de acero inoxidable con capacidad de 0.4L\r\nCuenco de ceramica con capacidad de 0.2L', 9.95),
('Teteras inglesas', 'teteras_variadas.jpg', 'Teteras rojas y blancas con flores en acero esmaltado vitrificado. Con capacidad para 0.5L y 0.75L. Aptas para gas y eléctrica.', 16.50);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `teteras`
--
ALTER TABLE `teteras`
 ADD PRIMARY KEY (`nombre`);
