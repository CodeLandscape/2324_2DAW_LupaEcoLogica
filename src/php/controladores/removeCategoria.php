<?php
    /* Aarón Izquierdo Cordero */
    if(isset($_GET['id'])){
        require '../modelos/modelo.php';
        $Modelo=new Modelo();
        $id=$_GET['id'];
        $Modelo->borrarCategoria($id);
        header("Location:../index.php");
    }