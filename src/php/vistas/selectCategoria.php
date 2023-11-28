<title>Seleccionar Categorías</title>
    </head>
    <body>
        <header>
            Seleccionar Categorías
            <?php
                include 'template/navegacion.html';
            ?>
        </header>
		<main>
            <?php
                $tabla = $controlador->tablaCategoria();

                if (empty($tabla)) {
                    echo "No se encontraron categorías";
                } else {
                    echo '<form action="index.php?accion=anadir_pregunta&controlador=Controlador" method="post"> 
                    <label for="opciones">Selecciona una categoría:</label>
                    <select id="opciones" name="idCategoria_seleccionada">';  // Cambiado el nombre del campo
            
                    foreach ($tabla as $fila) {
                        echo '<option value="' . $fila['idCategoria'] . '|' . $fila['nombre'] . '">' . $fila['nombre'] . '</option>';
                    }
                    
                
                echo '</select> <input type="submit" value="Enviar"> </form>';
                
                }    
            ?>
        </main>
    </body>