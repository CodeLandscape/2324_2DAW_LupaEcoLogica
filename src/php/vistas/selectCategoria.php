<title>Seleccionar Categorías</title>
</head>
<body>
    <header>
        <!-- Título de la página -->
        Seleccionar Categorías
        <?php
            // Inclusión de la navegación desde un archivo externo
            include 'template/navegacion.html';
        ?>
    </header>
    <main>
        <?php
            // Obtención de la tabla de categorías desde el controlador
            $tabla = $controlador->tablaCategoria();

            // Verificación de la función 'pregunta' para mostrar el formulario correspondiente
            if ($_GET['funcion'] == 'pregunta'){
                // Verifica si la tabla de categorías está vacía
                if (empty($tabla)) {
                    // Mensaje si no se encuentran categorías
                    echo "No se encontraron categorías";
                } else {
                    // Formulario para añadir preguntas con un selector de categorías
                    echo '<form action="index.php?accion=anadir_pregunta&controlador=pregunta" method="post">
                    <label for="opciones">Selecciona una categoría:</label></br></br></br></br></br></br></br></br></br>
                    <select id="opciones" name="idCategoria_seleccionada">';  // Cambiado el nombre del campo
                
                    // Ciclo para mostrar opciones de categorías
                    foreach ($tabla as $fila) {
                        echo '<option value="' . $fila['idCategoria'] . '|' . $fila['nombre'] . '">' . $fila['nombre'] . '</option>';
                    }
                    
                    echo '</select> </br></br></br></br></br></br></br></br></br></br><input type="submit" value="Enviar"> </form>';
                }    
            }

            // Verificación de la función 'objeto' para mostrar el formulario correspondiente
            if ($_GET['funcion'] == 'objeto'){
                // Verifica si la tabla de categorías está vacía
                if (empty($tabla)) {
                    // Mensaje si no se encuentran categorías
                    echo "No se encontraron categorías";
                } else {
                    // Formulario para añadir objetos con un selector de categorías
                    echo '<form action="index.php?accion=anadir_objeto&controlador=objeto" method="post"> 
                    <label for="opciones">Selecciona una categoría:</label></br></br></br></br></br></br></br></br></br>
                    <select id="opciones" name="idCategoria_seleccionada">';  // Cambiado el nombre del campo
                
                    // Ciclo para mostrar opciones de categorías
                    foreach ($tabla as $fila) {
                        echo '<option value="' . $fila['idCategoria'] . '|' . $fila['nombre'] . '">' . $fila['nombre'] . '</option>';
                    }
                    
                    echo '</select> </br></br></br></br></br></br></br></br></br></br><input type="submit" value="Enviar"> </form>';
                }    
            }
        ?>
    </main>
</body>
