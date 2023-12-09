    <title>Añadir Objeto</title>
</head>

<body>
    <header>
        Añadir Objeto
        <?php include 'template/navegacion.html'; ?>
    </header>
    <main class="aumentarMargin100">
        <form method='post' action="index.php?accion=agregar_actualizar_objeto&controlador=objeto" enctype="multipart/form-data">
            <div id="objetosContainer">
                <?php
                $categoriaSeleccionada = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';

                // Separar el idCategoria y el nombre
                list($idCategoria, $nombreCategoria) = explode('|', $categoriaSeleccionada);
                ?>
                <input type="hidden" name="idCategoria_seleccionada" value="<?php echo $idCategoria; ?>">
                <h1><?php echo $nombreCategoria; ?></h1>
                <?php
                // Obtener objetos existentes desde el controlador
                $objetosExistentes = $controlador->tablaObjeto($idCategoria);

                // Mostrar los objetos existentes con sus detalles para edición
                foreach ($objetosExistentes as $indice => $objeto) {
                    $id=$objeto['idObjeto'];
                    ?>
                    <div class="contenedores">
                        <input type="hidden" name="id[]" value="<?php echo $id; ?>">
                        <p class="datosObjeto">
                            <input type="text" name="nombre[]" value="<?php echo $objeto['nombre']; ?>" placeholder="Nombre del objeto" required>
                            <input type="text" name="descripcion[]" value="<?php echo $objeto['descripcion']; ?>" placeholder="Descripción" required class="descripcion">
                            <div class="objetoImagen" style="background-image: url('data:image/png;base64,<?php echo $objeto['imagen']; ?>'); width: 200px; height: 200px; background-size: cover;"></div>
                        </p>
                        <p>
                            <input type="file" name="img[]">
                        </p>
                        <p>
                            <label for="punt[]">Puntuación</label>
                            <input type="number" name="punt[]" value="<?php echo $objeto['puntuacion']; ?>" required class="inputPeq">
                            <label for="bueno[]">Bueno</label>
                            <input type="checkbox" name="bueno[]" <?php if($objeto['valoracion']==1){echo 'checked';} ?>>
                        </p>
                        <a href="index.php?accion=remove&id=<?php echo $id; ?>&controlador=objeto&funcion=objeto&idCategoria=<?php echo $idCategoria; ?>" class="submit">Borrar</a>
                    </div>
                    
                    <?php
                }
                ?>
            </div>
            <div id="botones">
                <input type='button' value='Añadir Objeto' onclick="agregarObjeto();" class="submit">
                <input type='submit' value='Guardar Cambios'>
                <a href="index.php?accion=selectCategoria&controlador=Controlador&funcion=objeto" class="submit">Volver</a>
            </div>
        </form>

        <script>
            'use strict';
            const objetosContainer = document.getElementById('objetosContainer');
            
            let contadorObjeto = <?php echo count($objetosExistentes); ?>;

            function agregarObjeto(){
                contadorObjeto++;

                let nuevoObjetoDiv = document.createElement('div');
                nuevoObjetoDiv.id = `objeto${contadorObjeto}`;
                nuevoObjetoDiv.className = 'contenedores';

                nuevoObjetoDiv.innerHTML = `
                    <input type="hidden" name="id[]" value="<?php echo $id; ?>">
                        <p class="datosObjeto nuevoObjeto">
                            <input type="text" name="nombre[]" placeholder="Nombre del objeto" required>
                            <input type="text" name="descripcion[]" placeholder="Descripción" required class="descripcion">
                        </p>
                        <p>
                            <input type="file" name="img[]">
                        </p>
                        <p>
                            <label for="punt[]">Puntuación</label>
                            <input type="number" name="punt[]" required class="inputPeq">
                            <label for="bueno[]">Bueno</label>
                            <input type="checkbox" name="bueno[]">
                        </p>
                        <input type='button' value='Quitar' onclick="quitarObjeto(${contadorObjeto});" class="submit">
                `;
                objetosContainer.appendChild(nuevoObjetoDiv);
            }
            function quitarObjeto(contador){
                const objetosContainer = document.getElementById('objetosContainer');
                const objetoDiv = document.getElementById('objeto'+contador);
                const throwawayNode = objetosContainer.removeChild(objetoDiv);
            }
        </script>
    </main>