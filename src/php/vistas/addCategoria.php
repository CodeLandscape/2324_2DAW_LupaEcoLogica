<!--Aarón Izquierdo Cordero-->
<html>
    <head>
        <meta charset=utf-8>
    </head>
    <body>
        <form action="../controladores/addCategoria.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="nomCategoria">Nombre de la Categoría: </label>
                <input type="text" name="nomCategoria">
            </p>
            <p>
                <label for="nomTablero">Nombre del Tablero: </label>
                <input type="text" name="nomTablero">
            </p>
            <p>
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error']=='1'){
                            echo "<p>El archivo debe de ser una imagen de tipo PNG, JPG o JPEG.</p>";
                        }
                    }
                ?>
                <label for="fondo">Fondo</label>
                <input type="file" name="fondo">
            </p>
            <input type="submit" value="Añadir">
        </form>
    </body>
</html>