<title>
            <?php        
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    echo $controlador->nombreCategoria($id);
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
                    echo $controlador->nombreCategoria($id);
                }
                else{
                    echo 'ERROR';
                }
                include 'template/navegacion.html';
            ?>
        </header>
        <main class="aumentarMargin100">
            <form method='post'>
            <?php
                if(isset($_GET['msg'])){
                    echo '<p>'.$_GET['msg'].'</p>';
                }
            ?>
                <div id="contenido">
                <?php
                /* Nombre e imagen del Tablero */
                    if(isset($_GET['id'])){
                        echo '<p class="tamFuenteGrande">'.$controlador->nombreTablero($id).'</p>';
                        echo '<div id="imagenTabla">
                            <img src="data:image/jpeg;base64,'.$controlador->fondoTablero($id).'" alt="Fondo del tablero">
                        </div>';
                    }
                    else{
                        echo '<p class="tamFuenteGrande">ERROR</p>';
                    }
                ?>
                    <a class="submit" href="index.php?controlador=categoria&accion=modTablero&id=<?php echo $_GET['id'];?>">Modificar</a>
                <!--Contenido de la tabla-->

                <table>
                    <tr>
                        <td colspan="6">Preguntas</td>
                    </tr>
                    <tr id="azul">
                        <td>Texto</td>
                        <td>Reflexión +</td>
                        <td>Reflexión -</td>
                        <td>Puntuación</td>
                    </tr>
                    <?php
                    /* Tablas de las Preguntas */
                        if(isset($_GET['id'])){
                            foreach($controlador->tablaPregunta($id) as $fila){
                                echo '<tr>
                                    <td>'.$fila['texto'].'</td>
                                    <td>'.$fila['reflexionAcierto'].'</td>
                                    <td>'.$fila['reflexionFallo'].'</td>
                                    <td>'.$fila['puntuacion'].'</td>
                                </tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="6" class="tamFuenteGrande">ERROR</td></tr><tr><td colspan="6" class="tamFuenteGrande">ERROR</td></tr>';
                        }
                    ?>
                </table>

                <table>
                    <tr>
                        <td colspan="5">Objetos</td>
                    </tr>
                    <tr id="azul">
                        <td>Nombre</td>
                        <td>Imagen</td>
                        <td>Puntuación</td>
                        <td>Descripcion</td>
                    </tr>
                    <?php
                    /* Tablas de los Objetos */
                        if(isset($_GET['id'])){
                            foreach($controlador->tablaObjeto($id) as $fila){
                                $punt = (int)$fila['puntuacion'];

                                if(!$fila['valoracion']){
                                    $punt=0-$punt;
                                }

                                echo '<tr>
                                    <td class="nombreObjeto">'.$fila['nombre'].'</td>
                                    <td><img src="data:image/jpeg;base64,'.$fila['imagen'].'" alt="'.$fila['descripcion'].'" class="imagenObjeto"></td>
                                    <td>'.$punt. '</td>
                                    <td>' . $fila['descripcion'] . '</td>
                                </tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="5" class="tamFuenteGrande">ERROR</td></tr><tr><td colspan="5" class="tamFuenteGrande">ERROR</td></tr>';
                        }
                    ?>
                </table>
            </div>
            </form>
        </main>