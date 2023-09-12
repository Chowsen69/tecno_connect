-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2023 a las 04:29:34
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
(17, 40, 'BeatCore', 123456789, 'Rafael Castillo', 'https://dsdesarrollo.com.ar/beatcore', 'Red social', 1, 1, '2023-09-06');

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
(5, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_postulantes`
--

CREATE TABLE `t_postulantes` (
  `id_postulacion` int(11) NOT NULL,
  `id_tecnico` int(11) NOT NULL,
  `id_propuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(53, 41, 5),
(54, 41, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_servicios`
--

CREATE TABLE `t_servicios` (
  `id_servicio` int(11) NOT NULL,
  `perfil_tec` varchar(500) NOT NULL,
  `curriculum` varchar(100) DEFAULT NULL,
  `id_ubicacion` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_servicios`
--

INSERT INTO `t_servicios` (`id_servicio`, `perfil_tec`, `curriculum`, `id_ubicacion`) VALUES
(41, '', 'usuario41.pdf', 2);

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
(10, 2, 'Adobe Photoshop');

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
(40, 'Nicolas Leonel', 'Corbalan', 46757313, 2, 1, '2023-09-05'),
(41, 'Santiago Geremias', 'Moyano', 46723531, 2, 1, '2023-09-06');

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
  `id_validacion` int(11) DEFAULT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `id_rol`, `gmail`, `contrasena`, `avatar`, `portada`, `id_validacion`, `fecha_creacion`) VALUES
(40, 15, 'nicolaslc.main@gmail.com', '$2y$10$vt/MXYcG/UVKlgdFEtp5IePR5VHCqjhv4yYgfuB/q4obeKolaiJi.', 'usuario40.jpeg', 'usuario40.jpeg', 3, '2023-09-05'),
(41, 14, 'moyano@gmail.com', '$2y$10$0rxD8IlmIt9JZq4FjVbjI.IptvNJ5rrq3RhuTjmVHt/ZZ7bLOLbiG', 'usuario41.png', 'usuario41.png', 3, '2023-09-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_validaciones`
--

CREATE TABLE `t_validaciones` (
  `id_validacion` int(11) NOT NULL,
  `validacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `t_validaciones`
--

INSERT INTO `t_validaciones` (`id_validacion`, `validacion`) VALUES
(1, 'En proceso'),
(2, 'Rechazado'),
(3, 'Aceptado');

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
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_validacion` (`id_validacion`);

--
-- Indices de la tabla `t_validaciones`
--
ALTER TABLE `t_validaciones`
  ADD PRIMARY KEY (`id_validacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `t_especialidades`
--
ALTER TABLE `t_especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `t_habilidades`
--
ALTER TABLE `t_habilidades`
  MODIFY `id_habilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `t_postulantes`
--
ALTER TABLE `t_postulantes`
  MODIFY `id_postulacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  MODIFY `id_propuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `t_sub_habilidades`
--
ALTER TABLE `t_sub_habilidades`
  MODIFY `id_sub_habilidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `t_validaciones`
--
ALTER TABLE `t_validaciones`
  MODIFY `id_validacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  ADD CONSTRAINT `tamaño de empresa` FOREIGN KEY (`id_tamano`) REFERENCES `t_tamanos` (`id_tamano`),
  ADD CONSTRAINT `tipo de empresa` FOREIGN KEY (`id_tipo`) REFERENCES `t_tipos` (`id_tipo`),
  ADD CONSTRAINT `usuario dueño de la empresa` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_postulantes`
--
ALTER TABLE `t_postulantes`
  ADD CONSTRAINT `propuesta a la que se postuló` FOREIGN KEY (`id_propuesta`) REFERENCES `t_propuestas` (`id_propuesta`) ON DELETE CASCADE,
  ADD CONSTRAINT `tecnico postulado` FOREIGN KEY (`id_tecnico`) REFERENCES `t_tecnicos` (`id_tecnico`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  ADD CONSTRAINT `empresa que generó la propuesta` FOREIGN KEY (`id_empresa`) REFERENCES `t_empresas` (`id_empresa`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `servicio` FOREIGN KEY (`id_servicio`) REFERENCES `t_servicios` (`id_servicio`) ON DELETE CASCADE,
  ADD CONSTRAINT `sub-habilidad` FOREIGN KEY (`id_sub_habilidad`) REFERENCES `t_sub_habilidades` (`id_sub_habilidad`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_servicios`
--
ALTER TABLE `t_servicios`
  ADD CONSTRAINT `tecnico a el que le pertenece el servicio` FOREIGN KEY (`id_servicio`) REFERENCES `t_tecnicos` (`id_tecnico`) ON DELETE CASCADE,
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
  ADD CONSTRAINT `usuario a el que pertenece el técnico` FOREIGN KEY (`id_tecnico`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `Para corroborar si el usuario pasó la validación o no` FOREIGN KEY (`id_validacion`) REFERENCES `t_validaciones` (`id_validacion`),
  ADD CONSTRAINT `rol que cumple el usuario` FOREIGN KEY (`id_rol`) REFERENCES `t_roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
