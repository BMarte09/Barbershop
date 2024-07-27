-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2024 a las 17:43:37
-- Versión del servidor: 8.0.34
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barberiabd`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearCita` (IN `p_idcliente` INT, IN `p_idbarbero` INT, IN `p_Fecha_cita` DATE, IN `p_Hora_cita` TIME, IN `p_idservicio` INT, IN `p_Estado_cita` VARCHAR(20))   BEGIN
    INSERT INTO Citas (idcliente, idbarbero, Fecha_cita, Hora_cita, idservicio, Estado_cita)
    VALUES (p_idcliente, p_idbarbero, p_Fecha_cita, p_Hora_cita, p_idservicio, p_Estado_cita);

    SELECT LAST_INSERT_ID() AS idcita; -- Devuelve el ID de la cita insertada
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarBarbero` (IN `p_Nombre` VARCHAR(45), IN `p_Apellido` VARCHAR(45), IN `p_Celular` VARCHAR(15), IN `p_Correo` VARCHAR(45), IN `p_Contrasena` VARCHAR(20))   BEGIN
    DECLARE id_usuario INT;
    DECLARE Id_Rol INT DEFAULT 2; -- Rol de barbero 

    -- Insertar primero en la tabla Usuarios
    INSERT INTO Usuarios (Correo, Contraseña, Rol)
    VALUES (p_Correo, p_Contrasena, Id_Rol); -- Asignando rol 2 al barbero
    
    -- Obtener el ID del usuario insertado
    SET id_usuario = LAST_INSERT_ID();
    
    -- Insertar en la tabla Barberos
    INSERT INTO Barberos (Nombre, Apellido, Celular, idUsuario)
    VALUES (p_Nombre, p_Apellido, p_Celular, id_usuario);
    

    
    -- Finalizar el procedimiento
    SELECT 'Barbero registrado exitosamente' AS Resultado;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barberos`
--

CREATE TABLE `barberos` (
  `idBarbero` int NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `Estado` varchar(20) DEFAULT 'Inactivo',
  `Correo` varchar(50) DEFAULT 'example@example.com'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `barberos`
--

INSERT INTO `barberos` (`idBarbero`, `Nombre`, `Apellido`, `Celular`, `idUsuario`, `Estado`, `Correo`) VALUES
(1, 'Juan', 'Pérez', '8091234567', 9, 'Inactivo', 'example@example.com'),
(2, 'Mario', 'Rodríguez', '8092345678', 10, 'Inactivo', 'example@example.com'),
(3, 'Carlos', 'Sánchez', '8093456789', 11, 'Inactivo', 'example@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idcita` int NOT NULL,
  `idcliente` int NOT NULL,
  `idbarbero` int NOT NULL,
  `Fecha_cita` date NOT NULL,
  `Hora_cita` time NOT NULL,
  `idservicio` int NOT NULL,
  `Estado_cita` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcita`, `idcliente`, `idbarbero`, `Fecha_cita`, `Hora_cita`, `idservicio`, `Estado_cita`) VALUES
(1, 5, 1, '2024-07-09', '16:10:00', 1, 'Realizada'),
(2, 5, 2, '2024-07-13', '16:14:00', 1, 'Pendiente'),
(3, 5, 1, '2024-07-06', '15:12:00', 1, 'Pendiente'),
(4, 5, 1, '2024-07-11', '03:14:00', 1, 'Pendiente'),
(5, 5, 1, '2024-07-12', '15:14:00', 1, 'Pendiente'),
(6, 5, 1, '2024-07-12', '15:14:00', 1, 'Pendiente'),
(7, 5, 1, '2024-07-12', '15:14:00', 1, 'Pendiente'),
(8, 5, 1, '2024-07-12', '15:14:00', 1, 'Pendiente'),
(9, 5, 1, '2024-07-04', '14:20:00', 1, 'Pendiente'),
(10, 5, 1, '2024-07-04', '14:20:00', 1, 'Pendiente'),
(11, 5, 1, '2024-10-08', '14:22:00', 1, 'Pendiente'),
(12, 5, 1, '2024-07-04', '11:23:00', 2, 'Pendiente'),
(13, 3, 3, '2024-07-20', '23:33:00', 1, 'Pendiente'),
(14, 2, 1, '2024-07-13', '11:33:00', 2, 'Pendiente'),
(15, 2, 1, '2024-07-13', '11:33:00', 2, 'Pendiente'),
(16, 3, 3, '2024-07-12', '13:34:00', 1, 'Pendiente'),
(17, 3, 3, '2024-07-12', '13:34:00', 1, 'Pendiente'),
(18, 2, 2, '2024-07-04', '14:35:00', 1, 'Pendiente'),
(19, 2, 2, '2024-07-04', '14:35:00', 1, 'Pendiente'),
(20, 2, 2, '2024-07-12', '14:39:00', 2, 'Pendiente'),
(21, 2, 2, '2024-07-12', '14:39:00', 2, 'Pendiente'),
(22, 2, 2, '2024-07-12', '14:39:00', 2, 'Pendiente'),
(23, 3, 1, '2024-07-06', '23:41:00', 1, 'Pendiente'),
(24, 3, 1, '2024-07-06', '23:41:00', 1, 'Pendiente'),
(25, 2, 2, '2044-08-12', '14:42:00', 2, 'Pendiente'),
(26, 3, 1, '2024-07-12', '14:45:00', 1, 'Pendiente'),
(27, 5, 2, '2024-07-04', '01:08:00', 2, 'Pendiente'),
(28, 5, 1, '2024-07-20', '02:15:00', 1, 'Pendiente'),
(29, 5, 2, '2024-07-05', '03:25:00', 2, 'Pendiente'),
(30, 5, 2, '2024-07-05', '03:25:00', 2, 'Realizada'),
(31, 2, 3, '2024-07-11', '03:33:00', 1, 'Pendiente'),
(32, 2, 3, '2024-07-11', '03:33:00', 1, 'Pendiente'),
(33, 2, 3, '2024-07-08', '04:37:00', 2, 'Pendiente'),
(34, 5, 2, '2024-07-08', '03:38:00', 2, 'Pendiente'),
(35, 5, 2, '2024-07-08', '03:38:00', 2, 'Pendiente'),
(36, 5, 2, '2024-07-08', '03:38:00', 2, 'Pendiente'),
(37, 3, 3, '2024-07-25', '03:46:00', 2, 'Pendiente'),
(38, 3, 3, '2024-07-04', '04:49:00', 3, 'Pendiente'),
(39, 3, 3, '2024-07-08', '03:49:00', 1, 'Pendiente'),
(40, 3, 2, '2024-07-11', '00:51:00', 2, 'Pendiente'),
(41, 3, 2, '2024-07-11', '02:52:00', 2, 'Pendiente'),
(42, 2, 2, '2024-07-06', '03:53:00', 2, 'Pendiente'),
(43, 5, 3, '2024-07-05', '04:54:00', 2, 'Pendiente'),
(44, 3, 3, '2024-07-02', '02:57:00', 2, 'Pendiente'),
(45, 3, 2, '2024-07-05', '03:57:00', 2, 'Pendiente'),
(46, 5, 1, '2024-07-08', '13:05:00', 1, 'Pendiente'),
(47, 5, 1, '2024-07-08', '13:05:00', 1, 'Pendiente'),
(48, 3, 3, '2024-07-25', '05:07:00', 1, 'Pendiente'),
(49, 3, 3, '2024-07-25', '05:07:00', 1, 'Pendiente'),
(50, 3, 3, '2024-07-19', '05:07:00', 1, 'Pendiente'),
(51, 3, 3, '2024-07-19', '05:07:00', 1, 'Pendiente'),
(52, 3, 2, '2024-07-10', '01:11:00', 1, 'Pendiente'),
(53, 3, 2, '2024-07-10', '01:11:00', 1, 'Pendiente'),
(54, 3, 2, '2024-07-10', '01:11:00', 1, 'Pendiente'),
(55, 3, 3, '2024-07-04', '01:12:00', 2, 'Pendiente'),
(56, 3, 3, '2024-07-04', '01:12:00', 2, 'Pendiente'),
(57, 2, 3, '2024-07-10', '04:12:00', 3, 'Pendiente'),
(58, 3, 2, '2024-07-06', '03:14:00', 2, 'Pendiente'),
(59, 3, 2, '2024-07-11', '01:15:00', 1, 'Pendiente'),
(60, 5, 2, '2024-07-12', '01:17:00', 1, 'Pendiente'),
(61, 2, 3, '2024-07-03', '05:16:00', 2, 'Pendiente'),
(62, 5, 1, '2024-07-11', '04:19:00', 1, 'Pendiente'),
(63, 2, 3, '2024-07-11', '06:20:00', 2, 'Pendiente'),
(64, 2, 3, '2024-07-11', '06:20:00', 2, 'Pendiente'),
(65, 5, 3, '2024-07-18', '05:27:00', 1, 'Pendiente'),
(66, 2, 3, '2024-07-18', '01:31:00', 2, 'Realizada'),
(67, 2, 3, '2024-07-18', '01:31:00', 2, 'Realizada'),
(68, 3, 2, '2024-07-06', '01:31:00', 1, 'Realizada'),
(69, 3, 3, '2024-07-13', '01:32:00', 2, 'Confirmada'),
(70, 3, 3, '2024-07-05', '05:32:00', 1, 'Realizada'),
(71, 3, 3, '2024-07-05', '05:32:00', 1, 'Realizada'),
(72, 3, 3, '2024-07-05', '05:32:00', 1, 'Cancelada'),
(73, 3, 3, '2024-07-05', '05:32:00', 1, 'Cancelada'),
(74, 3, 3, '2024-07-05', '05:32:00', 1, 'Cancelada'),
(75, 3, 3, '2024-07-05', '05:32:00', 1, 'Cancelada'),
(76, 2, 2, '2024-07-04', '05:40:00', 2, 'Cancelada'),
(77, 2, 2, '2024-07-04', '05:40:00', 2, 'Cancelada'),
(78, 2, 2, '2024-07-04', '05:40:00', 2, 'Cancelada'),
(79, 2, 1, '2024-07-06', '03:39:00', 2, 'Cancelada'),
(80, 5, 2, '2024-07-17', '03:24:00', 1, 'Pendiente'),
(81, 5, 1, '2024-07-25', '07:00:00', 3, 'Pendiente'),
(82, 5, 1, '2024-07-24', '05:06:00', 1, 'Confirmada'),
(83, 5, 2, '2024-07-26', '05:13:00', 2, 'Cancelada'),
(84, 5, 1, '2024-07-23', '04:14:00', 2, 'Realizada'),
(85, 2, 1, '2024-07-27', '40:23:20', 2, 'Realizada'),
(86, 7, 1, '2024-07-27', '32:55:42', 3, 'Cancelada'),
(87, 7, 1, '2024-07-27', '12:55:42', 3, 'Cancelada'),
(88, 3, 2, '2024-06-12', '24:17:57', 1, 'Realizada'),
(89, 2, 2, '2024-06-26', '21:17:57', 4, ''),
(90, 3, 2, '2024-06-12', '24:17:57', 1, 'Realizada'),
(91, 2, 2, '2024-06-26', '21:17:57', 4, ''),
(92, 3, 2, '2024-06-12', '24:17:57', 1, 'Realizada'),
(93, 2, 2, '2024-06-26', '21:17:57', 4, ''),
(94, 3, 2, '2024-06-12', '24:17:57', 1, 'Realizada'),
(95, 2, 2, '2024-06-26', '21:17:57', 4, ''),
(96, 3, 2, '2024-06-12', '24:17:57', 1, 'Realizada'),
(97, 2, 2, '2024-06-26', '21:17:57', 4, ''),
(98, 3, 2, '2024-06-12', '24:17:57', 1, 'Realizada'),
(99, 2, 2, '2024-06-26', '21:17:57', 4, ''),
(100, 3, 2, '2024-06-12', '24:17:57', 1, 'Realizada'),
(101, 2, 2, '2024-06-26', '21:17:57', 4, ''),
(102, 2, 2, '2024-05-08', '21:20:37', 2, 'Realizada'),
(103, 3, 3, '2024-07-03', '15:20:37', 4, ''),
(104, 7, 2, '2024-07-27', '26:05:57', 1, 'Realizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Celular` varchar(15) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Dirección` text,
  `idUsuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idCliente`, `Nombre`, `Apellido`, `Celular`, `Correo`, `Dirección`, `idUsuario`) VALUES
(2, 'Lisbeth Chantal', 'Perez', '8095970940', 'lisbethperezcm07@gmail.com', NULL, 5),
(3, 'Lisbeth Chantal', 'Perez', '8095970940', 'bmm930928@gmail.com', NULL, 6),
(5, 'Lisbeth Chantal', 'Perez', '8095970940', 'lisbethperezcm@gmail.com', NULL, 8),
(6, '', '', '', '', NULL, 13),
(7, 'Lisbeth', 'Lisbeth Perez', '80958711111', 'lisbethperezcm3@gmail.com', NULL, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `idHorario` int NOT NULL,
  `IdBarbero` int NOT NULL,
  `Dia` varchar(10) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Fin` time NOT NULL,
  `Estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IDRol` int NOT NULL,
  `Rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IDRol`, `Rol`) VALUES
(1, 'ADMIN'),
(2, 'BARBERO'),
(3, 'CLIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idServicio` int NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Tarifa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idServicio`, `Nombre`, `Tarifa`) VALUES
(1, 'Corte de Pelo y Barba', 500.00),
(2, 'Corte de Barba', 200.00),
(3, 'Cerquillo', 150.00),
(4, 'Corte Pelo', 350.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Contraseña` varchar(20) NOT NULL,
  `Rol` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Correo`, `Contraseña`, `Rol`) VALUES
(5, 'lisbethperezcm07@gmail.com', '8095970940', 3),
(6, 'bmm930928@gmail.com', '8095970940', 3),
(8, 'lisbethperezcm@gmail.com', '8095970940', 3),
(9, 'juan.perez@gmail.com', 'password123', 2),
(10, 'mario.rodriguez@gmail.com', 'securepass', 2),
(11, 'carlos.sanchez@gmail.com', 'barbershop2023', 2),
(12, 'admin@gmail.com', '123456', 1),
(13, '', '8095970940', 3),
(14, 'lisbethperezcm3@gmail.com', '123456', 3);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_citas_detalladas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_citas_detalladas` (
`Estado_cita` varchar(20)
,`Fecha_cita` date
,`Hora_cita` time
,`idbarbero` int
,`idcita` int
,`idcliente` int
,`idservicio` int
,`nombre_barbero` varchar(91)
,`nombre_cliente` varchar(91)
,`nombre_servicio` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_citas_servicio`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_citas_servicio` (
`Estado_cita` varchar(20)
,`Fecha_cita` date
,`Hora_cita` time
,`idbarbero` int
,`idcita` int
,`idcliente` int
,`idservicio` int
,`nombre_barbero` varchar(91)
,`nombre_cliente` varchar(91)
,`nombre_servicio` varchar(100)
,`tarifa_servicio` decimal(10,2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_citas_detalladas`
--
DROP TABLE IF EXISTS `vista_citas_detalladas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_citas_detalladas`  AS SELECT `c`.`idcita` AS `idcita`, `c`.`idcliente` AS `idcliente`, concat(`cl`.`Nombre`,' ',`cl`.`Apellido`) AS `nombre_cliente`, `c`.`idbarbero` AS `idbarbero`, concat(`b`.`Nombre`,' ',`b`.`Apellido`) AS `nombre_barbero`, `c`.`Fecha_cita` AS `Fecha_cita`, `c`.`Hora_cita` AS `Hora_cita`, `c`.`Estado_cita` AS `Estado_cita`, `s`.`idServicio` AS `idservicio`, `s`.`Nombre` AS `nombre_servicio` FROM (((`citas` `c` join `servicios` `s` on((`c`.`idservicio` = `s`.`idServicio`))) join `barberos` `b` on((`c`.`idbarbero` = `b`.`idBarbero`))) join `clientes` `cl` on((`c`.`idcliente` = `cl`.`idCliente`))) ORDER BY `c`.`Fecha_cita` DESC, `c`.`Hora_cita` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_citas_servicio`
--
DROP TABLE IF EXISTS `vista_citas_servicio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_citas_servicio`  AS SELECT `c`.`idcita` AS `idcita`, `c`.`idcliente` AS `idcliente`, concat(`cl`.`Nombre`,' ',`cl`.`Apellido`) AS `nombre_cliente`, `c`.`idbarbero` AS `idbarbero`, concat(`b`.`Nombre`,' ',`b`.`Apellido`) AS `nombre_barbero`, `c`.`Fecha_cita` AS `Fecha_cita`, `c`.`Hora_cita` AS `Hora_cita`, `c`.`Estado_cita` AS `Estado_cita`, `s`.`idServicio` AS `idservicio`, `s`.`Nombre` AS `nombre_servicio`, `s`.`Tarifa` AS `tarifa_servicio` FROM (((`citas` `c` join `servicios` `s` on((`c`.`idservicio` = `s`.`idServicio`))) join `barberos` `b` on((`c`.`idbarbero` = `b`.`idBarbero`))) join `clientes` `cl` on((`c`.`idcliente` = `cl`.`idCliente`))) ORDER BY `c`.`Fecha_cita` DESC, `c`.`Hora_cita` DESC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barberos`
--
ALTER TABLE `barberos`
  ADD PRIMARY KEY (`idBarbero`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idbarbero` (`idbarbero`),
  ADD KEY `idservicio` (`idservicio`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`idHorario`),
  ADD KEY `IdBarbero` (`IdBarbero`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IDRol`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Rol` (`Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barberos`
--
ALTER TABLE `barberos`
  MODIFY `idBarbero` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idcita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `idHorario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IDRol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idServicio` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barberos`
--
ALTER TABLE `barberos`
  ADD CONSTRAINT `barberos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`Id`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`idbarbero`) REFERENCES `barberos` (`idBarbero`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idServicio`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`Id`);

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`IdBarbero`) REFERENCES `barberos` (`idBarbero`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Rol`) REFERENCES `rol` (`IDRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
