
    <title>Eliminar</title>
</head>
<body>
    <header>
        Eliminar
        <?php
        include 'template/navegacion.html';
        ?>
    </header>
    <main>
        <?php
        if (isset($_GET['funcion']) && isset($_GET['id'])) {
            $funcion = $_GET['funcion'];
            $id = $_GET['id'];
            echo "<form action='index.php?accion=borrar{$funcion}&controlador={$_GET['funcion']}' method='post'>
                <div>
                    <p class='tamFuenteGrande'>¿Desea eliminar el/la $funcion";
                    
            if ($funcion == 'Categoria') {
                echo " " . $controlador->nombreCategoria($id);       
            }
            $idCategoria = isset($_GET['idCategoria']) ? $_GET['idCategoria'] : '';
            echo "?</p>
            <input type='hidden' name='id' value='$id'>
            <input type='hidden' name='idCategoria' value='$idCategoria'>
            <div id='botones'>
                <input type='submit' value='Eliminar'>
                <a href='index.php'>Volver</a>
            </div>
        </div>
            </form>";

        }
        ?>
    </main>
</body>
</html>
