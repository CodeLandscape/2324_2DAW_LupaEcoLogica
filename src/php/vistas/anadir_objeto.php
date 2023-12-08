<!DOCTYPE html>
<html lang="es">

<head>
    <title>Añadir Objeto</title>
</head>

<body>
    <header>
        Añadir Objeto
        <?php include 'template/navegacion.html'; ?>
    </header>
    <main class="aumentarMargin100">
        <form method='post' action="index.php?accion=agregar_actualizar_objeto&controlador=objeto" enctype="multipart/form-data">
            <div id="contenido">
                <?php
                $categoriaSeleccionada = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';

                // Separar el idCategoria y el nombre
                list($idCategoria, $nombreCategoria) = explode('|', $categoriaSeleccionada);
                ?>
                <input type="hidden" name="idCategoria_seleccionada" value="<?php echo $idCategoria; ?>">
                <?php
                echo '<h1>' . $nombreCategoria . '</h1>';

                // Obtener objetos existentes desde el controlador
                $objetosExistentes = $controlador->tablaObjeto($idCategoria);

                // Mostrar los objetos existentes con sus detalles para edición
                foreach ($objetosExistentes as $indice => $objeto) {
                    echo "<div class='contenedores'>";
                    echo "<h3>Objeto " . ($indice + 1) . "</h3>";
                    echo "<input type='hidden' name='id[]' value='{$objeto['idObjeto']}'>";
                    echo "<label for='nombre{$objeto['idObjeto']}'>Nombre:</label>";
                    echo "<input type='text' id='nombre{$objeto['idObjeto']}' name='nombre[]' value='{$objeto['nombre']}'><br>";

                    echo "<label for='descripcion{$objeto['idObjeto']}'>Descripción:</label>";
                    echo "<input type='text' id='descripcion{$objeto['idObjeto']}' name='descripcion[]' value='{$objeto['descripcion']}'><br>";

                    echo "<label for='img{$objeto['idObjeto']}'>Añadir imagen:</label>";
                    echo "<input type='file' id='img{$objeto['idObjeto']}' name='img[]'><br>";

                    echo "<label for='punt{$objeto['idObjeto']}'>Puntuación:</label>";
                    echo "<input type='text' id='punt{$objeto['idObjeto']}' name='punt[]' value='{$objeto['puntuacion']}' class='inputPeq'><br>";

                    echo "<label for='bueno{$objeto['idObjeto']}'>Bueno:</label>";
                    $checked = $objeto['valoracion'] == 1 ? 'checked' : '';
                    echo "<input type='checkbox' id='bueno{$objeto['idObjeto']}' name='bueno[]' {$checked} class='inputPeq'><br>";
                    echo '<a href="index.php?accion=remove&id=' . $objeto['idObjeto'] . '&controlador=objeto&funcion=objeto&idCategoria=' . $idCategoria . '" class="submit">Borrar</a>';


                    echo "</div>";
                }
                ?>

                <!-- Sección para agregar nuevos objetos -->
                <div id="objetosContainer"></div>

                <!-- Botón para agregar un nuevo objeto -->
                <div id="botones">
                    <input type='button' value='Añadir Objeto' id="btnMas">
                    <input type='submit' value='Guardar Cambios'>
                    <a href="index.php?accion=selectCategoria&controlador=Controlador&funcion=objeto"
                        class="submit">Volver</a>
                </div>

            </div>
        </form>

        <script>
            'use strict';

            const btnMas = document.getElementById('btnMas');
            const objetosContainer = document.getElementById('objetosContainer');
            const botonesDiv = document.getElementById('botones');
            let contadorObjeto = 1;

            btnMas.onclick = () => {
                contadorObjeto++;

                let nuevoObjetoDiv = document.createElement('div');
                nuevoObjetoDiv.id = `objeto${contadorObjeto}`;
                nuevoObjetoDiv.className = 'contenedores';

                nuevoObjetoDiv.innerHTML = `
                    <h3>Nuevo Objeto</h3>
                    <label for='nombreNuevo${contadorObjeto}'>Nombre:</label>
                    <input type='text' id='nombreNuevo${contadorObjeto}' name='nombre[]'><br>

                    <label for='descripcionNuevo${contadorObjeto}'>Descripción:</label>
                    <input type='text' id='descripcionNuevo${contadorObjeto}' name='descripcion[]'><br>

                    <label for='imgNuevo${contadorObjeto}'>Añadir imagen:</label>
                    <input type='file' id='imgNuevo${contadorObjeto}' name='img[]'><br>

                    <label for='puntNuevo${contadorObjeto}'>Puntuación:</label>
                    <input type='text' id='puntNuevo${contadorObjeto}' name='punt[]' class="inputPeq"><br>

                    <label for='buenoNuevo${contadorObjeto}'>Bueno:</label>
                    <input type='checkbox' id='buenoNuevo${contadorObjeto}' name='bueno[]' class="inputPeq"><br>
                `;

                objetosContainer.appendChild(nuevoObjetoDiv);
                objetosContainer.appendChild(botonesDiv);
            }
        </script>
    </main>
</body>

</html>