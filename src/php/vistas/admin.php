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
                            echo "<tr id=azul><td>".$fila['nombre']."</td>
                                <td class=sinEstilo><a href=../index.php?id=".$fila['idCategoria']."&ruta=categoria><img src=img/IonEye.svg class=icono></a></td>
                                <td class=sinEstilo><a href=../index.php?id=".$fila['idCategoria']."&ruta=removeCategoria><img src=img/IonIosRemoveCircle.svg class=icono></a></td>
                            </tr>";
                        }
                    ?>
				</table>
				<a href="../index.php?ruta=addCategoria" class="submit">Añadir Categoría</a>
			</div>
		</main>
<?php
    include 'template/pie.html';
?>

