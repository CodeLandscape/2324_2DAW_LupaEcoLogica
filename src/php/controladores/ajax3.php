<?php
require_once '../modelos/modelo.php';
require_once 'controlador.php';

// Crear una instancia del controlador
$controlador = new Controlador();

// Obtener datos desde la base de datos utilizando el controlador
$datos = $controlador->rankingTabla();  // Ajusta el nombre del método según tu lógica

// Devolver los datos como respuesta JSON
header('Content-Type: application/json');
echo json_encode($datos);
?>