<?php
require_once '../modelos/modelo.php';
require_once 'controlador.php';

try {
    $controlador = new Controlador();
    $id=$_POST['id'];
    $datos = $controlador->fondoTablero($id);
    // Verifica si $datos es una cadena (BLOB)
    if (is_string($datos)) {
        $imagen=base64_decode($datos);
        header('Content-Type: application/json');
        echo json_encode(['imagen' => base64_encode($imagen)]);
    } else {
        // Manejar el caso en que $datos no es una cadena
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Los datos no son válidos']);
    }
} catch (Exception $e) {
    // Manejar errores y devolver un mensaje JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?>
