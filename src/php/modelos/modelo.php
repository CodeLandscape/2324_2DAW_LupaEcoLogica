<?php
require_once 'conexion.php';
/**
 * Clase Modelo para la interacción con la base de datos.
 */
class Modelo extends Conexion
{
    /**
     * Obtiene las filas para la tabla de clasificación.
     *
     * @return array Un array bidimensional con las filas de la tabla de clasificación.
     */
    function rankingTabla()
    {
        $sql = "SELECT nombre, localidad, puntuacion FROM partida ORDER BY puntuacion DESC LIMIT 10;";
        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->get_result();
        $tabla = array();

        while ($fila = $resultado->fetch_assoc()) {
            array_push($tabla, $fila);
        }
        $stmt->close();
        $this->conexion->close();
        return $tabla;
    }

    /**
     * Obtiene la configuración actual del juego.
     *
     * @return array Un array asociativo con la configuración del juego.
     */
    function configuracion()
    {
        $sql = "SELECT * FROM config";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $configuracion = $resultado->fetch_assoc();
        $stmt->close();
        $this->conexion->close();
        return $configuracion;
    }

    /**
     * Actualiza la configuración del juego.
     *
     * @param int $tiempoCrono Tiempo del cronómetro.
     * @param int $nPregunta Número de preguntas.
     * @param int $nObjetosBuenos Número de objetos buenos.
     */
    function actualizarConfiguracion($tiempoCrono, $nPregunta, $nObjetosBuenos)
    {
        // Realizar la actualización en la tabla config
        $sql = "UPDATE config SET tiempoCrono = ?, nPregunta = ?, nObjetosBuenos = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iii", $tiempoCrono, $nPregunta, $nObjetosBuenos);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }
}

require_once 'conexion.php';
/**
 * Clase Modelo para la interacción con la base de datos.
 */
class Modelo extends Conexion
{
    /**
     * Obtiene las filas para la tabla de clasificación.
     *
     * @return array Un array bidimensional con las filas de la tabla de clasificación.
     */
    function rankingTabla()
    {
        $sql = "SELECT nombre, localidad, puntuacion FROM partida ORDER BY puntuacion DESC LIMIT 10;";
        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->get_result();
        $tabla = array();

        while ($fila = $resultado->fetch_assoc()) {
            array_push($tabla, $fila);
        }
        $stmt->close();
        $this->conexion->close();
        return $tabla;
    }

    /**
     * Obtiene la configuración actual del juego.
     *
     * @return array Un array asociativo con la configuración del juego.
     */
    function configuracion()
    {
        $sql = "SELECT * FROM config";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $configuracion = $resultado->fetch_assoc();
        $stmt->close();
        $this->conexion->close();
        return $configuracion;
    }

    /**
     * Actualiza la configuración del juego.
     *
     * @param int $tiempoCrono Tiempo del cronómetro.
     * @param int $nPregunta Número de preguntas.
     * @param int $nObjetosBuenos Número de objetos buenos.
     */
    function actualizarConfiguracion($tiempoCrono, $nPregunta, $nObjetosBuenos)
    {
        // Realizar la actualización en la tabla config
        $sql = "UPDATE config SET tiempoCrono = ?, nPregunta = ?, nObjetosBuenos = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("iii", $tiempoCrono, $nPregunta, $nObjetosBuenos);
        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
    }
}
