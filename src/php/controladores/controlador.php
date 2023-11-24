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

        function agregarPregunta($texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria) {
            $Modelo = new Modelo();
            $Modelo->insertarPregunta($texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria);
        }
    }