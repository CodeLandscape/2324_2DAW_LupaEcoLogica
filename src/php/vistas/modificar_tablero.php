    <title>Modificar Tablero</title>
</head>
<body>
    <!-- Cabecera de la página: Modificar Tablero -->
    <header>
        Modificar Tablero
        <?php
        // Inclusión de la navegación desde un archivo externo
        include 'template/navegacion.html';
        ?>
    </header>
    <main>
        <?php
        // Obtención de datos del tablero según el ID recibido por GET
        $datos = $controlador->verTablero($_GET['id']);
        ?>
        <!-- Formulario para modificar el tablero -->
        <form action="index.php?accion=actualizarTablero&controlador=categoria" method="post" enctype="multipart/form-data">
            <div>
                <!-- Campo para ingresar el nombre del tablero -->
                <label for='tablero'>Nombre del tablero:</label>
                <input type='text' id='tablero' name='tablero' required value="<?php echo $datos['nombre']; ?>"><br>

                <!-- Campo para subir una imagen de fondo -->
                <label for='img'>Fondo:</label>
                <input type='file' id='img' name='img'><br>

                <!-- Campos ocultos con valores del tablero y categoría -->
                <input type="hidden" name="idTablero" value="<?php echo $datos['idTablero']; ?>">
                <input type="hidden" id="imgActual" name="imgActual" value="base64:<?php echo  $datos['imagenFondo']; ?>"><br>
                <input type="hidden" name="idCategoria" value="<?php if (isset($_GET['id'])) { echo $_GET['id']; } ?>">
            </div>
            <!-- Botones para enviar el formulario o volver -->
            <div id="botones">
                <input type='submit' value='Añadir'>
                <a href="index.php?id=<?php if (isset($_GET['id'])) { echo $_GET['id']; } ?>accion=categoria&controlador=controlador">Volver</a>
            </div>
        </form>
    </main>