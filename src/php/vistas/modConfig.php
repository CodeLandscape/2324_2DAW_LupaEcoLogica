<!-- vista_config.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Modificar Configuración</title>
</head>
<body>
    <?php
    $configuracion=$controlador->configuracion();
    ?>
    <h1>Modificar Configuración</h1>
    <form action="index.php?accion=actualizarConfiguracion&controlador=Controlador" method="post" enctype="multipart/form-data"><form action="index.php?" method="post">
        <label for="parametro1">Parámetro 1:</label>
        <input type="text" id="parametro1" name="parametro1" value="<?php echo $configuracion['tiempoCrono']; ?>"><br><br>

        <label for="parametro2">Parámetro 2:</label>
        <input type="text" id="parametro2" name="parametro2" value="<?php echo $configuracion['nPregunta']; ?>"><br><br>

        <label for="parametro3">Parámetro 3:</label>
        <input type="text" id="parametro3" name="parametro3" value="<?php echo $configuracion['nObjetosBuenos']; ?>"><br><br>

        <!-- Agregar más campos según los parámetros que existan en la tabla config -->

        <input type="hidden" name="accion" value="actualizarConfiguracion">
        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>
