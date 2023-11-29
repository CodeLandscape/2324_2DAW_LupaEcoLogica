    <title>Añadir Pregunta</title>
</head>

<body>
    <header>
        Añadir Pregunta
        <?php include 'template/navegacion.html'; ?>
    </header>
    <main class="aumentarMargin100">
        <form method='post' action="index.php?accion=agregarPregunta&controlador=Controlador">
            <?php
                $categoriaSeleccionada = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';
                
                // Separar el idCategoria y el nombre
                list($idCategoria, $nombreCategoria) = explode('|', $categoriaSeleccionada);
            ?>
            <input type="hidden" name="idCategoria_seleccionada" value="<?php echo $idCategoria; ?>">
            <?php
                echo '<label>Categoría Seleccionada:</label>';
                echo '<p>' . $nombreCategoria . '</p>';
            ?>
            <div id="preguntasContainer">
                <div id="pregunta1" class="contenedores">
                    <label for='pregunta1'>Pregunta 1</label>
                    <input type='text' maxlength="100" name='pregunta[1]' required><br>
                    <div class="respuesta">
                        <label for='resp'>Respuesta</label>
                        <p>
                            <label for='si1'>Sí</label>
                            <input type="radio" name="opcion[1]" value="1">
                        </p>
                        <p>
                            <label for='no1'>No</label>
                            <input type="radio" name="opcion[1]" value="0">
                        </p>
                    </div>
                    <label for='ref1'>Reflexion Positiva: </label>
                    <input type='text' maxlength="255" name='ref1[1][]' required><br>
                    <label for='ref2'>Reflexión Negativa: </label>
                    <input type='text' maxlength="255" name='ref2[1][]' required><br>
                </div>
            </div>
            <div id="botonesPregunta">
                <input type='button' value='+' id="btnMas">
                <input type='submit' value='Enviar'>
                <a href="index.php?accion=selectCategoria&controlador=Controlador&funcion=pregunta" class="submit">Volver</a>
            </div>
        </form>

        <aside id="listaPreguntas">
            <div>Pregunta 1</div>
        </aside>

        <script>
            'use strict';

            // Obtener referencia al botón, al formulario y al div que se clonará
            const btnMas = document.getElementById('btnMas');
            const formulario = document.querySelector('form');
            const preguntasContainer = document.getElementById('preguntasContainer');
            const listaPreguntas = document.getElementById('listaPreguntas');

            // Contador para asignar un número de pregunta único
            let contadorPregunta = 1;

            btnMas.onclick = () => {
                // Incrementar el contador
                contadorPregunta++;

                // Crear un nuevo div para la pregunta
                let nuevaPreguntaDiv = document.createElement('div');
                nuevaPreguntaDiv.id = `pregunta${contadorPregunta}`;
                nuevaPreguntaDiv.className = 'contenedores';

                // Agregar la pregunta al aside
                let numeroPregunta = `Pregunta ${contadorPregunta}`;
                let nuevaPreguntaElemento = document.createElement('div');
                nuevaPreguntaElemento.innerHTML = numeroPregunta;
                listaPreguntas.appendChild(nuevaPreguntaElemento);

                // Agregar los elementos de la pregunta al nuevo div
                nuevaPreguntaDiv.innerHTML = `
                    <label for='pregunta${contadorPregunta}'>${numeroPregunta}</label>
                    <input type='text' maxlength="100" name='pregunta[${contadorPregunta}]' required><br>
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
                formulario.appendChild(document.getElementById('botonesPregunta'));
            }
        </script>
    </main>
</body>

</html>
