<?php
require_once '../php/modelos/objeto.php';

class Objeto
{

    public function __construct(){
        $this->vista = null;
    }
    // ... (otros métodos del constructor y de vista)

    public function anadir_objeto()
    {
        $this->vista = 'anadir_objeto';
    }

    public function modificar_objeto()
    {
        $this->vista = 'modificar_objeto';
    }

    public function eliminar_objeto()
    {
        $this->vista = 'eliminar_objeto';
    }

    public function agregar_actualizar_objeto()
    {
        $Modelo = new ObjetoModelo();
        $mensaje = '';
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idCategoria = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';
    
            // Obtener objetos existentes desde el controlador
            $objetosExistentes = $this->tablaObjeto($idCategoria);
    
            // Acceder a los valores del formulario
            $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : array();
            $descripciones = isset($_POST['descripcion']) ? $_POST['descripcion'] : array();
            $imgs = isset($_FILES['img']) ? $_FILES['img'] : array();
            $puntuaciones = isset($_POST['punt']) ? $_POST['punt'] : array();
            $buenos = isset($_POST['bueno']) ? $_POST['bueno'] : array();
    
            // Iterar sobre cada objeto
            foreach ($nombres as $index => $nombre) {
                // Verificar si existe un objeto correspondiente en la misma posición del array
                if (isset($objetosExistentes[$index])) {
                    // Objeto existente, verificar cambios antes de actualizar
                    if ($nombre != $objetosExistentes[$index]['nombre'] ||
                        isset($descripciones[$index]) && $descripciones[$index] != $objetosExistentes[$index]['descripcion'] ||
                        isset($puntuaciones[$index]) && $puntuaciones[$index] != $objetosExistentes[$index]['puntuacion'] ||
                        isset($buenos[$index]) && ($buenos[$index] ? 1 : 0) != $objetosExistentes[$index]['bueno']) {
                        // Al menos un campo ha cambiado, realizar la actualización
                        $Modelo->actualizarObjeto(
                            $objetosExistentes[$index]['idObjeto'],
                            $nombre,
                            isset($descripciones[$index]) ? $descripciones[$index] : $objetosExistentes[$index]['descripcion'],
                            $objetosExistentes[$index]['imagen'],
                            isset($puntuaciones[$index]) ? $puntuaciones[$index] : $objetosExistentes[$index]['puntuacion'],
                            isset($buenos[$index]) ? ($buenos[$index] ? 1 : 0) : $objetosExistentes[$index]['bueno'],
                            $idCategoria
                        );
                    }
                } else {
                    // Objeto no existente, agregar
                    if (!empty($imgs['tmp_name'][$index]) && in_array($imgs['type'][$index], array('image/png', 'image/jpg', 'image/jpeg'))) {
                        $imagenTmp = $imgs['tmp_name'][$index];
    
                        // Leer el contenido de la imagen
                        $contenido = file_get_contents($imagenTmp);
                        $base64 = base64_encode($contenido);
    
                        $descripcion = isset($descripciones[$index]) ? $descripciones[$index] : '';
                        $puntuacion = isset($puntuaciones[$index]) ? $puntuaciones[$index] : '';
                        $bueno = isset($buenos[$index]) ? ($buenos[$index] ? 1 : 0) : 0;
    
                        $Modelo->agregarObjeto($nombre, $descripcion, $base64, $puntuacion, $bueno, $idCategoria);
                    }
                }
            }
    
            // Cerrar la conexión después de procesar todos los objetos
            $Modelo->cerrarConexion();
            $mensaje = 'Objetos agregados o actualizados correctamente';
        }
    
        // Redireccionar después de procesar los objetos
        header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador&msg=' . $mensaje);
        exit;
    }
    
    



    public function borrar_objeto()
    {
        $Modelo = new ObjetoModelo();
        $Modelo->borrarObjeto($_POST["id"]);
        header('location:index.php?id=' . $_POST["idCategoria"] . '&accion=categoria&controlador=controlador');
    }

    function ver_objeto($idObjeto)
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
}
