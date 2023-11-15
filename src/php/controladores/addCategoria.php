<?php
    /* Aarón Izquierdo Cordero */
    if(isset($_POST['nomCategoria']) && isset($_FILES['fondo'])){
        require '../modelos/modelo.php';
        $nomC = $_POST['nomCategoria'];
        $nomT = $_POST['nomTablero'];

        $fondo = $_FILES['fondo']['tmp_name'];
        $tipo = $_FILES['fondo']['type'];
        if($tipo=='image/png' || $tipo=='image/jpg' || $tipo=='image/jpeg'){
            $contenido = file_get_contents($fondo);

            $base64 = base64_encode($contenido);

            $Modelo = new Modelo();
            $Modelo->insertarCategoria($nomC,$nomT,$base64);

            header("Location:../vistas/inicio.php");
        }
        else{
            header("Location:../vistas/addCategoria.php?error=1");
        }
    }