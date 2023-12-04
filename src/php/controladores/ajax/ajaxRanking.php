<?php
require_once '../../config/configBD.php';
$conexion = null;

// Establecer la conexión a la base de datos
$conexion = new mysqli(HOST, USER, PSW, BDD);
$conexion->set_charset("utf8");
$sql = "SELECT nombre, localidad, puntuacion FROM partida ORDER BY puntuacion DESC LIMIT 10;";
$stmt = $conexion->prepare($sql);

$stmt->execute();

$resultado = $stmt->get_result();
$tabla = array();

while ($fila = $resultado->fetch_assoc()) {
    array_push($tabla, $fila);
}
$stmt->close();
$conexion->close();
echo json_encode($tabla);
?>