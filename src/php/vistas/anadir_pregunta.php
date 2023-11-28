<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <div id="pregunta1" class="pregunta">
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
            </div>
        </form>

        <aside id="listaPreguntas">
            <!-- Aquí se mostrarán las preguntas agregadas dinámicamente -->
        </aside>

        <script>
            'use strict';

            // Obtener referencia al botón, al formulario y al div que se clonará
            this.btnMas = document.getElementById('btnMas');
            this.formulario = document.querySelector('form');
            this.preguntasContainer = document.getElementById('preguntasContainer');
            this.listaPreguntas = document.getElementById('listaPreguntas');

            // Contador para asignar un número de pregunta único
            this.contadorPregunta = 1;

            this.btnMas.onclick = () => {
                // Incrementar el contador
                this.contadorPregunta++;

                // Crear un nuevo div para la pregunta
                let nuevaPreguntaDiv = document.createElement('div');
                nuevaPreguntaDiv.id = `pregunta${this.contadorPregunta}`;
                nuevaPreguntaDiv.className = 'pregunta';

                // Agregar la pregunta al aside
                let numeroPregunta = `Pregunta ${this.contadorPregunta}`;
                let nuevaPreguntaElemento = document.createElement('div');
                nuevaPreguntaElemento.innerHTML = numeroPregunta;
                listaPreguntas.appendChild(nuevaPreguntaElemento);

                // Agregar los elementos de la pregunta al nuevo div
                nuevaPreguntaDiv.innerHTML = `
                    <label for='pregunta${this.contadorPregunta}'>${numeroPregunta}</label>
                    <input type='text' maxlength="100" name='pregunta[${this.contadorPregunta}]' required><br>
                    <div class="respuesta">
                        <label for='si${this.contadorPregunta}'>Sí</label>
                        <input type="radio" name="opcion[${this.contadorPregunta}]" value="1">
                        <label for='no${this.contadorPregunta}'>No</label>
                        <input type="radio" name="opcion[${this.contadorPregunta}]" value="0">
                    </div>
                    <label for='ref1'>Reflexion Positiva: </label>
                    <input type='text' maxlength="255" name='ref1[${this.contadorPregunta}][]' required><br>
                    <label for='ref2'>Reflexión Negativa: </label>
                    <input type='text' maxlength="255" name='ref2[${this.contadorPregunta}][]' required><br>
                `;

                // Agregar el nuevo div como hijo del contenedor de preguntas
                preguntasContainer.appendChild(nuevaPreguntaDiv);
                formulario.appendChild(document.getElementById('botonesPregunta'));
            }
        </script>
    </main>
</body>
</html>
