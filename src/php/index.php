<?php
    if(isset($_GET['ruta'])){
        $ruta=$_GET['ruta'];
        if(isset($_GET['error'])){
            if(!isset($_GET['error'])){$error=0;}
            else{$error=$_GET['error'];}
            header('Location:vistas/'.$ruta.'.php?error='.$error);
        }
        elseif(isset($_GET['id'])){
            $id=$_GET['id'];
            header('Location:vistas/'.$ruta.'.php?id='.$id);
        }
        elseif(isset($_GET['id']) && isset($_GET['error'])){
            $id=$_GET['id'];
            if(!isset($_GET['error'])){$error=0;}
            else{$error=$_GET['error'];}
            header('Location:vistas/'.$ruta.'.php?id='.$id."&error=".$error);
        }
        else{
            header('Location:vistas/'.$ruta.'.php');
        }
    }
    else{
        header('Location:vistas/admin.php');
    }