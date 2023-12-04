<?php
require_once 'conexion.php';
/**
 * Modelo para gestionar operaciones relacionadas con las categorías.
 */
class CategoriaModelo extends Conexion
{
    /**
     * Inserta una nueva categoría y su tablero asociado en la base de datos.
     *
     * @param string $nomC Nombre de la categoría.
     * @param string $nomT Nombre del tablero.
     * @param string $fondo Imagen de fondo del tablero.
     * @return int Código que indica el resultado de la operación.
     *   - 0: Éxito.
     *   - 2: Error de clave duplicada.
     *   - 3: Otro error.
     *   - 4: Excepción desconocida.
     */
    public function insertarCategoria($nomC, $nomT, $fondo)
    {
        try {
            // Intenta la consulta de creación de categoría.
            // Consulta preparada para la inserción de la categoría
            $sqlCategoria = "INSERT INTO categoria(nombre) VALUES(?)";
            $stmtCategoria = $this->conexion->prepare($sqlCategoria);
            $stmtCategoria->bind_param("s", $nomC);
            $stmtCategoria->execute();

            // Obtiene el ID de la categoría insertada
            $idCategoria = $stmtCategoria->insert_id;

            // Cierra la consulta preparada de la categoría
            $stmtCategoria->close();

            // Consulta preparada para la inserción del tablero
            $sqlTablero = "INSERT INTO tablero(nombre, imagenFondo, idCategoria) VALUES(?, ?, ?)";
            $stmtTablero = $this->conexion->prepare($sqlTablero);
            $stmtTablero->bind_param("ssi", $nomT, $fondo, $idCategoria);
            $stmtTablero->execute();

            // Cierra la consulta preparada del tablero
            $stmtTablero->close();
            $this->conexion->close();
        } catch (mysqli_sql_exception $e) {
            $errorCode = $e->getCode();

            // En caso de error, elimina la categoría si se creó
            if (isset($idCategoria)) {
                $sqlCategoria = "DELETE FROM categoria WHERE idCategoria = ?";
                $stmtDeleteCategoria = $this->conexion->prepare($sqlCategoria);
                $stmtDeleteCategoria->bind_param("i", $idCategoria);
                $stmtDeleteCategoria->execute();
                $stmtDeleteCategoria->close();
                $this->conexion->close();
            }

            if ($errorCode == 1062) {
                // Error de clave secundaria duplicada
                return isset($idCategoria) ? 3 : 2;
            } else {
                return 4;
            }
        }

        return 0;
    }

    /**
     * Obtiene todas las filas de la tabla categoría.
     *
     * @return array Un array bidimensional con las filas de la tabla categoría.
     */
    public function tablaCategoria()
    {
        // Preparar la consulta
        $sql = "SELECT * FROM categoria";
        $stmt = $this->conexion->prepare($sql);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $resultado = $stmt->get_result();

        $tabla = array();

        // Obtener los datos de la consulta preparada
        while ($fila = $resultado->fetch_assoc()) {
            array_push($tabla, $fila);
        }

        // Cerrar la conexión y devuelve los resultados
        $stmt->close();
        $this->conexion->close();

        return $tabla;
    }

    /**
     * Obtiene los detalles de una categoría por su ID.
     *
     * @param int $id ID de la categoría.
     * @return array Un array de una fila de la tabla categoría.
     */
    public function verCategoria($id)
    {
        //preparacion de la consulta
        $sqlCategoria = "SELECT * FROM categoria WHERE idCategoria = ?";

        $stmt = $this->conexion->prepare($sqlCategoria);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $resultado = $stmt->get_result();

        $fila = $resultado->fetch_assoc();

        $stmt->close();
        $this->conexion->close();

        return $fila;
    }

    /**
     * Obtiene los detalles del tablero de una categoría por su ID.
     *
     * @param int $id ID de la categoría.
     * @return array Un array de una fila de la tabla Tablero.
     */
    public function verTablero($id)
    {
        $sqlTablero = "SELECT * FROM tablero WHERE idCategoria = ?";
        $stmt = $this->conexion->prepare($sqlTablero);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $fila = $resultado->fetch_assoc();
        $stmt->close();
        $this->conexion->close();

        return $fila;
    }

    /**
     * Borra una categoría y los objetos asociados.
     *
     * @param int $id ID de la categoría.
     */
    public function borrarCategoria($id)
    {
        // Eliminar objetos asociados a la categoría
        $sqlEliminarObjetos = "DELETE FROM objeto WHERE idCategoria = ?";
        $stmtEliminarObjetos = $this->conexion->prepare($sqlEliminarObjetos);
        $stmtEliminarObjetos->bind_param("i", $id);
        $stmtEliminarObjetos->execute();
        $stmtEliminarObjetos->close();

        // Eliminar la categoría
        $sqlCategoria = "DELETE FROM categoria WHERE idCategoria = ?";
        $stmt = $this->conexion->prepare($sqlCategoria);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        $this->conexion->close();
    }

    /**
     * Selecciona un tablero al azar.
     *
     * @return array Un array con la fila de la tabla Tablero seleccionada aleatoriamente.
     */
    public function randomTablero()
    {
        $sql = "SELECT * FROM tablero ORDER BY RAND() LIMIT 1;";
        $Resultado = $this->conexion->query($sql);
        $fila = $Resultado->fetch_assoc();
        $this->conexion->close();
        return $fila;
    }

    /**
     * Actualiza los datos de un tablero en la base de datos.
     *
     * @param int $id ID del tablero.
     * @param string $nombre Nuevo nombre del tablero.
     * @param string $imagen Nueva imagen de fondo del tablero.
     */
    public function actualizarTablero($id, $nombre, $imagen)
    {
        // Realizar la actualización en la tabla tablero
        $sql = "UPDATE tablero SET nombre = ?, imagenFondo = ? WHERE idTablero = ? ";
        $stmt = $this->conexion->prepare($sql);

        // Ajustar los tipos de datos en bind_param, considerando el booleano como un entero
        $stmt->bind_param("ssi", $nombre, $imagen, $id);

        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }
}