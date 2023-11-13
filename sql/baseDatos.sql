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
  `fechaHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE categoria(
  `idCategoria` tinyint UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE tablero(
  `idTablero` tinyint UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagenFondo` blob NOT NULL,
  `idCategoria` tinyint UNSIGNED
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE objeto(
  `idObjeto` tinyint UNSIGNED NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(120) NOT NULL,
  `imagen` blob NOT NULL,
  `puntuacion` tinyint UNSIGNED NOT NULL DEFAULT 10,
  `valoracion` bit NOT NULL,
  `idCategoria` tinyint UNSIGNED
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE pregunta(
  `idPregunta` tinyint UNSIGNED NOT NULL,
  `texto` varchar(150) NOT NULL,
  `reflexionAcierto` varchar(255) NOT NULL,
  `reflexionFallo` varchar(255) NOT NULL,
  `puntuacion` tinyint UNSIGNED NOT NULL DEFAULT 100,
  `respuesta` bit NOT NULL,
  `idCategoria` tinyint UNSIGNED
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE config
  ADD CONSTRAINT checkTiempo CHECK (tiempoCrono>=60);
  ADD CONSTRAINT checkPreguntas CHECK (nPregunta>=3);
  ADD CONSTRAINT checkObjetosBuenos CHECK (nObjetosBuenos<=6 AND nObjetosBuenos>=0);

ALTER TABLE partida
  ADD PRIMARY KEY (idPartida);
  ADD CONSTRAINT checkObjetoAcertado CHECK (objetosAcertados>=0);
  ADD CONSTRAINT checkPreguntaAcertada CHECK (preguntasAcertadas>=0);

ALTER TABLE categoria
  ADD PRIMARY KEY (idCategoria);

ALTER TABLE tablero
  ADD PRIMARY KEY (idTablero);
  ADD CONSTRAINT categoriaTablero FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE objeto
  ADD PRIMARY KEY (idObjeto);
  ADD CONSTRAINT categoriaObjeto FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria) ON DELETE CASCADE ON UPDATE CASCADE;
  ADD CONSTRAINT checkPuntuacion CHECK (puntuacion>=1);

ALTER TABLE pregunta
  ADD PRIMARY KEY (idPregunta);
  ADD CONSTRAINT categoriaPregunta FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria) ON DELETE CASCADE ON UPDATE CASCADE;
  ADD CONSTRAINT checkPuntuacion CHECK (puntuacion>=1);

CREATE UNIQUE INDEX catgoriaNombre
  ON categoria (nombre);

CREATE UNIQUE INDEX tableroNombre
  ON tablero (nombre);

CREATE UNIQUE INDEX objetoNombre
  ON objeto (nombre);