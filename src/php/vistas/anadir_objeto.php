<!DOCTYPE html>
<html lang="es">

<head>
    <title>Crear Objeto</title>
</head>

<body>
    <!--Cabecera de la página-->
    <header>
        Crear Objeto
        <?php include 'template/navegacion.html'; ?>
    </header>
    <main class="aumentarMargin25">
        <form method='post' action="index.php?accion=agregarObjeto&controlador=Controlador" enctype="multipart/form-data">
            <div id="contenido">
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
                <div id="objetosContainer">
                    <div id="objeto1" class="contenedores">
                        <h3>Objeto 1</h3>
                        <label for='nombre1'>Nombre:</label>
                        <input type='text' id='nombre1' name='nombre[1]' required><br>

                        <label for='descripcion1'>Descripción:</label>
                        <input type='text' id='descripcion1' name='descripcion[1]' required><br>

                        <label for='img1'>Añadir imagen:</label>
                        <input type='file' id='img1' name='img[1]' required><br>

                        <label for='punt1'>Puntuación:</label>
                        <input type='text' id='punt1' name='punt[1]' class="inputPeq"><br>

                        <label for='bueno1'>Bueno:</label>
                        <input type='checkbox' id='bueno1' name='bueno[1]' class="inputPeq"><br>
                    </div>
                </div>
                <div id="botones">
                    <input type='button' value='+' id="btnMas">
                    <input type='submit' value='Añadir'>
                    <input type='submit' value='Volver'>
                </div>
            </div>
        </form>

        <script>
            'use strict';

            // Obtener referencia al botón, al formulario y al div que se clonará
            const btnMas = document.getElementById('btnMas');
            const formulario = document.querySelector('form');
            const objetosContainer = document.getElementById('objetosContainer');

            // Contador para asignar un número de objeto único
            let contadorObjeto = 1;

            btnMas.onclick = () => {
                // Incrementar el contador
                contadorObjeto++;

                // Crear un nuevo div para el objeto
                let nuevoObjetoDiv = document.createElement('div');
                nuevoObjetoDiv.id = `objeto${contadorObjeto}`;
                nuevoObjetoDiv.className = 'contenedores';

                // Agregar los elementos del objeto al nuevo div
                nuevoObjetoDiv.innerHTML = `
                    <h3>Objeto ${contadorObjeto}</h3>
                    <label for='nombre${contadorObjeto}'>Nombre:</label>
                    <input type='text' id='nombre${contadorObjeto}' name='nombre[${contadorObjeto}]' required><br>

                    <label for='descripcion${contadorObjeto}'>Descripción:</label>
                    <input type='text' id='descripcion${contadorObjeto}' name='descripcion[${contadorObjeto}]' required><br>

                    <label for='img${contadorObjeto}'>Añadir imagen:</label>
                    <input type='file' id='img${contadorObjeto}' name='img[${contadorObjeto}]' required><br>

                    <label for='punt${contadorObjeto}'>Puntuación:</label>
                    <input type='text' id='punt${contadorObjeto}' name='punt[${contadorObjeto}]' class="inputPeq"><br>

                    <label for='bueno${contadorObjeto}'>Bueno:</label>
                    <input type='checkbox' id='bueno${contadorObjeto}' name='bueno[${contadorObjeto}]' class="inputPeq"><br>
                `;

                // Agregar el nuevo div como hijo del contenedor de objetos
                objetosContainer.appendChild(nuevoObjetoDiv);
                formulario.appendChild(document.getElementById('botones'));
            }
        </script>
    </main>
</body>

</html>
