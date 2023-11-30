<?php
require_once '../php/modelos/modelo.php';
require_once '../php/modelos/categoria.php';
require_once '../php/modelos/pregunta.php';
require_once '../php/modelos/objeto.php';
/**
 * Controlador para interactuar con la lógica de negocio y la presentación.
 */
class Controlador
{
    public $vista;

    public function __construct()
    {
        $this->vista = null;
    }

    public function inicio()
    {
        $this->vista = 'admin';
    }

    public function selectCategoria()
    {
        $this->vista = 'selectCategoria';
    }

    public function categoria()
    {
        $this->vista = 'categoria';
    }

    public function remove()
    {
        $this->vista = 'remove';
    }

    /**
     * Método que devuelve la tabla de categorías.
     *
     * @return array Un array bidimensional con las filas de la tabla categoría.
     */
    function tablaCategoria()
    {
        $Modelo = new CategoriaModelo();
        $tabla = $Modelo->tablaCategoria();
        return $tabla;
    }

    /**
     * Método que devuelve el nombre de una categoría.
     *
     * @param int $id El ID de la categoría.
     * @return string El nombre de la categoría.
     */
    function nombreCategoria($id)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verCategoria($id);
        return $fila['nombre'];
    }

    /**
     * Método que devuelve el nombre del tablero de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return string El nombre del tablero de la categoría.
     */
    function nombreTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['nombre'];
    }

    /**
     * Método que devuelve la imagen de fondo del tablero de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return string La ruta de la imagen de fondo del tablero.
     */
    function fondoTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['imagenFondo'];
    }

    function verTablero($idCategoria){
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila;
    }
    /**
     * Método que devuelve las filas de las preguntas de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return array Un array bidimensional con las filas de la tabla pregunta.
     */
    function tablaPregunta($idCategoria)
    {
        $Modelo = new PreguntaModelo();
        $tabla = $Modelo->verPreguntas($idCategoria);
        return $tabla;
    }

    /**
     * Método que devuelve las filas de los objetos de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return array Un array bidimensional con las filas de la tabla objeto.
     */
    function tablaObjeto($idCategoria)
    {
        $Modelo = new ObjetoModelo();
        $tabla = $Modelo->verObjetos($idCategoria);
        return $tabla;
    }

    function verObjeto($idObjeto)
    {
        $Modelo = new ObjetoModelo();
        $fila = $Modelo->verObjeto($idObjeto);
        return $fila;
    }

    /**
     * Método que devuelve las 10 filas con mayor puntuación de la tabla de partidas.
     * 
     * @return array Un array bidimensional con las filas de las partidas.
     */
    function rankingTabla()
    {
        $Modelo = new Modelo();
        $tabla = $Modelo->rankingTabla();
        return $tabla;
    }

    /**
     * Método que devuelve la configuración del juego.
     * 
     * @return array Un array con la configuración.
     */
    function configuracion()
    {
        $Modelo = new Modelo();
        $fila = $Modelo->configuracion();
        return $fila;
    }

    function pregunta($id)
    {
        $Modelo = new PreguntaModelo();
        $fila = $Modelo->verPregunta($id);
        return $fila;
    }

    /**
     * Método que devuelve un tablero seleccionado aleatoriamente.
     * 
     * @return array Un array con la fila de la tabla Tablero seleccionada aleatoriamente.
     */
    function randomTablero()
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->randomTablero();
        return $fila;
    }
    function actualizarConfiguracion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'actualizarConfiguracion') {
            $Modelo = new Modelo();

            // Recuperar los valores del formulario
            $parametro1 = $_POST['parametro1'];
            $parametro2 = $_POST['parametro2'];
            $parametro3 = $_POST['parametro3'];
            // Agregar más variables según los parámetros que existan en la tabla config

            // Actualizar la configuración en la base de datos
            $Modelo->actualizarConfiguracion($parametro1, $parametro2, $parametro3);
        }
        // Redirigir a la vista de configuración
        $this->vista = 'modConfig';
    }
}