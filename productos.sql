-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-01-2022 a las 18:00:57
-- Versión del servidor: 5.7.33
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`) VALUES
(13, 'Fuentes'),
(14, 'Placas de vídeo'),
(15, 'Discos de almacenamiento'),
(16, 'Procesadores'),
(17, 'Cables y perifericos'),
(18, 'Sin clasificar'),
(19, 'Memorias RAM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `text` varchar(140) NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `user`, `score`, `text`, `product`) VALUES
(14, 'ryuma', 5, 'Funcionan todos los juegos\n', 11),
(15, 'ryuma', 5, 'Excelente grafica, no llego ni a palo a comprarla pero excelente grafica', 16),
(16, 'ryuma', 5, 'Excelente producto!', 18),
(17, 'ryuma', 4, 'No era mentira lo de las patadas, pero al menos pasa bien los datos', 21),
(19, 'ryuma', 5, 'Buen producto!', 22),
(20, 'Chuck', 1, 'El cable me toco descalzo y lo revente a patadas', 21),
(21, 'Chuck', 5, 'Me anda re bien el maincra', 11),
(22, 'Chuck', 5, 'La mire fijo y se quemo', 16),
(24, 'ElDemoledor', 1, 'Tu eres la enfermedad, y yo la cura...', 11),
(25, 'ElDemoledor', 1, 'Tu eres la enfermedad, y yo la cura...', 16),
(26, 'ElDemoledor', 1, 'Tu eres la enfermedad, y yo la cura...', 18),
(27, 'ElDemoledor', 1, 'Tu eres la enfermedad, y yo la cura...', 20),
(28, 'Terminator', 1, 'Hasta la vista baby', 11),
(29, 'Terminator', 1, 'Hasta la vista baby', 20),
(30, 'Terminator', 1, 'Hasta la vista baby', 21),
(31, 'Terminator', 5, 'Necesito una de esas', 23),
(32, 'alguien', 4, 'hola', 24),
(33, 'ryuma', 5, 'excelente', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(140) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `categoria`, `imagen`) VALUES
(11, 'GTX 1650 Super', 'placa de video de nvidia 4gb gddr6', 22000, 3000, 14, 'img/imagen-generica.jpg'),
(16, 'RTX 2060', 'Placa de video de la marca NVIDIA. 8GB gddr6 y chorrocientos cuda cores.', 100000, 2, 14, 'img/61eee16d021255.99297100.jpg'),
(18, 'Ryzen 3300x', 'Procesador de AMD 4 núcleos y 8 hilos, no posee gráficos integrados.', 13000, 5, 16, 'img/5fc3c07b1fff94.68703750.jpg'),
(20, 'ryzen 3600', 'Procesador de AMD 6 núcleos y 12 hilos, no posee gráficos integrados.', 22000, 6, 16, 'img/5fc3c09d4a9a01.29618458.jpg'),
(21, 'Cable usb', 'Cable para pasar datos, calibrar aparatos y que te agarre a patadas al conectarlo en la pc.', 1500, 2, 17, 'img/5fc2e37184ff44.70818010.png'),
(22, 'Intel core i3-9100F', 'procesador de intel novena generacion 4 nucleos y 4 hilos sin graficos integrados', 9000, 15, 16, 'img/5fc3bb518c9679.85931852.jpg'),
(23, 'Ram GSkill 8gb', '1x Ram GSkill 8gb DDR4 3200mhz ', 3500, 10, 19, 'img/61eee0e4a93906.53423946.jpg'),
(24, 'Thermaltake TR2-600', 'Fuente Thermaltake de 600 wats con certificacion 80plus-bronze', 20000, 10, 13, 'img/imagen-generica.jpg'),
(25, 'Marvo KG916 Scorpio', 'Teclado mecanico Marvo KG916 Scorpio retroiluminado con switches blue', 4000, 5, 17, 'img/5fc3cd43eed2c7.67270368.jpg'),
(26, 'ssd green 240gb', 'disco de estado solido', 5000, 20, 15, 'img/61eee1ac3db224.55576300.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nick` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nick`, `email`, `password`, `admin`) VALUES
(1, 'ryuma', 'juanbarthes@outlook.com', '$2y$10$BTYcOzOAxgfOk6O/qoG2aODn2inOxRvFu/GLcDb9/mO6fqb2Q2f12', 1),
(9, 'juan', 'juan@gmail.com', '$2y$10$ta0tzh.i9DTZ7xwA4kGcg./yhiN/GRKhwc.22KfhuClpNVAz1SrrG', 1),
(10, 'ChuckNorris', 'chuck@gmail.com', '$2y$10$nojp8ZKoSmE3/OATdc3ji.uVo666baPSI.0X8XZvFMNxG56M8SwGO', 1),
(13, 'Terminator', 'terminator@skynet.com', '$2y$10$Pz7YLAfjohhe/FcA9xAjZO2GBtNb3aTEJI8y7BZpYJgonThL8/bWK', 0),
(14, 'juan admin', 'juan@admin', '$2y$10$h.gfhSZo1g9EFvTuSwvWz.sFh0rC8OFK/7kxrGdnEB6.sDe58xpee', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_categoria` (`categoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
