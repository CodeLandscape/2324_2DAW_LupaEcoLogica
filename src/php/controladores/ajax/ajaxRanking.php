<?php
require_once '../../config/configBD.php';
// define('HOST',"13.2daw.esvirgua.com");
// define('USER',"user2daw_ABP");
// define('PSW',"L.=K#2AM^F7T");
// define('BDD',"user2daw_ABP_GrupoE");
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

// // Crear una instancia del controlador
// $controlador = new Ajax();

// // Obtener datos desde la base de datos utilizando el controlador
// $datos = $controlador->rankingTabla();  // Ajusta el nombre del método según tu lógica

// // Devolver los datos como respuesta JSON
//header('Content-Type: application/json');
echo json_encode($tabla);
?>