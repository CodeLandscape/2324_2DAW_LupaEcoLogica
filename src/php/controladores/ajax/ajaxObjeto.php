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
    $tabla = array();
    $sqlObjeto = "SELECT * FROM objeto WHERE idCategoria=? ;";
    $stmt = $conexion->prepare($sqlObjeto);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $Resultado = $stmt->get_result();
    while ($fila = $Resultado->fetch_assoc()) {
        array_push($tabla, $fila);
    }
    $stmt->close();
    $conexion->close();

    echo json_encode($tabla);
    // Verifica si $datos es una cadena (BLOB)
    // if (is_string($datos)) {
        // header('Content-Type: application/json');
        // echo json_encode($datos);
    // } else {
    //     // Manejar el caso en que $datos no es una cadena
    //     header('Content-Type: application/json');
    //     echo json_encode(['error' => 'Los datos no son válidos']);
    // }
// } catch (Exception $e) {
//     // Manejar errores y devolver un mensaje JSON
//     //header('Content-Type: application/json');
//     echo json_encode(['error' => $e->getMessage()]);
// }
?>