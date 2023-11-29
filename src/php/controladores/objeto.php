<?php
require_once '../php/modelos/objeto.php';

class Objeto
{
    public function __construct()
    {
        $this->vista = null;
    }

    public function remove()
    {
        $this->vista = 'remove';
    }

    public function anadir_objeto()
    {
        $this->vista = 'anadir_objeto';
    }

    public function modificar_objeto()
    {
        $this->vista = 'modificar_objeto';
    }



    /**
     * Método que agrega un objeto.
     */
    public function agregarObjeto()
    {
        $Modelo = new ObjetoModelo();

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
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador&codigo=1');
        }
    }

    public function borrarObjeto()
    {
        $Modelo = new ObjetoModelo();
        $Modelo->borrarObjeto($_POST["id"]);
        header('location:index.php?id=' . $_POST["idCategoria"] .'&accion=categoria&controlador=Controlador');
    }

    
    function verObjeto($idObjeto)
    {
        $Modelo = new ObjetoModelo();
        $fila = $Modelo->verObjeto($idObjeto);
        return $fila;
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

    public function actualizarObjeto()
    {
        $Modelo = new ObjetoModelo();
    
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

}
