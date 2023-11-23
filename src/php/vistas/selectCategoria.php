
        <title>Seleccionar Categorías</title>
    </head>
    <body>
        <header>
            Seleccionar Categorías
        </header>
		<main>
            <?php
                function mostrarFormulario($controlador) {
                    // Obtener las categorías
                $tabla = $controlador->tablaCategoria();

                if (empty($tabla)) {
                    echo "No se encontraron categorías";
                } else {
                    echo '<form action="anadir_pregunta.php" method="post"> 
                            <label for="opciones">Selecciona una categoría:</label>
                            <select id="opciones" name="categoria_seleccionada">';
                                                
                    foreach ($tabla as $fila) {
                        echo '<option value="' . $fila['nombre'] . '">' . $fila['nombre'] . '</option>';
                    }

                    echo '</select> <input type="submit" value="Enviar"> </form>';
                }    
            }
            ?>
        </main>
    </body>