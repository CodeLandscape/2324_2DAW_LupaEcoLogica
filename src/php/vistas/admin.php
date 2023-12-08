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
            // Verifica si la tabla de categorías está vacía
            if (empty($tabla)) {
                // Mensaje si no se encuentran categorías
                echo "No se encontraron categorías";
            } else {
                // Formulario para añadir objetos con un selector de categorías
                ?>
                <form action="index.php?accion=anadir_<?php echo $_GET['funcion']; ?>&controlador=<?php echo $_GET['funcion']; ?>" method="post">
                    <label for="opciones">Selecciona una categoría:</label>
                    <select id="opciones" name="idCategoria_seleccionada">
                </form>
                <?php
                // Ciclo para mostrar opciones de categorías
                foreach ($tabla as $fila) {
                    echo '<option value="' . $fila['idCategoria'] . '|' . $fila['nombre'] . '">' . $fila['nombre'] . '</option>';
                }
                ?>
                    </select>
                    <input type="submit" value="Enviar">
                </form>
            <?php
            }
        ?>
    </main>
</body>
