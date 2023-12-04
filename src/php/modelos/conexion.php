<?php
class Conexion {
    protected $conexion = null;

    public function __construct() {
        require_once '../php/config/configBD.php';

        $this->conexion = new mysqli(HOST, USER, PSW, BDD);
        $this->conexion->set_charset("utf8");

        $mysqli_controlador = new mysqli_driver();
        $mysqli_controlador->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
    }
}
?>