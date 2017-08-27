/*
SQLyog Community v10.51 
MySQL - 5.5.24-log : Database - miniclinic
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `atencion` */

CREATE TABLE `atencion` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `tipo_atencion` int(1) NOT NULL,
  `tipo_consulta` varchar(50) NOT NULL,
  `paciente` varchar(20) NOT NULL,
  `cod_autorizacion` varchar(11) DEFAULT NULL,
  `estado` int(1) NOT NULL,
  `agendado` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `boleta` */

CREATE TABLE `boleta` (
  `id_consulta` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `folio` varchar(11) DEFAULT NULL,
  KEY `id_consulta` (`id_consulta`),
  CONSTRAINT `boleta_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `atencion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `bono` */

CREATE TABLE `bono` (
  `id_consulta` int(11) NOT NULL,
  `monto_copago` int(11) NOT NULL,
  `num_operacion` varchar(11) NOT NULL,
  `folio` varchar(11) DEFAULT NULL,
  `id_trx_imed` varchar(11) DEFAULT NULL,
  KEY `id_consulta` (`id_consulta`),
  CONSTRAINT `bono_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `atencion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `config` */

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
