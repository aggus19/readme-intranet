#####################################################
#              AGRAS SYSTEMS DDL                    #
#####################################################
Ultima Actualización # Date 18/11/22 00:43Hs

#
# Structure for table "almacena"
#
DROP TABLE IF EXISTS `almacena`;
CREATE TABLE `almacena` (
  `codigo_institucion` int(11) NOT NULL,
  `id_multimedia` int(11) NOT NULL,
  PRIMARY KEY (`codigo_institucion`,`id_multimedia`),
  KEY `id_multimedia` (`id_multimedia`),
  CONSTRAINT `almacena_ibfk_1` FOREIGN KEY (`codigo_institucion`) REFERENCES `institucion_educativa` (`codigo_institucion`),
  CONSTRAINT `almacena_ibfk_2` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



#
# Structure for table "asiste"
#

DROP TABLE IF EXISTS `asiste`;
CREATE TABLE `asiste` (
  `codigo_institucion` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo_institucion`,`correo`),
  KEY `correo` (`correo`),
  CONSTRAINT `asiste_ibfk_1` FOREIGN KEY (`codigo_institucion`) REFERENCES `institucion_educativa` (`codigo_institucion`),
  CONSTRAINT `asiste_ibfk_2` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#
# Structure for table "autores"
#
DROP TABLE IF EXISTS `autores`;
CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL DEFAULT 'Anonimo',
  `apellido` varchar(255) NOT NULL DEFAULT 'Anonimo',
  `nacionalidad` varchar(255) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT 'https://cdn.discordapp.com/attachments/874108766436597760/1003989723909476373/unknown.png',
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;



#
# Structure for table "clubes"
#
DROP TABLE IF EXISTS `clubes`;
CREATE TABLE `clubes` (
  `codigo_club` int(11) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `nombre` varchar(200) NOT NULL DEFAULT 'Club de Lectura',
  `genero` varchar(255) DEFAULT NULL,
  `createdBy` varchar(255) NOT NULL DEFAULT 'Usuario',
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#
# Structure for table "consume"
#

DROP TABLE IF EXISTS `consume`;
CREATE TABLE `consume` (
  `correo` varchar(255) NOT NULL,
  `id_multimedia` int(11) NOT NULL,
  PRIMARY KEY (`correo`,`id_multimedia`),
  KEY `id_multimedia` (`id_multimedia`),
  CONSTRAINT `consume_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`),
  CONSTRAINT `consume_ibfk_2` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



#
# Structure for table "hace_resenia"
#
DROP TABLE IF EXISTS `hace_resenia`;
CREATE TABLE `hace_resenia` (
  `id_resenia` int(11) NOT NULL,
  `id_multimedia` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_resenia`, `id_multimedia`, `correo`),
  KEY `id_multimedia` (`id_multimedia`),
  KEY `correo` (`correo`),
  CONSTRAINT `hace_resenia_ibfk_1` FOREIGN KEY (`id_resenia`) REFERENCES `resenia` (`id_resenia`),
  CONSTRAINT `hace_resenia_ibfk_2` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`),
  CONSTRAINT `hace_resenia_ibfk_3` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



#
# Structure for table "institucion_educativa"
#
DROP TABLE IF EXISTS `institucion_educativa`;
CREATE TABLE `institucion_educativa` (
  `codigo_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;


#
# Structure for table "multas"
#
DROP TABLE IF EXISTS `multas`;
CREATE TABLE `multas` (
  `id_multa` int(11) NOT NULL AUTO_INCREMENT,
  `castigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_multa`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;


#
# Structure for table "multimedia"
#
DROP TABLE IF EXISTS `multimedia`;
CREATE TABLE `multimedia` (
  `id_multimedia` int(11) NOT NULL AUTO_INCREMENT,
  `rating` varchar(255) NOT NULL DEFAULT '',
  `tipo_multimedia` varchar(255) NOT NULL DEFAULT '',
  `nombre` varchar(255) NOT NULL DEFAULT '',
  `descripcion` varchar(255) NOT NULL DEFAULT '',
  `genero` varchar(255) NOT NULL DEFAULT '',
  `fecha_publicacion` datetime DEFAULT NULL,
  `costo` varchar(255) NOT NULL DEFAULT '100',
  `uploadBy` varchar(255) NOT NULL DEFAULT 'Usuario',
  `photo` varchar(255) DEFAULT NULL,
  `pubBy` varchar(255) DEFAULT NULL,
  `directorio` varchar(255) NOT NULL DEFAULT '/var/www/readme.agrasystems.u/project/website/404.php',
  PRIMARY KEY (`id_multimedia`)
) ENGINE=InnoDB AUTO_INCREMENT=1997 DEFAULT CHARSET=utf8mb4;


#
# Structure for table "panel_developers"
#
DROP TABLE IF EXISTS `panel_developers`;
CREATE TABLE `panel_developers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `edad` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `colorBadge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;


#
# Structure for table "panel_info"
#
DROP TABLE IF EXISTS `panel_info`;
CREATE TABLE `panel_info` (
  `logo` varchar(255) DEFAULT NULL,
  `tabName` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `logoReadme` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



#
# Structure for table "pertenece"
#
DROP TABLE IF EXISTS `pertenece`;
CREATE TABLE `pertenece` (
  `correo` varchar(255) NOT NULL,
  `codigo_club` int(11) NOT NULL,
  `isOwner` tinyint(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`correo`,`codigo_club`),
  KEY `codigo_club` (`codigo_club`),
  CONSTRAINT `pertenece_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`),
  CONSTRAINT `pertenece_ibfk_2` FOREIGN KEY (`codigo_club`) REFERENCES `clubes` (`codigo_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#
# Structure for table "recibe"
#
DROP TABLE IF EXISTS `recibe`;
CREATE TABLE `recibe` (
  `fecha_recibida` datetime NOT NULL,
  `correo` varchar(255) NOT NULL,
  `id_multa` int(11) NOT NULL,
  PRIMARY KEY (`fecha_recibida`,`correo`,`id_multa`),
  KEY `correo` (`correo`),
  KEY `id_multa` (`id_multa`),
  CONSTRAINT `recibe_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`),
  CONSTRAINT `recibe_ibfk_2` FOREIGN KEY (`id_multa`) REFERENCES `multas` (`id_multa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#
# Structure for table "redes_sociales"
#
DROP TABLE IF EXISTS `redes_sociales`;
CREATE TABLE `redes_sociales` (
  `red_social` varchar(255) NOT NULL,
  `id_autor` int(11) NOT NULL,
  PRIMARY KEY (`id_autor`,`red_social`),
  CONSTRAINT `redes_sociales_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#
# Structure for table "resenia"
#
DROP TABLE IF EXISTS `resenia`;
CREATE TABLE `resenia` (
  `id_resenia` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `calificacion_dada` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id_resenia`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;


#
# Structure for table "tiene_autor"
#
DROP TABLE IF EXISTS `tiene_autor`;
CREATE TABLE `tiene_autor` (
  `id_multimedia` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  PRIMARY KEY (`id_multimedia`,`id_autor`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `tiene_autor_ibfk_1` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`),
  CONSTRAINT `tiene_autor_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


#
# Structure for table "users_accounts"
#
DROP TABLE IF EXISTS `users_accounts`;
CREATE TABLE `users_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `perms_level` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `creditos` int(11) DEFAULT 0,
  `createdAt` datetime NOT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `localidad` varchar(255) NOT NULL DEFAULT 'Sin especificar',
  `verified` tinyint(1) NULL DEFAULT,
  `fecha_nacimiento` datetime NUll,
  PRIMARY KEY (`correo`,`id`),
  UNIQUE KEY `UkUsername` (`username`),
  KEY `IdContador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;


#
# Structure for table "users_alquila"
#
DROP TABLE IF EXISTS `users_alquila`;
CREATE TABLE `users_alquila` (
  `id_multimedia` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  `fecha_entregado` datetime NULL,
  `Verifica` tinyint(1) NULL,
  PRIMARY KEY (`id_multimedia`,`correo`),
  KEY `correo` (`correo`),
  CONSTRAINT `users_alquila_ibfk_1` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



#
# Structure for table "users_logs"
#
DROP TABLE IF EXISTS `users_logs`;
CREATE TABLE `users_logs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) DEFAULT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '0',
  `info` varchar(255) NOT NULL DEFAULT '',
  `date` datetime,
  `localidad` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `userId` (`userId`),
  KEY `username` (`username`),
  CONSTRAINT `users_logs_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users_accounts` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4;

#
# Structure for table "users_passwords_reset"
#
DROP TABLE IF EXISTS "users_passwords_reset";
CREATE TABLE `users_passwords_reset` (
	Id int(11) NOT NULL AUTO_INCREMENT,
	email varchar(255) NOT NULL,
	newPass varchar(255) NOT NULL,
	encrypted varchar(255) NOT NULL,
	date datetime NOT NULL,
	PRIMARY KEY (`Id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# Structure for table "utiliza"
#
DROP TABLE IF EXISTS `utiliza`;
CREATE TABLE `utiliza` (
  `id_multimedia` int(11) NOT NULL,
  `codigo_club` int(11) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  PRIMARY KEY (`id_multimedia`,`codigo_club`),
  KEY `codigo_club` (`codigo_club`),
  CONSTRAINT `utiliza_ibfk_1` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`),
  CONSTRAINT `utiliza_ibfk_2` FOREIGN KEY (`codigo_club`) REFERENCES `clubes` (`codigo_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

