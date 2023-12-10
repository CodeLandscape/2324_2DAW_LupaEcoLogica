<?php
require_once '../php/modelos/pregunta.php';
/**
 * Clase Pregunta que gestiona las operaciones relacionadas con las preguntas.
 */
class Pregunta
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
     * Establece la vista para la página de añadir pregunta.
     */
    public function anadir_pregunta()
    {
        $this->vista = 'anadir_pregunta';
    }

    /**
     * Establece la vista para la página de modificar pregunta.
     */
    public function modificar_pregunta()
    {
        $this->vista = 'modificar_pregunta';
    }

    /**
     * Establece la vista para la página de eliminar.
     */
    public function remove()
    {
        $this->vista = 'remove';
    }

    /**
     * Devuelve las filas de las preguntas de una categoría.
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
     * Borra una pregunta de la base de datos.
     */
    public function borrarPregunta()
    {
        $Modelo = new PreguntaModelo();
        $Modelo->borrarPregunta($_POST["id"]);
        $mensaje = 'Pregunta borrada correctamente';
        header('location:index.php?id=' . $_POST["idCategoria"] .'&accion=categoria&controlador=controlador&msg=' . $mensaje.'');
        exit;
    }

    /**
     * Obtiene la información de una pregunta por su ID.
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

    public function verTodasPreguntas(){
        $Modelo = new PreguntaModelo();
        $tabla = $Modelo->verTodasPreguntas();
        return $tabla;
    }
    /**
     * Agrega o actualiza preguntas en la base de datos.
     */
    public function agregar_actualizar_pregunta()
    {
        $Modelo = new PreguntaModelo();
        $mensaje = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idCategoria = isset($_POST['idCategoria_seleccionada']) ? $_POST['idCategoria_seleccionada'] : '';

            // Acceder a los valores del formulario
            $preguntas = isset($_POST['pregunta']) ? $_POST['pregunta'] : array();
            $respuestas = isset($_POST['opcion']) ? $_POST['opcion'] : array();
            $reflexionesAcierto = isset($_POST['ref1']) ? $_POST['ref1'] : array();
            $reflexionesFallo = isset($_POST['ref2']) ? $_POST['ref2'] : array();

            // Iterar sobre cada pregunta
            foreach ($preguntas as $index => $preguntaData) {
                // Obtener la pregunta actual
                $pregunta = isset($preguntaData['texto']) ? $this->sanitizarEntrada($preguntaData['texto']) : '';

                // Verificar si la pregunta está vacía después de la sanitización
                if (empty($pregunta)) {
                    $mensaje = 'Error: La pregunta no puede estar vacía. No se pueden introducir caracteres especiales.';
                    break; // Detener el bucle si hay un error
                }

                // Verificar si la pregunta ya existe al añadir
                if (empty($preguntaData['idPregunta']) && $Modelo->preguntaExiste($pregunta, $idCategoria)) {
                    $mensaje = 'Error: La pregunta ya existe. Por favor, elige otro nombre.';
                    break; // Detener el bucle si hay un error
                }

                // Obtener el ID de la pregunta actual
                $idPregunta = $preguntaData['idPregunta'];

                // Obtener la respuesta correcta para la pregunta actual
                $respuesta = isset($respuestas[$index]) ? $respuestas[$index] : '';

                // Si la respuesta es un array, tomar el primer elemento (puede ser '1' o '0')
                if (is_array($respuesta)) {
                    $respuesta = isset($respuesta[0]) ? $respuesta[0] : '';
                }

                $refAcierto = isset($reflexionesAcierto[$index][0]) ? $this->sanitizarEntrada($reflexionesAcierto[$index][0]) : '';
                $refFallo = isset($reflexionesFallo[$index][0]) ? $this->sanitizarEntrada($reflexionesFallo[$index][0]) : '';

                // Intentar actualizar la pregunta directamente
                $Modelo->modificarPregunta($idPregunta, $pregunta, $refAcierto, $refFallo, $respuesta, $idCategoria);

                // Verificar si la pregunta fue actualizada correctamente
                $preguntaActualizada = $Modelo->verPregunta($idPregunta);

                if (!$preguntaActualizada) {
                    // La pregunta no existía, agregar
                    $Modelo->agregarPregunta($pregunta, $refAcierto, $refFallo, $respuesta, $idCategoria);
                    $mensaje = 'Preguntas agregadas o actualizadas correctamente';
                } else {
                    $mensaje = 'Preguntas actualizadas correctamente';
                }
            }

            // Cerrar la conexión después de procesar todas las preguntas
            $Modelo->cerrarConexion();
        }

        // Redireccionar después de procesar las preguntas
        header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=controlador&msg=' . $mensaje);
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
