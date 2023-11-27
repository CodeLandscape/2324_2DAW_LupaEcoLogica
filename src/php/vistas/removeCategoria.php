<!--Aarón Izquierdo Cordero y Oscar Arroyo Aguadero-->
<?php
    include 'template/cabecera.html';
?>
        <title>Eliminar Categoría</title>
    </head>
    <body>
        <header>
            Eliminar Categoría
            <?php
                include 'template/navegacion.php';
            ?>
        </header>
        <main>
            <form action="../controladores/removeCategoria.php" method="post">
                <div>
                    <p class="tamFuenteGrande">¿Desea eliminar la categoría 
                        <?php
                            require '../controladores/controlador.php';
                            if(isset($_GET['id'])){
                                $id=$_GET['id'];
                                $Control = new Controlador();
                                echo $Control->nombreCategoria($id);
                            }
                        ?>
                        ?
                    </p>
                    <input type="hidden" name="idCategoria" value=<?php if(isset($_GET['id'])){echo $_GET['id'];}   ?>>
                    <div id="botones">
                        <input type='submit' value='Eliminar'>
                        <a href="../index.php">Volver</a>
                    </div>
                </div>
            </form>
        </main>
<?php
    include 'template/pie.html';
?>