<?php
    require_once '../modelos/modelo.php';
    class Controlador{
        /**
         * Método que devuelve el nombre de una categoría.
         */
        function tablaCategoria(){
            $Modelo = new Modelo();
            $tabla=$Modelo->tablaCategoria();
            return $tabla;
        }
        function nombreCategoria($id){
            $Modelo = new Modelo();
            $fila=$Modelo->verCategoria($id);
            return $fila['nombre'];
        }
        /**
         * Método que devuelve el nombre del tablero de una categoría.
         */
        function nombreTablero($idCategoria){
            $Modelo = new Modelo();
            $fila=$Modelo->verTablero($idCategoria);
            return $fila['nombre'];
        }
        /**
         * Método que devuelve la imagen del tablero de una categoría
         */
        function fondoTablero($idCategoria){
            $Modelo = new Modelo();
            $fila=$Modelo->verTablero($idCategoria);
            return $fila['imagenFondo'];
        }
        /**
         * Método que devuelve las filas de las preguntas de una categoría.
         */
        function tablaPregunta($idCategoria){
            $Modelo = new Modelo();
            $tabla = $Modelo->verPreguntas($idCategoria);
            return $tabla;
        }
        /**
         * Método que devuelve las filas de los objetos de una categoría.
         */
        function tablaObjeto($idCategoria){
            $Modelo = new Modelo();
            $tabla = $Modelo->verObjetos($idCategoria);
            return $tabla;
        }
    }