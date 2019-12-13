-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-12-2019 a las 07:04:54
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `asesorias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumnos`
--

CREATE TABLE `Alumnos` (
  `AlumnoID` int(11) NOT NULL,
  `NoControl` varchar(8) NOT NULL,
  `CarreraID` int(11) NOT NULL,
  `PersonaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Alumnos`
--

INSERT INTO `Alumnos` (`AlumnoID`, `NoControl`, `CarreraID`, `PersonaID`) VALUES
(1, '15171192', 1, 2),
(2, '15171193', 1, 1),
(3, '17173853', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AsesoriaAltas`
--

CREATE TABLE `AsesoriaAltas` (
  `AsesoriaAltaID` int(11) NOT NULL,
  `AsesoriaDatoID` int(11) NOT NULL,
  `Asesorado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `AsesoriaAltas`
--

INSERT INTO `AsesoriaAltas` (`AsesoriaAltaID`, `AsesoriaDatoID`, `Asesorado`) VALUES
(1, 1, 1),
(75, 13, 4),
(76, 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AsesoriaDatos`
--

CREATE TABLE `AsesoriaDatos` (
  `AsesoriaDatoID` int(11) NOT NULL,
  `AsesorID` int(11) NOT NULL,
  `MateriaID` int(11) NOT NULL,
  `SalonID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `HoraInicio` time NOT NULL,
  `HoraFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `AsesoriaDatos`
--

INSERT INTO `AsesoriaDatos` (`AsesoriaDatoID`, `AsesorID`, `MateriaID`, `SalonID`, `Fecha`, `HoraInicio`, `HoraFin`) VALUES
(1, 7, 7, 1, '2019-11-13', '09:00:00', '10:00:00'),
(13, 5, 4, 3, '2019-12-22', '10:00:00', '11:00:00'),
(14, 6, 8, 5, '2019-12-22', '12:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Carreras`
--

CREATE TABLE `Carreras` (
  `CarreraID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `DepartamentoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Carreras`
--

INSERT INTO `Carreras` (`CarreraID`, `Nombre`, `DepartamentoID`) VALUES
(1, 'Ing. en Sistemas Computacionales', 1),
(2, 'Ing. Bioquímica', 4),
(3, 'Ing. Eléctrica', 5),
(4, 'Ing. Electrónica', 5),
(5, 'Ing. en Tecnologías de la Información y Comunicaciones', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Departamentos`
--

CREATE TABLE `Departamentos` (
  `DepartamentoID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Departamentos`
--

INSERT INTO `Departamentos` (`DepartamentoID`, `Nombre`) VALUES
(1, 'Sistemas y computacion'),
(2, 'Metal-Mecánica'),
(3, 'Ingeniería Industrial'),
(4, 'Ingeniería Química-Bioquímica'),
(5, 'Eléctrica-Electrónica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Materias`
--

CREATE TABLE `Materias` (
  `MateriaID` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Creditos` varchar(1) NOT NULL,
  `CarreraID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Materias`
--

INSERT INTO `Materias` (`MateriaID`, `Nombre`, `Creditos`, `CarreraID`) VALUES
(1, 'CALCULO DIFERENCIAL', '5', 1),
(2, 'POO', '5', 1),
(3, 'PROLOG', '4', 1),
(4, 'ECUACIONES DIFERENCIALES', '5', 1),
(5, 'TALLER DE BASE DE DATOS', '5', 1),
(6, 'ALGEBRA LINEAL', '5', 1),
(7, 'ADMINISTRACION DE REDES', '5', 1),
(8, 'TERMODINAMICA', '5', 2),
(9, 'ELECTROMAGNETISMO', '4', 2),
(10, 'ESTADISTICA Y CONTROL DE CALIDAD', '5', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Personas`
--

CREATE TABLE `Personas` (
  `PersonaID` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Edad` int(11) DEFAULT NULL,
  `Sexo` varchar(1) DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `UsuarioID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Personas`
--

INSERT INTO `Personas` (`PersonaID`, `Nombre`, `Apellido`, `Edad`, `Sexo`, `Correo`, `Telefono`, `UsuarioID`) VALUES
(1, 'Alvaro', 'Ramos', 22, 'H', 'alvRa@hotmail.com', '6675326587', 3),
(2, 'Carlos', 'Rios', 21, 'H', 'carlos123df@gmail.com', '6672226943', 2),
(3, 'Marco', 'Romo', 45, 'H', 'marcoitc@itculiacan.edu.mx', '6677385432', 1),
(4, 'Alejandra', 'Madrid', 22, 'M', 'ale@gmail.com', '6675382949', 4),
(5, 'Juan Leoncio', 'Nuñez Armenta', 40, 'H', 'leoncio@hotmail.com', '6675483920', 5),
(6, 'Evangelina', 'Avila Gaxiola', 40, 'M', 'eva930@gmail.com', '6676942854', 6),
(7, 'Pedro', 'Villa Casas', 40, 'H', 'pedrocasas@hotmail.com', '6642658745', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Profesores`
--

CREATE TABLE `Profesores` (
  `ProfesorID` int(11) NOT NULL,
  `Rfc` varchar(13) NOT NULL,
  `PersonaID` int(11) NOT NULL,
  `DepartamentoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Profesores`
--

INSERT INTO `Profesores` (`ProfesorID`, `Rfc`, `PersonaID`, `DepartamentoID`) VALUES
(1, 'MORC781123RM6', 3, 1),
(2, 'LOJA750714TV6', 5, 1),
(3, 'AIGE760504MV8', 6, 4),
(4, 'VICP8103049E6', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Salones`
--

CREATE TABLE `Salones` (
  `SalonID` int(11) NOT NULL,
  `Nombre` varchar(2) NOT NULL,
  `DepartamentoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Salones`
--

INSERT INTO `Salones` (`SalonID`, `Nombre`, `DepartamentoID`) VALUES
(1, 'B1', 1),
(2, 'B2', 1),
(3, 'B5', 1),
(4, 'C3', 1),
(5, 'D2', 4),
(6, 'D5', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `UsuarioID` int(11) NOT NULL,
  `Usuario` varchar(45) DEFAULT NULL,
  `Contraseña` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`UsuarioID`, `Usuario`, `Contraseña`) VALUES
(1, 'MORC781123RM6', '124'),
(2, '15171192', '123'),
(3, '15171193', '123'),
(4, '17173853', '123'),
(5, 'sistemas', '123'),
(6, 'bioquimica', '123'),
(7, 'sistemas2', '123');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vasesorias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vasesorias` (
`AsesoriaDatoID` int(11)
,`Asesor` varchar(91)
,`Materia` varchar(50)
,`Aula` varchar(2)
,`Fecha` date
,`Horario` varchar(23)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vasesorias`
--
DROP TABLE IF EXISTS `vasesorias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `vasesorias`  AS  select `ad`.`AsesoriaDatoID` AS `AsesoriaDatoID`,concat_ws(' ',`p`.`Nombre`,`p`.`Apellido`) AS `Asesor`,`m`.`Nombre` AS `Materia`,`s`.`Nombre` AS `Aula`,`ad`.`Fecha` AS `Fecha`,concat_ws(' - ',`ad`.`HoraInicio`,`ad`.`HoraFin`) AS `Horario` from (((`asesoriadatos` `ad` join `personas` `p` on(`ad`.`AsesorID` = `p`.`PersonaID`)) join `materias` `m` on(`ad`.`MateriaID` = `m`.`MateriaID`)) join `salones` `s` on(`ad`.`SalonID` = `s`.`SalonID`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  ADD PRIMARY KEY (`AlumnoID`),
  ADD KEY `PersonaID` (`PersonaID`),
  ADD KEY `CarreraID` (`CarreraID`);

--
-- Indices de la tabla `AsesoriaAltas`
--
ALTER TABLE `AsesoriaAltas`
  ADD PRIMARY KEY (`AsesoriaAltaID`),
  ADD KEY `AsesoriaDatoID` (`AsesoriaDatoID`),
  ADD KEY `Asesorado` (`Asesorado`) USING BTREE;

--
-- Indices de la tabla `AsesoriaDatos`
--
ALTER TABLE `AsesoriaDatos`
  ADD PRIMARY KEY (`AsesoriaDatoID`),
  ADD KEY `AsesorID` (`AsesorID`),
  ADD KEY `MateriaID` (`MateriaID`),
  ADD KEY `SalonID` (`SalonID`);

--
-- Indices de la tabla `Carreras`
--
ALTER TABLE `Carreras`
  ADD PRIMARY KEY (`CarreraID`),
  ADD KEY `DepartamentoID` (`DepartamentoID`);

--
-- Indices de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  ADD PRIMARY KEY (`DepartamentoID`);

--
-- Indices de la tabla `Materias`
--
ALTER TABLE `Materias`
  ADD PRIMARY KEY (`MateriaID`),
  ADD KEY `CarreraID` (`CarreraID`);

--
-- Indices de la tabla `Personas`
--
ALTER TABLE `Personas`
  ADD PRIMARY KEY (`PersonaID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Indices de la tabla `Profesores`
--
ALTER TABLE `Profesores`
  ADD PRIMARY KEY (`ProfesorID`),
  ADD KEY `PersonaID` (`PersonaID`),
  ADD KEY `DepartamentoID` (`DepartamentoID`);

--
-- Indices de la tabla `Salones`
--
ALTER TABLE `Salones`
  ADD PRIMARY KEY (`SalonID`),
  ADD KEY `DepartamentoID` (`DepartamentoID`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`UsuarioID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  MODIFY `AlumnoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `AsesoriaAltas`
--
ALTER TABLE `AsesoriaAltas`
  MODIFY `AsesoriaAltaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `AsesoriaDatos`
--
ALTER TABLE `AsesoriaDatos`
  MODIFY `AsesoriaDatoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `Carreras`
--
ALTER TABLE `Carreras`
  MODIFY `CarreraID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Departamentos`
--
ALTER TABLE `Departamentos`
  MODIFY `DepartamentoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Materias`
--
ALTER TABLE `Materias`
  MODIFY `MateriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Personas`
--
ALTER TABLE `Personas`
  MODIFY `PersonaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Profesores`
--
ALTER TABLE `Profesores`
  MODIFY `ProfesorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Salones`
--
ALTER TABLE `Salones`
  MODIFY `SalonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `UsuarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alumnos`
--
ALTER TABLE `Alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`PersonaID`) REFERENCES `Personas` (`PersonaID`),
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`CarreraID`) REFERENCES `Carreras` (`CarreraID`);

--
-- Filtros para la tabla `AsesoriaAltas`
--
ALTER TABLE `AsesoriaAltas`
  ADD CONSTRAINT `asesoriaaltas_ibfk_1` FOREIGN KEY (`AsesoriaDatoID`) REFERENCES `AsesoriaDatos` (`AsesoriaDatoID`),
  ADD CONSTRAINT `asesoriaaltas_ibfk_2` FOREIGN KEY (`Asesorado`) REFERENCES `Personas` (`PersonaID`);

--
-- Filtros para la tabla `AsesoriaDatos`
--
ALTER TABLE `AsesoriaDatos`
  ADD CONSTRAINT `asesoriadatos_ibfk_1` FOREIGN KEY (`AsesorID`) REFERENCES `Personas` (`PersonaID`),
  ADD CONSTRAINT `asesoriadatos_ibfk_2` FOREIGN KEY (`MateriaID`) REFERENCES `Materias` (`MateriaID`),
  ADD CONSTRAINT `asesoriadatos_ibfk_3` FOREIGN KEY (`SalonID`) REFERENCES `Salones` (`SalonID`);

--
-- Filtros para la tabla `Carreras`
--
ALTER TABLE `Carreras`
  ADD CONSTRAINT `carreras_ibfk_1` FOREIGN KEY (`DepartamentoID`) REFERENCES `Departamentos` (`DepartamentoID`);

--
-- Filtros para la tabla `Materias`
--
ALTER TABLE `Materias`
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`CarreraID`) REFERENCES `Carreras` (`CarreraID`);

--
-- Filtros para la tabla `Personas`
--
ALTER TABLE `Personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `Usuarios` (`UsuarioID`);

--
-- Filtros para la tabla `Profesores`
--
ALTER TABLE `Profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`PersonaID`) REFERENCES `Personas` (`PersonaID`),
  ADD CONSTRAINT `profesores_ibfk_2` FOREIGN KEY (`DepartamentoID`) REFERENCES `Departamentos` (`DepartamentoID`);

--
-- Filtros para la tabla `Salones`
--
ALTER TABLE `Salones`
  ADD CONSTRAINT `salones_ibfk_1` FOREIGN KEY (`DepartamentoID`) REFERENCES `Departamentos` (`DepartamentoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
