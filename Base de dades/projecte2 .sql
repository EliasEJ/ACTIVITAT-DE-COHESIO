-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2024 a las 16:46:41
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
-- Base de datos: `projecte2`
--
CREATE DATABASE IF NOT EXISTS `projecte2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projecte2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activitat`
--

DROP TABLE IF EXISTS `activitat`;
CREATE TABLE IF NOT EXISTS `activitat` (
  `actividad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(255) NOT NULL,
  `posicion_id` int(11) NOT NULL,
  `porfessor_id` int(11) NOT NULL,
  `grup1` int(11) NOT NULL,
  `grup2` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  PRIMARY KEY (`actividad_id`),
  UNIQUE KEY `fk_porfessor_id` (`porfessor_id`),
  KEY `fk_material_id` (`material_id`) USING BTREE,
  KEY `fk_posicio_id` (`posicion_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `cognom` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `correu` varchar(50) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `tutor` tinyint(1) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `correu` (`correu`),
  UNIQUE KEY `user` (`user`),
  KEY `fk_grup_id` (`grup_id`),
  KEY `fk_actividad_id` (`actividad_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumne`
--

DROP TABLE IF EXISTS `alumne`;
CREATE TABLE IF NOT EXISTS `alumne` (
  `alume_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `cognom` varchar(50) NOT NULL,
  `correu` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `curs` enum('FP Basica','ASIX','DAW','SMX') NOT NULL,
  `any` enum('1r','2n') NOT NULL,
  `classe` enum('A','B','C','D') NOT NULL,
  `asistencia` tinyint(1) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `tutor` tinyint(1) NOT NULL,
  PRIMARY KEY (`alume_id`),
  KEY `fk_grup_id` (`grup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enfrentaments`
--

DROP TABLE IF EXISTS `enfrentaments`;
CREATE TABLE IF NOT EXISTS `enfrentaments` (
  `enfrentament_id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad_id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `resultat` varchar(20) NOT NULL,
  PRIMARY KEY (`enfrentament_id`),
  KEY `fk_actividad_id` (`actividad_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grup`
--

DROP TABLE IF EXISTS `grup`;
CREATE TABLE IF NOT EXISTS `grup` (
  `grup_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `puntuacio` int(11) NOT NULL,
  PRIMARY KEY (`grup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` int(11) NOT NULL,
  `comprar` tinyint(1) NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicio`
--

DROP TABLE IF EXISTS `posicio`;
CREATE TABLE IF NOT EXISTS `posicio` (
  `posicio_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(255) NOT NULL,
  PRIMARY KEY (`posicio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `professor_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `cognom` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `tutor` tinyint(1) NOT NULL,
  PRIMARY KEY (`professor_id`),
  UNIQUE KEY `user` (`user`),
  KEY `fk_actividad_id` (`actividad_id`),
  KEY `fk_grup_id` (`grup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `activitat`
--
ALTER TABLE `activitat`
  ADD CONSTRAINT `activitat_ibfk_1` FOREIGN KEY (`actividad_id`) REFERENCES `admin` (`actividad_id`),
  ADD CONSTRAINT `activitat_ibfk_2` FOREIGN KEY (`porfessor_id`) REFERENCES `professor` (`professor_id`);

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`grup_id`);

--
-- Filtros para la tabla `enfrentaments`
--
ALTER TABLE `enfrentaments`
  ADD CONSTRAINT `enfrentaments_ibfk_1` FOREIGN KEY (`actividad_id`) REFERENCES `activitat` (`actividad_id`);

--
-- Filtros para la tabla `grup`
--
ALTER TABLE `grup`
  ADD CONSTRAINT `grup_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `alumne` (`grup_id`);

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `activitat` (`material_id`);

--
-- Filtros para la tabla `posicio`
--
ALTER TABLE `posicio`
  ADD CONSTRAINT `posicio_ibfk_1` FOREIGN KEY (`posicio_id`) REFERENCES `activitat` (`posicion_id`);

--
-- Filtros para la tabla `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `professor_ibfk_1` FOREIGN KEY (`actividad_id`) REFERENCES `activitat` (`actividad_id`),
  ADD CONSTRAINT `professor_ibfk_2` FOREIGN KEY (`grup_id`) REFERENCES `grup` (`grup_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
