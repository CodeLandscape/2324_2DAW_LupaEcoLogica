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
                    echo '<div id="pregunta' . $pregunta['idPregunta'] . '" class="contenedores">';
                    // Agregar un campo oculto para el ID de la pregunta
                    echo '<input type="hidden" name="pregunta[' . $pregunta['idPregunta'] . '][idPregunta]" value="' . $pregunta['idPregunta'] . '">';
                    echo '<label for="pregunta' . $pregunta['idPregunta'] . '">Pregunta ' . $pregunta['idPregunta'] . '</label>';
                    echo '<input type="text" maxlength="100" name="pregunta[' . $pregunta['idPregunta'] . '][texto]" value="' . $pregunta['texto'] . '" required><br>';
                    echo '<div class="respuesta">';
                    echo '<label for="resp' . $pregunta['idPregunta'] . '">Respuesta</label>';
                    echo '<p>';
                    echo '<label for="si' . $pregunta['idPregunta'] . '">Sí</label>';
                    echo '<input type="radio" name="opcion[' . $pregunta['idPregunta'] . ']" value="1" ' . ($pregunta['respuesta'] == 1 ? 'checked' : '') . '>';
                    echo '</p>';
                    echo '<p>';
                    echo '<label for="no' . $pregunta['idPregunta'] . '">No</label>';
                    echo '<input type="radio" name="opcion[' . $pregunta['idPregunta'] . ']" value="0" ' . ($pregunta['respuesta'] == 0 ? 'checked' : '') . '>';
                    echo '</p>';
                    echo '</div>';
                    echo '<label for="ref1">Reflexion Positiva: </label>';
                    echo '<input type="text" maxlength="255" name="ref1[' . $pregunta['idPregunta'] . '][]" value="' . $pregunta['reflexionAcierto'] . '" required><br>';
                    echo '<label for="ref2">Reflexión Negativa: </label>';
                    echo '<input type="text" maxlength="255" name="ref2[' . $pregunta['idPregunta'] . '][]" value="' . $pregunta['reflexionFallo'] . '" required><br>';
                    echo '<a href="index.php?accion=remove&id=' . $pregunta['idPregunta'] . '&controlador=pregunta&funcion=Pregunta&idCategoria=' . $idCategoria . '" class="submit">Borrar</a>';
                    echo '</div>';
                }
                ?>
            </div>
            
            <!-- Cambia la estructura del botón agregar -->
            <input type="button" value="+" id="btnMas" onclick="agregarPregunta();">
            
            <div id="botonesPregunta">
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
                nuevaPreguntaDiv.id = `pregunta${contadorPregunta}`;
                nuevaPreguntaDiv.className = 'contenedores';

                // Agregar los elementos de la pregunta al nuevo div
                nuevaPreguntaDiv.innerHTML = `
                    <label for='pregunta${contadorPregunta}'>Pregunta ${contadorPregunta}</label>
                    <input type='text' maxlength="100" name='pregunta[${contadorPregunta}][texto]' required><br>
                    <div class="respuesta">
                        <label for='resp'>Respuesta</label>
                        <p>
                            <label for='si${contadorPregunta}'>Sí</label>
                            <input type="radio" name="opcion[${contadorPregunta}]" value="1">
                        </p>
                        <p>
                            <label for='no${contadorPregunta}'>No</label>
                            <input type="radio" name="opcion[${contadorPregunta}]" value="0">
                        </p>
                    </div>
                    <label for='ref1'>Reflexion Positiva: </label>
                    <input type='text' maxlength="255" name='ref1[${contadorPregunta}][]' required><br>
                    <label for='ref2'>Reflexión Negativa: </label>
                    <input type='text' maxlength="255" name='ref2[${contadorPregunta}][]' required><br>
                `;

                // Agregar el nuevo div como hijo del contenedor de preguntas
                preguntasContainer.appendChild(nuevaPreguntaDiv);
            }
        </script>
    </main>
</body>
</html>
