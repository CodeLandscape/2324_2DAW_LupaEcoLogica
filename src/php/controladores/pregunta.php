<?php
require_once '../php/modelos/pregunta.php';

class Pregunta
{
    public function __construct()
    {
        $this->vista = null;
    }

    public function anadir_pregunta()
    {
        $this->vista = 'anadir_pregunta';
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

            // Redireccionar después de procesar las preguntas
            header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador');
        }
    }

    /**
     * Método que devuelve las filas de las preguntas de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return array Un array bidimensional con las filas de la tabla pregunta.
     */
    public function tablaPregunta($idCategoria)
    {
        $Modelo = new Modelo();
        $tabla = $Modelo->verPreguntas($idCategoria);
        return $tabla;
    }


    public function borrarPregunta()
    {
        $Modelo = new Modelo();
        $Modelo->borrarPregunta($_POST["id"]);
        header('location:index.php?id=' . $_POST["idCategoria"] .'&accion=categoria&controlador=Controlador');
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
        header('location:index.php?id=' . $idCategoria . '&accion=categoria&controlador=Controlador');
    }

    function pregunta($id)
    {
        $Modelo = new Modelo();
        $fila = $Modelo->verPregunta($id);
        return $fila;
    }

}
