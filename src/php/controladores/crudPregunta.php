<?php
    /* Leandro José Paniagua Balbuena */
    if (isset($_POST['texto']) && isset($_POST['reflexionAcierto']) && isset($_POST['reflexionFallo']) && isset($_POST['respuesta']) && isset($_POST['idCategoria'])) {
        require '../modelos/modelo.php';
        $modelo = new Modelo();
        $error = 1;

        $texto = $_POST['texto'];
        $reflexionAcierto = $_POST['reflexionAcierto'];
        $reflexionFallo = $_POST['reflexionFallo'];
        $respuesta = $_POST['respuesta'];
        $idCategoria = $_POST['idCategoria'];

        /* Añadir Pregunta */
        if ($_POST['tipo'] == 'add') {
            $insercionExitosa = $Modelo->insertarPregunta($texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria);
            if (!$insercionExitosa) {
                header("Location:../index.php?ruta=addPregunta&error=1");
                exit();
            } else {
                header("Location:../index.php");
                exit();
            }
        }
            /* Modificar Pregunta */
        else if ($_POST['tipo'] == 'mod') {
            $idPregunta = $_POST['idPregunta'];
            if ($error == 0) {
                $error = $Modelo->modificarPregunta($idPregunta, $texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria);
            }
            if ($error != 0) {
                header("Location:../index.php?ruta=modPregunta&error=" . $error . "&id=" . $idPregunta);
            } else {
                header("Location:../index.php?ruta=pregunta&id=" . $idPregunta);
            }
        }
    }
?>
