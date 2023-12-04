<?php
require_once '../php/modelos/modelo.php';
require_once '../php/modelos/categoria.php';
require_once '../php/modelos/pregunta.php';
require_once '../php/modelos/objeto.php';
require_once '../php/modelos/modelo.php';
require_once '../php/modelos/categoria.php';
require_once '../php/modelos/pregunta.php';
require_once '../php/modelos/objeto.php';
/**
 * Controlador para interactuar con la lógica de negocio y la presentación.
 */
class Controlador
{
    /**
     * @var string|null $vista Nombre de la vista actual.
     */
    public $vista;

    /**
     * Constructor de la clase.
     */
    public function __construct()
    {
        $this->vista = null;
    }

    /**
     * Establece la vista para la página de inicio del administrador.
     */
    public function inicio()
    {
        $this->vista = 'admin';
    }

    /**
     * Establece la vista para seleccionar una categoría.
     */
    public function selectCategoria()
    {
        $this->vista = 'selectCategoria';
    }

    /**
     * Establece la vista para modificar la configuración.
     */
    public function modConfig()
    {
        $this->vista = 'modConfig';
    }

    /**
     * Establece la vista de categoría.
     */
    public function categoria()
    {
        $this->vista = 'categoria';
    }

    /**
     * Establece la vista para eliminar una categoría.
     */
    public function remove()
    {
        $this->vista = 'remove';
    }

    /**
     * Método que devuelve la tabla de categorías.
     *
     * @return array Un array bidimensional con las filas de la tabla categoría.
     */
    public function tablaCategoria()
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
    public function nombreCategoria($id)
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
    public function nombreTablero($idCategoria)
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
    public function fondoTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['imagenFondo'];
    }

    /**
     * Método que devuelve la información de un tablero por el ID de la categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return array Información del tablero.
     */
    public function verTablero($idCategoria)
    {
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
    public function tablaPregunta($idCategoria)
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
    public function tablaObjeto($idCategoria)
    {
        $Modelo = new ObjetoModelo();
        $tabla = $Modelo->verObjetos($idCategoria);
        return $tabla;
    }

    /**
     * Método que devuelve la información de un objeto por su ID.
     *
     * @param int $idObjeto El ID del objeto.
     * @return array Información del objeto.
     */
    public function verObjeto($idObjeto)
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
    public function rankingTabla()
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
    public function configuracion()
    {
        $Modelo = new Modelo();
        $fila = $Modelo->configuracion();
        return $fila;
    }

    /**
     * Método que devuelve la información de una pregunta por su ID.
     *
     * @param int $id El ID de la pregunta.
     * @return array Información de la pregunta.
     */
    public function pregunta($id)
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
    public function randomTablero()
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->randomTablero();
        return $fila;
    }
    
    /**
     * Actualiza la configuración del juego en la base de datos.
     */
    public function actualizarConfiguracion()
    {
        $mensaje = ''; // Variable para almacenar el mensaje
    
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'actualizarConfiguracion') {
 * Controlador para interactuar con la lógica de negocio y la presentación.
 */
class Controlador
{
    /**
     * @var string|null $vista Nombre de la vista actual.
     */
    public $vista;

    /**
     * Constructor de la clase.
     */
    public function __construct()
    {
        $this->vista = null;
    }

    /**
     * Establece la vista para la página de inicio del administrador.
     */
    public function inicio()
    {
        $this->vista = 'admin';
    }

    /**
     * Establece la vista para seleccionar una categoría.
     */
    public function selectCategoria()
    {
        $this->vista = 'selectCategoria';
    }

    /**
     * Establece la vista para modificar la configuración.
     */
    public function modConfig()
    {
        $this->vista = 'modConfig';
    }

    /**
     * Establece la vista de categoría.
     */
    public function categoria()
    {
        $this->vista = 'categoria';
    }

    /**
     * Establece la vista para eliminar una categoría.
     */
    public function remove()
    {
        $this->vista = 'remove';
    }

    /**
     * Método que devuelve la tabla de categorías.
     *
     * @return array Un array bidimensional con las filas de la tabla categoría.
     */
    public function tablaCategoria()
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
    public function nombreCategoria($id)
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
    public function nombreTablero($idCategoria)
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
    public function fondoTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['imagenFondo'];
    }

    /**
     * Método que devuelve la información de un tablero por el ID de la categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return array Información del tablero.
     */
    public function verTablero($idCategoria)
    {
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
    public function tablaPregunta($idCategoria)
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
    public function tablaObjeto($idCategoria)
    {
        $Modelo = new ObjetoModelo();
        $tabla = $Modelo->verObjetos($idCategoria);
        return $tabla;
    }

    /**
     * Método que devuelve la información de un objeto por su ID.
     *
     * @param int $idObjeto El ID del objeto.
     * @return array Información del objeto.
     */
    public function verObjeto($idObjeto)
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
    public function rankingTabla()
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
    public function configuracion()
    {
        $Modelo = new Modelo();
        $fila = $Modelo->configuracion();
        return $fila;
    }

    /**
     * Método que devuelve la información de una pregunta por su ID.
     *
     * @param int $id El ID de la pregunta.
     * @return array Información de la pregunta.
     */
    public function pregunta($id)
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
    public function randomTablero()
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->randomTablero();
        return $fila;
    }
    
    /**
     * Actualiza la configuración del juego en la base de datos.
     */
    public function actualizarConfiguracion()
    {
        $mensaje = ''; // Variable para almacenar el mensaje
    
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'actualizarConfiguracion') {
            $Modelo = new Modelo();
    
            // Recuperar los valores del formulario y sanitizar cada entrada permitiendo solo números
            $parametro1 = isset($_POST['parametro1']) ? $this->sanitizarEntrada($_POST['parametro1'], true) : '';
            $parametro2 = isset($_POST['parametro2']) ? $this->sanitizarEntrada($_POST['parametro2'], true) : '';
            $parametro3 = isset($_POST['parametro3']) ? $this->sanitizarEntrada($_POST['parametro3'], true) : '';
            // Agregar más variables según los parámetros que existan en la tabla config
    
            // Verificar si los campos son numéricos después de la sanitización
            if (!is_numeric($parametro1) || !is_numeric($parametro2) || !is_numeric($parametro3)) {
                $mensaje = 'Error: Los campos deben contener solo números.';
            } else {
                // Los datos son válidos, proceder a actualizar la configuración en la base de datos
                $Modelo->actualizarConfiguracion($parametro1, $parametro2, $parametro3);
                $mensaje = 'Configuración actualizada correctamente.';
            }
        }
        
        // Redirigir a la vista de configuración con el mensaje
        header('location:index.php?accion=modConfig&controlador=controlador&msg=' . $mensaje);
        // exit;
    }

    /**
     * Función AJAX que devuelve las preguntas de una categoría.
     */
    public function ajaxPregunta()
    {
        try {
            $id = $_POST['id'];
            $datos = $this->tablaPregunta($id);
            header('Content-Type: application/json');
            echo json_encode($datos);
        } catch (Exception $e) {
            // Manejar errores y devolver un mensaje JSON
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Función AJAX que devuelve los objetos de una categoría.
     */
    public function ajaxObjeto()
    {
        try {
            $id = $_POST['id'];
            $datos = $this->tablaObjeto($id);
            header('Content-Type: application/json');
            echo json_encode($datos);
        } catch (Exception $e) {
            // Manejar errores y devolver un mensaje JSON
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Función AJAX que devuelve la imagen de fondo de un tablero de una categoría.
     */
    public function ajaxFondo()
    {
        try {
            $id = $_POST['id'];
            $datos = $this->fondoTablero($id);
            // Verifica si $datos es una cadena (BLOB)
            if (is_string($datos)) {
                $imagen = base64_decode($datos);
                header('Content-Type: application/json');
                echo json_encode(['imagen' => base64_encode($imagen)]);
            } else {
                // Manejar el caso en que $datos no es una cadena
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Los datos no son válidos']);
            }
        } catch (Exception $e) {
            // Manejar errores y devolver un mensaje JSON
            header('Content-Type: application/json');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * Función AJAX que devuelve la configuración del juego.
     */
    public function ajaxConfig()
    {
        // Obtener datos desde la base de datos utilizando el controlador
        $datos = $this->configuracion();  // Ajusta el nombre del método según tu lógica

        // Devolver los datos como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    /**
     * Función AJAX que devuelve un tablero seleccionado aleatoriamente.
     */
    public function ajaxCateg()
    {
        $datos = $this->randomTablero();  // Ajusta el nombre del método según tu lógica

        // Devolver los datos como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    /**
     * Función AJAX que devuelve las 10 filas con mayor puntuación de la tabla de partidas.
     */
    public function ajaxRanking()
    {
        // Obtener datos desde la base de datos utilizando el controlador
        $datos = $this->rankingTabla();  // Ajusta el nombre del método según tu lógica

        // Devolver los datos como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($datos);
    }

    /**
     * Sanitiza una entrada eliminando etiquetas HTML, emojis y otros caracteres especiales.
     *
     * @param string $input Entrada a sanitizar.
     * @param bool $permitirSoloNumeros Indica si se deben permitir solo números en la entrada.
     * @return string Entrada sanitizada.
     */
    private function sanitizarEntrada($input, $permitirSoloNumeros = false)
    {
        // Si se permite solo números, eliminar todo excepto los dígitos
        if ($permitirSoloNumeros) {
            $sanitizedInput = preg_replace('/[^\p{N}]/u', '', $input);
        } else {
            // Eliminar etiquetas HTML, emojis y otros caracteres especiales excepto los permitidos sin adyacencia a otros caracteres
            $sanitizedInput = preg_replace('/(<[^>]+[\'"]>|\w(?=\w))|[^ \w"<>]+/', '', strip_tags($input));
        }
        return $sanitizedInput;
    }
}