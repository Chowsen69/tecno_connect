-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-08-2023 a las 05:31:40
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
  `id_tamano` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_especialidades`
--

CREATE TABLE `t_especialidades` (
  `id_especialidad` int(11) NOT NULL,
  `especialidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_habilidades`
--

CREATE TABLE `t_habilidades` (
  `id_habilidad` int(11) NOT NULL,
  `habilidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_postulaciones`
--

CREATE TABLE `t_postulaciones` (
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
  `titulo` int(11) NOT NULL,
  `descripcion` int(11) NOT NULL,
  `pago_min` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_relaciones_sub_habilidades_servicios`
--

CREATE TABLE `t_relaciones_sub_habilidades_servicios` (
  `id_relacion_sub_habilidades_servicios` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_sub_habilidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_relaciones_tec_esp`
--

CREATE TABLE `t_relaciones_tec_esp` (
  `id_relacion_tec_esp` int(11) NOT NULL,
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
(14, 'Tecnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_servicios`
--

CREATE TABLE `t_servicios` (
  `id_servicio` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `id_ubicacion` tinyint(4) NOT NULL,
  `pago_min` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_sub_habilidades`
--

CREATE TABLE `t_sub_habilidades` (
  `id_sub_habilidad` int(11) NOT NULL,
  `id_habilidad` int(11) NOT NULL,
  `sub_habilidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tamanos`
--

CREATE TABLE `t_tamanos` (
  `id_tamano` int(11) NOT NULL,
  `tamano` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tecnicas`
--

CREATE TABLE `t_tecnicas` (
  `id_tecnica` int(11) NOT NULL,
  `tecnica` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `id_especialidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_tipos`
--

CREATE TABLE `t_tipos` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ubicaciones`
--

CREATE TABLE `t_ubicaciones` (
  `id_ubicacion` tinyint(4) NOT NULL,
  `ubicacion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(2, 14, 'tecnico@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-05'),
(3, 13, 'empresa@gmail.com', '123', '../../publico/img/avatar/por_defecto.png', '../../publico/img/portada/por_defecto.png', '2023-08-05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `id_usuario` (`id_usuario`,`id_tipo`,`id_tamano`),
  ADD KEY `t_empresa->t_tipos` (`id_tipo`),
  ADD KEY `t_empresa->t_tamanos` (`id_tamano`);

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
-- Indices de la tabla `t_postulaciones`
--
ALTER TABLE `t_postulaciones`
  ADD PRIMARY KEY (`id_postulacion`),
  ADD KEY `id_tecnico` (`id_tecnico`,`id_propuesta`),
  ADD KEY `t_postulaciones->t_propuestas` (`id_propuesta`);

--
-- Indices de la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  ADD PRIMARY KEY (`id_propuesta`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `t_relaciones_sub_habilidades_servicios`
--
ALTER TABLE `t_relaciones_sub_habilidades_servicios`
  ADD PRIMARY KEY (`id_relacion_sub_habilidades_servicios`),
  ADD KEY `id_servicio` (`id_servicio`,`id_sub_habilidad`),
  ADD KEY `id_sub_habilidad` (`id_sub_habilidad`);

--
-- Indices de la tabla `t_relaciones_tec_esp`
--
ALTER TABLE `t_relaciones_tec_esp`
  ADD PRIMARY KEY (`id_relacion_tec_esp`),
  ADD KEY `id_tecnica` (`id_tecnica`,`id_especialidad`),
  ADD KEY `relacion->t_especialidad` (`id_especialidad`);

--
-- Indices de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`id_rol`);

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
  ADD KEY `t-tecnicos->t_especialidad` (`id_especialidad`);

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
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_especialidades`
--
ALTER TABLE `t_especialidades`
  MODIFY `id_especialidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_habilidades`
--
ALTER TABLE `t_habilidades`
  MODIFY `id_habilidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_postulaciones`
--
ALTER TABLE `t_postulaciones`
  MODIFY `id_postulacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  MODIFY `id_propuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_relaciones_sub_habilidades_servicios`
--
ALTER TABLE `t_relaciones_sub_habilidades_servicios`
  MODIFY `id_relacion_sub_habilidades_servicios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_relaciones_tec_esp`
--
ALTER TABLE `t_relaciones_tec_esp`
  MODIFY `id_relacion_tec_esp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `id_rol` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `t_sub_habilidades`
--
ALTER TABLE `t_sub_habilidades`
  MODIFY `id_sub_habilidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tamanos`
--
ALTER TABLE `t_tamanos`
  MODIFY `id_tamano` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tecnicas`
--
ALTER TABLE `t_tecnicas`
  MODIFY `id_tecnica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_tipos`
--
ALTER TABLE `t_tipos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_ubicaciones`
--
ALTER TABLE `t_ubicaciones`
  MODIFY `id_ubicacion` tinyint(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_empresas`
--
ALTER TABLE `t_empresas`
  ADD CONSTRAINT `t_empresa->t_tamanos` FOREIGN KEY (`id_tamano`) REFERENCES `t_tamanos` (`id_tamano`),
  ADD CONSTRAINT `t_empresa->t_tipos` FOREIGN KEY (`id_tipo`) REFERENCES `t_tipos` (`id_tipo`),
  ADD CONSTRAINT `t_empresas->t_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `t_postulaciones`
--
ALTER TABLE `t_postulaciones`
  ADD CONSTRAINT `t_postulaciones->t_propuestas` FOREIGN KEY (`id_propuesta`) REFERENCES `t_propuestas` (`id_propuesta`),
  ADD CONSTRAINT `t_postulaciones->t_tecnicos` FOREIGN KEY (`id_tecnico`) REFERENCES `t_tecnicos` (`id_tecnico`);

--
-- Filtros para la tabla `t_propuestas`
--
ALTER TABLE `t_propuestas`
  ADD CONSTRAINT `propuesta->empresa` FOREIGN KEY (`id_empresa`) REFERENCES `t_empresas` (`id_empresa`);

--
-- Filtros para la tabla `t_relaciones_sub_habilidades_servicios`
--
ALTER TABLE `t_relaciones_sub_habilidades_servicios`
  ADD CONSTRAINT `t_relacion->t_servicios` FOREIGN KEY (`id_servicio`) REFERENCES `t_servicios` (`id_servicio`),
  ADD CONSTRAINT `t_relaciones_sub_habilidades_servicios_ibfk_1` FOREIGN KEY (`id_sub_habilidad`) REFERENCES `t_sub_habilidades` (`id_sub_habilidad`);

--
-- Filtros para la tabla `t_relaciones_tec_esp`
--
ALTER TABLE `t_relaciones_tec_esp`
  ADD CONSTRAINT `relacion->t_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `t_especialidades` (`id_especialidad`),
  ADD CONSTRAINT `relacion->t_tecnica` FOREIGN KEY (`id_tecnica`) REFERENCES `t_tecnicas` (`id_tecnica`);

--
-- Filtros para la tabla `t_servicios`
--
ALTER TABLE `t_servicios`
  ADD CONSTRAINT `t_servicios->t_tecnicos` FOREIGN KEY (`id_servicio`) REFERENCES `t_tecnicos` (`id_tecnico`),
  ADD CONSTRAINT `t_servicios->t_ubicaciones` FOREIGN KEY (`id_ubicacion`) REFERENCES `t_ubicaciones` (`id_ubicacion`);

--
-- Filtros para la tabla `t_sub_habilidades`
--
ALTER TABLE `t_sub_habilidades`
  ADD CONSTRAINT `t_sub_habilidades_ibfk_1` FOREIGN KEY (`id_habilidad`) REFERENCES `t_habilidades` (`id_habilidad`);

--
-- Filtros para la tabla `t_tecnicas`
--
ALTER TABLE `t_tecnicas`
  ADD CONSTRAINT `t_tecnicas_ibfk_1` FOREIGN KEY (`id_tecnica`) REFERENCES `t_relaciones_tec_esp` (`id_tecnica`);

--
-- Filtros para la tabla `t_tecnicos`
--
ALTER TABLE `t_tecnicos`
  ADD CONSTRAINT `t-tecnicos->t_especialidad` FOREIGN KEY (`id_especialidad`) REFERENCES `t_especialidades` (`id_especialidad`),
  ADD CONSTRAINT `t_tecnicos->t_postulaciones` FOREIGN KEY (`id_tecnico`) REFERENCES `t_postulaciones` (`id_tecnico`),
  ADD CONSTRAINT `t_tecnicos->t_tecnica` FOREIGN KEY (`id_tecnica`) REFERENCES `t_tecnicas` (`id_tecnica`);

--
-- Filtros para la tabla `t_ubicaciones`
--
ALTER TABLE `t_ubicaciones`
  ADD CONSTRAINT `t_ubicaciones_ibfk_1` FOREIGN KEY (`id_ubicacion`) REFERENCES `t_servicios` (`id_ubicacion`);

--
-- Filtros para la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD CONSTRAINT `t_usuarios->rol` FOREIGN KEY (`id_rol`) REFERENCES `t_roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
