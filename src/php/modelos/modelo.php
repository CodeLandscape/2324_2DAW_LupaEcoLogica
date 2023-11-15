<?php
    /* Aarón Izquierdo Cordero */
    require_once '../config/configBD.php';

    class Modelo {
        /* Propiedades */
        public $Conexion;

        /**
         * Constructor de la clase.
         */
        function __construct(){
            $this->conectar();
        }
        /**
         * Método de conexión con la base de datos.
         */
        function conectar(){
            $this->Conexion=new Mysqli(HOST,USER,PSW,BDD);
        }
        /**
         * Método para insertar en la base de datos la categoría y el tablero.
         */
        function insertarCategoria($nomC, $nomT, $fondo){
            $sqlCategoria="INSERT INTO categoria(nombre) VALUES('".$nomC."');";
            $Resultado = $this->Conexion->query($sqlCategoria);
            $idCategoria = $this->Conexion->insert_id;
            $this->Conexion->close();
            /* --- */
            $this->conectar();
            $sqlTablero="INSERT INTO tablero(nombre, imagenFondo, idCategoria) VALUES('".$nomT."','".$fondo."',".$idCategoria.");";
            $Resultado = $this->Conexion->query($sqlTablero);
            $this->Conexion->close();
        }
        /**
         * Método para sacar todas las filas de la tabla categoria.
         * Devuelve las filas de la base de datos y las inserta en una tabla (array bidimensional).
         */
        function tablaCategoria(){
            $sql="SELECT * FROM categoria";
            $Resultado = $this->Conexion->query($sql);
            $tabla = array();
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            return $tabla;
        }
        /**
         * Método que devuelve una categoría y todas sus filas asociadas en tablero, pregunta y objeto.
         * Inserta las filas obtenidas en un array tridimensional.
         */
        function verCategoria($id){
            $tabla = array();
            /* --- */
            $sqlCategoria="SELECT * FROM categoria WHERE idCategoria = ".$id.";"; 
            $Resultado = $this->Conexion->query($sqlCategoria);
            $fila = $Resultado->fetch_assoc();
            array_push($tabla, $fila);
            $this->Conexion->close();
            /* --- */
            $this->conectar();
            $sqlTablero="SELECT * FROM tablero WHERE idCategoria = ".$id.";";
            $Resultado = $this->Conexion->query($sqlTablero);
            $fila = $Resultado->fetch_assoc();
            array_push($tabla, $fila);
            $this->Conexion->close();
            /* --- */
            $this->conectar();
            $sqlPregunta="SELECT * FROM pregunta WHERE idCategoria = ".id.";";
            $Resultado = $this->Conexion->query($sqlPregunta);
            $tabla[2]=array();
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla[2],$fila);
            }
            $this->Conexion->close();
            /* --- */
            $this->conectar();
            $sqlObjeto="SELECT * FROM pregunta WHERE idCategoria = ".id.";";
            $Resultado = $this->Conexion->query($sqlObjeto);
            $tabla[3]=array();
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla[3],$fila);
            }
            $this->Conexion->close();
            return $tabla;
        }
    }