<!--Aarón Izquierdo Cordero y Oscar Arroyo Aguadero-->
<title>Eliminar Categoría</title>
    </head>
    <body>
        <header>
            Eliminar Categoría
        </header>
        <main>
        <form action="index.php?accion=borrarCategoria&controlador=Controlador" method="post">
    <div>
        <p class="tamFuenteGrande">¿Desea eliminar la categoría 
            <?php
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    echo $controlador->nombreCategoria($id);
                    
                }
            ?> ?
        </p>
        <input type="hidden" name="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];} ?>">
        <div id="botones">
            <input type='submit' value='Eliminar'>
            <a href="index.php">Volver</a>
        </div>
    </div>
</form>

        </main>