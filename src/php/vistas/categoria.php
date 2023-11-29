<!-- Aarón Izquierdo Cordero y Oscar Arroyo Aguadero -->
Categorias

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
                    <a class="submit" href="index.php?controlador=Controlador&accion=modTablero&id=<?php echo $_GET['id'];?>">Modificar</a>
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
                        <td>Borrar</td>
                        <td>Modificar</td>
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
                                    <td><a href=index.php?id='.$fila['idPregunta'].'&accion=remove_categoria&controlador=Controlador&funcion=Pregunta class="sinEstilo"><img src="../img/IonBan.svg" class="icono"></a></td>
                                    <td><a href=index.php?idPregunta='.$fila['idPregunta'].'&accion=modificar_pregunta&controlador=Controlador&funcion=actualizarPregunta&idCategoria='.$_GET['id'].' class="submit sinEstilo"><img src="../img/IonPencil.svg" class="icono"></a></td>

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
                        <td>Borrar</td>
                        <td>Modificar</td>
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
                                    <td>'.$fila['nombre'].'</td>
                                    <td><img src="data:image/jpeg;base64,'.$fila['imagen'].'" alt="'.$fila['descripcion'].'" class="imagenObjeto"></td>
                                    <td>'.$punt.'</td>
                                    <td><a href=index.php?id='.$fila['idObjeto'].'&accion=remove_categoria&controlador=Controlador&funcion=Objeto&idCategoria='.$_GET['id'].' class="sinEstilo"><img src="../img/IonBan.svg" class="icono"></a></td>
                                    <td><a href=index.php?idCategoria='.$_GET['id'].'&id='.$fila['idObjeto'].'&accion=modificar_objeto&controlador=Controlador&funcion=Objeto class="sinEstilo"><img src="../img/IonPencil.svg" class="icono"></a></td>
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