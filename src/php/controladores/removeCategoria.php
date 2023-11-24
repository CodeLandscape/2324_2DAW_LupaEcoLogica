<?php
    /* Aarón Izquierdo Cordero */
    if(isset($_POST['idCategoria'])){
        require '../modelos/modelo.php';
        $Modelo=new Modelo();
        $id=$_POST['idCategoria'];
        $Modelo->borrarCategoria($id);
        header("Location:index.php");
    }