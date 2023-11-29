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
                if ($_GET['funcion'] == 'pregunta'){
                    if (empty($tabla)) {
                        echo "No se encontraron categorías";
                    } else {
                        echo '<form action="index.php?accion=anadir_pregunta&controlador=Pregunta" method="post">
                        <label for="opciones">Selecciona una categoría:</label></br></br></br></br></br></br></br></br></br>
                        <select id="opciones" name="idCategoria_seleccionada">';  // Cambiado el nombre del campo
                
                        foreach ($tabla as $fila) {
                            echo '<option value="' . $fila['idCategoria'] . '|' . $fila['nombre'] . '">' . $fila['nombre'] . '</option>';
                        }
                        
                    
                    echo '</select> </br></br></br></br></br></br></br></br></br></br><input type="submit" value="Enviar"> </form>';
                    
                    }    
                }

                if ($_GET['funcion'] == 'objeto'){
                    if (empty($tabla)) {
                        echo "No se encontraron categorías";
                    } else {
                        echo '<form action="index.php?accion=anadir_objeto&controlador=Objeto" method="post"> 
                        <label for="opciones">Selecciona una categoría:</label></br></br></br></br></br></br></br></br></br>
                        <select id="opciones" name="idCategoria_seleccionada">';  // Cambiado el nombre del campo
                
                        foreach ($tabla as $fila) {
                            echo '<option value="' . $fila['idCategoria'] . '|' . $fila['nombre'] . '">' . $fila['nombre'] . '</option>';
                        }
                        
                    
                        echo '</select> </br></br></br></br></br></br></br></br></br></br><input type="submit" value="Enviar"> </form>';
                    
                    }    
                }
             
            ?>
        </main>
    </body>