<?php
require_once '../../config/configBD.php';
$conexion = null;

// Establecer la conexión a la base de datos
$conexion = new mysqli(HOST, USER, PSW, BDD);
$conexion->set_charset("utf8");
    $nombre=$_GET['nombre'];
    $localidad=$_GET['localidad'];
    $puntuacion=$_GET['puntuacion'];
    $objetosAcertados=$_GET['objetosAcertados'];
    $preguntasAcertadas = $_GET['preguntasAcertadas'];

    $sql = "INSERT INTO `partida` (`nombre`, `localidad`, `puntuacion`, `objetosAcertados`, `preguntasAcertadas`) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    
    $stmt->bind_param("ssiii", $nombre, $localidad, $puntuacion, $objetosAcertados, $preguntasAcertadas);
    $stmt->execute();
    $stmt->close();
    $conexion->close();
?>