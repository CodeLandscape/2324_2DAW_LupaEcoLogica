
    <title>Añadir Pregunta</title>
    </head>
    <body>
        <header>
            Añadir Pregunta
        </header>
        <main class="aumentarMargin100">
                <form method='post' action="../controladores/gestionPregunta.php">
                    <div id="contenidoPregunta">
                        <?php
                            //La condición if ($_SERVER["REQUEST_METHOD"] == "POST") se utiliza para verificar si el formulario en la página se ha enviado mediante el método POST de HTTP.
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Acceder al valor de la categoría seleccionada
                                $categoriaSeleccionada = isset($_POST['categoria_seleccionada']) ? $_POST['categoria_seleccionada'] : '';
                            
                                // Mostrar la categoría seleccionada como un label
                                echo '<label>Categoría Seleccionada:</label>';
                                echo '<p>' . $categoriaSeleccionada . '</p>';
                            }
                        ?>
                        <div id="contenido">
                            <h2>Añadir Pregunta</h2>
                            <label for='pregunta'>Pregunta </label>
                            <input type='text' maxlength="100" name='pregunta' required><br>
                            <div id="respuesta">
                                <label for='resp'>Respuesta</label>
                                <p>
                                    <label for='si'>Sí</label>
                                    <input type="radio" name="opcion" value="si">
                                </p>
                                <p>
                                    <label for='no'>No</label>
                                    <input type="radio" name="opcion" value="no">
                                </p>
                            </div>
                            <label for='ref1'>Reflexion Positiva: </label>
                        
                            <input type='text' maxlength="255" name='ref1' required><br>
                    
                            <label for='ref2'>Reflexión Negativa: </label>
                            <input type='text' maxlength="255" name='ref2' required><br>
                        </div>      
                    </div>
                    <div>
                            <input type='submit' value='+' id="btnMas">
                            <input type='submit' value='Enviar'>
                    </div>
                </form>
               
         
            <aside id="listaPreguntas">
                <p>
                    Pregunta 1
                </p>
                <!-- <p>
                    Pregunta 2
                </p>
                <p>
                    Pregunta 3
                </p> -->
            </aside>
        </main>

        <script>
            'use strict'
            // Obtener referencia al botón, al formulario y al div que se clonará
            this.btnMas = document.getElementById('btnMas');
            this.formulario = document.querySelector('form');
            this.contenidoDiv = document.getElementById('contenido');
            this.listaPreguntas = document.getElementById('listaPreguntas');
        
            // Contador para asignar un número de pregunta único
            this.contadorPregunta = 1;
        
            this.btnMas.onclick = () => {
                // Clonar el div con id "contenido"
                let nuevoContenido = contenidoDiv.cloneNode(true);
        
                // Incrementar el contador y agregar el número de pregunta al aside
                this.contadorPregunta++;
                let numeroPregunta = 'Pregunta ' + this.contadorPregunta;
                let nuevaPreguntaElemento = document.createElement('p');
                nuevaPreguntaElemento.textContent = numeroPregunta;
                listaPreguntas.appendChild(nuevaPreguntaElemento);
        
                // Agregar el nuevo div como hijo del formulario
                formulario.appendChild(nuevoContenido);
            }
        </script>

    </body>
</html>