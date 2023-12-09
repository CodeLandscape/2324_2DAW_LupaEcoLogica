<title>Modificar Configuración</title>
</head>
<body>
    <!-- Encabezado de la página: Modificar Configuración -->
    <header>
        Modificar Configuración
        <?php
            // Inclusión de la navegación desde un archivo externo
            include 'template/navegacion.html';
        ?>
    </header>
    <main class="aumentarMargin100">
        <?php
        // Obtiene la configuración actual desde el controlador
        $configuracion = $controlador->configuracion();
        ?>
        <!-- Formulario para actualizar la configuración -->
        <form action="index.php?accion=actualizarConfiguracion&controlador=controlador" method="post" enctype="multipart/form-data">
            <?php
                // Muestra un mensaje si está presente en los parámetros GET
                if (isset($_GET['msg'])){
                    echo $_GET['msg'] . "</br>";
                }
            ?>
            <!-- Campos para modificar la configuración -->
            <label for="parametro1">Tiempo Cronómetro:</label>
            <input type="text" id="parametro1" name="parametro1" value="<?php echo $configuracion['tiempoCrono']; ?>"><br><br>

            <label for="parametro2">Número de preguntas:</label>
            <input type="text" id="parametro2" name="parametro2" value="<?php echo $configuracion['nPregunta']; ?>"><br><br>

            <label for="parametro3">Número de objetos buenos:</label>
            <input type="text" id="parametro3" name="parametro3" value="<?php echo $configuracion['nObjetosBuenos']; ?>"><br><br>

            <!-- Campo oculto para indicar la acción -->
            <input type="hidden" name="accion" value="actualizarConfiguracion">
            <!-- Botón para guardar los cambios -->
            <input type="submit" value="Guardar">
        </form>
    </main>