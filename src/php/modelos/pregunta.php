<?php
require_once 'conexion.php';

class PreguntaModelo extends Conexion
{
    function verPreguntas($id)
    {
        $tabla = array();
        $sqlPregunta = "SELECT * FROM pregunta WHERE idCategoria = ?";
        $stmt = $this->conexion->prepare($sqlPregunta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $Resultado = $stmt->get_result();
        while ($fila = $Resultado->fetch_assoc()) {
            array_push($tabla, $fila);
        }
        $stmt->close();
        $this->conexion->close();

        return $tabla;
    }

    function verPregunta($id)
    {
        $sqlPregunta = "SELECT * FROM pregunta WHERE idPregunta = ?";
        $stmt = $this->conexion->prepare($sqlPregunta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $objeto = $resultado->fetch_assoc();
        $stmt->close();

        return $objeto;
    }

    function borrarPregunta($id)
    {
        $sqlCategoria = "DELETE FROM pregunta WHERE idPregunta = ?";
        $stmt = $this->conexion->prepare($sqlCategoria);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    public function agregarPregunta($texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria)
    {
        // Asegurarse de que $respuesta sea 0 o 1
        $respuesta = ($respuesta == '1') ? 1 : 0;

        // Realizar la inserción en la tabla pregunta
        $sql = "INSERT INTO pregunta (texto, reflexionAcierto, reflexionFallo, respuesta, idCategoria) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssii", $texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria);
        $stmt->execute();
        $stmt->close();
        // No cierres la conexión aquí
    }

    public function modificarPregunta($id, $texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria)
    {
        // Asegurarse de que $respuesta sea 0 o 1
        $respuesta = ($respuesta == '1') ? 1 : 0;

        // Realizar la actualización en la tabla pregunta
        $sql = "UPDATE pregunta SET texto = ?, reflexionAcierto = ?, reflexionFallo = ?, respuesta = ?, idCategoria = ? WHERE idPregunta = ?";
        $stmt = $this->conexion->prepare($sql);

        // Ajustar los tipos de datos en bind_param, considerando el booleano como un entero
        $stmt->bind_param("sssiii", $texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria, $id);
        $stmt->execute();
        $stmt->close();
        // No cierres la conexión aquí
    }
    public function obtenerConexion()
    {
        return $this->conexion;
    }
    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}
?>
