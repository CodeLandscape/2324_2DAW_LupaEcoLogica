<?php
require_once '../php/modelos/modelo.php';

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

    public function addCategoria()
    {
        $this->vista = 'anadir_categoria';
    }

    public function selectCategoria()
    {
        $this->vista = 'selectCategoria';
    }

    public function anadir_pregunta()
    {
        $this->vista = 'anadir_pregunta';
    }

    public function anadir_objeto()
    {
        $this->vista = 'anadir_objeto';
    }

    public function categoria()
    {
        $this->vista = 'categoria';
    }

    public function modTablero()
    {
        $this->vista = 'modificar_tablero';
    }

    public function modificar_objeto()
    {
        $this->vista = 'modificar_objeto';
    }

    public function modificar_pregunta()
    {
        $this->vista = 'modificar_pregunta';
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
        $Modelo = new Modelo();
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
        $Modelo = new Modelo();
        $fila = $Modelo->verCategoria($id);
        return $fila['nombre'];
    }

    function borrarCategoria()
    {
        $Modelo = new Modelo();
        $Modelo->borrarCategoria($_POST["id"]);
        $this->vista = 'admin';
    }

    function borrarPregunta()
    {
        $Modelo = new Modelo();
        $Modelo->borrarPregunta($_POST["id"]);
        // $this->vista = 'categoria';
    }

    function borrarObjeto()
    {
        $Modelo = new Modelo();
        $Modelo->borrarObjeto($_POST["id"]);
        header('location:index.php?id=' . $_POST["idCategoria"] .'&accion=categoria&controlador=Controlador');
    }

    /**
     * Método que devuelve el nombre del tablero de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return string El nombre del tablero de la categoría.
     */
    function nombreTablero($idCategoria)
    {
        $Modelo = new Modelo();
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
        $Modelo = new Modelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['imagenFondo'];
    }

    function verTablero($idCategoria){
        $Modelo = new Modelo();
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
        $Modelo = new Modelo();
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
        $Modelo = new Modelo();
        $tabla = $Modelo->verObjetos($idCategoria);
        return $tabla;
    }

    function verObjeto($idObjeto)
    {
        $Modelo = new Modelo();
        $fila = $Modelo->verObjeto($idObjeto);
        return $fila;
    }

    /**
     * Método que agrega una pregunta.
     */
    public function agregarPregunta()
    {
        $Modelo = new Modelo();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Acceder a los valores del formulario
            $preguntas = isset($_POST['pregunta']) ? $_POST['pregunta'] : array();
            $respuestas = isset($_POST['opcion']) ? $_POST['opcion'] : array();
            $reflexionesAcierto = isset($_POST['ref1']) ? $_POST['ref1'] : array();
            $reflexionesFallo = isset($_POST['ref2']) ? $_POST['ref2'] : array();
            $idCategoria = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';
            // Agregar cada pregunta utilizando el modelo
            foreach ($preguntas as $index => $pregunta) {
                // Obtener la respuesta correcta para la pregunta actual
                $respuesta = isset($respuestas[$index]) ? $respuestas[$index] : '';

                // Si la respuesta es un array, toma el primer elemento (puede ser '1' o '0')
                if (is_array($respuesta)) {
                    $respuesta = isset($respuesta[0]) ? $respuesta[0] : '';
                }

                $refAcierto = isset($reflexionesAcierto[$index][0]) ? $reflexionesAcierto[$index][0] : '';
                $refFallo = isset($reflexionesFallo[$index][0]) ? $reflexionesFallo[$index][0] : '';

                $Modelo->agregarPregunta($pregunta, $refAcierto, $refFallo, $respuesta, $idCategoria);
            }
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador');
        }
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
        $Modelo = new Modelo();
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
        $Modelo = new Modelo();
        $fila = $Modelo->randomTablero();
        return $fila;
    }

    function insertarCategoria()
    {
        $Modelo = new Modelo();
        $fondo = $_FILES['img']['tmp_name'];
        $tipo = $_FILES['img']['type'];
        if ($tipo == 'image/png' || $tipo == 'image/jpg' || $tipo == 'image/jpeg') {
            $contenido = file_get_contents($fondo);
            $base64 = base64_encode($contenido);
        }
        $Modelo->insertarCategoria($_POST["categoria"], $_POST["tablero"], $base64);
        $this->vista = 'admin';
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

    public function agregarObjeto()
    {
        $Modelo = new Modelo();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Acceder a los valores del formulario
            $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : array();
            $descripciones = isset($_POST['descripcion']) ? $_POST['descripcion'] : array();
            $imgs = isset($_FILES['img']) ? $_FILES['img'] : array();
            $puntuaciones = isset($_POST['punt']) ? $_POST['punt'] : array();
            $buenos = isset($_POST['bueno']) ? $_POST['bueno'] : array();
            $idCategoria = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';

            // Agregar cada objeto utilizando el modelo
            foreach ($nombres as $index => $nombre) {
                // Verificar si se ha subido una imagen y es del tipo correcto
                if (!empty($imgs['tmp_name'][$index]) && in_array($imgs['type'][$index], array('image/png', 'image/jpg', 'image/jpeg'))) {
                    $imagenTmp = $imgs['tmp_name'][$index];

                    // Leer el contenido de la imagen
                    $contenido = file_get_contents($imagenTmp);
                    $base64 = base64_encode($contenido);

                    $descripcion = isset($descripciones[$index]) ? $descripciones[$index] : '';
                    $puntuacion = isset($puntuaciones[$index]) ? $puntuaciones[$index] : '';

                    // Verificar si el checkbox está marcado
                    $bueno = isset($buenos[$index]) ? 1 : 0;

                    $Modelo->agregarObjeto($nombre, $descripcion, $base64, $puntuacion, $bueno, $idCategoria);
                }
            }

            // Redireccionar después de procesar los objetos
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador');
        }
    }

    public function actualizarObjeto()
    {
        $Modelo = new Modelo();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Acceder a los valores del formulario
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
            $puntuacion = isset($_POST['punt']) ? $_POST['punt'] : '';
            $esBueno = isset($_POST['bueno']) ? 1 : 0;
            $idCategoria = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';
    
            // Inicializar las variables de la imagen
            $base64 = '';
    
            if (!empty($_FILES['img']['tmp_name'])) {
                $img = $_FILES['img'];
    
                // Verificar si se ha subido una imagen y es del tipo correcto
                if (in_array($img['type'], array('image/png', 'image/jpg', 'image/jpeg'))) {
                    $imagenTmp = $img['tmp_name'];
    
                    // Leer el contenido de la imagen
                    $contenido = file_get_contents($imagenTmp);
                    $base64 = base64_encode($contenido);
                }
            } else {
                // Si no se seleccionó un nuevo archivo, utilizar la imagen actual
                // Verifica que el valor tenga el prefijo 'base64:' para identificar que es una imagen base64
                if (isset($_POST['imgActual']) && strpos($_POST['imgActual'], 'base64:') === 0) {
                    $base64 = substr($_POST['imgActual'], 7); // Elimina el prefijo 'base64:'
                }
            }
    
            // Verificar si se seleccionó un nuevo archivo o si es necesario conservar la imagen actual
            if (!empty($base64)) {
                // Modificar el objeto utilizando el modelo
                $Modelo->actualizarObjeto($id, $nombre, $descripcion, $base64, $puntuacion, $esBueno, $idCategoria);
            }
    
            // Redireccionar después de procesar las modificaciones de los objetos
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador');
        }
    }
    
    
    

    public function actualizarPregunta()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] == 'actualizarPregunta') {
            $Modelo = new Modelo();
    
            // Recuperar los valores del formulario
            $idPregunta = $_POST['idPregunta'];
            $textoPregunta = $_POST['textoPregunta'];
            $reflexionAcierto = $_POST['reflexionAcierto'];
            $reflexionFallo = $_POST['reflexionFallo'];
            $respuesta = $_POST['respuesta'];
            $idCategoria = $_POST['idCategoria_seleccionada'];
    
            // Actualizar la pregunta en la base de datos
            $Modelo->modificarPregunta($idPregunta, $textoPregunta, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria);
        }
        // Redirigir a la vista de configuración
        // header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador');
    }
    public function actualizarTablero()
    {
        $Modelo = new Modelo();
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Acceder a los valores del formulario
            $id = isset($_POST['idTablero']) ? $_POST['idTablero'] : '';
            $nombre = isset($_POST['tablero']) ? $_POST['tablero'] : '';
            $idCategoria = isset($_POST['idCategoria']) ? $_POST['idCategoria'] : '';
            
            // Inicializar las variables de la imagen
            $base64 = '';
    
            if (!empty($_FILES['img']['tmp_name'])) {
                $img = $_FILES['img'];
    
                // Verificar si se ha subido una imagen y es del tipo correcto
                if (in_array($img['type'], array('image/png', 'image/jpg', 'image/jpeg'))) {
                    $imagenTmp = $img['tmp_name'];
    
                    // Leer el contenido de la imagen
                    $contenido = file_get_contents($imagenTmp);
                    $base64 = base64_encode($contenido);
                }
            } else {
                // Si no se seleccionó un nuevo archivo, utilizar la imagen actual
                // Verifica que el valor tenga el prefijo 'base64:' para identificar que es una imagen base64
                if (isset($_POST['imgActual']) && strpos($_POST['imgActual'], 'base64:') === 0) {
                    $base64 = substr($_POST['imgActual'], 7); // Elimina el prefijo 'base64:'
                }
            }
    
            // Verificar si se seleccionó un nuevo archivo o si es necesario conservar la imagen actual
            if (!empty($base64)) {
                // Modificar el objeto utilizando el modelo
                $Modelo->actualizarTablero($id, $nombre, $base64);
            }
    
            // Redireccionar después de procesar las modificaciones de los objetos
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador');
        }
    }

}

?>