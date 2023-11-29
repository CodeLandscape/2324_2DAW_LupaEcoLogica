CREATE TABLE config(
  `tiempoCrono` tinyint UNSIGNED NOT NULL,
  `nPregunta` tinyint UNSIGNED NOT NULL,
  `nObjetosBuenos` tinyint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE partida(
  `idPartida` int UNSIGNED NOT NULL auto_increment,
  `nombre` varchar(8) NOT NULL,
  `localidad` varchar(8) NOT NULL,
  `puntuación` smallint UNSIGNED NOT NULL DEFAULT 0,
  `objetosAcertados` tinyint UNSIGNED NOT NULL,
  `preguntasAcertadas` tinyint UNSIGNED NOT NULL,
  `fechaHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pkPartida PRIMARY KEY (idPartida)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE categoria(
  `idCategoria` tinyint UNSIGNED NOT NULL auto_increment,
  `nombre` varchar(20) NOT NULL,
  CONSTRAINT pkCategoria PRIMARY KEY (idCategoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE tablero(
  `idTablero` tinyint UNSIGNED NOT NULL auto_increment,
  `nombre` varchar(50) NOT NULL,
  `imagenFondo` blob NOT NULL,
  `idCategoria` tinyint UNSIGNED,
  CONSTRAINT pkTablero PRIMARY KEY (idTablero)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE objeto(
  `idObjeto` tinyint UNSIGNED NOT NULL auto_increment,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `imagen` blob NOT NULL,
  `puntuacion` tinyint UNSIGNED NOT NULL DEFAULT 10,
  `valoracion` bit NOT NULL,
  `idCategoria` tinyint UNSIGNED,
  CONSTRAINT pkObjeto PRIMARY KEY (idObjeto)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE pregunta(
  `idPregunta` tinyint UNSIGNED NOT NULL auto_increment,
  `texto` varchar(150) NOT NULL,
  `reflexionAcierto` varchar(255) NOT NULL,
  `reflexionFallo` varchar(255) NOT NULL,
  `puntuacion` tinyint UNSIGNED NOT NULL DEFAULT 100,
  `respuesta` bit NOT NULL,
  `idCategoria` tinyint UNSIGNED,
  CONSTRAINT pkPregunta PRIMARY KEY (idPregunta)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE tablero
  ADD CONSTRAINT categoriaTablero FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE objeto
  ADD CONSTRAINT categoriaObjeto FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria) ON UPDATE CASCADE;

ALTER TABLE pregunta
  ADD CONSTRAINT categoriaPregunta FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE UNIQUE INDEX categoriaNombre
  ON categoria (nombre);

CREATE UNIQUE INDEX tableroNombre
  ON tablero (nombre);

CREATE UNIQUE INDEX tableroCategoria
  ON tablero (idCategoria);

CREATE UNIQUE INDEX objetoNombre
  ON objeto (nombre);