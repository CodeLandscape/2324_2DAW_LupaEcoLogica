<!--Aarón Izquierdo Cordero y Oscar Arroyo Aguadero-->
<title> Modificar Tablero</title>
    </head>
    <body>
        <header>
            Modificar Tablero
            <?php
                include 'template/navegacion.html';
            ?>
        </header>
        <main>
            <form action="../controladores/crudTablero.php" method="post" enctype="multipart/form-data"> <!--falta por modificar-->
                <div>
                    <label for='tablero'>Nombre del tablero:</label>
                    <input type='text' id='tablero' name='tablero' required><br>
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error']=='2'){
                                echo "<p>El nombre del tablero no puede ser uno existente.</p>";
                            }
                    ?>
                    <label for='img'>Fondo:</label>
                    <input type='file' id='img' name='img' required><br>
                    <?php
                        
                            if($_GET['error']=='1'){
                                echo "<p>El archivo debe de ser una imagen de tipo PNG, JPG o JPEG.</p>";
                            }
                            elseif($_GET['error']=='3'){
                                echo "<p>Ha habido un error inexperado al realizar la acción, pruebe en otro momento. Si el problema persiste, llame a un administrador.</p>";
                            }
                        }
                    ?>
                    <input type="hidden" name="idCategoria" value=<?php if(isset($_GET['id'])){echo $_GET['id'];   ?>>
                    <input type="hidden" name="tipo" value="mod">
                    <div id="botones">
                        <input type='submit' value='Añadir'>
                        <a href="index.php?id=<?php echo $_GET['id'];}?>accion=categoria&controlador=Controlador">Volver</a>
                    </div>
                </div>
            </form>
        </main>