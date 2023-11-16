<?php
    if(isset($_GET['ruta'])){
        $ruta=$_GET['ruta'];
        switch ($ruta) {
            case 'addCategoria':
                if(!isset($_GET['error'])){$error=0;}
                else{$error=$_GET['error'];}
                header('Location:vistas/'.$ruta.'.php&error='.$error);
                break;
            case 'categoria':
                $id=$_GET['id'];
                header('Location:vistas/'.$ruta.'.php?id='.$id);
                break;
            case 'removeCategoria':
                $id=$_GET['id'];
                header('Location:controladores/'.$ruta.'.php?id='.$id);
                break;
            case 'modTablero':
                $id=$_GET['id'];
                if(!isset($_GET['error'])){$error=0;}
                else{$error=$_GET['error'];}
                header('Location:vistas/'.$ruta.'.php?id='.$id."&error=".$error);
                break;
        }
    }
    else{
        header('Location:vistas/admin.php');
    }