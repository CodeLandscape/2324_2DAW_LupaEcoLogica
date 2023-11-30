<!DOCTYPE html>
<html lang="es">

<head>
    <title>Modificar Pregunta</title>
</head>

<body>
    <!--Cabecera de la página-->
    <header>
        Modificar Pregunta
        <?php include 'template/navegacion.html'; ?>
    </header>
    <main class="aumentarMargin25">
        <form method='post' action="index.php?accion=actualizarPregunta&controlador=pregunta" enctype="multipart/form-data">
            <div id="contenido">
                <input type="hidden" name="idCategoria_seleccionada" value="<?php echo $_GET['idCategoria']; ?>">
                <?php
                // Obtener datos de la pregunta a modificar
                $datos = $controlador->pregunta($_GET['idPregunta']);
                ?>
                <div id="preguntaContainer">
                    <div id="pregunta1" class="contenedores">
                        <input type="hidden" id="idPregunta" name="idPregunta" value="<?php echo $_GET['idPregunta']; ?>"><br>

                        <label for='textoPregunta'>Texto de la pregunta:</label>
                        <input type='text' id='textoPregunta' name='textoPregunta' required value="<?php echo $datos['texto']; ?>"><br>

                        <label for='reflexionAcierto'>Reflexión en caso de acierto:</label>
                        <input type='text' id='reflexionAcierto' name='reflexionAcierto' required value="<?php echo $datos['reflexionAcierto']; ?>"><br>

                        <label for='reflexionFallo'>Reflexión en caso de fallo:</label>
                        <input type='text' id='reflexionFallo' name='reflexionFallo' required value="<?php echo $datos['reflexionFallo']; ?>"><br>

                        <label for='respuesta'>Respuesta:</label>
                        <input type='text' id='respuesta' name='respuesta' class="inputPeq" value="<?php echo $datos['respuesta']; ?>"><br><br>

                        <label for='idCategoria'>ID de la categoría:</label>
                        <input type='text' id='idCategoria' name='idCategoria' class="inputPeq" value="<?php echo $datos['idCategoria']; ?>"><br><br>

                    </div>
                </div>
                <!-- Agregar campo oculto para 'accion' -->
                <input type="hidden" name="accion" value="actualizarPregunta">
                <div id="botones">
                    <input type='submit' value='Actualizar Pregunta'>
                    <input type='submit' value='Volver'>
                </div>
            </div>
        </form>
    </main>
</body>

</html>
