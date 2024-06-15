/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table almacena
# ------------------------------------------------------------

DROP TABLE IF EXISTS `almacena`;

CREATE TABLE `almacena` (
  `codigo_institucion` int NOT NULL,
  `id_multimedia` int NOT NULL,
  PRIMARY KEY (`codigo_institucion`,`id_multimedia`),
  KEY `id_multimedia` (`id_multimedia`),
  CONSTRAINT `almacena_ibfk_1` FOREIGN KEY (`codigo_institucion`) REFERENCES `institucion_educativa` (`codigo_institucion`),
  CONSTRAINT `almacena_ibfk_2` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table asiste
# ------------------------------------------------------------

DROP TABLE IF EXISTS `asiste`;

CREATE TABLE `asiste` (
  `codigo_institucion` int NOT NULL,
  `correo` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo_institucion`,`correo`),
  KEY `correo` (`correo`),
  CONSTRAINT `asiste_ibfk_1` FOREIGN KEY (`codigo_institucion`) REFERENCES `institucion_educativa` (`codigo_institucion`),
  CONSTRAINT `asiste_ibfk_2` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table autores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `autores`;

CREATE TABLE `autores` (
  `id_autor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL DEFAULT 'Anonimo',
  `apellido` varchar(255) NOT NULL DEFAULT 'Anonimo',
  `nacionalidad` varchar(255) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `profilePic` varchar(255) DEFAULT 'https://cdn.discordapp.com/attachments/874108766436597760/1003989723909476373/unknown.png',
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table clubes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clubes`;

CREATE TABLE `clubes` (
  `codigo_club` int NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `nombre` varchar(200) NOT NULL DEFAULT 'Club de Lectura',
  `genero` varchar(255) DEFAULT NULL,
  `createdBy` varchar(255) NOT NULL DEFAULT 'Usuario',
  `icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `clubes` WRITE;
/*!40000 ALTER TABLE `clubes` DISABLE KEYS */;

INSERT INTO `clubes` (`codigo_club`, `descripcion`, `fecha_creacion`, `rating`, `nombre`, `genero`, `createdBy`, `icon`) VALUES
	(1, "Lorem Ipsum", "2024-01-01 23:59:00", 5, "Agras", "Drama", "1", "https://img.freepik.com/vector-gratis/concepto-ilustracion-terapia-grupo_52683-45774.jpg?w=2000");

/*!40000 ALTER TABLE `clubes` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table consume
# ------------------------------------------------------------

DROP TABLE IF EXISTS `consume`;

CREATE TABLE `consume` (
  `correo` varchar(255) NOT NULL,
  `id_multimedia` int NOT NULL,
  PRIMARY KEY (`correo`,`id_multimedia`),
  KEY `id_multimedia` (`id_multimedia`),
  CONSTRAINT `consume_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`),
  CONSTRAINT `consume_ibfk_2` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table hace_resenia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hace_resenia`;

CREATE TABLE `hace_resenia` (
  `id_resenia` int NOT NULL,
  `id_multimedia` int NOT NULL,
  `correo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_resenia`,`id_multimedia`,`correo`),
  KEY `id_multimedia` (`id_multimedia`),
  KEY `correo` (`correo`),
  CONSTRAINT `hace_resenia_ibfk_1` FOREIGN KEY (`id_resenia`) REFERENCES `resenia` (`id_resenia`),
  CONSTRAINT `hace_resenia_ibfk_2` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`),
  CONSTRAINT `hace_resenia_ibfk_3` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table institucion_educativa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `institucion_educativa`;

CREATE TABLE `institucion_educativa` (
  `codigo_institucion` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  PRIMARY KEY (`codigo_institucion`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table multas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `multas`;

CREATE TABLE `multas` (
  `id_multa` int NOT NULL AUTO_INCREMENT,
  `castigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`id_multa`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table multimedia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `multimedia`;

CREATE TABLE `multimedia` (
  `id_multimedia` int NOT NULL AUTO_INCREMENT,
  `rating` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `tipo_multimedia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `descripcion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `genero` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `fecha_publicacion` datetime DEFAULT NULL,
  `costo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '100',
  `uploadBy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Usuario',
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pubBy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `directorio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '/var/www/readme.agrasystems.u/project/website/404.php',
  PRIMARY KEY (`id_multimedia`)
) ENGINE=InnoDB AUTO_INCREMENT=2076 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `multimedia` WRITE;
/*!40000 ALTER TABLE `multimedia` DISABLE KEYS */;

INSERT INTO `multimedia` (`id_multimedia`, `rating`, `tipo_multimedia`, `nombre`, `descripcion`, `genero`, `fecha_publicacion`, `costo`, `uploadBy`, `photo`, `pubBy`, `directorio`) VALUES
	(2018, "4", "Libro", "Lucy by the Sea", "Con su característica prosa sobria y cristalina, Elizabeth Strout dirige su ojo exquisitamente afinado hacia el funcionamiento interno del corazón humano, siguiendo a la indomable heroína de Mi nombre es Lucy Barton a través de los primeros días de la pandemia.\n", "Ficcion", "2022-09-20 00:00:00", "287", "Usuario", "assets/media/books/Lucy by the Sea.jpg\r\n", "37", "files/libros/_OceanofPDF.com_Lucy_By_the_Sea_-_Elizabeth_Strout.pdf"),
	(2019, "4", "Libro", "Now Is Not the Time to Panic", "De la autora del bestseller del New York Times \"Nada que ver aquí\", llega una novela exuberante y de gran corazón sobre dos adolescentes inadaptados que chocan espectacularmente un verano fatídico, y el arte que hacen que cambia sus vidas para siempre.", "Ficcion", "2022-11-15 00:00:00", "615", "Usuario", "assets/media/books/Now Is Not the Time to Panic.jpg\r\n", "38", "NO"),
	(2020, "3", "Libro", "Our Missing Hearts", "Bird Gardner, de doce años, vive una existencia tranquila con su cariñoso pero destrozado padre, un antiguo lingüista que ahora archiva libros en una biblioteca universitaria. Bird sabe que no debe hacer demasiadas preguntas, ni destacar demasiado, ni alejarse demasiado. Durante una década, sus vidas se han regido por leyes escritas para preservar la ", "Ficcion", "2022-08-04 00:00:00", "615", "Usuario", "assets/media/books/Our Missing Hearts.jpg\r\n", "39", "files/libros/_OceanofPDF.com_Our_Missing_Hearts_-_Celeste_Ng_ (1).pdf\r\n"),
	(2021, "4", "Libro", "Cleopatra and Frankenstein", "Cleo, una pintora británica de veinticuatro años, ha escapado de Inglaterra a Nueva York y aún está buscando su lugar en la insomne ciudad cuando, unos meses antes de que termine su visado de estudiante, conoce a Frank. Veinte años mayor y un éxito hecho a sí mismo, la vida de Frank está llena de todos los excesos de los que carece Cleo. Él le ofrece la posibilidad de ser feliz, la libertad de pintar y la oportunidad de solicitar la tarjeta verde. Pero su impulsivo matrimonio cambia irreversiblemente sus vidas y las de sus allegados, de una manera que nunca hubieran podido prever.  Cada capítulo, de lectura compulsiva, explora las vidas de Cleo, Frank y un inolvidable elenco de sus amigos y familiares más cercanos mientras crecen y se hacen mayores. Tanto si se trata del mejor amigo de Cleo que lucha por aceptar su homosexualidad tras el matrimonio de Cleo, como si se trata de la hermana de Frank, dependiente económicamente, que organiza citas con un papito para mantenerse después de haber sido excluida, o si se trata de Cleo y Frank, que descubren las pruebas del matrimonio y la enfermedad mental, cada personaje es tan absorbente y tan dolorosamente identificable como el anterior.  Tan hilarante como desgarrador, tan entretenido como profundamente conmovedor, Cleopatra y Frankenstein supone la entrada de un nuevo talento brillante y audaz.", "Ficcion", "2022-02-15 00:00:00", "369", "Usuario", "assets/media/books/Cleopatra and Frankenstein.jpg", "40", "files/libros/_OceanofPDF.com_Cleopatra_and_Frankenstein_-_Coco_Mellors.pdf\r\n"),
	(2022, "4", "Libro", "Demon Copperhead", "Ambientada en las montañas del sur de los Apalaches, esta es la historia de un chico nacido de una madre soltera adolescente en una caravana de una sola hoja, sin más bienes que la buena apariencia y el pelo cobrizo de su padre muerto, un ingenio cáustico y un feroz talento para sobrevivir. En una trama que nunca se detiene para respirar, relatada con su propia e implacable voz, se enfrenta a los peligros modernos de los hogares de acogida, el trabajo infantil, las escuelas abandonadas, el éxito deportivo, la adicción, los amores desastrosos y las pérdidas aplastantes. A través de todo ello, se enfrenta a su propia invisibilidad en una cultura popular en la que incluso los superhéroes han abandonado a los pueblos rurales en favor de las ciudades.  Hace muchas generaciones, Charles Dickens escribió David Copperfield a partir de su experiencia como superviviente de la pobreza institucional y sus daños en los niños de su sociedad. Esos problemas aún no se han resuelto en la nuestra. Dickens no es un requisito indispensable para los lectores de esta novela, pero le sirvió de inspiración. Al trasladar una novela épica victoriana al sur estadounidense contemporáneo, Barbara Kingsolver recurre a la ira y la compasión de Dickens y, sobre todo, a su fe en el poder transformador de una buena historia. Demon Copperhead habla en nombre de una nueva generación de niños perdidos, y de todos aquellos que nacen en lugares hermosos y malditos que no pueden imaginar dejar atrás.", "Ficcion", "2022-08-18 00:00:00", "656", "Usuario", "assets/media/books/Demon Copperhead.jpg\r\n", "41", "files/libros/_OceanofPDF.com_Demon_Copperhead_-_Barbara_Kingsolver.pdf\r\n"),
	(2023, "4", "Libro", "Shrines of Gaiety", "1926, y en un país que aún se recupera de la Gran Guerra, Londres se ha convertido en el centro de una nueva y delirante vida nocturna. En los clubes del Soho, los miembros del reino se codean con las estrellas, los dignatarios extranjeros con los gánsteres y las chicas venden bailes por un chelín cada vez.  La notoria reina de este mundo de relumbrón es Nellie Coker, despiadada pero también ambiciosa para sacar adelante a sus seis hijos, incluido el enigmático mayor, Niven, cuyo carácter se ha forjado en el crisol del Somme. Pero el éxito genera enemigos, y el imperio de Nellie se enfrenta a amenazas de fuera y de dentro. Porque bajo el deslumbramiento de la alegría del Soho, hay un oscuro fondo, un mundo en el que es demasiado fácil perderse.  Con su singular estilo dickensiano, Kate Atkinson nos ofrece una ventana a un mundo desaparecido. Astutamente divertida, brillantemente observadora e ingeniosamente tramada, Los santuarios de la alegría muestra los múltiples talentos que han hecho de Atkinson una de las escritoras más alabadas de nuestro tiempo.", "Ficcion histórica", "2022-09-27 00:00:00", "615", "Usuario", "assets/media/books/Shrines of Gaiety.jpg\r\n", "42", "files/libros/_OceanofPDF.com_Shrines_of_Gaiety_-_Kate_Atkinson.pdf\r\n"),
	(2024, "4", "Libro", "The Marriage Portrait", "De la autora del éxito de ventas del New York Times, Hamnet -ganador del Premio del Círculo Nacional de Críticos de Libros-, una nueva y electrizante novela ambientada en la Italia del Renacimiento y centrada en la cautivadora joven duquesa Lucrecia de Médicis.", "Ficcion histórica", "2022-09-06 00:00:00", "615", "Usuario", "assets/media/books/The Marriage Portrait.jpg\r\n", "43", "files/libros/_OceanofPDF.com_The_Marriage_Portrait_-_Maggie_OFarrell.pdf"),
	(2025, "3", "Libro", "Other Birds", "Kevin Wilson", "Ficcion", "2022-07-30 00:00:00", "615", "Usuario", "assets/media/books/Other Birds.jpg\r\n", "44", "files/libros/_OceanofPDF.com_Other_Birds_-_Sarah_Addison_Allen.pdf\r\n"),
	(2026, "4", "Libro", "Fairy Tale", "Charlie Reade parece un chico normal de instituto, genial en béisbol y fútbol, un estudiante decente. Pero lleva una pesada carga. Su madre murió en un accidente en el que se dio a la fuga cuando él tenía diez años, y el dolor llevó a su padre a la bebida. Charlie aprendió a cuidar de sí mismo y de su padre. Entonces, cuando Charlie tiene diecisiete años, conoce a Howard Bowditch, un recluso con un gran perro en una gran casa en la cima de una gran colina. En el patio trasero hay un cobertizo cerrado con llave del que surgen extraños sonidos, como si alguna criatura intentara escapar. Cuando el Sr. Bowditch muere, le deja a Charlie la casa, una enorme cantidad de oro, una cinta de casete que cuenta una historia imposible de creer y una responsabilidad demasiado grande para que la asuma un niño.  Porque dentro del cobertizo hay un portal a otro mundo, uno cuyos habitantes están en peligro y cuyos monstruosos líderes pueden destruir su propio mundo y el nuestro. En este universo paralelo, en el que dos lunas surcan el cielo y las grandes torres de un extenso palacio atraviesan las nubes, hay princesas y príncipes exiliados que sufren horribles castigos; hay mazmorras; hay juegos en los que hombres y mujeres deben luchar entre sí hasta la muerte para diversión del \"Hermoso\". Y hay un reloj de sol mágico que puede hacer retroceder el tiempo.  Una historia tan antigua como el mito, y tan sorprendente e icónica como el resto de la obra de King, Fairy Tale trata de un tipo ordinario obligado a asumir el papel de héroe por las circunstancias, y es a la vez espectacularmente", "Fantasia", "2022-09-06 00:00:00", "697", "Usuario", "assets/media/books/Fairy Tale.jpg\r\n", "45", "files/libros/_OceanofPDF.com_Fairy_Tale_-_Stephen_King.pdf\r\n"),
	(2027, "3", "Libro", "The Atlas Six", "La Sociedad Alejandrina es una sociedad secreta de académicos mágicos, los mejores del mundo. Sus miembros son guardianes del conocimiento perdido de las mayores civilizaciones de la antigüedad. Y aquellos que se ganen un puesto entre ellos se asegurarán una vida de riqueza, poder y prestigio más allá de sus sueños más salvajes. Cada década, los seis magos con más talento del mundo son seleccionados para la iniciación - y aquí están los elegidos...", "Fantasia", "2020-01-31 00:00:00", "369", "Usuario", "assets/media/books/The Atlas Six.jpg\r\n", "46", "files/libros/_OceanofPDF.com_The_Atlas_Six_-_Olivie_Blake.pdf\r\n"),
	(2028, "4", "Libro", "The War of Two Queens", "Casteel Da\'Neer sabe muy bien que muy pocos son tan astutos o despiadados como la Reina de la Sangre, pero nadie, ni siquiera él, podría haberse preparado para las asombrosas revelaciones. La magnitud de lo que ha hecho la Reina de la Sangre es casi impensable.", "Fantasia", "2022-03-15 00:00:00", "328", "Usuario", "assets/media/books/The War of Two Queens.jpg\r\n", "47", "files/libros/_OceanofPDF.com_The_war_of_two_queens_-_Jennifer_L_Armentrout.pdf\r\n"),
	(2030, "4", "Libro", "Gallows Hill", "La familia Hull ha sido propietaria de la bodega Gallows Hill durante generaciones, viviendo y trabajando en los hermosos terrenos donde cultivan sus famosas uvas. Hasta la noche en que el Sr. y la Sra. Hull se instalan por la noche... y están muertos por la mañana.  Cuando su hija, Margot, hereda el negocio familiar, no quiere saber nada de él. La bodega es valorada por sus inigualables productos, pero está construida en un campo donde una vez fueron ahorcados cientos de convictos, y los lugareños susurran rumores morbosos. Dicen que el terreno está maldito.  Ha pasado más de una década desde que Margot vio por última vez la casa de su infancia. Pero ahora que está sola en el extenso y ruinoso edificio, empieza a creer que la maldición es más que real y que ella puede ser la próxima víctima de la casa que nunca descansa...", "Terror", "2022-09-06 00:00:00", "205", "Usuario", "assets/media/books/Gallows Hill.jpg\r\n", "48", "files/libros/_OceanofPDF.com_Gallows_Hill_-_Darcy_Coates.pdf\r\n"),
	(2031, "3", "Libro", "The Violence", "Chelsea Martin parece ser el ama de casa perfecta: casada con su novio del instituto, madre de dos hijas y cuidadora de un hogar inmaculado.  Pero el marido de Chelsea ha convertido su casa en una prisión; lleva años abusando de ella, cortando su independencia, su autonomía y su apoyo. No tiene a quién recurrir, ni siquiera a su narcisista madre, Patricia, más preocupada por mantener la apariencia de una familia ideal que por el bienestar real de su hija. Y a Chelsea le preocupa que sus hijas queden atrapadas igual que ella... hasta que una misteriosa enfermedad recorre la nación.  Conocida como La Violencia, esta enfermedad hace que los infectados experimenten repentinos y explosivos ataques de rabia animal y ataquen a cualquiera que se encuentre en su camino. Pero para Chelsea, el caos y la confusión que provoca el virus es una oportunidad, e inspira un plan para liberarse de su agresor.", "Terror", "2022-02-01 00:00:00", "492", "Usuario", "assets/media/books/The Violence.jpg\r\n", "49", "NO"),
	(2032, "4", "Libro", "Gwendy\'s Final Task", "Cuando Gwendy Peterson tenía doce años, un misterioso desconocido llamado Richard Farris le dio una misteriosa caja para que la guardara. Ofrecía golosinas y monedas antiguas, pero era peligrosa. Pulsar cualquiera de sus ocho botones de colores prometía muerte y destrucción. Años después, la caja de botones volvió a entrar en la vida de Gwendy. Una novelista de éxito y una estrella política en ascenso, se vio obligada una vez más a enfrentarse a la tentación que representaba la caja. Ahora, fuerzas malignas buscan poseer la caja de botones, y depende de la senadora Gwendy Peterson alejarla de ellos a toda costa. Pero, ¿dónde se puede esconder algo de entidades tan poderosas?  En La tarea final de Gwendy, los maestros de la narrativa Stephen King y Richard Chizmar nos llevan en un viaje desde Castle Rock a otra famosa ciudad maldita de Maine hasta la estación espacial MF-1, donde Gwendy debe ejecutar una misión secreta para salvar el mundo. Y, tal vez, a todos los mundos.", "Terror", "2022-01-15 00:00:00", "574", "Usuario", "assets/media/books/Gwendy\'s Final Task.jpg\r\n", "45", "NO"),
	(2033, "3", "Libro", "The Children on the Hill", "Una nueva novela que desafía el género, inspirada en la obra maestra de Mary Shelley, Frankenstein, que explora brillantemente los misterios espeluznantes de la infancia y las maldades perpetradas por los monstruos entre nosotros.", "Terror", "2022-04-26 00:00:00", "574", "Usuario", "assets/media/books/The Children on the Hill.jpg\r\n", "50", "NO"),
	(2034, "5", "Libro", "Reminders of Him", "Tras cumplir cinco años de prisión por un trágico error, Kenna Rowan regresa al pueblo donde todo salió mal, con la esperanza de reunirse con su hija de cuatro años. Pero los puentes que Kenna quemó están resultando imposibles de reconstruir. Todos los que forman parte de la vida de su hija están decididos a excluir a Kenna, sin importar lo mucho que se esfuerce por demostrar su valía.", "Romance", "2022-01-18 00:00:00", "246", "Usuario", "assets/media/books/Reminders of Him.jpg\r\n", "52", "files/libros/_OceanofPDF.com_Reminders_of_him_-_colleen_hoover.pdf\r\n"),
	(2035, "4", "Libro", "Twisted Hate", "Josh Chen, guapo, engreído y en vías de convertirse en un médico de primera, nunca había conocido a una mujer a la que no pudiera seducir, excepto a la jodida Jules Ambrose.", "Romance", "2022-01-27 00:00:00", "205", "Usuario", "assets/media/books/Twisted Hate.jpg\r\n", "53", "NO"),
	(2036, "4", "Libro", "It Starts with Us", "Lily y su ex marido, Ryle, acaban de establecer un ritmo civilizado de copaternidad cuando, de repente, se encuentra de nuevo con su primer amor, Atlas. Después de casi dos años de separación, está encantada de que, por una vez, el tiempo esté de su lado, e inmediatamente dice que sí cuando Atlas le pide una cita.", "Romance", "2022-08-18 00:00:00", "574", "Usuario", "assets/media/books/It Starts with Us.jpg\r\n", "52", "files/libros/_OceanofPDF.com_It_starts_with_us_-_Coollen_Hoover.pdf\r\n"),
	(2037, "3", "Libro", "The Wedding Crasher", "A pocas semanas de abandonar DC para ir a pastos más verdes, Solange Pereira se ve obligada a ayudar a su primo organizador de bodas en el gran día de una pareja cualquiera. Es un trabajo fácil... hasta que se topa con una situación que la convence de que la pareja no está destinada a ser. ¿Qué puede hacer una romántica de verdad? Irrumpir en la boda, por supuesto. Y asegurarse de que el incauto novio no cometa el mayor error de su vida.", "Romance", "2022-04-05 00:00:00", "451", "Usuario", "assets/media/books/The Wedding Crasher.jpg\r\n", "54", "files/libros/_OceanofPDF.com_The_Wedding_Crasher_-_Mia_Sosa.pdf\r\n"),
	(2038, "4", "Libro", "Book Lovers", "La vida de Nora Stephens son los libros -los ha leído todos- y no es ese tipo de heroína. Ni la valiente, ni la relajada chica de los sueños, ni mucho menos la enamorada. De hecho, las únicas personas para las que Nora es una heroína son sus clientes, para los que consigue enormes tratos como agente literaria despiadada, y su querida hermana pequeña Libby.", "Romance", "2022-03-03 00:00:00", "410", "Usuario", "assets/media/books/Book Lovers.jpg", "55", "files/libros/_OceanofPDF.com_Book_Lovers_-_Emily_Henry.pdf\r\n"),
	(2040, "4", "Libro", "Start Without Me", "En Empezar sin mí, Gary vuelve con su ácida lengua en la mejilla a los momentos y épocas que le definieron. Nos lleva de la mano mientras le seguimos a través de los veranos que pasa en su veintena, persiguiendo tanto el bronceado perfecto como el hombre perfecto en vano y con mucho pesar. En su instituto católico, entabla una improbable amistad con una monja que comparte la afición de Gary por las telenovelas, lo que se convierte en una salvación para ambos. Y no le hagas hablar de cómo una mala habitación de hotel puede arruinar incluso las mejores vacaciones. Esta colección de historias reales del hombre \"detrás de la mejor comedia de su generación\" (The New York Times) es para cualquiera que haya sentido la alegría de guardar un rencor de una década.", "Comedia", "2022-04-26 00:00:00", "615", "Usuario", "assets/media/books/Start Without Me.jpg\r\n", "56", "NO"),
	(2041, "4", "Libro", "All about Me!: My Remarkable Life in Show Business", "A sus 95 años, el legendario Mel Brooks sigue marcando la pauta de la comedia en la televisión, el cine y el teatro. Ahora, por primera vez, este ganador del EGOT (Emmy, Grammy, Oscar y Tony) comparte su historia con sus propias palabras.", "Comedia", "2021-11-30 00:00:00", "410", "Usuario", "assets/media/books/All about Me My Remarkable Life in Show Business.jpg\r\n", "57", "NO"),
	(2042, "3", "Libro", "Sicker in the Head: More Conversations about Life ", "Nadie conoce la comedia como Judd Apatow. Desde entrevistar a los cómicos más importantes del momento para su programa de radio en el instituto hasta actuar como monologuista en bares de mala muerte de Los Ángeles con su compañero de piso Adam Sandler, pasando por escribir y dirigir Knocked Up y producir Freaks and Geeks, Apatow siempre ha vivido, respirado y soñado con la comedia.", "Comedia", "2022-05-29 00:00:00", "533", "Usuario", "assets/media/books/Sicker in the Head More Conversations about Life and Comedy.jpg\r\n", "58", "NO"),
	(2043, "4", "Libro", "I\'d Like to Play Alone, Please: Essays", "Tom Segura es conocido por sus retorcidas tomas y su irreverente voz cómica. Pero después de unos años de giras locas y de producir podcasts semanalmente, todo ello mientras es padre de dos niños pequeños, necesita desesperadamente un segundo para sí mismo. No es que odie a sus amigos y a su familia -no es un monstruo-, simplemente está agotado, por lo que la primera frase completa de su hijo (implacable), \"Me gustaría jugar solo, por favor\", se ha convertido desde entonces en su mantra. ", "Comedia", "2022-01-01 00:00:00", "615", "Usuario", "assets/media/books/I\'d Like to Play Alone, Please Essays.jpg\r\n", "59", "NO"),
	(2044, "3", "Libro", "How High We Go in the Dark", "Para los fans de El atlas de las nubes y Estación Once, un debut fascinante y profundamente premonitorio que sigue a un elenco de personajes intrincadamente vinculados a lo largo de cientos de años mientras la humanidad lucha por reconstruirse tras una plaga climática, una obra audaz y profundamente sentida de imaginación alucinante de una nueva voz singular.", "Ciencia y Ficción", "2022-01-18 00:00:00", "615", "Usuario", "assets/media/books/How High We Go in the Dark.jpg\r\n", "60", "files/libros/_OceanofPDF.com_How_High_We_Go_in_the_Dark_-_Sequoia_Nagamatsu.pdf\r\n"),
	(2045, "3", "Libro", "Mickey7", "Mickey7 es un ", "Ciencia y Ficción", "2022-02-15 00:00:00", "615", "Usuario", "assets/media/books/Mickey7.jpg\r\n", "61", "files/libros/_OceanofPDF.com_Mickey7_-_Edward_Ashton.pdf\r\n"),
	(2046, "4", "Libro", "The Kaiju Preservation Society", "Cuando el COVID-19 arrasa con la ciudad de Nueva York, Jamie Gray se encuentra atrapada como conductora sin futuro de aplicaciones de reparto de comida. Eso es, hasta que Jamie hace una entrega a un viejo conocido, Tom, que trabaja en lo que él llama ", "Ciencia y Ficción", "2022-03-15 00:00:00", "574", "Usuario", "assets/media/books/The Kaiju Preservation Society.jpg\r\n", "62", "files/libros/_OceanofPDF.com_The_Kaiju_Preservation_Society_-_John_Scalzi.pdf\r\n"),
	(2047, "4", "Libro", "Wrong Place Wrong Time", "A finales de octubre. Después de medianoche. Estás esperando a tu hijo de diecisiete años. Llega tarde. Mientras lo observas desde la ventana, sale, y te das cuenta de que no está solo: camina hacia un hombre, y está armado.", "Misterio & Thriller", "2022-05-12 00:00:00", "615", "Usuario", "assets/media/books/Wrong Place Wrong Time.jpg", "63", "files/libros/_OceanofPDF.com_Wrong_Place_Wrong_Time_-_Gillian_McAllister.pdf\r\n"),
	(2048, "4", "Libro", "A Flicker in the Dark", "Ahora, 20 años después, Chloe es una psicóloga que ejerce su profesión en Baton Rouge y se prepara para su boda. Por fin tiene un frágil control sobre la felicidad que tanto le ha costado conseguir. Sin embargo, a veces se siente tan fuera de control de su propia vida como los adolescentes problemáticos que son sus pacientes. Y entonces desaparece una adolescente de la zona, y luego otra, y ese terrorífico verano vuelve a repetirse. ¿Está paranoica y ve paralelismos que no existen realmente o, por segunda vez en su vida, está a punto de desenmascarar a un asesino?", "Misterio & Thriller", "2022-01-11 00:00:00", "615", "Usuario", "assets/media/books/A Flicker in the Dark.jpg\r\n", "64", "files/libros/_OceanofPDF.com_A_flicker_in_the_dark_-_Stacy_willingham.pdf"),
	(2049, "3", "Libro", "Daisy Darker", "Después de años de evasión, toda la familia de Daisy Darker se reúne para la fiesta de 80 años de Nana en la casa gótica en ruinas de Nana en una pequeña isla con mareas. Por fin, reunidos por última vez, cuando suba la marea, quedarán aislados del resto del mundo durante ocho horas.", "Misterio & Thriller", "2022-08-30 00:00:00", "615", "Usuario", "assets/media/books/Daisy Darker.jpg\r\n", "65", "files/libros/_OceanofPDF.com_Daisy_Darker_-_Alice_Feeney.pdf\r\n"),
	(2050, "3", "Libro", "Friends, Lovers, and the Big Terrible Thing", "En una historia extraordinaria que sólo él podría contar, Matthew Perry lleva a los lectores al escenario de la comedia de mayor éxito de todos los tiempos, al tiempo que se sincera sobre su lucha privada contra la adicción. Sincero, consciente de sí mismo y narrado con su característico humor, Perry detalla vívidamente su batalla de toda la vida con la enfermedad y lo que la alimentó a pesar de tenerlo aparentemente todo.", "Memorias y Autobiografia", "2022-11-01 00:00:00", "615", "Usuario", "assets/media/books/Friends, Lovers, and the Big Terrible Thing.jpg\r\n", "66", "files/libros/_OceanofPDF.com_Friends_Lovers_and_the_Big_Terrible_Thing_-_Matthew_Perry.pdf"),
	(2051, "4", "Libro", "I\'m Glad My Mom Died", "Unas memorias desgarradoras y divertidas de la estrella de iCarly y Sam & Cat, Jennette McCurdy, sobre sus luchas como ex actriz infantil -incluyendo desórdenes alimenticios, adicción y una complicada relación con su dominante madre- y cómo retomó el control de su vida.", "Memorias y Autobiografia", "2022-08-09 00:00:00", "615", "Usuario", "assets/media/books/I\'m Glad My Mom Died.jpg\r\n", "67", "files/libros/_OceanofPDF.com_Im_glad_my_mom_died_-_Jennette_McCurdy.pdf\r\n"),
	(2052, "3", "Libro", "Trust", "A pesar del estruendo y la efervescencia de los años 20, todo el mundo en Nueva York ha oído hablar de Benjamin y Helen Rask. Él es un legendario magnate de Wall Street; ella es la brillante hija de unos excéntricos aristócratas. Juntos han llegado a la cima de un mundo de riqueza aparentemente infinita. Pero los secretos que rodean su afluencia y grandeza incitan a las habladurías. Los rumores sobre las maniobras financieras de Benjamin y la reclusión de Helen comienzan a extenderse, todo ello mientras una década de excesos y especulaciones llega a su fin. ¿A qué precio han adquirido su inmensa fortuna?", "Ficcion histórica", "2022-05-03 00:00:00", "615", "Usuario", "assets/media/books/Trust.jpg\r\n", "68", "files/libros/_OceanofPDF.com_Trust_-_Hernan_Diaz.pdf\r\n"),
	(2053, "4", "Libro", "In the Distance", "Un joven sueco se encuentra sin dinero y solo en California. Viaja hacia el este en busca de su hermano, avanzando a pie en contra del gran impulso hacia el oeste. En su viaje a través de vastas extensiones, Håkan se encuentra con naturalistas, criminales, fanáticos religiosos, indios y agentes de la ley, y sus hazañas lo convierten en una leyenda. Díaz desafía las convenciones de la ficción histórica y del género (la narrativa de viajes, el bildungsroman, la escritura de la naturaleza, el western), ofreciendo una mirada indagadora a los estereotipos que pueblan nuestro pasado y un retrato del extranjerismo radical.", "Ficcion histórica", "2017-08-03 00:00:00", "697", "Usuario", "assets/media/books/In the Distance.jpg\r\n", "68", "files/libros/_OceanofPDF.com_In_the_Distance_-_Hernan_Diaz.pdf\r\n"),
	(2054, "4", "Libro", "The Diamond Eye", "En 1937, en la ciudad nevada de Kiev (ahora conocida como Kyiv), la estudiante de historia Mila Pavlichenko organiza su vida en torno a su trabajo en la biblioteca y a su hijo pequeño, pero la invasión de Ucrania y Rusia por parte de Hitler la lleva por un camino diferente. Cuando le dan un rifle y la envían a luchar, Mila debe pasar de ser una chica estudiosa a una francotiradora letal, una cazadora de nazis conocida como Lady Death. Cuando la noticia de su muerte número 300 la convierte en una heroína nacional, Mila se ve arrancada de los sangrientos campos de batalla del frente oriental y enviada a Estados Unidos en una gira de buena voluntad.", "Ficcion histórica", "2022-03-29 00:00:00", "615", "Usuario", "assets/media/books/The Diamond Eye.jpg\r\n", "69", "files/libros/_OceanofPDF.com_The_Diamond_Eye_-_Kate_Quinn.pdf\r\n"),
	(2055, "5", "Libro", "The Hurting Kind: Poems", "\"Siempre he sido demasiado sensible, un llorón / de una larga estirpe de llorones\", escribe Limón. \"Soy de los que se duelen\". ¿Qué significa ser del tipo doliente? ¿Ser sensible no sólo al dolor y a las alegrías del mundo, sino a los significados que se doblan en la malla entre el mundo natural y el mundo humano? ¿Adivinar las relaciones entre todos nosotros? ¿Percibirnos a nosotros mismos en otros seres y saber que esos seres son decididamente suyos, que \"no les importa ser vistos como símbolos\"?", "Poemas", "2022-05-10 00:00:00", "348", "Usuario", "assets/media/books/The Hurting Kind Poems.jpg\r\n", "70", "NO"),
	(2056, "4", "Libro", "Time Is a Mother", "En este segundo poemario, profundamente íntimo, Ocean Vuong busca la vida entre las secuelas de la muerte de su madre, encarnando la paradoja de sentarse dentro del dolor mientras se está decidido a sobrevivir más allá de él. ", "Poemas", "2022-04-05 00:00:00", "615", "Usuario", "assets/media/books/Time Is a Mother.jpg\r\n", "71", "files/libros/_OceanofPDF.com_Time_is_a_Mother_-_Ocean_Vuong.pdf\r\n"),
	(2057, "4", "Libro", "Poukahangatus: Poems", "Íntima, conmovedora, virtuosa e hilarante, Tayi Tibble es una de las nuevas voces más interesantes de la poesía actual. En Poūkahangatus (pronunciado \"Pocahontas\"), su primer volumen, Tibble desafía una deslumbrante variedad de mitologías -griegas, maoríes, feministas, kiwis-, desmenuzándolas y reestructurándolas en términos modernos. ", "Poemas", "2022-07-26 00:00:00", "615", "Usuario", "assets/media/books/Poukahangatus Poems.jpg\r\n", "72", "NO"),
	(2058, "5", "Libro", "Ducks: Two Years in the Oil Sands", "Antes de que existiera Kate Beaton, dibujante superventas del New York Times con fama de Hark A Vagrant, existía Katie Beaton, de los Beatons de Cabo Bretón, concretamente de Mabou, una comunidad costera muy unida donde la langosta es tan abundante como las playas, los violines y las canciones populares gaélicas. Después de la universidad, Beaton se dirige al oeste para aprovechar la fiebre del petróleo de Alberta, formando parte de la larga tradición de los habitantes de la costa este que buscan un empleo remunerado en otro lugar cuando no lo encuentran en la patria que tanto aman. Con el único objetivo de pagar sus préstamos estudiantiles, lo que el viaje le costará a Beaton será mucho más de lo que prevé.", "Novelas Gráficas y Cómics", "2022-09-13 00:00:00", "615", "Usuario", "assets/media/books/Ducks Two Years in the Oil Sands.jpg\r\n", "73", "NO"),
	(2059, "4", "Libro", "Everything Is OK", "Todo está bien es la historia de la lucha de Debbie Tung contra la ansiedad y su experiencia con la depresión. Comparte lo que es navegar por la vida, pensar en todos los posibles peores escenarios y sentir constantemente que se ha perdido toda esperanza.", "Novelas Gráficas y Cómics", "2022-02-01 00:00:00", "369", "Usuario", "assets/media/books/Everything Is OK.jpg\r\n", "74", "NO"),
	(2060, "4", "Libro", "Oddball", "El cuarto libro de la enormemente popular serie de novelas gráficas, la última colección de cómics Sarah\'s Scribbles explora los males de la procrastinación, las pruebas del proceso creativo, la ternura de los gatitos y la belleza de no preocuparse por tu apariencia tanto como cuando eras más joven. Cuando se trata de ilustraciones humorísticas de la torpeza y la hilaridad de la vida milenaria, Sarah\'s Scribbles no tiene parangón.", "Novelas Gráficas y Cómics", "2021-12-07 00:00:00", "350", "Usuario", "assets/media/books/Oddball.jpg\r\n", "75", "files/libros/_OceanofPDF.com_Oddball_Sarahs_Scribbles_4_-_Sarah_Andersen.pdf\r\n"),
	(2061, "4", "Libro", "And There Was Light: Abraham Lincoln and the Ameri", "Un presidente que gobernó un país dividido tiene mucho que enseñarnos en un momento de polarización y crisis política del siglo XXI. Abraham Lincoln fue presidente cuando los implacables secesionistas no daban cuartel en un choque de visiones inextricablemente ligado al dinero, el poder, la raza, la identidad y la fe. Fue odiado y aclamado, excoriado y venerado. En Lincoln podemos ver las posibilidades de la presidencia, así como sus limitaciones.", "Historia y Biografía", "2022-08-18 00:00:00", "615", "Usuario", "assets/media/books/And There Was Light Abraham Lincoln and the American Struggle.jpg", "76", "NO"),
	(2062, "4", "Libro", "Bad Mexicans: Race, Empire, and Revolution in the ", "Bad Mexicans cuenta la dramática historia de los magonistas, los rebeldes migrantes que desencadenaron la Revolución Mexicana de 1910 desde Estados Unidos. Liderados por un radical brillante pero malhumorado llamado Ricardo Flores Magón, los magonistas eran una banda variopinta de periodistas, mineros, trabajadores migrantes y otros, que organizaron a miles de trabajadores mexicanos -y disidentes estadounidenses- para su causa.", "Historia y Biografía", "2022-05-10 00:00:00", "376", "Usuario", "assets/media/books/Bad Mexicans Race, Empire, and Revolution in the Borderlands.jpg\r\n", "77", "NO"),
	(2063, "4", "Libro", "American Midnight: Democracy\'s Forgotten Crisis, 1", "La nación estaba al borde del abismo. Turbas enfurecidas queman iglesias negras y persiguen a pacifistas e inmigrantes. Más de mil hombres y mujeres fueron encarcelados sólo por lo que habían escrito o dicho, incluso en privado. Unas asombrosas 250.000 personas se unieron a un grupo de vigilancia nacional patrocinado por el Departamento de Justicia.", "Historia y Biografía", "2022-08-04 00:00:00", "656", "Usuario", "assets/media/books/American Midnight Democracy\'s Forgotten Crisis, 1917-1921.jpg\r\n", "78", "NO"),
	(2070, "3", "Pelicula", "Mesi", "Reseña de Pelicula ", "Otro", "2024-01-01 23:59:59", "100", "asd", "https://i.imgur.com/3nM29bW.png", "18", "NO"),
	(2071, "10", "Musica", " IV by Led Zeppelin\r\n\r\n", "Reseña de Musica ", "Rock", "2024-01-01 23:59:59", "100", "usuario", "https://i.imgur.com/sMr6PY0.png", "95", "NO"),
	(2072, "10", "Musica", "Abbey Road by The Beatles", "Reseña de Musica ", "Rock", "2024-01-01 23:59:59", "100", "usuario", "https://i.imgur.com/sMr6PY0.png", "95", "NO"),
	(2073, "10", "Musica", "Dark Side Of The Moon by Pink Floyd", "Reseña de Musica ", "Rock", "2024-01-01 23:59:59", "100", "usuario", "https://i.imgur.com/sMr6PY0.png", "95", "NO"),
	(2074, "10", "Musica", "OK Computer by Radiohead", "Reseña de Musica ", "Rock", "2024-01-01 23:59:59", "100", "usuario", "https://i.imgur.com/sMr6PY0.png", "95", "NO"),
	(2075, "5", "Musica", "asd", "Reseña de Musica ", "Salsa", "2024-01-01 23:59:59", "100", "agus", "https://i.imgur.com/sMr6PY0.png", "1", "NO");

/*!40000 ALTER TABLE `multimedia` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table panel_developers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `panel_developers`;

CREATE TABLE `panel_developers` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `edad` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `colorBadge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `panel_developers` WRITE;
/*!40000 ALTER TABLE `panel_developers` DISABLE KEYS */;

INSERT INTO `panel_developers` (`Id`, `nombre`, `apellido`, `descripcion`, `rol`, `edad`, `foto`, `colorBadge`) VALUES
	(1, "Agustin", "Fagundez", "Desarrollador principal", "Developer", "20", "assets/media/avatars/150-2.jpg", "5"),
	(2, "Rodrigo", "Sanchez", "Encargado de base de datos", "DB Manager", "18", "assets/media/avatars/150-3.jpg", "2"),
	(3, "Agustin", "Garcia", "Encargado de los respaldos", "Backup Manager", "18", "assets/media/avatars/150-4.jpg", "1"),
	(4, "Guillermo", "Soanes", "Gestor de la plataforma", "Platform Manager", "18", "assets/media/avatars/150-7.jpg", "3");

/*!40000 ALTER TABLE `panel_developers` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table panel_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `panel_info`;

CREATE TABLE `panel_info` (
  `logo` varchar(255) DEFAULT NULL,
  `tabName` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `logoReadme` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `panel_info` WRITE;
/*!40000 ALTER TABLE `panel_info` DISABLE KEYS */;

INSERT INTO `panel_info` (`logo`, `tabName`, `url`, `owner`, `logoReadme`) VALUES
	("https://png.pngtree.com/png-vector/20230302/ourmid/pngtree-dashboard-line-icon-vector-png-image_6626604.png", NULL, "https://sdbe.afagundez.shop/", "Agus", "assets/media/ReadmeLogo.png");

/*!40000 ALTER TABLE `panel_info` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table pertenece
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pertenece`;

CREATE TABLE `pertenece` (
  `correo` varchar(255) NOT NULL,
  `codigo_club` int NOT NULL,
  `isOwner` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`correo`,`codigo_club`),
  KEY `codigo_club` (`codigo_club`),
  CONSTRAINT `pertenece_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`),
  CONSTRAINT `pertenece_ibfk_2` FOREIGN KEY (`codigo_club`) REFERENCES `clubes` (`codigo_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table recibe
# ------------------------------------------------------------

DROP TABLE IF EXISTS `recibe`;

CREATE TABLE `recibe` (
  `fecha_recibida` datetime NOT NULL,
  `correo` varchar(255) NOT NULL,
  `id_multa` int NOT NULL,
  PRIMARY KEY (`fecha_recibida`,`correo`,`id_multa`),
  KEY `correo` (`correo`),
  KEY `id_multa` (`id_multa`),
  CONSTRAINT `recibe_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `users_accounts` (`correo`),
  CONSTRAINT `recibe_ibfk_2` FOREIGN KEY (`id_multa`) REFERENCES `multas` (`id_multa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table redes_sociales
# ------------------------------------------------------------

DROP TABLE IF EXISTS `redes_sociales`;

CREATE TABLE `redes_sociales` (
  `red_social` varchar(255) NOT NULL,
  `id_autor` int NOT NULL,
  PRIMARY KEY (`id_autor`,`red_social`),
  CONSTRAINT `redes_sociales_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table resenia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `resenia`;

CREATE TABLE `resenia` (
  `id_resenia` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `calificacion_dada` int NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_resenia`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `resenia` WRITE;
/*!40000 ALTER TABLE `resenia` DISABLE KEYS */;

INSERT INTO `resenia` (`id_resenia`, `fecha`, `calificacion_dada`, `descripcion`) VALUES
	(2, "1991-12-03 18:10:42", 9, "Duis mattis egestas metus. Aenean fermentum. Donec ut mauris eget massa tempor convallis."),
	(3, "2000-07-12 16:42:43", 6, "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros. Vestibulum ac est lacinia nisi venenatis tristique."),
	(4, "2019-04-13 18:25:55", 6, "Nullam molestie nibh in lectus."),
	(5, "2008-09-21 17:20:16", 6, "Vivamus tortor. Duis mattis egestas metus. Aenean fermentum."),
	(6, "2009-02-07 02:44:18", 2, "Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat."),
	(7, "2000-07-01 16:07:18", 6, "Donec dapibus. Duis at velit eu est congue elementum. In hac habitasse platea dictumst."),
	(8, "1991-08-04 04:37:28", 8, "In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit."),
	(9, "1998-12-25 13:36:49", 7, "Morbi vestibulum, velit id pretium iaculis, diam erat fermentum justo, nec condimentum neque sapien placerat ante. Nulla justo."),
	(10, "2020-03-30 18:45:57", 2, "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo. In blandit ultrices enim. Lorem ipsum dolor sit amet, consectetuer adipiscing elit."),
	(12, "1992-03-04 09:31:42", 2, "Morbi ut odio."),
	(18, "2017-11-27 15:17:23", 10, "Nullam sit amet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh."),
	(19, "2000-05-23 09:45:27", 4, "Praesent lectus. Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio."),
	(22, "2003-02-05 14:00:35", 3, "Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla."),
	(23, "2000-06-20 17:32:34", 10, "Cras mi pede, malesuada in, imperdiet et, commodo vulputate, justo."),
	(24, "2012-05-08 08:07:30", 6, "Nulla tempus."),
	(25, "1995-01-11 23:28:05", 9, "Aenean lectus. Pellentesque eget nunc."),
	(27, "2012-06-02 14:10:03", 7, "Proin risus. Praesent lectus."),
	(31, "2022-11-06 22:15:04", 5, "fasfsa"),
	(32, "2022-11-06 22:25:30", 3, "fasfasfa"),
	(33, "2022-11-06 22:26:54", 6, "Reseña de Musica -: fasfsa"),
	(34, "2022-11-06 22:33:39", 4, "Reseña de Musica "),
	(35, "2022-11-06 22:36:38", 9, "Reseña de Musica "),
	(40, "2022-11-07 19:35:33", 4, "Malisimo"),
	(48, "2022-11-07 19:38:34", 2, "Jajajjaja"),
	(51, "2022-11-08 09:31:02", 3, "espantoso"),
	(52, "2022-11-10 09:03:55", 5, "Reseña de Musica "),
	(53, "2022-11-10 09:04:45", 5, "Reseña de Musica "),
	(57, "2022-11-13 19:12:08", 9, "Reseña de Musica "),
	(60, "2022-11-14 21:53:30", 10, "wfefwgfafd"),
	(61, "2022-11-14 23:31:41", 8, "Reseña de Pelicula "),
	(62, "2022-11-16 09:52:57", 3, "Me parecio un muy buen libro, debido a su larga y divertida trama. Concidero que lo mejor de todo fue el final, debido a que es muy inesperado"),
	(63, "2022-11-17 21:04:24", 1, "Reseña de Musica "),
	(64, "2022-11-17 22:55:33", 5, "Reseña de Pelicula"),
	(66, "2022-11-18 00:12:57", 7, "Reseña de Musicaaaaaaaaaaaaaaa"),
	(67, "2022-11-18 00:17:39", 2, "Reseña de Pelicula "),
	(68, "2022-11-18 16:53:20", 3, "Reseña de Pelicula reseñada"),
	(69, "2022-11-18 17:20:11", 5, "sfdg"),
	(70, "2022-11-18 17:28:25", 10, "The name of the album is IV by Led Zeppelin. It was released on 8 November 1971 in London by Atlantic Records. This is considered a Hard Rock album. This album was produced by Jimmy Page, the band’s guitarist. It took six months and it was recorded in the Rolling Stones Mobile Studios. Like its name suggests, this is the fourth album by the famous band.\n\nIV starts with the song Black Dog, which is very upbeat and energetic. It fluctuates between Robert Plant’s amazing lyrics and Jimmy Page’s hard guitar riffs.I still remember the first time I heard this opener; I was blown away! I think this is one of the best hard rock songs of all time. Then, Led Zeppelin moves onto Rock and Roll, which was born from a jam session. It is a great ode to old rockstars like Little Richards, the architect of this genre.\n\nThis album has an incredible tracklist. After listening to it more than ten times, I believe that out of the eight songs, all of them were basically perfect. Battle of Evermore, Misty Mountain Top and Going to California are, in my opinion, the most forgettable songs in the disc, but they’re still great. Stairway to Heaven is regarded as one of the best songs of all time, with one of the most epic guitar solos from Jimmy Page. I enjoy this song a lot, and it is the reason why IV is so popular. The song’s lyrics make me very emotional, even more so when sung by Plant. The last song, When The Levee Breaks, is, from my point of view, the greatest country blues track of the 70’s, and my second favorite song by Led Zeppelin, only behind The Ocean, from Houses of The Holy.\n\nIn conclusion, I think this is a classic rock album. With a perfect tracklist and album art, it’s the band’s magnum opus, their masterpiece. I give it a 10/10. It is a must listen for everybody who loves music"),
	(71, "2022-11-18 17:31:28", 10, "The name of the album is Abbey Road by The Beatles. It was released on 26 September 1969 in London by Apple Records. This is considered an Art Rock album. This album was produced by George Martin. It took six months to be recorded in EMI Studios (now called Abbey Road).\n\nIn conclusion, I think this is a classic rock album. With a perfect tracklist and album art, it’s the band’s magnum opus, their masterpiece. I give it a 10/10. It is a must listen for everybody who loves music."),
	(72, "2022-11-18 17:32:17", 10, "The name of the album is The Dark Side Of The Moon by Pink Floyd. It was released on 1 March 1973 in the United States by Capitol Records. This is considered a Progressive Rock and Psychedelic Rock album. This album was produced by the band itself. It took six months and it was recorded in Abbey Road Studios."),
	(73, "2022-11-18 17:32:57", 10, "The name of the album is OK Computer by Radiohead. It was released on 21 March 1997 in London by Capitol Records. This is considered an Alternative Rock album. This album was produced by Nigel Godrich. It took almost a year to record and it was recorded in a mansion called Saint Catherine’s Court, where the band lived."),
	(74, "2022-11-18 19:24:13", 8, "Muy bueno "),
	(75, "2022-11-21 11:48:38", 6, "Muy bueno"),
	(76, "2022-11-21 11:50:42", 6, "Probando");

/*!40000 ALTER TABLE `resenia` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table tiene_autor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tiene_autor`;

CREATE TABLE `tiene_autor` (
  `id_multimedia` int NOT NULL,
  `id_autor` int NOT NULL,
  PRIMARY KEY (`id_multimedia`,`id_autor`),
  KEY `id_autor` (`id_autor`),
  CONSTRAINT `tiene_autor_ibfk_1` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`),
  CONSTRAINT `tiene_autor_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table users_accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_accounts`;

CREATE TABLE `users_accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `perms_level` varchar(255) DEFAULT '1',
  `nombre` varchar(255) DEFAULT 'Sin especificar.',
  `apellido` varchar(255) DEFAULT 'Sin especificar.',
  `celular` int DEFAULT '0',
  `creditos` int DEFAULT '0',
  `createdAt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastLogin` datetime DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'assets/media/avatars/blank.png',
  `localidad` varchar(255) NOT NULL DEFAULT 'Sin especificar',
  `verified` tinyint(1) DEFAULT '1',
  `fecha_nacimiento` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`correo`,`id`),
  UNIQUE KEY `UkUsername` (`username`),
  KEY `IdContador` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `users_accounts` WRITE;
/*!40000 ALTER TABLE `users_accounts` DISABLE KEYS */;

INSERT INTO `users_accounts` (`id`, `correo`, `username`, `password`, `perms_level`, `nombre`, `apellido`, `celular`, `creditos`, `createdAt`, `lastLogin`, `ip`, `profile_pic`, `localidad`, `verified`, `fecha_nacimiento`) VALUES
	(94, "visitante@agrasystems.us", "visitante", "648a9cec47e5ee7543e0f180ca8ecb7e", "0", "Visitante", "Visitante", 0, 0, "2022-11-17 00:00:00", "2024-06-13 21:34:20", "179.26.204.18", "assets/media/avatars/blank.png", "Uruguay", 1, "0000-00-00 00:00:00");

/*!40000 ALTER TABLE `users_accounts` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users_alquila
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_alquila`;

CREATE TABLE `users_alquila` (
  `id_multimedia` int NOT NULL,
  `correo` varchar(255) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  `fecha_entregado` datetime DEFAULT NULL,
  `Verifica` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_multimedia`,`correo`),
  KEY `correo` (`correo`),
  CONSTRAINT `users_alquila_ibfk_1` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table users_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_logs`;

CREATE TABLE `users_logs` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) DEFAULT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT '0',
  `info` varchar(255) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `localidad` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `userId` (`userId`),
  KEY `username` (`username`),
  CONSTRAINT `users_logs_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users_accounts` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table users_passwords_reset
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_passwords_reset`;

CREATE TABLE `users_passwords_reset` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `newPass` varchar(255) NOT NULL DEFAULT '',
  `encrypted` varchar(255) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of table utiliza
# ------------------------------------------------------------

DROP TABLE IF EXISTS `utiliza`;

CREATE TABLE `utiliza` (
  `id_multimedia` int NOT NULL,
  `codigo_club` int NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  PRIMARY KEY (`id_multimedia`,`codigo_club`),
  KEY `codigo_club` (`codigo_club`),
  CONSTRAINT `utiliza_ibfk_1` FOREIGN KEY (`id_multimedia`) REFERENCES `multimedia` (`id_multimedia`),
  CONSTRAINT `utiliza_ibfk_2` FOREIGN KEY (`codigo_club`) REFERENCES `clubes` (`codigo_club`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;





# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2024-06-15T11:51:33-03:00
