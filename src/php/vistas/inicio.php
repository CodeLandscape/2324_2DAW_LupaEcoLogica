<!--Aarón Izquierdo Cordero-->
<html>
    <head>
        <meta charset=utf-8>
        <title>Inicio</title>
    </head>
    <body>
        <?php
            require '../modelos/modelo.php';
            $Modelo = new Modelo();
            $tabla = $Modelo->tablaCategoria();
            echo "<table><tr><th>Nombre</th><th>Ver</th><th>Borrar</th></tr>";
            foreach($tabla as $fila){
                echo "<tr><td>".$fila['nombre']."</td>
                    <td><a href=../controladores/categoria.php?id=".$fila['idCategoria']."&tipo=ver>Ver</a></td>
                    <td><a href=../controladores/categoria.php?id=".$fila['idCategoria']."&tipo=borrar>Borrar</a>
                </td>";
            }
        ?>
        <p><a href="addCategoria.php">Añadir Categoría</a></p>
    </body>
</html>