<?php
/**
 * Clase de conexión a la base de datos.
 */
class Conexion
{
    /**
     * @var mysqli|null Instancia de la conexión a la base de datos.
     */
    protected $conexion = null;

    /**
     * Constructor de la clase, establece la conexión a la base de datos.
     */
    public function __construct()
    {
        require_once '../php/config/configBD.php';

        // Establecer la conexión a la base de datos
        $this->conexion = new mysqli(HOST, USER, PSW, BDD);
        $this->conexion->set_charset("utf8");

        // Configurar el controlador mysqli para informar errores de manera más estricta
        $mysqli_controlador = new mysqli_driver();
        $mysqli_controlador->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
    }
}
?>