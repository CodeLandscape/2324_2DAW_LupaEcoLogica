<?php
require_once '../../config/configBD.php';
$conexion = null;

// Establecer la conexión a la base de datos
$conexion = new mysqli(HOST, USER, PSW, BDD);
$conexion->set_charset("utf8");


    $sql = "SELECT * FROM config";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $configuracion = $resultado->fetch_assoc();
    $stmt->close();
    $conexion->close();


// Devolver los datos como respuesta JSON
echo json_encode($configuracion);
?>