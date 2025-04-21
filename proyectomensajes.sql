-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2025 a las 23:21:03
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectomensajes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria`
--

CREATE TABLE `mensajeria` (
  `codigo` int(11) NOT NULL,
  `emisor` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  `asunto` varchar(20) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajeria`
--

INSERT INTO `mensajeria` (`codigo`, `emisor`, `destino`, `asunto`, `mensaje`, `fecha`) VALUES
(8001, 3012, 3011, 'Tarea', 'Pa cuando la tarea >:v', '2025-04-18'),
(8002, 3011, 3012, 'Tarea', 'Mi estimado compañero de estudio, presento una angustia relevante por la incomprensión de su estima con respecto al deber que se nos correspondió realizar de forma unida, espero con todo respeto que pueda comunicarse con mi persona para poder solucionar e', '2025-04-18'),
(8004, 3011, 3012, 'Tarea', 'ya te envie mi parte, me falta la tuya >:V', '2025-04-18'),
(8005, 3012, 3011, 'rthgfghnfghfgyh', 'tgrrtghrftghrftgdftg', '2025-04-18'),
(8006, 3012, 3011, 'rtggdftdfggdfdfg', 'dfggdfdfgfgddfgfgd', '2025-04-18'),
(8007, 3012, 3011, 'gdffggfgfhghf', 'fghgdfhghffghfghghffghfgh', '2025-04-18'),
(8008, 3012, 3011, 'Tarea', 'fdgfdgfgdfdgdfgdfg', '2025-04-18'),
(8009, 3013, 3012, 'Entretenimiento', 'Vamos a jugar genchin pobre de mierda', '2025-04-19'),
(8011, 3012, 3011, 'sdfsadf', 'asdfasdfasdfasdfasd', '2025-04-20'),
(8012, 3017, 3012, 'hhhhh', 'bebi ger', '2025-04-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `dni` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `fecha_nac` date NOT NULL,
  `celular` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`dni`, `nombre`, `apellido`, `fecha_nac`, `celular`) VALUES
(0, '', '', '0000-00-00', 0),
(22222222, 'la cucanba', 'Vargas ', '2019-05-07', 989012345),
(34567898, 'Frank', 'Sahe Itoshi', '2005-10-11', 234567895),
(60123456, 'Jhon', 'Rojas Quispe', '2006-07-25', 987654321),
(74621255, 'Frank Gabriel Silva', 'Litardo Genio', '2024-10-23', 987654321),
(74622222, 'la cucanbo', 'Vargas ', '2025-04-14', 989012345),
(74622233, 'vacalola', 'De la Cruz', '2025-04-16', 987654321),
(74622250, 'aaa', 'lll', '2025-04-24', 999999999),
(74622251, 'notocar', 'maritochiu', '2025-04-26', 987654321),
(74622252, 'madrianlaptm', 'Vargas ', '2019-05-07', 989012345),
(74622259, 'asd', 'asdd', '2025-04-08', 987654321),
(74622267, 'vacalola', 'Litardo Rupay', '2025-04-01', 987654321),
(74699912, 'Ruth Siomara', 'De la Cruz', '2005-09-28', 999999999);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ususarios`
--

CREATE TABLE `ususarios` (
  `codigo` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nom_user` varchar(35) NOT NULL,
  `contrasena` varchar(25) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ususarios`
--

INSERT INTO `ususarios` (`codigo`, `usuario`, `nom_user`, `contrasena`, `estado`) VALUES
(3011, 74699912, 'Blu Stard', '1234567', ''),
(3012, 34567898, 'Loky_Sae', '12345', ''),
(3013, 60123456, 'Diluc', 'j34n', ''),
(3016, 74622233, 'gatosfeos', '12', ''),
(3017, 74622250, 'ccc', '12', ''),
(3018, 74621255, 'Sae_Itoshi', '123', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `emisor` (`emisor`),
  ADD KEY `destino` (`destino`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `ususarios`
--
ALTER TABLE `ususarios`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8013;

--
-- AUTO_INCREMENT de la tabla `ususarios`
--
ALTER TABLE `ususarios`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3019;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  ADD CONSTRAINT `mensajeria_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `ususarios` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensajeria_ibfk_2` FOREIGN KEY (`destino`) REFERENCES `ususarios` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ususarios`
--
ALTER TABLE `ususarios`
  ADD CONSTRAINT `ususarios_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `persona` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
