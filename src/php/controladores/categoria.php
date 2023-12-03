<?php
require_once '../php/modelos/categoria.php';

class Categoria
{
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
        $categoria = $this->sanitizarEntrada($_POST["categoria"]);
        $tablero = $this->sanitizarEntrada($_POST["tablero"]);

        if (empty($categoria) || empty($tablero)) {
            // Mensaje de error si la entrada se vuelve vacía después de la sanitización
            $msg = "Error: La entrada no puede estar vacía o contener solo caracteres especiales.";
            header("location:index.php?msg=" . urlencode($msg));
            exit;
        }

        $fondo = $_FILES['img']['tmp_name'];
        $tipo = $_FILES['img']['type'];

        if ($tipo == 'image/png' || $tipo == 'image/jpg' || $tipo == 'image/jpeg') {
            $contenido = file_get_contents($fondo);
            $base64 = base64_encode($contenido);
        }

        $Modelo->insertarCategoria($categoria, $tablero, $base64);

        // Mensaje de éxito
        $msg = "Categoría añadida correctamente";
        header("location:index.php?msg=" . urlencode($msg));
        exit;
    }

    public function actualizarTablero()
    {
        $Modelo = new CategoriaModelo();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $this->sanitizarEntrada($_POST['idTablero']);
            $nombre = $this->sanitizarEntrada($_POST['tablero']);
            $idCategoria = $this->sanitizarEntrada($_POST['idCategoria']);

            if (empty($id) || empty($nombre) || empty($idCategoria)) {
                // Mensaje de error si la entrada se vuelve vacía después de la sanitización
                $msg = "Error: La entrada no puede estar vacía o contener solo caracteres especiales.";
                header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador&msg=' . urlencode($msg));
                exit;
            }

            $base64 = '';

            if (!empty($_FILES['img']['tmp_name'])) {
                $img = $_FILES['img'];

                if (in_array($img['type'], array('image/png', 'image/jpg', 'image/jpeg'))) {
                    $imagenTmp = $img['tmp_name'];
                    $contenido = file_get_contents($imagenTmp);
                    $base64 = base64_encode($contenido);
                }
            } else {
                if (isset($_POST['imgActual']) && strpos($_POST['imgActual'], 'base64:') === 0) {
                    $base64 = substr($_POST['imgActual'], 7);
                }
            }

            if (!empty($base64)) {
                $Modelo->actualizarTablero($id, $nombre, $base64);
            }

            // Mensaje de éxito
            $msg = "Tablero actualizado correctamente";
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador&msg=' . urlencode($msg));
            exit;
        }
    }

    public function borrarCategoria()
    {
        $Modelo = new CategoriaModelo();
        $Modelo->borrarCategoria($_POST["id"]);
        $msg = "Categoría borrada correctamente";

        header('location:index.php?msg=' . urlencode($msg));
        exit;
    }

    private function sanitizarEntrada($input)
    {
        // Eliminar etiquetas HTML, emojis y otros caracteres especiales
        $sanitizedInput = preg_replace('/[^\p{L}\p{N}\s\p{P}]/u', '', strip_tags($input));
        return $sanitizedInput;
    }
}
?>
