<?php
require_once '../php/modelos/categoria.php';
/**
 * Clase que representa la gestión de categorías.
 */
class Categoria
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
     * Establece la vista para añadir una categoría.
     */
    public function addCategoria()
    {
        $this->vista = 'anadir_categoria';
    }

    /**
     * Establece la vista para modificar un tablero.
     */
    public function modTablero()
    {
        $this->vista = 'modificar_tablero';
    }

    /**
     * Establece la vista para seleccionar una categoría.
     */
    public function selectCategoria()
    {
        $this->vista = 'selectCategoria';
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
     * Obtiene el nombre de una categoría por su ID.
     *
     * @param int $id ID de la categoría.
     * @return string Nombre de la categoría.
     */
    public function nombreCategoria($id)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verCategoria($id);
        return $fila['nombre'];
    }

    /**
     * Obtiene el nombre de un tablero por el ID de la categoría.
     *
     * @param int $idCategoria ID de la categoría.
     * @return string Nombre del tablero.
     */
    public function nombreTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['nombre'];
    }

    /**
     * Obtiene el fondo de un tablero por el ID de la categoría.
     *
     * @param int $idCategoria ID de la categoría.
     * @return string Ruta del fondo del tablero.
     */
    public function fondoTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['imagenFondo'];
    }

    /**
     * Obtiene la información de un tablero por el ID de la categoría.
     *
     * @param int $idCategoria ID de la categoría.
     * @return array Información del tablero.
     */
    public function verTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila;
    }

    /**
     * Obtiene información de un tablero aleatorio.
     *
     * @return array Información del tablero aleatorio.
     */
    public function randomTablero()
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->randomTablero();
        return $fila;
    }

    /**
     * Inserta una nueva categoría en la base de datos.
     */
    public function insertarCategoria()
    {
        $Modelo = new CategoriaModelo();
    
        /**
         * Sanitiza las entradas.
         *
         * @var string $categoria Nombre de la categoría.
         * @var string $tablero   Nombre del tablero.
         */
        $categoria = $this->sanitizarEntrada($_POST["categoria"]);
        $tablero = $this->sanitizarEntrada($_POST["tablero"]);
    
        if (empty($categoria) || empty($tablero)) {
            // Mensaje de error si la entrada se vuelve vacía después de la sanitización
            $msg = "Error: La entrada no puede estar vacía o contener solo caracteres especiales.";
            header("location:index.php?msg=" . urlencode($msg));
            exit;
        }
    
        /**
         * Ruta temporal del archivo de la imagen.
         * @var string $fondo
         */
        $fondo = $_FILES['img']['tmp_name'];
        $tipo = $_FILES['img']['type'];
    
        // Validar tipo de extensión de imagen
        $extensionesValidas = array('image/png', 'image/jpg', 'image/jpeg');
        if (!in_array($tipo, $extensionesValidas)) {
            // Mensaje de error si la extensión no es válida
            $msg = "Error: Solo se permiten imágenes en formato PNG, JPG o JPEG.";
            header("location:index.php?msg=" . urlencode($msg));
            exit;
        }
    
        $contenido = file_get_contents($fondo);
        $base64 = base64_encode($contenido);
    
        $Modelo->insertarCategoria($categoria, $tablero, $base64);
    
        // Mensaje de éxito
        $msg = "Categoría añadida correctamente";
        header("location:index.php?msg=" . urlencode($msg));
        exit;
    }
    
    /**
     * Actualiza la información de un tablero en la base de datos.
     */
    public function actualizarTablero()
    {
        $Modelo = new CategoriaModelo();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitiza las entradas
            $id = $this->sanitizarEntrada($_POST['idTablero']);
            $nombre = $this->sanitizarEntrada($_POST['tablero']);
            $idCategoria = $this->sanitizarEntrada($_POST['idCategoria']);

            if (empty($id) || empty($nombre) || empty($idCategoria)) {
                // Mensaje de error si la entrada se vuelve vacía después de la sanitización
                $msg = "Error: La entrada no puede estar vacía o contener solo caracteres especiales.";
                header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador&msg=' . urlencode($msg));
                exit;
            }

            // Obtiene la imagen del formulario
            $base64 = '';
            if (!empty($_FILES['img']['tmp_name'])) {
                $img = $_FILES['img'];
                if (in_array($img['type'], array('image/png', 'image/jpg', 'image/jpeg'))) {
                    $imagenTmp = $img['tmp_name'];
                    $contenido = file_get_contents($imagenTmp);
                    $base64 = base64_encode($contenido);
                }
            } else {
                // Si no se seleccionó un nuevo archivo, utiliza la imagen actual
                if (isset($_POST['imgActual']) && strpos($_POST['imgActual'], 'base64:') === 0) {
                    $base64 = substr($_POST['imgActual'], 7);
                }
            }

            if (!empty($base64)) {
                // Actualiza el tablero con la nueva información
                $Modelo->actualizarTablero($id, $nombre, $base64);
            }

            // Mensaje de éxito
            $msg = "Tablero actualizado correctamente";
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador&msg=' . urlencode($msg));
            exit;
        }
    }

    /**
     * Elimina una categoría de la base de datos.
     */
    public function borrarCategoria()
    {
        $Modelo = new CategoriaModelo();
        $Modelo->borrarCategoria($_POST["id"]);
        $msg = "Categoría borrada correctamente";
        header('location:index.php?msg=' . urlencode($msg));
        exit;
    }

    /**
     * Sanitiza una entrada eliminando etiquetas HTML, emojis y otros caracteres especiales.
     *
     * @param string $input Entrada a sanitizar.
     * @return string Entrada sanitizada.
     */
    private function sanitizarEntrada($input)
    {
        // Eliminar etiquetas HTML, emojis y otros caracteres especiales
        $sanitizedInput = preg_replace('/[^\p{L}\p{N}\s\p{P}]/u', '', strip_tags($input));
        return $sanitizedInput;
    }
}
?>
