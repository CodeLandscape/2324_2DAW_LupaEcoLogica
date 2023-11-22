<?php
    require_once 'config/configBD.php';
    require_once 'model/db.php';

    if (!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
    if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

    $controller_path = 'controlador/' . $_GET["controller"] . '.php';

    /* Verifica si existe el controlador */
    if (!file_exists($controller_path)) $controller_path = 'controlador/' . constant("DEFAULT_CONTROLLER") . '.php';

    /* Carga el controlador */
    require_once $controller_path;
    $nombreControlador = $_GET["controller"] . 'Controller';
    $controlador = new $nombreControlador();

    /* Verifica si el método está definido */
    $datosAVista["data"] = array();
    if (method_exists($controlador, $_GET["action"])) $datosAVista["data"] = $controlador->{$_GET["action"]}();

    /* Carga las vistas */
    require_once 'vista/template/cabezera.php';
    require_once 'vista/' . $controlador->vista . '.php';
    require_once 'vista/template/pie.php';
?>
