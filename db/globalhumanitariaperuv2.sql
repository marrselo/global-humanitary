/*
SQLyog Enterprise - MySQL GUI v8.02 RC
MySQL - 5.5.15-log : Database - globalhumanitariaperu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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
  `fecha_creacion` date DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `banner` */

LOCK TABLES `banner` WRITE;

insert  into `banner`(`banner_id`,`banner_nombre`,`banner_link`,`banner_img`,`banner_publico`,`banner_orden`,`fecha_creacion`) values (1,'banner1','banner1','001.jpg',1,1,NULL),(2,'banner2','banner1','002.jpg',1,2,NULL);

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

/*Table structure for table `imagenes` */

DROP TABLE IF EXISTS `imagenes`;

CREATE TABLE `imagenes` (
  `imagenes_id` int(11) NOT NULL AUTO_INCREMENT,
  `imagenes_nombre` char(100) DEFAULT NULL,
  `imagenes_imagen` char(45) DEFAULT NULL,
  `imagenes_publico` tinyint(1) DEFAULT NULL,
  `imagenes_orden` int(11) DEFAULT NULL,
  `imagenes_descripcion` text,
  PRIMARY KEY (`imagenes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `imagenes` */

LOCK TABLES `imagenes` WRITE;

insert  into `imagenes`(`imagenes_id`,`imagenes_nombre`,`imagenes_imagen`,`imagenes_publico`,`imagenes_orden`,`imagenes_descripcion`) values (1,'asdasd asdasd','71_asdasd.jpg',1,1,'asdasd asdaasd asdasdsa'),(2,'asdasdasd','28_asdasdasd.jpg',1,2,'asdasdd'),(3,'asdasdasd','577_asdasdasd.JPG',1,3,'asdasdasd'),(4,'asdasd','706_asdasd.jpg',1,4,'asdasd'),(5,'asdasd','755_asdasd.JPG',1,5,'asdasdasd');

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
  `memorias_publico` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`memorias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `memorias` */

LOCK TABLES `memorias` WRITE;

insert  into `memorias`(`memorias_id`,`memorias_nombre`,`memorias_imagen`,`memorias_titulo`,`memorias_descripcion`,`memorias_orden`,`memorias_publico`) values (1,'asdfafadfad','106-5646A.jpg','asdasd','asdasd',2,1),(2,'asdfafadfad','106-5558.jpg','asdasd','asdasd',1,1),(3,'asdfafadfad','106-5583.jpg','asdasd','asd',3,1);

UNLOCK TABLES;

/*Table structure for table `miembros` */

DROP TABLE IF EXISTS `miembros`;

CREATE TABLE `miembros` (
  `miembros_id` int(11) NOT NULL AUTO_INCREMENT,
  `miembros_nombre` char(100) DEFAULT NULL,
  `miembros_apellidos` char(100) DEFAULT NULL,
  `miembros_cargo` char(150) DEFAULT NULL,
  `miembros_resumen` text,
  `miembros_imagen` char(45) DEFAULT NULL,
  `miembros_publico` tinyint(1) NOT NULL,
  `miembros_orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`miembros_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `miembros` */

LOCK TABLES `miembros` WRITE;

insert  into `miembros`(`miembros_id`,`miembros_nombre`,`miembros_apellidos`,`miembros_cargo`,`miembros_resumen`,`miembros_imagen`,`miembros_publico`,`miembros_orden`) values (1,'asdfafadfad','asdasd','fsdsdf','sadasasd','153-1420.jpg',1,2),(2,'asdfafadfad','asdasd','fsdsdf','asdasdas asdasdasd','231-151.jpg',1,1);

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

/*Table structure for table `nosotros` */

DROP TABLE IF EXISTS `nosotros`;

CREATE TABLE `nosotros` (
  `nosotros_id` int(11) NOT NULL AUTO_INCREMENT,
  `nosotros_titulo` char(100) DEFAULT NULL,
  `nosotros_descripcion` text,
  `nosotros_date` datetime DEFAULT NULL,
  PRIMARY KEY (`nosotros_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `nosotros` */

LOCK TABLES `nosotros` WRITE;

insert  into `nosotros`(`nosotros_id`,`nosotros_titulo`,`nosotros_descripcion`,`nosotros_date`) values (1,'asdasd','asdasdsa','0000-00-00 00:00:00'),(2,'asdasdsd','asdasdasd','0000-00-00 00:00:00'),(3,'asdasd','asdasd','2012-11-14 20:31:49'),(4,'asdasd asdasdasd','asdasd asdasdsa asdasdsad adassa adasdasd','2012-11-14 20:34:39'),(5,'asdasd asdasdasd','asdasd asdasdsa asdasdsad adassa adasdasd','2012-11-14 20:40:42'),(6,'asdasd asdasdasd','asdasd asdasdsa asdasdsad adassa adasdasd','2012-11-14 20:41:38'),(7,'asdasd asdasdasd','asdasd asdasdsa asdasdsad adassa adasdasd','2012-11-14 20:41:59'),(8,'asdasd asdasdasd','asdasd asdasdsa asdasdsad adassa adasdasd','2012-11-14 20:42:52'),(9,'asdasd asdasdasd','asdasd asdasdsa asdasdsad adassa adasdasd','2012-11-14 20:43:28'),(10,'asdasd asdasdasd','asdasd asdasdsa asdasdsad adassa adasdasd','2012-11-14 20:43:36'),(11,'¿QUIENES SOMOS?','Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que tiene una distribución más o menos normal de las letras, al contrario de usar textos como por ejemplo \"Contenido aquí, contenido aquí\". Estos textos hacen parecerlo un español que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem Ipsum como su texto por defecto, y al hacer una búsqueda de \"Lorem Ipsum\" va a dar por resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras veces a propósito (por ejemplo insertándole humor y cosas por el estilo).','2012-11-14 20:43:41');

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
  `noticias_slug` text,
  `noticias_descripcion_corta` char(50) DEFAULT NULL,
  PRIMARY KEY (`noticias_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `noticias` */

LOCK TABLES `noticias` WRITE;

insert  into `noticias`(`noticias_id`,`noticias_titulo`,`noticias_subtitulo`,`noticias_fecha_creacion`,`noticias_descripcion`,`noticias_imagen`,`noticias_publico`,`noticias_slug`,`noticias_descripcion_corta`) values (1,'La ayuda llego a Pucara','SUBTitulo primera noticias',NULL,NULL,'noticia1.jpg',1,'titulo-primera-noticias','Lorem ipsum dolor sit amet, consectetur adipisicin'),(2,'La ayuda llego a Pucara','SUBTitulo primera noticias',NULL,NULL,'noticia2.jpg',1,'titulo-primera-noticias','Lorem ipsum dolor sit amet, consectetur adipisicin');

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
  `proyectos_home` tinyint(4) DEFAULT NULL,
  `proyectos_slug` text,
  `proyectos_descripcion_corta` char(50) DEFAULT NULL,
  PRIMARY KEY (`proyectos_id`),
  KEY `fk_proyectos_proyectos_estado_idx` (`proyectos_estado_id`),
  CONSTRAINT `fk_proyectos_proyectos_estado` FOREIGN KEY (`proyectos_estado_id`) REFERENCES `proyectos_estado` (`proyectos_estado_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `proyectos` */

LOCK TABLES `proyectos` WRITE;

insert  into `proyectos`(`proyectos_id`,`proyectos_nombre`,`proyectos_subtitulo`,`proyectos_descripcion`,`proyectos_orden`,`proyectos_publico`,`proyectos_estado_id`,`proyectos_home`,`proyectos_slug`,`proyectos_descripcion_corta`) values (1,'La ayuda llego a Pucara',NULL,'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',1,1,1,1,'la-ayuda-llego-a-pucalla','Lorem ipsum dolor sit amet, consectetur adipisicin'),(2,'La ayuda llego a Pucara',NULL,'Lorem ipsum dolor sit amet, consectetur adipisicin',2,1,1,1,'la-ayuda-llego-a-pucalla','Lorem ipsum dolor sit amet, consectetur adipisicin');

UNLOCK TABLES;

/*Table structure for table `proyectos_estado` */

DROP TABLE IF EXISTS `proyectos_estado`;

CREATE TABLE `proyectos_estado` (
  `proyectos_estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyectos_estado_nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`proyectos_estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `proyectos_estado` */

LOCK TABLES `proyectos_estado` WRITE;

insert  into `proyectos_estado`(`proyectos_estado_id`,`proyectos_estado_nombre`) values (1,'Realizados'),(2,'En proceso');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `proyectos_imagen` */

LOCK TABLES `proyectos_imagen` WRITE;

insert  into `proyectos_imagen`(`proyectos_imagen_id`,`proyectos_imagen_nombre`,`proyectos_id`) values (1,'proyecto1.jpg',1),(2,'proyecto2.jpg',1),(3,'proyecto3.jpg',1),(4,'proyecto4.jpg',2),(5,'proyecto1.jpg',2),(6,'proyecto1.jpg',2);

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
  `videos_imagen` char(100) DEFAULT NULL,
  `videos_descripcion` char(200) DEFAULT NULL,
  PRIMARY KEY (`videos_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `videos` */

LOCK TABLES `videos` WRITE;

insert  into `videos`(`videos_id`,`videos_titulo`,`videos_link`,`videos_publico`,`videos_orden`,`videos_imagen`,`videos_descripcion`) values (1,'asdasdasd',NULL,1,3,'IMAGE0021.JPG','asdasdasd'),(2,'asdasd',NULL,1,2,'IMAGE0021.JPG','asdasd'),(3,'asdasd',NULL,0,1,'nazart retocado.jpg','adad'),(4,'asdasd',NULL,1,4,NULL,'asdasd'),(5,'asdasd',NULL,1,5,'153_asdasd','asdasd'),(6,'asdasd',NULL,1,6,'961_asdasd','asdasd'),(7,'asdasd','491_asdasd',1,7,'352_asdasd','sadasd'),(8,'asdasd','434_asdasd',1,8,'337_asdasd','asdasd');

UNLOCK TABLES;

/*Table structure for table `wallpaper` */

DROP TABLE IF EXISTS `wallpaper`;

CREATE TABLE `wallpaper` (
  `wallpaper_id` int(11) NOT NULL AUTO_INCREMENT,
  `wallpaper_nombre` char(100) DEFAULT NULL,
  `wallpaper_imagen` char(45) DEFAULT NULL,
  `wallpaper_publico` tinyint(1) DEFAULT NULL,
  `wallpaper_orden` int(11) DEFAULT NULL,
  `wallpaper_descripcion` text,
  PRIMARY KEY (`wallpaper_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `wallpaper` */

LOCK TABLES `wallpaper` WRITE;

insert  into `wallpaper`(`wallpaper_id`,`wallpaper_nombre`,`wallpaper_imagen`,`wallpaper_publico`,`wallpaper_orden`,`wallpaper_descripcion`) values (1,'asdasd','554_asdasd.jpg',1,2,'asdads asdasdasd'),(2,'asdasd','623_asdasd.jpg',1,1,'asdasdasd');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
