<?php
    ini_set('display_errors', 1);

    require_once 'config/configBD.php';
    require_once 'modelos/modelo.php';
    require_once 'config/configVal.php';
    
    /** 
     * Los ifs verifican si los parámetros controlador y accion están presentes en la URL. Si no están presentes, se asignan los
     * valores por defecto definidos en las constantes CONTROLADOR_POR_DEFECTO y ACCION_POR_DEFECTO.
    */
    if (!isset($_GET["controlador"])) $_GET["controlador"] = constant("CONTROLADOR_POR_DEFECTO");
    if (!isset($_GET["accion"])) $_GET["accion"] = constant("ACCION_POR_DEFECTO");

    /**  
     * Construye la ruta al archivo del controlador en función del parámetro controlador.
     * Si el archivo del controlador no existe en la ruta especificada, utiliza el controlador por defecto.
    */
    $rutaControlador = '../php/controladores/' . $_GET["controlador"] . '.php';

    /* Verifica si existe el controlador */
    if (!file_exists($rutaControlador)) $rutaControlador = '../php/controladores/' . constant("CONTROLADOR_POR_DEFECTO") . '.php';
    
    /**
     * Incluye el archivo del controlador.
     * Crea una instancia del controlador correspondiente.
    */

    require_once $rutaControlador;
    $nombreControlador = $_GET["controlador"];
    $controlador = new $nombreControlador();

    /**
     * Verifica si el método (acción) especificado en la URL está definido en el controlador.
     * Si está definido, ejecuta la acción y almacena los resultados en $datosAVista.
    */
    $datosAVista["data"] = array();
    if (method_exists($controlador, $_GET["accion"])) $datosAVista["data"] = $controlador->{$_GET["accion"]}();

    /**
     * Carga las vistas.
     * Incluye archivos de plantillas para la cabecera y el pie de la página.
     * Incluye la vista específica del controlador.
    */
    require_once 'vistas/template/cabecera.html';
    require_once 'vistas/' . $controlador->vista . '.php';
    require_once 'vistas/template/pie.html';
?>
