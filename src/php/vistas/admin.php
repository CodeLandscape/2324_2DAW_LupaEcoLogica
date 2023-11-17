<!--Aarón Izquierdo Cordero y Leandro José Paniagua Balbuena-->
<?php
    include 'template/cabezera.html';
?>
        <title>Administración</title>
    </head>
    <body>
        <header>
            Administración
            <?php
                include 'template/navegacion.php';
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
                            require '../controladores/controlador.php';
                            $Control = new Controlador();
                            $tabla = $Control->tablaCategoria();
                            foreach($tabla as $fila){
                                echo "<tr><td id=azul>".$fila['nombre']."</td>
                                    <td><a href=../index.php?id=".$fila['idCategoria']."&ruta=categoria class=sinEstilo><img src=../../img/IonEye.svg class=icono></a></td>
                                    <td><a href=../index.php?id=".$fila['idCategoria']."&ruta=removeCategoria class=sinEstilo><img src=../../img/IonIosRemoveCircle.svg class=icono></a></td>
                                </tr>";
                            }
                        ?>
                    </table>
                    <a href="../index.php?ruta=addCategoria" class="submit">Añadir Categoría</a>
                </div>
            </form>
		</main>
<?php
    include 'template/pie.html';
?>
