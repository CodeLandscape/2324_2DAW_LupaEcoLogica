<?php
require_once '../../config/configBD.php';
$conexion = null;

// Establecer la conexión a la base de datos
$conexion = new mysqli(HOST, USER, PSW, BDD);
$conexion->set_charset("utf8");
    $id=$_POST['id'];
    $tabla = array();
    $sqlPregunta = "SELECT * FROM pregunta WHERE idCategoria = ?";
    $stmt = $conexion->prepare($sqlPregunta);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $Resultado = $stmt->get_result();
    while ($fila = $Resultado->fetch_assoc()) {
        array_push($tabla, $fila);
    }
    $stmt->close();
    $conexion->close();

    echo json_encode($tabla);
?>