<!--Aarón Izquierdo Cordero y Leandro José Paniagua Balbuena-->
<title>Administración</title>
    </head>
    <body>
        <header>
            Administración
            <?php
                include 'template/navegacion.html';
            ?>
        </header>
		<main>
            <form>
                <div id="contenido">
                        <!--Contenido de la tabla-->
                    <table>
                        <tr id="azul">
                            <td>Nombre</td>
                            <td>Ver</td>
                            <td>Borrar</td>
                        </tr>
                        <?php
                            $tabla = $controlador->tablaCategoria();
                            foreach ($tabla as $fila) {
                                echo "<tr>
                                        <td id=azul>".$fila['nombre']."</td>
                                        <td><a href=index.php?id=".$fila['idCategoria']."&accion=categoria&controlador=Controlador class=sinEstilo><img src='../img/IonEye.svg' class=icono></a></td>
                                        <td><a href=index.php?id=".$fila['idCategoria']."&accion=remove_categoria&controlador=Controlador&funcion=categoria class=sinEstilo><img src='../img/IonIosRemoveCircle.svg' class=icono></a></td>
                                      </tr>";
                            }
                        ?>
                    </table>
                    <a href="index.php?controlador=Controlador&accion=addCategoria" class="submit">Añadir Categoría</a>
                </div>
            </form>
		</main>
