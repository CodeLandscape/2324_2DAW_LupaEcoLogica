<?php
    /* Aarón Izquierdo Cordero */
    require_once 'C:/xampp/htdocs/Proyecto-ABP/2324_2DAW_LupaEcoLogica/src/php/config/configBD.php';

    /**
     * Clase Modelo para la interacción con la base de datos.
     */
    class Modelo {
        /**
         * @var mysqli La conexión a la base de datos.
         */
        public $Conexion;
        /**
         * Método de conexión con la base de datos.
         */
        function conectar(){
            $this->Conexion=new Mysqli(HOST,USER,PSW,BDD);
            $this->Conexion->set_charset("utf8");
        }
        /**
         * Método para insertar en la base de datos la categoría y el tablero.
         *
         * @param string $nomC Nombre de la categoría.
         * @param string $nomT Nombre del tablero.
         * @param string $fondo Imagen de fondo del tablero.
         * @return int Código de resultado (0 para éxito, 2 para clave secundaria duplicada en Categoria, 3 para clave secundaria duplicada en Tablero, 4 para otros errores).
         */
        function insertarCategoria($nomC, $nomT, $fondo){
            //Intenta la consulta de creación de categoría.
            try {
                $this->conectar();
                $sqlCategoria="INSERT INTO categoria(nombre) VALUES('".$nomC."');";
                $Resultado = $this->Conexion->query($sqlCategoria);
                $idCategoria = $this->Conexion->insert_id;
                $this->Conexion->close();
                //Intenta la consulta de creación de tablero de la categoria.
                try {
                    $this->conectar();
                    $sqlTablero="INSERT INTO tablero(nombre, imagenFondo, idCategoria) VALUES('".$nomT."','".$fondo."',".$idCategoria.");";
                    $Resultado = $this->Conexion->query($sqlTablero);
                    $this->Conexion->close();
                } catch (mysqli_sql_exception $e) {
                    $errorCode = $e->getCode();
                    $sqlCategoria="DELETE FROM categoria WHERE nombre='".$nomC."';";
                    $Resultado = $this->Conexion->query($sqlCategoria);
                    $this->Conexion->close();

                    if ($errorCode == 1062) {
                        //Error de clave secundaria duplicada
                        return 3;
                    } else {
                        return 4;
                    }
                }
            } catch (mysqli_sql_exception $e) {
                $errorCode = $e->getCode();

                if ($errorCode == 1062) {
                    //Error de clave secundaria duplicada
                    return 2;
                } else {
                    return 4;
                }
                
            }
            return 0;
        }
        /**
         * Método para sacar todas las filas de la tabla categoría.
         *
         * @return array Un array bidimensional con las filas de la tabla categoría.
         */
        function tablaCategoria(){
            $this->conectar();
            $sql="SELECT * FROM categoria";
            $Resultado = $this->Conexion->query($sql);
            $tabla = array();
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $this->Conexion->close();
            return $tabla;
        }
        /**
         * Método que devuelve una categoría.
         * 
         * @param string $id Id de la categoría.
         * @return array Un array de una fila de la tabla categoría.
         */
        function verCategoria($id){
            $this->conectar();
            $sqlCategoria="SELECT * FROM categoria WHERE idCategoria = ".$id.";"; 
            $Resultado = $this->Conexion->query($sqlCategoria);
            $fila = $Resultado->fetch_assoc();
            $this->Conexion->close();

            return $fila;
        }
        /**
         * Método que devuelve el tablero de una categoría.
         * 
         * @param string $id Id de la categoría.
         * @return array Un array de una fila de la tabla Tablero.
         */
        function verTablero($id){
            $this->conectar();
            $sqlTablero="SELECT * FROM tablero WHERE idCategoria = ".$id.";";
            $Resultado = $this->Conexion->query($sqlTablero);
            $fila = $Resultado->fetch_assoc();
            $this->Conexion->close();

            return $fila;
        }
        /**
         * Método que devuelve todas las preguntas de una categoría.
         * 
         * @param string $id Id de la categoría.
         * @return array Un array bidimensional con las filas de la tabla pregunta.
         */
        function verPreguntas($id){
            $tabla=array();

            $this->conectar();
            $sqlPregunta="SELECT * FROM pregunta WHERE idCategoria = ".$id.";";
            $Resultado = $this->Conexion->query($sqlPregunta);
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $this->Conexion->close();

            return $tabla;
        }
        /**
         * Método que devuleve todos los objetos de una categoría.
         * 
         * @param string $id Id de la categoría.
         * @return array Un array bidimensional con las filas de la tabla objeto.
         */
        function verObjetos($id){
            $tabla=array();

            $this->conectar();
            $sqlObjeto="SELECT * FROM objeto WHERE idCategoria = ".$id.";";
            $Resultado = $this->Conexion->query($sqlObjeto);
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $this->Conexion->close();

            return $tabla;
        }
        /**
         * Método que borra una categoria. (Se debe modificar este método para que los objetos que tengan categoría pasen a tener idCategoria=NULL)
         * 
         * @param string $id Id de la categoría.
         */
        function borrarCategoria($id){
            $this->conectar();
            $sqlCategoria="DELETE FROM categoria WHERE idCategoria = ".$id.";";
            $Resultado = $this->Conexion->query($sqlCategoria);
            $this->Conexion->close();
        }
        /**
         * Método que modifica un tablero de una categoría.
         * 
         * @param string $idCategoria Id de la categoría.
         * @param string $nombre Nombre del tablero.
         * @param string $fondo Imagen de fondo del tablero.
         * @return int Código de resultado (0 para éxito, 2 para clave secundaria duplicada en Categoria, 3 para otros errores).
         */
        function modificarTablero($idCategoria,$nombre,$fondo){
            $this->conectar();
            $sqlTablero="UPDATE tablero SET nombre='".$nombre."', imagenFondo='".$fondo."' WHERE idCategoria=".$idCategoria.";";
            try {
                $Resultado=$this->Conexion->query($sqlTablero);
            } catch (mysqli_sql_exception $e) {
                if ($errorCode == 1062) {
                    //Error de clave secundaria duplicada
                    return 2;
                } else {
                    return 3;
                }
            }
            return 0;
        }
        /**
         * Método que devuelve las filas en la tabla objetos que no tienen categoría.
         * 
         * @return array Un array bidimensional con los objetos con idCategoria en NULL.
         */
        function tablaObjetos(){
            $tabla=array();
            $this->conectar();
            $sqlObjeto="SELECT * FROM objeto WHERE idCategoria IS NULL;";
            $Resultado = $this->Conexion->query($sqlObjeto);
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $this->Conexion->close();

            return $tabla;
        }
    }