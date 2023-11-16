<?php
    /* Aarón Izquierdo Cordero */
    if(isset($_POST['categoria']) && isset($_FILES['img'])){
        require '../modelos/modelo.php';
        $Modelo = new Modelo();
        $error=1;

        $categoria = $_POST['categoria'];
        $tablero = $_POST['tablero'];

        $fondo = $_FILES['img']['tmp_name'];
        $tipo = $_FILES['img']['type'];
        if($tipo=='image/png' || $tipo=='image/jpg' || $tipo=='image/jpeg'){
            $contenido = file_get_contents($fondo);
            $base64 = base64_encode($contenido);
            error=0;
        }
        /**
         * Añade Categoria y tablero
         */
        if($_POST['tipo']=='add'){
            $error=$Modelo->insertarCategoria($categoria,$tablero,$base64);
            if($error!=0){
                header("Location:../index.php?error=".$error);
            }
            header("Location:../index.php");
        }
        /**
         * Modifica el tablero.
         */
        elseif($_POST['tipo']=='mod'){
            $idCategoria=$_POST['idCategoria']
            $error=$Modelo->modificarTablero($idCategoria,$tablero,$base64);
            if($error!=0){
                header("Location:../index.php?error=".$error."&id=".$idCategoria);
            }
            header("Location:../index.php?id=".$idCategoria);
        }
    }

    