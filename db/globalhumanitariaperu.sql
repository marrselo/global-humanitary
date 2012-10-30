/*
SQLyog Enterprise - MySQL GUI v8.02 RC
MySQL - 5.5.15-log : Database - globalhumanitariaperu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`globalhumanitariaperu` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `globalhumanitariaperu`;

/*Table structure for table `actividades` */

DROP TABLE IF EXISTS `actividades`;

CREATE TABLE `actividades` (
  `actividades_id` int(11) NOT NULL AUTO_INCREMENT,
  `actividades_nombre` char(200) DEFAULT NULL,
  `actividades_descripcion` text,
  `actividades_fecha_inicio` datetime DEFAULT NULL,
  `actividades_fecha_fin` datetime DEFAULT NULL,
  `actividades_publico` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`actividades_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `actividades` */

LOCK TABLES `actividades` WRITE;

UNLOCK TABLES;

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_nombre` char(45) DEFAULT NULL,
  `banner_link` text,
  `banner_img` char(45) DEFAULT NULL,
  `banner_publico` tinyint(1) NOT NULL,
  `banner_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `banner` */

LOCK TABLES `banner` WRITE;

UNLOCK TABLES;

/*Table structure for table `config_variable` */

DROP TABLE IF EXISTS `config_variable`;

CREATE TABLE `config_variable` (
  `config_variable_id` int(11) NOT NULL,
  `config_variable_nombre` char(50) DEFAULT NULL,
  `config_variable_valor` char(200) DEFAULT NULL,
  PRIMARY KEY (`config_variable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `config_variable` */

LOCK TABLES `config_variable` WRITE;

UNLOCK TABLES;

/*Table structure for table `documentos` */

DROP TABLE IF EXISTS `documentos`;

CREATE TABLE `documentos` (
  `documentos_id` int(11) NOT NULL AUTO_INCREMENT,
  `documentos_nombre` char(150) DEFAULT NULL,
  `documentos_link` char(100) DEFAULT NULL,
  `documentos_orden` int(11) DEFAULT NULL,
  `documentos_public` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`documentos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `documentos` */

LOCK TABLES `documentos` WRITE;

UNLOCK TABLES;

/*Table structure for table `empresa_colaboradora` */

DROP TABLE IF EXISTS `empresa_colaboradora`;

CREATE TABLE `empresa_colaboradora` (
  `empresa_colaboradora_id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_colaboradora_nombre` char(200) DEFAULT NULL,
  `empresa_colaboradora_logo` char(45) DEFAULT NULL,
  `empresa_colaboradora_public` tinyint(1) DEFAULT NULL,
  `empresa_colaboradora_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`empresa_colaboradora_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `empresa_colaboradora` */

LOCK TABLES `empresa_colaboradora` WRITE;

UNLOCK TABLES;

/*Table structure for table `memorias` */

DROP TABLE IF EXISTS `memorias`;

CREATE TABLE `memorias` (
  `memorias_id` int(11) NOT NULL AUTO_INCREMENT,
  `memorias_nombre` char(145) DEFAULT NULL,
  `memorias_imagen` char(45) DEFAULT NULL,
  `memorias_titulo` char(100) DEFAULT NULL,
  `memorias_descripcion` char(150) DEFAULT NULL,
  `memorias_orden` int(11) DEFAULT NULL,
  `memorias_publico` tinyint(1) NOT NULL,
  PRIMARY KEY (`memorias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `memorias` */

LOCK TABLES `memorias` WRITE;

UNLOCK TABLES;

/*Table structure for table `mienbros` */

DROP TABLE IF EXISTS `mienbros`;

CREATE TABLE `mienbros` (
  `mienbros_id` int(11) NOT NULL AUTO_INCREMENT,
  `mienbros_nombre` char(100) DEFAULT NULL,
  `mienbros_apellidos` char(100) DEFAULT NULL,
  `mienbros_cargo` char(150) DEFAULT NULL,
  `mienbros_resumen` text,
  `mienbros_imagen` char(45) DEFAULT NULL,
  `mienbros_publico` tinyint(1) NOT NULL,
  `mienbros_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`mienbros_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mienbros` */

LOCK TABLES `mienbros` WRITE;

UNLOCK TABLES;

/*Table structure for table `modos_ayuda` */

DROP TABLE IF EXISTS `modos_ayuda`;

CREATE TABLE `modos_ayuda` (
  `modos_ayuda_id` int(11) NOT NULL AUTO_INCREMENT,
  `modos_ayuda_titulo` char(200) DEFAULT NULL,
  `modos_ayuda_descripcion` text,
  `modos_ayuda_img` char(45) DEFAULT NULL,
  `modos_ayuda_orden` int(11) DEFAULT NULL,
  `modos_ayuda_publico` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`modos_ayuda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `modos_ayuda` */

LOCK TABLES `modos_ayuda` WRITE;

UNLOCK TABLES;

/*Table structure for table `noticias` */

DROP TABLE IF EXISTS `noticias`;

CREATE TABLE `noticias` (
  `noticias_id` int(11) NOT NULL AUTO_INCREMENT,
  `noticias_titulo` char(200) DEFAULT NULL,
  `noticias_subtitulo` char(200) DEFAULT NULL,
  `noticias_fecha_creacion` datetime DEFAULT NULL,
  `noticias_descripcion` text,
  `noticias_imagen` char(45) DEFAULT NULL,
  `noticias_publico` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`noticias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `noticias` */

LOCK TABLES `noticias` WRITE;

UNLOCK TABLES;

/*Table structure for table `proyectos` */

DROP TABLE IF EXISTS `proyectos`;

CREATE TABLE `proyectos` (
  `proyectos_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyectos_nombre` char(200) DEFAULT NULL,
  `proyectos_subtitulo` char(200) DEFAULT NULL,
  `proyectos_descripcion` text,
  `proyectos_orden` int(11) DEFAULT NULL,
  `proyectos_publico` tinyint(1) DEFAULT NULL,
  `proyectos_estado_id` int(11) NOT NULL,
  PRIMARY KEY (`proyectos_id`),
  KEY `fk_proyectos_proyectos_estado_idx` (`proyectos_estado_id`),
  CONSTRAINT `fk_proyectos_proyectos_estado` FOREIGN KEY (`proyectos_estado_id`) REFERENCES `proyectos_estado` (`proyectos_estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyectos` */

LOCK TABLES `proyectos` WRITE;

UNLOCK TABLES;

/*Table structure for table `proyectos_estado` */

DROP TABLE IF EXISTS `proyectos_estado`;

CREATE TABLE `proyectos_estado` (
  `proyectos_estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyectos_estado_nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`proyectos_estado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyectos_estado` */

LOCK TABLES `proyectos_estado` WRITE;

UNLOCK TABLES;

/*Table structure for table `proyectos_imagen` */

DROP TABLE IF EXISTS `proyectos_imagen`;

CREATE TABLE `proyectos_imagen` (
  `proyectos_imagen_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyectos_imagen_nombre` char(45) DEFAULT NULL,
  `proyectos_id` int(11) NOT NULL,
  PRIMARY KEY (`proyectos_imagen_id`),
  KEY `fk_proyectos_imagen_proyectos1_idx` (`proyectos_id`),
  CONSTRAINT `fk_proyectos_imagen_proyectos1` FOREIGN KEY (`proyectos_id`) REFERENCES `proyectos` (`proyectos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proyectos_imagen` */

LOCK TABLES `proyectos_imagen` WRITE;

UNLOCK TABLES;

/*Table structure for table `tipo_colaboracion` */

DROP TABLE IF EXISTS `tipo_colaboracion`;

CREATE TABLE `tipo_colaboracion` (
  `tipo_colaboracion_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_colaboracion_titulo` char(200) DEFAULT NULL,
  `tipo_colaboracion_subtitulo` char(200) DEFAULT NULL,
  `tipo_colaboracion_descripcion` text,
  `tipo_colaboracion_file` char(45) DEFAULT NULL,
  `tipo_colaboracion_img` char(45) DEFAULT NULL,
  `tipo_colaboracion_publico` tinyint(1) DEFAULT NULL,
  `tipo_colaboracion_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`tipo_colaboracion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tipo_colaboracion` */

LOCK TABLES `tipo_colaboracion` WRITE;

UNLOCK TABLES;

/*Table structure for table `user_admin` */

DROP TABLE IF EXISTS `user_admin`;

CREATE TABLE `user_admin` (
  `user_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_admin_nombre` char(100) DEFAULT NULL,
  `user_admin_user` char(35) DEFAULT NULL,
  `user_admin_password` char(50) DEFAULT NULL,
  `user_admin_activo` tinyint(1) DEFAULT NULL,
  `user_admin_mail` char(200) DEFAULT NULL,
  PRIMARY KEY (`user_admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_admin` */

LOCK TABLES `user_admin` WRITE;

UNLOCK TABLES;

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `videos_id` int(11) NOT NULL AUTO_INCREMENT,
  `videos_titulo` char(150) DEFAULT NULL,
  `videos_link` char(45) DEFAULT NULL,
  `videos_publico` tinyint(1) DEFAULT NULL,
  `videos_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`videos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `videos` */

LOCK TABLES `videos` WRITE;

UNLOCK TABLES;

/*Table structure for table `wallpaper` */

DROP TABLE IF EXISTS `wallpaper`;

CREATE TABLE `wallpaper` (
  `wallpaper_id` int(11) NOT NULL AUTO_INCREMENT,
  `wallpaper_nombre` char(100) DEFAULT NULL,
  `wallpaper_imagen` char(45) DEFAULT NULL,
  `wallpaper_public` tinyint(1) DEFAULT NULL,
  `wallpaper_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`wallpaper_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `wallpaper` */

LOCK TABLES `wallpaper` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
