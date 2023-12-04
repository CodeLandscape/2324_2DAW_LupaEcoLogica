<?php
require_once '../php/modelos/objeto.php';

class Objeto
{

    public function __construct()
    {
        $this->vista = null;
    }
   

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

        // Acceder a los valores del formulario y sanitizar cada entrada
        $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : array();
        $descripciones = isset($_POST['descripcion']) ? $_POST['descripcion'] : array();
        $imgs = isset($_FILES['img']) ? $_FILES['img'] : array();
        $puntuaciones = isset($_POST['punt']) ? $_POST['punt'] : array();
        $buenos = isset($_POST['bueno']) ? $_POST['bueno'] : array();

        // Iterar sobre cada objeto y realizar la sanitización
        foreach ($nombres as $index => $nombre) {
            $nombreSanitizado = $this->sanitizarEntrada($nombre);
            $descripcionSanitizada = $this->sanitizarEntrada(isset($descripciones[$index]) ? $descripciones[$index] : '');
            $puntuacionSanitizada = $this->sanitizarEntrada(isset($puntuaciones[$index]) ? $puntuaciones[$index] : '');
            $buenoSanitizado = $this->sanitizarEntrada(isset($buenos[$index]) ? $buenos[$index] : '');

            // Verificar si los campos sanitizados están completos
            if (!empty($nombreSanitizado) && !empty($descripcionSanitizada) && !empty($puntuacionSanitizada) && !empty($buenoSanitizado)) {
                // Verificar si existe un objeto correspondiente en la misma posición del array
                if (isset($objetosExistentes[$index])) {
                    // Objeto existente, verificar cambios antes de actualizar
                    if (
                        $nombreSanitizado != $objetosExistentes[$index]['nombre'] ||
                        $descripcionSanitizada != $objetosExistentes[$index]['descripcion'] ||
                        $puntuacionSanitizada != $objetosExistentes[$index]['puntuacion'] ||
                        ($buenoSanitizado ? 1 : 0) != $objetosExistentes[$index]['bueno']
                    ) {
                        // Al menos un campo ha cambiado, realizar la actualización
                        $Modelo->actualizarObjeto(
                            $objetosExistentes[$index]['idObjeto'],
                            $nombreSanitizado,
                            $descripcionSanitizada,
                            $objetosExistentes[$index]['imagen'],
                            $puntuacionSanitizada,
                            ($buenoSanitizado ? 1 : 0),
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

                        $Modelo->agregarObjeto($nombreSanitizado, $descripcionSanitizada, $base64, $puntuacionSanitizada, ($buenoSanitizado ? 1 : 0), $idCategoria);
                    }
                }        
                $mensaje = 'Objetos agregados o actualizados correctamente';

            } else {
                // Mostrar mensaje de error si no se pueden agregar campos sanitizados
                $mensaje = 'Error al agregar objetos. Verifica que todos los campos estén completos y válidos.';
                break;
            }
        }

        // Cerrar la conexión después de procesar todos los objetos
        $Modelo->cerrarConexion();
    }

    // Redireccionar después de procesar los objetos o mostrar el mensaje de error
    header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador&msg=' . $mensaje);
    exit;
}


    public function borrar_objeto()
    {
        $Modelo = new ObjetoModelo();
        $Modelo->borrarObjeto($_POST["id"]);
        header('location:index.php?id=' . $_POST["idCategoria"] . '&accion=categoria&controlador=controlador');
    }

    public function ver_objeto($idObjeto)
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
    public function tablaObjeto($idCategoria)
    {
        $Modelo = new ObjetoModelo();
        $tabla = $Modelo->verObjetos($idCategoria);
        return $tabla;
    }

    private function sanitizarEntrada($input)
    {
        // Eliminar etiquetas HTML, emojis y otros caracteres especiales
        $sanitizedInput = preg_replace('/[^\p{L}\p{N}\s\p{P}]/u', '', strip_tags($input));
        return $sanitizedInput;
    }
}
