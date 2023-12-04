<!-- Etiqueta del título de la página -->
<title>Administración</title>

<!-- Cierre de la sección head del documento -->
</head>

<!-- Comienzo del cuerpo del documento -->
<body>
    <!-- Encabezado de la página -->
    <header>
        Administración

        <!-- Incluir la barra de navegación desde un archivo externo -->
        <?php
            include 'template/navegacion.html';
        ?>
    </header>

    <!-- Sección principal del contenido -->
    <main>
        <form>
            <div id="contenido">
                <!-- Mostrar mensaje en caso de que exista la variable 'msg' -->
                <?php
                if(isset($_GET['msg'])){
                    echo '<p>'.$_GET['msg'].'</p>';
                }
                ?>

                <!-- Contenido de la tabla -->
                <table>
                    <!-- Encabezados de la tabla -->
                    <tr id="azul">
                        <td>Nombre</td>
                        <td>Ver</td>
                        <td>Borrar</td>
                    </tr>

                    <!-- Generar filas de la tabla dinámicamente -->
                    <?php
                        // Obtener información de la tabla de categorías
                        $tabla = $controlador->tablaCategoria();

                        // Iterar sobre cada fila de la tabla
                        foreach ($tabla as $fila) {
                            // Mostrar información de cada categoría en una fila de la tabla
                            echo "<tr>
                                    <td id=azul>".$fila['nombre']."</td>
                                    <td><a href=index.php?id=".$fila['idCategoria']."&accion=categoria&controlador=controlador class=sinEstilo><img src='../img/IonEye.svg' class=icono></a></td>
                                    <td><a href=index.php?id=".$fila['idCategoria']."&accion=remove&controlador=categoria&funcion=Categoria class=sinEstilo><img src='../img/IonIosRemoveCircle.svg' class=icono></a></td>
                                  </tr>";
                        }
                    ?>
                </table>

                <!-- Enlace para añadir una nueva categoría -->
                <a href="index.php?controlador=categoria&accion=addCategoria" class="submit">Añadir Categoría</a>
            </div>
        </form>
    </main>
</body>
