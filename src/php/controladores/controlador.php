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
    }