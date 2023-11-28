    <title>Modificar Configuración</title>
</head>
<body>
        <header>
            Modificar Configuración
            <?php
                include 'template/navegacion.html';
            ?>
        </header>
    <main>
    <?php
    $configuracion=$controlador->configuracion();
    ?>
    <form action="index.php?accion=actualizarConfiguracion&controlador=Controlador" method="post" enctype="multipart/form-data">
        <label for="parametro1">Tiempo Cronometro:</label>
        <input type="text" id="parametro1" name="parametro1" value="<?php echo $configuracion['tiempoCrono']; ?>"><br><br>

        <label for="parametro2">Numero de preguntas:</label>
        <input type="text" id="parametro2" name="parametro2" value="<?php echo $configuracion['nPregunta']; ?>"><br><br>

        <label for="parametro3">Numero de objetos buenos:</label>
        <input type="text" id="parametro3" name="parametro3" value="<?php echo $configuracion['nObjetosBuenos']; ?>"><br><br>

        <input type="hidden" name="accion" value="actualizarConfiguracion">
        <input type="submit" value="Guardar Cambios">
    </form>
    </main>
</body>
</html>
