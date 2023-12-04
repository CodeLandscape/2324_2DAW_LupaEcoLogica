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
$id=$_POST['id'];
$sqlTablero = "SELECT * FROM tablero WHERE idCategoria = ?";
$stmt = $conexion->prepare($sqlTablero);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si se obtuvieron resultados
if ($resultado->num_rows > 0) {
    $imagen = $resultado->fetch_assoc();
    $imageData = $imagen['imagenFondo'];  // Reemplaza 'nombre_de_la_columna_de_imagen' con el nombre real de la columna de imagen
    $stmt->close();
    $conexion->close();

    echo json_encode(['imagen' => $imageData]);
} else {
    // No se encontraron resultados, manejar el caso apropiadamente
    $stmt->close();
    $conexion->close();

    echo json_encode(['error' => 'No se encontraron resultados']);
}
?>
