<?php
    require '../modelos/modelo.php';
    if(isset($_GET['id'])){
        $Modelo = new Modelo();
        if($_GET['tipo']=='ver'){

        }
        elseif($_GET['tipo']=='borrar'){

        }
        else{
            header('Location:../vistas/inicio.php');
        }
    }