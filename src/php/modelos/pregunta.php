<?php

require_once 'conexion.php';

/**
 * Clase PreguntaModelo para la interacción con la base de datos relacionada con preguntas.
 */
class PreguntaModelo extends Conexion
{
    /**
     * Obtiene todas las preguntas de una categoría mediante una consulta preparada.
     *
     * @param int $id Id de la categoría.
     * @return array Un array bidimensional con las filas de la tabla pregunta.
     */
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

        return $tabla;
    }

    function verTodasPreguntas()
    {
        $tabla = array();
        $sqlPregunta = "SELECT * FROM pregunta";
        $stmt = $this->conexion->prepare($sqlPregunta);
        $stmt->execute();
        $Resultado = $stmt->get_result();
        while ($fila = $Resultado->fetch_assoc()) {
            array_push($tabla, $fila);
        }
        $stmt->close();
        $this->conexion->close();

        return $tabla;
    }


    /**
     * Obtiene una pregunta específica mediante una consulta preparada.
     *
     * @param int $id Id de la pregunta.
     * @return array Un array asociativo con los datos de la pregunta.
     */
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

    /**
     * Borra una pregunta específica mediante una consulta preparada.
     *
     * @param int $id Id de la pregunta.
     */
    function borrarPregunta($id)
    {
        $sqlCategoria = "DELETE FROM pregunta WHERE idPregunta = ?";
        $stmt = $this->conexion->prepare($sqlCategoria);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    /**
     * Agrega una nueva pregunta mediante una consulta preparada.
     *
     * @param string $texto Texto de la pregunta.
     * @param string $reflexionAcierto Reflexión en caso de acierto.
     * @param string $reflexionFallo Reflexión en caso de fallo.
     * @param int $respuesta Valor booleano que indica la respuesta (0 o 1).
     * @param int $idCategoria Id de la categoría a la que pertenece la pregunta.
     */
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

    /**
     * Modifica una pregunta existente mediante una consulta preparada.
     *
     * @param int $id Id de la pregunta.
     * @param string $texto Nuevo texto de la pregunta.
     * @param string $reflexionAcierto Nueva reflexión en caso de acierto.
     * @param string $reflexionFallo Nueva reflexión en caso de fallo.
     * @param int $respuesta Nuevo valor booleano que indica la respuesta (0 o 1).
     * @param int $idCategoria Nuevo Id de la categoría a la que pertenece la pregunta.
     */
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

    /**
     * Verifica si una pregunta ya existe en una categoría específica.
     *
     * @param string $pregunta Texto de la pregunta.
     * @param int $idCategoria Id de la categoría.
     * @return bool True si la pregunta existe, False si no.
     */
    public function preguntaExiste($pregunta, $idCategoria)
    {
        $sql = "SELECT idPregunta FROM pregunta WHERE texto = ? AND idCategoria = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("si", $pregunta, $idCategoria);
        $stmt->execute();
        $stmt->store_result();
        $existe = $stmt->num_rows > 0;
        $stmt->close();
        return $existe;
    }

    /**
     * Obtiene la conexión actual.
     *
     * @return mysqli La instancia de la conexión.
     */
    public function obtenerConexion()
    {
        return $this->conexion;
    }

    /**
     * Cierra la conexión actual.
     */
    public function cerrarConexion()
    {
        $this->conexion->close();
    }
}
