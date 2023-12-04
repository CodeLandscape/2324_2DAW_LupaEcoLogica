<!DOCTYPE html>
<html lang="es">

<head>
    <title>Modificar Tablero</title>
</head>

<body>
    <!-- Cabecera de la página -->
    <header>
        Modificar Tablero
        <?php
        include 'template/navegacion.html';
        ?>
    </header>
    <main>
    <?php
                $datos = $controlador->verTablero($_GET['id']);
                ?>
        <form action="index.php?accion=actualizarTablero&controlador=categoria" method="post" enctype="multipart/form-data">
            <div>

                <label for='tablero'>Nombre del tablero:</label>
                <input type='text' id='tablero' name='tablero' required value="<?php echo $datos['nombre']; ?>"><br>



                <label for='img'>Fondo:</label>
                <input type='file' id='img' name='img'><br>
                <input type="hidden" name="idTablero" value="<?php echo $datos['idTablero']; ?>">
                <input type="hidden" id="imgActual" name="imgActual" value="base64:<?php echo  $datos['imagenFondo']; ?>"><br>
                <input type="hidden" name="idCategoria" value="<?php if (isset($_GET['id'])) { echo $_GET['id']; } ?>">
            </div>
            <div id="botones">
                <input type='submit' value='Añadir'>
                <a href="index.php?id=<?php if (isset($_GET['id'])) { echo $_GET['id']; } ?>accion=categoria&controlador=controlador">Volver</a>
            </div>
        </form>
    </main>
</body>

</html>
