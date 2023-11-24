<<<<<<< HEAD
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
=======
<?php
require_once '../modelos/modelo.php';
/**
     * Controlador para interactuar con la l�gica de negocio y la presentaci�n.
     */
    class Controlador{
        /**
         * M�todo que devuelve la tabla de categor�as.
         *
         * @return array Un array bidimensional con las filas de la tabla categor�a.
         */
        function tablaCategoria(){
            $Modelo = new Modelo();
            $tabla=$Modelo->tablaCategoria();
            return $tabla;
        }
        /**
         * M�todo que devuelve el nombre de una categor�a.
         *
         * @param int $id El ID de la categor�a.
         * @return string El nombre de la categor�a.
         */
        function nombreCategoria($id){
            $Modelo = new Modelo();
            $fila=$Modelo->verCategoria($id);
            return $fila['nombre'];
        }
        /**
         * M�todo que devuelve el nombre del tablero de una categor�a.
         *
         * @param int $idCategoria El ID de la categor�a.
         * @return string El nombre del tablero de la categor�a.
         */
        function nombreTablero($idCategoria){
            $Modelo = new Modelo();
            $fila=$Modelo->verTablero($idCategoria);
            return $fila['nombre'];
        }
        /**
         * M�todo que devuelve la imagen de fondo del tablero de una categor�a.
         *
         * @param int $idCategoria El ID de la categor�a.
         * @return string La ruta de la imagen de fondo del tablero.
         */
        function fondoTablero($idCategoria){
            $Modelo = new Modelo();
            $fila=$Modelo->verTablero($idCategoria);
            return $fila['imagenFondo'];
        }
        /**
         * M�todo que devuelve las filas de las preguntas de una categor�a.
         *
         * @param int $idCategoria El ID de la categor�a.
         * @return array Un array bidimensional con las filas de la tabla pregunta.
         */
        function tablaPregunta($idCategoria){
            $Modelo = new Modelo();
            $tabla = $Modelo->verPreguntas($idCategoria);
            return $tabla;
        }
        /**
         * M�todo que devuelve las filas de los objetos de una categor�a.
         *
         * @param int $idCategoria El ID de la categor�a.
         * @return array Un array bidimensional con las filas de la tabla objeto.
         */
        function tablaObjeto($idCategoria){
            $Modelo = new Modelo();
            $tabla = $Modelo->verObjetos($idCategoria);
            return $tabla;
        }
        /**
         * M�todo que devuelve las filas 10 filas con mayor puntuaci�n de la tabla de partidas.
         * 
         * @return array Un array bidimensional con las filas de las partidas.
         */
        function rankingTabla(){
            $Modelo = new Modelo();
            $tabla = $Modelo->rankingTabla();
            return $tabla;
        }
        /**
         * 
         */
        function configuracion(){
            $Modelo = new Modelo();
            $fila = $Modelo->configuracion();
            return $fila;
        }
        /**
         * 
         */
        function randomTablero(){
            $Modelo = new Modelo();
            $fila = $Modelo->randomTablero();
            return $fila;
        }
>>>>>>> 6e72f15e7f3f26fe41aebf90d7f14873c908b75f
    }