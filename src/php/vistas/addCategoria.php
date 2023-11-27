<!--Oscar Arroyo Aguadero y Aarón Izquierdo Cordero-->
<?php
    include 'template/cabecera.html';
?>
		<title>Crear Categoría y Tablero</title>
	</head>
    <body>
        <header>
            Crear Categoría y Tablero
            <?php
                include 'template/navegacion.php';
            ?>
        </header>
        <main>
            <form action="../controladores/crudTablero.php" method="post" enctype="multipart/form-data">
                <div id="contenido">
                    <label for='categoria'>Nombre de la categoría:</label>
                    <input type='text' id='categoria' name='categoria' required><br>
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error']=='2'){
                                echo "<p>El nombre de la categoría no puede ser uno existente.</p>";
                            }
                        }
                    ?>
                    <label for='tablero'>Nombre del tablero:</label>
                    <input type='text' id='tablero' name='tablero' required><br>
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error']=='3'){
                                echo "<p>El nombre del tablero no puede ser uno existente.</p>";
                            }
                        }
                    ?>
                    <label for='img'>Fondo:</label>
                    <input type='file' id='img' name='img' required><br>
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error']=='1'){
                                echo "<p>El archivo debe de ser una imagen de tipo PNG, JPG o JPEG.</p>";
                            }
                            elseif($_GET['error']=='4'){
                                echo "<p>Ha habido un error inexperado al realizar la acción, pruebe en otro momento. Si el problema persiste, llame a un administrador.</p>";
                            }
                        }
                    ?>
                    <input type="hidden" name="tipo" value="add">
                    <div id="botones">
                        <input type='submit' value='Añadir'>
                        <a href="../index.php">Volver</a>
                    </div>
                </div>
            </form>
        </main>
<?php
    include 'template/pie.html';
?>