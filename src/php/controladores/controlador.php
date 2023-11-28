<?php
    require_once '../php/modelos/modelo.php';
    /**
     * Controlador para interactuar con la lógica de negocio y la presentación.
     */
    class Controlador{

        public $vista;

        public function __construct() 
        {
            $this->vista = null;
        }

        public function inicio(){
            $this->vista = 'admin';
        }

        public function addCategoria(){
            $this->vista = 'addCategoria';
        }

        public function selectCategoria(){
            $this->vista = 'selectCategoria';
        }
        public function anadir_pregunta(){
            $this->vista = 'anadir_pregunta';
        }
        public function categoria(){
            $this->vista = 'categoria';
        }

        public function modTablero(){
            $this->vista = 'modTablero';
        }

        public function remove_Categoria(){
            $this->vista = 'remove_Categoria';
        }

        /**
         * Método que devuelve la tabla de categorías.
         *
         * @return array Un array bidimensional con las filas de la tabla categoría.
         */
        function tablaCategoria(){
            $Modelo = new Modelo();
            $tabla=$Modelo->tablaCategoria();
            return $tabla;
        }
        /**
         * Método que devuelve el nombre de una categoría.
         *
         * @param int $id El ID de la categoría.
         * @return string El nombre de la categoría.
         */
        function nombreCategoria($id){
            $Modelo = new Modelo();
            $fila=$Modelo->verCategoria($id);
            return $fila['nombre'];
        }
        function borrarCategoria(){
            // if(isset($_POST['idCategoria'])){
                $Modelo=new Modelo();
                // $id=$_POST['idCategoria'];
                $Modelo->borrarCategoria($_POST["id"]);
                $this->vista = 'admin';
            // }
        }
        /**
         * Método que devuelve el nombre del tablero de una categoría.
         *
         * @param int $idCategoria El ID de la categoría.
         * @return string El nombre del tablero de la categoría.
         */
        function nombreTablero($idCategoria){
            $Modelo = new Modelo();
            $fila=$Modelo->verTablero($idCategoria);
            return $fila['nombre'];
        }
        /**
         * Método que devuelve la imagen de fondo del tablero de una categoría.
         *
         * @param int $idCategoria El ID de la categoría.
         * @return string La ruta de la imagen de fondo del tablero.
         */
        function fondoTablero($idCategoria){
            $Modelo = new Modelo();
            $fila=$Modelo->verTablero($idCategoria);
            return $fila['imagenFondo'];
        }
        /**
         * Método que devuelve las filas de las preguntas de una categoría.
         *
         * @param int $idCategoria El ID de la categoría.
         * @return array Un array bidimensional con las filas de la tabla pregunta.
         */
        function tablaPregunta($idCategoria){
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
        function tablaObjeto($idCategoria){
            $Modelo = new Modelo();
            $tabla = $Modelo->verObjetos($idCategoria);
            return $tabla;
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
                header('location:index.php?id='.$idCategoria.'&accion=categoria&controlador=Controlador');
                }
            }
            
            
            
            
        /**
         * Método que devuelve las 10 filas con mayor puntuación de la tabla de partidas.
         * 
         * @return array Un array bidimensional con las filas de las partidas.
         */
        function rankingTabla(){
            $Modelo = new Modelo();
            $tabla = $Modelo->rankingTabla();
            return $tabla;
        }

        /**
         * Método que devuelve la configuración del juego.
         * 
         * @return array Un array con la configuración.
         */
        function configuracion(){
            $Modelo = new Modelo();
            $fila = $Modelo->configuracion();
            return $fila;
        }

        /**
         * Método que devuelve un tablero seleccionado aleatoriamente.
         * 
         * @return array Un array con la fila de la tabla Tablero seleccionada aleatoriamente.
         */
        function randomTablero(){
            $Modelo = new Modelo();
            $fila = $Modelo->randomTablero();
            return $fila;
        }

        function insertarCategoria(){
            $Modelo = new Modelo();
            $fondo = $_FILES['img']['tmp_name'];
            $tipo = $_FILES['img']['type'];
            if($tipo=='image/png' || $tipo=='image/jpg' || $tipo=='image/jpeg'){
                $contenido = file_get_contents($fondo);
                $base64 = base64_encode($contenido);
            }
            $Modelo->insertarCategoria($_POST["categoria"], $_POST["tablero"], $base64);
            $this->vista = 'admin';
        }


        // En tu Controlador.php
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
        $Modelo->actualizarConfiguracion($parametro1, $parametro2,$parametro3);
    }
    // Redirigir a la vista de configuración
    $this->vista = 'modConfig';
}


        
}