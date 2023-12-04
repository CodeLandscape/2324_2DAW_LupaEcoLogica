<?php
require_once '../../config/configBD.php';
$conexion = null;

// Establecer la conexión a la base de datos
$conexion = new mysqli(HOST, USER, PSW, BDD);
$conexion->set_charset("utf8");

$sql = "SELECT * FROM tablero ORDER BY RAND() LIMIT 1;";
$Resultado = $conexion->query($sql);
$fila = $Resultado->fetch_assoc();
$conexion->close();

// Devolver los datos como respuesta JSON
echo json_encode($fila);
?>