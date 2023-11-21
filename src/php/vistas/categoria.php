<!-- Aarón Izquierdo Cordero y Oscar Arroyo Aguadero -->
<?php
    include 'template/cabezera.html';
?>
		<title>
            <?php
                require '../controladores/controlador.php';
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $Control = new Controlador();
                    echo $Control->nombreCategoria($id);
                }
                else{
                    echo 'ERROR';
                }
            ?>
        </title>
    </head>
    <body>
        <!--Cabecera de la página-->
		<header>
            <?php
                if(isset($_GET['id'])){
                    echo $Control->nombreCategoria($id);
                }
                else{
                    echo 'ERROR';
                }
                include 'template/navegacion.php';
            ?>
        </header>
        <main class="aumentarMargin100">
            <form method='post'>
                <div id="contenido">
                <?php
                /* Nombre e imagen del Tablero */
                    if(isset($_GET['id'])){
                        echo '<p class="tamFuenteGrande">'.$Control->nombreTablero($id).'</p>';
                        echo '<div id="imagenTabla">
                            <img src="data:image/jpeg;base64,'.$Control->fondoTablero($id).'" alt="Fondo del tablero">
                        </div>';
                    }
                    else{
                        echo '<p class="tamFuenteGrande">ERROR</p>';
                    }
                ?>
                    <a class="submit" href="../index.php?ruta=modTablero&id=<?php echo $id; ?>">Modificar</a>
                <!--Contenido de la tabla-->
                <div class="botonAbajo">
                    <a class="submit">Añadir Pregunta</a>
                </div>

                <table>
                    <tr>
                        <td colspan="6">Preguntas</td>
                    </tr>
                    <tr id="azul">
                        <td>Texto</td>
                        <td>Reflexión +</td>
                        <td>Reflexión -</td>
                        <td>Puntuación</td>
                        <td>Borrar</td>
                        <td>Modificar</td>
                    </tr>
                    <?php
                    /* Tablas de las Preguntas */
                        if(isset($_GET['id'])){
                            foreach($Control->tablaPregunta($id) as $fila){
                                echo '<tr>
                                    <td>'.$fila['texto'].'</td>
                                    <td>'.$fila['reflexionAcierto'].'</td>
                                    <td>'.$fila['reflexionFallo'].'</td>
                                    <td>'.$fila['puntuacion'].'</td>
                                    <td><a href="" class="sinEstilo"><img src="../../img/IonBan.svg" class="icono"></a></td>
                                    <td><a href="" class="sinEstilo"><img src="../../img/IonPencil.svg" class="icono"></a></td>
                                </tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="6" class="tamFuenteGrande">ERROR</td></tr><tr><td colspan="6" class="tamFuenteGrande">ERROR</td></tr>';
                        }
                    ?>
                </table>

                <div class="botonAbajo">
                    <a class="submit">Añadir Objeto</a>
                </div>

                <table>
                    <tr>
                        <td colspan="5">Objetos</td>
                    </tr>
                    <tr id="azul">
                        <td>Nombre</td>
                        <td>Imagen</td>
                        <td>Puntuación</td>
                        <td>Borrar</td>
                        <td>Modificar</td>
                    </tr>
                    <?php
                    /* Tablas de los Objetos */
                        if(isset($_GET['id'])){
                            foreach($Control->tablaObjeto($id) as $fila){
                                $punt = (int)$fila['puntuacion'];

                                if(!$fila['valoracion']){
                                    $punt=0-$punt;
                                }

                                echo '<tr>
                                    <td>'.$fila['nombre'].'</td>
                                    <td><img src="data:image/jpeg;base64,'.$fila['imagen'].'" alt="'.$fila['descripcion'].'"></td>
                                    <td>'.$punt.'</td>
                                    <td><a href="" class="sinEstilo"><img src="../../img/IonBan.svg" class="icono"></a></td>
                                    <td><a href="" class="sinEstilo"><img src="../../img/IonPencil.svg" class="icono"></a></td>
                                </tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="5" class="tamFuenteGrande">ERROR</td></tr><tr><td colspan="5" class="tamFuenteGrande">ERROR</td></tr>';
                        }
                    ?>
                </table>
                <a href="../index.php">Volver</a>
            </div>
            </form>
        </main>
<?php
    include 'template/pie.html';
?>