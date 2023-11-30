<?php
require_once 'controlador.php';

try {
    $controlador = new Controlador();
    $id=$_POST['id'];
    $datos = $controlador->tablaPregunta($id);
    // Verifica si $datos es una cadena (BLOB)
    // if (is_string($datos)) {
        header('Content-Type: application/json');
        echo json_encode($datos);
    // } else {
    //     // Manejar el caso en que $datos no es una cadena
    //     header('Content-Type: application/json');
    //     echo json_encode(['error' => 'Los datos no son válidos']);
    // }
} catch (Exception $e) {
    // Manejar errores y devolver un mensaje JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>