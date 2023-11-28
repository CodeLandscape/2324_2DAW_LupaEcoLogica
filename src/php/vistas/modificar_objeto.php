<!DOCTYPE html>
<html lang="es">

<head>
    <title>Modificar Objeto</title>
</head>

<body>
    <!--Cabecera de la página-->
    <header>
        Modificar Objeto
        <?php include 'template/navegacion.html'; ?>
    </header>
    <main class="aumentarMargin25">
        <form method='post' action="index.php?accion=actualizarObjeto&controlador=Controlador" enctype="multipart/form-data">
            <div id="contenido">
                <input type="hidden" name="idCategoria_seleccionada" value="<?php echo $_GET['idCategoria']; ?>">
                <?php
                $datos = $controlador->verObjeto($_GET['id']);
                ?>
                <div id="objetosContainer">
                    <div id="objeto1" class="contenedores">
                        <label for='nombre1'>Nombre:</label>
                        <input type='text' id='nombre1' name='nombre[1]' required value="<?php echo $datos['nombre']; ?>"><br>

                        <label for='descripcion1'>Descripción:</label>
                        <input type='text' id='descripcion1' name='descripcion[1]' required value="<?php echo $datos['descripcion']; ?>"><br>

                        <label for='img1'>Añadir imagen:</label>
                        <input type='file' id='img1' name='img[1]' required value="<?php echo $datos['imagen']; ?>"><br>

                        <label for='punt1'>Puntuación:</label>
                        <input type='text' id='punt1' name='punt[1]' class="inputPeq" value="<?php echo $datos['puntuacion']; ?>"<br><br>

                        <label for='bueno1'>Bueno:</label>

                        <input type='checkbox' id='bueno1' name='bueno[1]' class="inputPeq" value="<?php echo $datos['valoracion']; ?>"><br><br>
                    </div>
                </div>
                <div id="botones">
                    <input type='submit' value='Añadir'>
                    <input type='submit' value='Volver'>
                </div>
            </div>
        </form>
</body>

</html>
