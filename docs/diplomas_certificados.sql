-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.2.0.6576
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para capacitacion_diploma
CREATE DATABASE IF NOT EXISTS `capacitacion_diploma` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `capacitacion_diploma`;

-- Volcando estructura para tabla capacitacion_diploma.td_curso_usuario
CREATE TABLE IF NOT EXISTS `td_curso_usuario` (
  `curd_id` int(11) NOT NULL AUTO_INCREMENT,
  `cur_id` int(11) DEFAULT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `fecha_crea` datetime DEFAULT NULL,
  `est` int(11) DEFAULT NULL,
  PRIMARY KEY (`curd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla capacitacion_diploma.td_curso_usuario: ~3 rows (aproximadamente)
REPLACE INTO `td_curso_usuario` (`curd_id`, `cur_id`, `usu_id`, `fecha_crea`, `est`) VALUES
	(1, 1, 1, '2023-11-20 12:05:56', 1),
	(2, 1, 2, '2023-11-20 12:13:13', 1),
	(3, 2, 3, '2023-11-20 12:15:25', 1);

-- Volcando estructura para tabla capacitacion_diploma.tm_categoria
CREATE TABLE IF NOT EXISTS `tm_categoria` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(150) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla capacitacion_diploma.tm_categoria: ~4 rows (aproximadamente)
REPLACE INTO `tm_categoria` (`cat_id`, `cat_nom`, `fech_crea`, `est`) VALUES
	(1, 'PROGRAMACION', '2023-11-20 11:19:40', 1),
	(2, 'MARKETING', '2023-11-20 11:19:40', 1),
	(3, 'NEGOCIOS', '2023-11-20 11:19:40', 1),
	(4, 'EDUCACION', '2023-11-20 11:19:40', 1);

-- Volcando estructura para tabla capacitacion_diploma.tm_curso
CREATE TABLE IF NOT EXISTS `tm_curso` (
  `cur_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `cur_nom` varchar(150) NOT NULL,
  `cur_descrip` varchar(1000) NOT NULL,
  `cur_fechini` date NOT NULL,
  `cur_fechafin` date NOT NULL,
  `inst_id` int(11) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL,
  PRIMARY KEY (`cur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla capacitacion_diploma.tm_curso: ~2 rows (aproximadamente)
REPLACE INTO `tm_curso` (`cur_id`, `cat_id`, `cur_nom`, `cur_descrip`, `cur_fechini`, `cur_fechafin`, `inst_id`, `fech_crea`, `est`) VALUES
	(1, 1, 'CURSO HTML5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-20', '2023-11-25', 1, '2023-11-20 11:37:05', 1),
	(2, 2, 'INTRODUCCION DE LOS NEGOCIOS', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-11-20', '2023-11-25', 2, '2023-11-20 11:37:05', 1);

-- Volcando estructura para tabla capacitacion_diploma.tm_instructor
CREATE TABLE IF NOT EXISTS `tm_instructor` (
  `inst_id` int(11) NOT NULL AUTO_INCREMENT,
  `inst_nom` varchar(150) DEFAULT NULL,
  `inst_apep` varchar(150) DEFAULT NULL,
  `inst_apem` varchar(150) DEFAULT NULL,
  `inst_correo` varchar(150) DEFAULT NULL,
  `inst_sex` varchar(1) DEFAULT NULL,
  `inst_telf` varchar(12) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) DEFAULT NULL,
  PRIMARY KEY (`inst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla capacitacion_diploma.tm_instructor: ~2 rows (aproximadamente)
REPLACE INTO `tm_instructor` (`inst_id`, `inst_nom`, `inst_apep`, `inst_apem`, `inst_correo`, `inst_sex`, `inst_telf`, `fech_crea`, `est`) VALUES
	(1, 'Ricardo', 'Palma', 'Palma', 'ricardo_palma@gmai.com', 'M', '88888888', '2023-11-20 11:07:49', 1),
	(2, 'Cesar', 'Vallejo', 'Vallejo', 'cesar_vallejo@hotmail.com', 'M', '777777777', '2023-11-20 11:12:10', 1);

-- Volcando estructura para tabla capacitacion_diploma.tm_usuario
CREATE TABLE IF NOT EXISTS `tm_usuario` (
  `usu_id` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nom` varchar(150) NOT NULL DEFAULT '0',
  `usu_apep` varchar(150) NOT NULL DEFAULT '0',
  `usu_apem` varchar(150) NOT NULL DEFAULT '0',
  `usu_correo` varchar(150) NOT NULL DEFAULT '0',
  `usu_pass` varchar(10) NOT NULL DEFAULT '0',
  `usu_sex` varchar(1) NOT NULL DEFAULT '0',
  `usu_telf` varchar(12) NOT NULL DEFAULT '0',
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla capacitacion_diploma.tm_usuario: ~3 rows (aproximadamente)
REPLACE INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_apep`, `usu_apem`, `usu_correo`, `usu_pass`, `usu_sex`, `usu_telf`, `fech_crea`, `est`) VALUES
	(1, 'andres', 'gaszpar', 'suarez', 'andres@gmail.com', '123456', 'M', '999999999', '2023-11-20 10:40:33', 1),
	(2, 'juan', 'peresx', 'marciano', 'juan@gmail.com', '654123', 'M', '999999999', '2023-11-20 10:44:13', 1),
	(3, 'andrea', 'puican', 'vazues', 'andrea@gmail.com', '852369', 'F', '999999999', '2023-11-20 10:45:59', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
