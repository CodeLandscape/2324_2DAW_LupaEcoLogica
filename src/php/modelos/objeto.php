<?php

require_once 'conexion.php';

/**
 * Clase ObjetoModelo para la interacción con la base de datos relacionada con objetos.
 */
class ObjetoModelo extends Conexion
{
    /**
     * Obtiene todos los objetos de una categoría mediante una consulta preparada.
     *
     * @param int $id Id de la categoría.
     * @return array Un array bidimensional con las filas de la tabla objeto.
     */
    function verObjetos($id)
    {
        $tabla = array();
        $sqlObjeto = "SELECT * FROM objeto WHERE idCategoria=? ;";
        $stmt = $this->conexion->prepare($sqlObjeto);
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

    /**
     * Obtiene un objeto específico mediante una consulta preparada.
     *
     * @param int $id Id del objeto.
     * @return array Un array asociativo con los datos del objeto.
     */
    function verObjeto($id)
    {
        $sqlObjeto = "SELECT * FROM objeto WHERE idObjeto=? ;";
        $stmt = $this->conexion->prepare($sqlObjeto);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $objeto = $resultado->fetch_assoc();
        $stmt->close();
        $this->conexion->close();

        return $objeto;
    }

    /**
     * Borra un objeto específico mediante una consulta preparada.
     *
     * @param int $id Id del objeto.
     */
    function borrarObjeto($id)
    {
        $sqlCategoria = "DELETE FROM objeto WHERE idObjeto = ?";
        $stmt = $this->conexion->prepare($sqlCategoria);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }

    /**
     * Agrega un nuevo objeto mediante una consulta preparada.
     *
     * @param string $nombre Nombre del objeto.
     * @param string $descripcion Descripción del objeto.
     * @param string $imagen Imagen del objeto (base64).
     * @param int $puntuacion Puntuación del objeto.
     * @param int $esBueno Valor booleano que indica si el objeto es bueno.
     * @param int $idCategoria Id de la categoría a la que pertenece el objeto.
     */
    public function agregarObjeto($nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria)
    {
        // Realizar la inserción en la tabla objeto
        $sql = "INSERT INTO objeto (nombre, descripcion, imagen, puntuacion, valoracion, idCategoria) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssiii", $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Actualiza un objeto existente mediante una consulta preparada.
     *
     * @param int $id Id del objeto.
     * @param string $nombre Nuevo nombre del objeto.
     * @param string $descripcion Nueva descripción del objeto.
     * @param string $imagen Nueva imagen del objeto (base64).
     * @param int $puntuacion Nueva puntuación del objeto.
     * @param int $esBueno Nuevo valor booleano que indica si el objeto es bueno.
     * @param int $idCategoria Nuevo Id de la categoría a la que pertenece el objeto.
     */
    public function actualizarObjeto($id, $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria)
    {
        

        // Realizar la actualización en la tabla objeto
        $sql = "UPDATE objeto SET nombre = ?, descripcion = ?, imagen = ?, puntuacion = ?, valoracion = ?, idCategoria = ? WHERE idObjeto = ?";
        $stmt = $this->conexion->prepare($sql);

        // Ajustar los tipos de datos en bind_param, considerando el booleano como un entero
        $stmt->bind_param("sssiiii", $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria, $id);

        $stmt->execute();
        $stmt->close();
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
