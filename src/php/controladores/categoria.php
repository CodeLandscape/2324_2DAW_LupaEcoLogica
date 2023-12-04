<?php
require_once '../php/modelos/categoria.php';

    class Categoria{

    public function __construct()
    {
        $this->vista = null;
    }


    public function addCategoria()
    {
        $this->vista = 'anadir_categoria';
    }

    public function modTablero()
    {
        $this->vista = 'modificar_tablero';
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


    public function nombreCategoria($id)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verCategoria($id);
        return $fila['nombre'];
    }

    public function nombreTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['nombre'];
    }

    public function fondoTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['imagenFondo'];
    }

    public function verTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila;
    }

    public function randomTablero()
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->randomTablero();
        return $fila;
    }

    public function insertarCategoria()
    {
        $Modelo = new CategoriaModelo();
        $fondo = $_FILES['img']['tmp_name'];
        $tipo = $_FILES['img']['type'];
        if ($tipo == 'image/png' || $tipo == 'image/jpg' || $tipo == 'image/jpeg') {
            $contenido = file_get_contents($fondo);
            $base64 = base64_encode($contenido);
        }
        $Modelo->insertarCategoria($_POST["categoria"], $_POST["tablero"], $base64);
        header("location:index.php");
        exit; 
    }
    public function actualizarTablero()
    {
        $Modelo = new CategoriaModelo();
    
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
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador');
            exit; 
        }
    }
    public function borrarCategoria()
    {
        $Modelo = new CategoriaModelo();
        $Modelo->borrarCategoria($_POST["id"]);
        header('location:index.php');
        exit; 
    }
    
    private function sanitizarEntrada($input)
{
    // Eliminar etiquetas HTML, emojis y otros caracteres especiales
    $sanitizedInput = preg_replace('/[^\p{L}\p{N}\s\p{P}]/u', '', strip_tags($input));
    return $sanitizedInput;
}
}