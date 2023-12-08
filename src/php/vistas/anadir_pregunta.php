<title>Administrar Preguntas</title>
</head>
<body>
    <header>
        Administrar Preguntas
        <?php include 'template/navegacion.html'; ?>
    </header>
    <main class="aumentarMargin100">
        <form method='post' action="index.php?accion=agregar_actualizar_pregunta&controlador=pregunta">
            <?php
            $categoriaSeleccionada = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';

            // Separar el idCategoria y el nombre
            list($idCategoria, $nombreCategoria) = explode('|', $categoriaSeleccionada);
            ?>
            <input type="hidden" name="idCategoria_seleccionada" value="<?php echo $idCategoria; ?>">
            <?php
            echo '<h1>' . $nombreCategoria . '</h1>';
            ?>
            <div id="preguntasContainer">
            <?php
                // Obtener las preguntas de la base de datos
                $preguntasModelo = new PreguntaModelo();
                $preguntas = $preguntasModelo->verPreguntas($idCategoria);

                foreach ($preguntas as $pregunta) {
                    $id=$pregunta['idPregunta'];
                    ?>
                    <div class="contenedores">
                        <input type="hidden" name="pregunta[<?php echo $id; ?>][idPregunta]" value="<?php echo $id; ?>">
                        <p>
                            <input type="text" maxlength="100" name="pregunta[<?php echo $id; ?>][texto]" value="<?php echo $pregunta['texto']; ?>" placeholder="Pregunta" required>
                            <input type="text" maxlength="255" name="ref1[<?php echo $id; ?>][]" value="<?php echo $pregunta['reflexionAcierto']; ?>" placeholder="Reflexión positiva" required>
                            <input type="text" maxlength="255" name="ref2[<?php echo $id; ?>][]" value="<?php echo $pregunta['reflexionFallo']; ?>" placeholder="Reflexión negativa" required>
                        </p>
                        <p>
                            <span>Respuesta</span>
                            <label for="opcion[<?php echo $id; ?>]">Si</label>
                            <input type="radio" name="opcion[<?php echo $id; ?>]" value=1 <?php if($pregunta['respuesta'] == 1){echo 'checked';} ?>>
                            <label for="opcion[<?php echo $id; ?>]">No</label>
                            <input type="radio" name="opcion[<?php echo $id; ?>]" value=0 <?php if($pregunta['respuesta'] == 0){echo 'checked';} ?>>
                        </p>
                        <a href="index.php?accion=remove&id=<?php echo $id; ?>&controlador=pregunta&funcion=Pregunta&idCategoria=<?php echo $idCategoria; ?>" class="submit">Borrar</a>
                    </div>
                    <?php
                }
                ?>
            </div>
            
            <!-- Cambia la estructura del botón agregar -->
            <div id="botonesPregunta">
                <input type="button" value="Añadir" onclick="agregarPregunta();" class="submit">
                <input type='submit' value='Guardar'>
                <a href="index.php?accion=selectCategoria&controlador=controlador&funcion=pregunta" class="submit">Volver</a>
            </div>
        </form>

        <!-- Agregar el siguiente script al final de la vista -->
        <script>
            'use strict';

            // Obtener referencia al formulario
            const formulario = document.querySelector('form');

            // Inicializar el contador de preguntas
            let contadorPregunta = <?php echo count($preguntas); ?>;

            function agregarPregunta() {
                // Obtener el contenedor de preguntas
                const preguntasContainer = document.getElementById('preguntasContainer');

                // Incrementar el contador
                contadorPregunta++;

                // Crear un nuevo div para la pregunta
                let nuevaPreguntaDiv = document.createElement('div');
                nuevaPreguntaDiv.setAttribute("id",`pregunta${contadorPregunta}`);
                nuevaPreguntaDiv.className = 'contenedores';

                // Agregar los elementos de la pregunta al nuevo div
                nuevaPreguntaDiv.innerHTML = `
                    <p>
                        <input type="text" maxlength="100" name="pregunta[${contadorPregunta}][texto]" placeholder="Pregunta" required>
                        <input type="text" maxlength="255" name="ref1[${contadorPregunta}][]" placeholder="Reflexión positiva" required>
                        <input type="text" maxlength="255" name="ref2[${contadorPregunta}][]" placeholder="Reflexión negativa" required>
                    </p>
                    <p>
                        <span>Respuesta</span>
                        <label for="opcion[${contadorPregunta}]">Si</label>
                        <input type="radio" name="opcion[${contadorPregunta}]" value=1>
                        <label for="opcion[${contadorPregunta}]">No</label>
                        <input type="radio" name="opcion[${contadorPregunta}]" value=0>
                    </p>
                    <input type="button" value="Quitar" onclick="quitarPregunta();" class="submit">
                `;

                // Agregar el nuevo div como hijo del contenedor de preguntas
                preguntasContainer.appendChild(nuevaPreguntaDiv);
            }
            function quitarPregunta(){
                const preguntasContainer = document.getElementById('preguntasContainer');
                const preguntaDiv = document.getElementById(`pregunta${contadorPregunta}`);
                const throwawayNode = preguntasContainer.removeChild(preguntaDiv);

                contadorPregunta--;
            }
        </script>
    </main>
</body>
</html>
