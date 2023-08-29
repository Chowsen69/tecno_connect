-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2023 a las 20:03:17
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecno_connect`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_empresas`
--

CREATE TABLE `t_empresas` (
  `id_empresa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `cuit` int(11) NOT NULL,
  `localidad` varchar(255) NOT NULL,
  `sitio_web` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_tamano` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_empresas`
--

INSERT INTO `t_empresas` (`id_empresa`, `id_usuario`, `nombre_empresa`, `cuit`, `localidad`, `sitio_web`, `sector`, `id_tipo`, `id_tamano`, `fecha_creacion`) VALUES
(7, 19, 'Covidelpi', 2147483647, 'Virrey del Pino', '', 'Redes', 1, 3, '2023-08-17'),
(8, 22, 'CUDI', 2147483647, 'Gonzalez Catán', 'https://www.cudi.ar', 'Educación', 3, 3, '2023-08-18'),
(9, 18, 'BeatCore', 154845210, 'Rafael Castillo', '', 'Venta de servicios', 1, 1, '2023-08-18'),
(10, 24, 'La serenísima', 2147483647, 'El palomar', 'https://www.laserenisima.com.ar', 'Elaboración y comercialización de productos alimenticios', 1, 4, '2023-08-18'),
(11, 26, 'Capcom', 2147483647, 'Gregorio Laferrer', '', '', 1, 4, '2023-08-21'),
(12, 27, 'Twitter', 2147483647, 'Virrey del Pino', 'https://twitter.com', 'Red social', 1, 4, '2023-08-21'),
(13, 28, 'Empresa ejemplo', 123455666, 'Gonzalez Catan', '', 'Tecnología', 1, 4, '2023-08-23'),
(14, 32, 'Empresa de estafas', 2147483647, 'Anonimo', '', 'Estafas', 3, 1, '2023-08-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_especialidades`
--

CREATE TABLE `t_especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `especialidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_especialidades`
--

INSERT INTO `t_especialidades` (`id_especialidad`, `especialidad`) VALUES
(1, 'Programación'),
(2, 'Informática'),
(3, 'Alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_habilidades`
--

CREATE TABLE `t_habilidades` (
  `id_habilidad` int(11) NOT NULL,
  `habilidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_habilidades`
--

INSERT INTO `t_habilidades` (`id_habilidad`, `habilidad`) VALUES
(1, 'Programación'),
(2, 'Diseño'),
(4, 'Habilidad de ejemplo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_postulantes`
--

CREATE TABLE `t_postulantes` (
  `id_postulacion` int(11) NOT NULL,
  `id_tecnico` int(11) NOT NULL,
  `id_propuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_postulantes`
--

INSERT INTO `t_postulantes` (`id_postulacion`, `id_tecnico`, `id_propuesta`) VALUES
(49, 18, 20),
(41, 18, 21),
(59, 18, 28),
(58, 18, 30),
(64, 18, 34),
(57, 20, 29),
(53, 21, 28),
(52, 21, 29),
(51, 21, 31),
(37, 23, 21),
(62, 23, 28),
(45, 23, 29),
(46, 23, 30),
(61, 23, 31),
(60, 23, 32),
(55, 25, 28),
(54, 25, 29),
(63, 29, 33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_propuestas`
--

CREATE TABLE `t_propuestas` (
  `id_propuesta` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descr` varchar(300) NOT NULL,
  `pago_min` varchar(50) NOT NULL,
  `limite` date DEFAULT NULL,
  `fecha_publicacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_propuestas`
--

INSERT INTO `t_propuestas` (`id_propuesta`, `id_empresa`, `titulo`, `descr`, `pago_min`, `limite`, `fecha_publicacion`) VALUES
(20, 7, 'Primer propuesta', 'Estoy generando la primer propuesta!', 'Negociable', '2023-06-20', '2023-08-18'),
(21, 7, 'Segunda propuesta', 'Estoy generando una segunda propuesta', '50000', '2000-02-20', '2023-08-18'),
(28, 9, 'Propuesta con cuenta de administrador', 'Estoy viendo si puedo generar propuestas nuevas con la vista de administrador', 'Negociable', '2025-06-20', '2023-08-18'),
(29, 9, 'Web Developer', 'Estoy desarrollando una red social para beatboxers, y necesito a alguien para que le de un buen diseño a la plataforma', 'Negociable', '2023-09-20', '2023-08-18'),
(30, 8, 'Sistema para tomar asistencia', 'Queremos un sistema que nos permita tomar la asistencia de alumnos, profesores, directivos y porteros.', '25000', '2023-09-18', '2023-08-18'),
(31, 10, 'Necesitamos a un contador', '', '1700 x hora', '2023-08-25', '2023-08-18'),
(32, 9, 'Propuesta de ejemplo', 'Una descripción de ejemplo', '4500', '2023-08-20', '2023-08-21'),
(33, 13, 'Propuesta de ejemplo0', 'bla bla bla ', 'Negociable', '2023-08-24', '2023-08-23'),
(34, 9, 'Análisis foda', 'ASDASDASDADS', 'Negociable', '2023-08-26', '2023-08-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_relaciones_tec_esp`
--

CREATE TABLE `t_relaciones_tec_esp` (
  `id_relacion` int(11) NOT NULL,
  `id_tecnica` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_roles`
--

CREATE TABLE `t_roles` (
  `id_rol` tinyint(4) NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_roles`
--

INSERT INTO `t_roles` (`id_rol`, `rol`) VALUES
(13, 'Empresa'),
(14, 'Tecnico'),
(15, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_r_sub_habilidad_servicio`
--

CREATE TABLE `t_r_sub_habilidad_servicio` (
  `id_relacion` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_sub_habilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_r_sub_habilidad_servicio`
--

INSERT INTO `t_r_sub_habilidad_servicio` (`id_relacion`, `id_servicio`, `id_sub_habilidad`) VALUES
(1, 20, 3),
(4, 20, 5),
(5, 20, 5),
(2, 20, 6),
(3, 20, 7),
(8, 23, 3),
(9, 23, 4),
(10, 23, 5),
(11, 23, 6),
(12, 23, 7),
(13, 23, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_servicios`
--

CREATE TABLE `t_servicios` (
  `id_servicio` int(11) NOT NULL,
  `perfil_tec` varchar(500) NOT NULL,
  `id_ubicacion` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_servicios`
--

INSERT INTO `t_servicios` (`id_servicio`, `perfil_tec`, `id_ubicacion`) VALUES
(20, 'ASDASDASDASD', 3),
(23, 'ASDASDASDASD', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_sub_habilidades`
--

CREATE TABLE `t_sub_habilidades` (
  `id_sub_habilidad` int(11) NOT NULL,
  `id_habilidad` int(11) NOT NULL,
  `sub_habilidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_sub_habilidades`
--

INSERT INTO `t_sub_habilidades` (`id_sub_habilidad`, `id_habilidad`, `sub_habilidad`) VALUES
(1, 1, 'C++'),
(2, 1, 'Python'),
(3, 1, 'JavaScript'),
(4, 1, 'C#'),
(5, 1, 'HTML'),
(6, 1, 'CSS'),
(7, 1, 'PHP'),
(8, 2, 'UX'),
(9, 2, 'UI'),
(10, 2, 'Adobe Photoshop'),
(11, 4, 'Ej 1'),
(12, 4, 'Ej 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tamanos`
--

CREATE TABLE `t_tamanos` (
  `id_tamano` int(11) NOT NULL,
  `tamano` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_tamanos`
--

INSERT INTO `t_tamanos` (`id_tamano`, `tamano`) VALUES
(1, 'Microempresa (0 - 9 empleados)'),
(2, 'Empresa pequeña (10 - 49 empleados)'),
(3, 'Empresa mediana (50 - 249 empleados)'),
(4, 'Empresa grande (250 o más empleados)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tecnicas`
--

CREATE TABLE `t_tecnicas` (
  `id_tecnica` int(11) NOT NULL,
  `tecnica` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_tecnicas`
--

INSERT INTO `t_tecnicas` (`id_tecnica`, `tecnica`) VALUES
(2, 'E.E.S.T.N°14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tecnicos`
--

CREATE TABLE `t_tecnicos` (
  `id_tecnico` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dni` int(8) NOT NULL,
  `id_tecnica` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_tecnicos`
--

INSERT INTO `t_tecnicos` (`id_tecnico`, `nombre`, `apellido`, `dni`, `id_tecnica`, `id_especialidad`, `fecha_creacion`) VALUES
(18, 'Nicolas Leonel', 'Corbalan', 46757313, 2, 1, '2023-08-17'),
(20, 'Ramiro', 'Garcia', 46855412, 2, 1, '2023-08-17'),
(21, 'Ailin Mara', 'Villar', 46574523, 2, 3, '2023-08-18'),
(23, 'Ramon Gabriel', 'Pinto', 46854753, 2, 1, '2023-08-18'),
(25, 'Santiago David', 'Garcia', 46588121, 2, 2, '2023-08-18'),
(29, 'Tecnico', '123', 46757313, 2, 1, '2023-08-23'),
(30, 'Tecnico de pruebaa', 'asjldkdasjklasdjkl', 1231232, 2, 1, '2023-08-23'),
(31, 'Chanchito', 'Feliz', 46757313, 2, 2, '2023-08-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipos`
--

CREATE TABLE `t_tipos` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_tipos`
--

INSERT INTO `t_tipos` (`id_tipo`, `tipo`) VALUES
(1, 'Empresa pública'),
(2, 'Autónomo'),
(3, 'Organismo gubernamental'),
(4, 'Organización sin ánimo de lucro'),
(5, 'Empresa individual'),
(6, 'De financiación privada'),
(7, 'Asociación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ubicaciones`
--

CREATE TABLE `t_ubicaciones` (
  `id_ubicacion` tinyint(4) NOT NULL,
  `ubicacion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_ubicaciones`
--

INSERT INTO `t_ubicaciones` (`id_ubicacion`, `ubicacion`) VALUES
(1, 'Remoto'),
(2, 'Físico'),
(3, 'Híbrido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` tinyint(4) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `avatar` varchar(500) NOT NULL,
  `portada` varchar(500) NOT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `id_rol`, `gmail`, `contrasena`, `avatar`, `portada`, `fecha_creacion`) VALUES
(18, 15, 'lele@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-17'),
(19, 13, 'covidelpi@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-17'),
(20, 14, 'ramiro@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-17'),
(21, 14, 'mara@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-17'),
(22, 13, 'cudi@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-17'),
(23, 14, 'ramon@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-18'),
(24, 13, 'serenisima@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-18'),
(25, 14, 'santiago.garcia@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-18'),
(26, 13, 'capcom@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-21'),
(27, 13, 'twitter@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-21'),
(28, 13, 'empresa_ejemplo@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-23'),
(29, 14, 'tecnico_ejemplo@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-23'),
(30, 14, 'tecnico@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-23'),
(31, 14, 'tecnico2@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-23'),
(32, 13, 'empresa@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-23'),
(33, 13, 'empresa2@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `id_usuario` (`id_usuario`,`id_tipo`,`id_tamano`),
  ADD KEY `tamaño de empresa` (`id_tamano`),
  ADD KEY `tipo de empresa` (`id_tipo`);

--
-- Indices de la tabla `t_especialidades`
--
ALTER TABLE `t_especialidades`
  ADD PRIMARY KEY (`id_especialidad`);

--
-- Indices de la tabla `t_habilidades`
--
ALTER TABLE `t_habilidades`
  ADD PRIMARY KEY (`id_habilidad`);

--
-- Indices de la tabla `t_postulantes`
--
ALTER TABLE `t_postulantes`
  ADD PRIMARY KEY (`id_postulacion`),
  ADD KEY `id_tecnico` (`id_tecnico`,`id_propuesta`),
  ADD KEY `propuesta a la que se postuló` (`id_propuesta`);

--
-- Indices de la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  ADD PRIMARY KEY (`id_propuesta`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `t_relaciones_tec_esp`
--
ALTER TABLE `t_relaciones_tec_esp`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `id_tecnica` (`id_tecnica`,`id_especialidad`),
  ADD KEY `especialidad` (`id_especialidad`);

--
-- Indices de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `t_r_sub_habilidad_servicio`
--
ALTER TABLE `t_r_sub_habilidad_servicio`
  ADD PRIMARY KEY (`id_relacion`),
  ADD KEY `id_servicio` (`id_servicio`,`id_sub_habilidad`),
  ADD KEY `sub-habilidad` (`id_sub_habilidad`);

--
-- Indices de la tabla `t_servicios`
--
ALTER TABLE `t_servicios`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `id_ubicacion` (`id_ubicacion`);

--
-- Indices de la tabla `t_sub_habilidades`
--
ALTER TABLE `t_sub_habilidades`
  ADD PRIMARY KEY (`id_sub_habilidad`),
  ADD KEY `id_habilidad` (`id_habilidad`);

--
-- Indices de la tabla `t_tamanos`
--
ALTER TABLE `t_tamanos`
  ADD PRIMARY KEY (`id_tamano`);

--
-- Indices de la tabla `t_tecnicas`
--
ALTER TABLE `t_tecnicas`
  ADD PRIMARY KEY (`id_tecnica`);

--
-- Indices de la tabla `t_tecnicos`
--
ALTER TABLE `t_tecnicos`
  ADD PRIMARY KEY (`id_tecnico`),
  ADD KEY `id_tecnica` (`id_tecnica`,`id_especialidad`),
  ADD KEY `especialidad del técnico` (`id_especialidad`);

--
-- Indices de la tabla `t_tipos`
--
ALTER TABLE `t_tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `t_ubicaciones`
--
ALTER TABLE `t_ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `t_especialidades`
--
ALTER TABLE `t_especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_habilidades`
--
ALTER TABLE `t_habilidades`
  MODIFY `id_habilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `t_postulantes`
--
ALTER TABLE `t_postulantes`
  MODIFY `id_postulacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  MODIFY `id_propuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `t_relaciones_tec_esp`
--
ALTER TABLE `t_relaciones_tec_esp`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `id_rol` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `t_r_sub_habilidad_servicio`
--
ALTER TABLE `t_r_sub_habilidad_servicio`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `t_sub_habilidades`
--
ALTER TABLE `t_sub_habilidades`
  MODIFY `id_sub_habilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `t_tamanos`
--
ALTER TABLE `t_tamanos`
  MODIFY `id_tamano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `t_tecnicas`
--
ALTER TABLE `t_tecnicas`
  MODIFY `id_tecnica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `t_tipos`
--
ALTER TABLE `t_tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `t_ubicaciones`
--
ALTER TABLE `t_ubicaciones`
  MODIFY `id_ubicacion` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  ADD CONSTRAINT `tamaño de empresa` FOREIGN KEY (`id_tamano`) REFERENCES `t_tamanos` (`id_tamano`),
  ADD CONSTRAINT `tipo de empresa` FOREIGN KEY (`id_tipo`) REFERENCES `t_tipos` (`id_tipo`),
  ADD CONSTRAINT `usuario dueño de la empresa` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `t_postulantes`
--
ALTER TABLE `t_postulantes`
  ADD CONSTRAINT `propuesta a la que se postuló` FOREIGN KEY (`id_propuesta`) REFERENCES `t_propuestas` (`id_propuesta`),
  ADD CONSTRAINT `tecnico postulado` FOREIGN KEY (`id_tecnico`) REFERENCES `t_tecnicos` (`id_tecnico`);

--
-- Filtros para la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  ADD CONSTRAINT `empresa que generó la propuesta` FOREIGN KEY (`id_empresa`) REFERENCES `t_empresas` (`id_empresa`);

--
-- Filtros para la tabla `t_relaciones_tec_esp`
--
ALTER TABLE `t_relaciones_tec_esp`
  ADD CONSTRAINT `especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `t_especialidades` (`id_especialidad`),
  ADD CONSTRAINT `tecnica` FOREIGN KEY (`id_tecnica`) REFERENCES `t_tecnicas` (`id_tecnica`);

--
-- Filtros para la tabla `t_r_sub_habilidad_servicio`
--
ALTER TABLE `t_r_sub_habilidad_servicio`
  ADD CONSTRAINT `servicio` FOREIGN KEY (`id_servicio`) REFERENCES `t_servicios` (`id_servicio`),
  ADD CONSTRAINT `sub-habilidad` FOREIGN KEY (`id_sub_habilidad`) REFERENCES `t_sub_habilidades` (`id_sub_habilidad`);

--
-- Filtros para la tabla `t_servicios`
--
ALTER TABLE `t_servicios`
  ADD CONSTRAINT `ubicación (remoto-físico)` FOREIGN KEY (`id_ubicacion`) REFERENCES `t_ubicaciones` (`id_ubicacion`);

--
-- Filtros para la tabla `t_sub_habilidades`
--
ALTER TABLE `t_sub_habilidades`
  ADD CONSTRAINT `la sub-habilidad de una habilidad` FOREIGN KEY (`id_habilidad`) REFERENCES `t_habilidades` (`id_habilidad`);

--
-- Filtros para la tabla `t_tecnicos`
--
ALTER TABLE `t_tecnicos`
  ADD CONSTRAINT `especialidad del técnico` FOREIGN KEY (`id_especialidad`) REFERENCES `t_especialidades` (`id_especialidad`),
  ADD CONSTRAINT `técnica en la que se recibió` FOREIGN KEY (`id_tecnica`) REFERENCES `t_tecnicas` (`id_tecnica`),
  ADD CONSTRAINT `usuario a el que pertenece el técnico` FOREIGN KEY (`id_tecnico`) REFERENCES `t_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `rol que cumple el usuario` FOREIGN KEY (`id_rol`) REFERENCES `t_roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
