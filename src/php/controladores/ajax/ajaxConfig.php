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


    $sql = "SELECT * FROM config";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $configuracion = $resultado->fetch_assoc();
    $stmt->close();
    $conexion->close();


// Devolver los datos como respuesta JSON
//header('Content-Type: application/json');
echo json_encode($configuracion);
?>