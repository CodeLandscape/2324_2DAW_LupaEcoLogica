<?php
    /* Aar�n Izquierdo Cordero */
    require_once '../config/configBD.php';

    /**
     * Clase Modelo para la interacci�n con la base de datos.
     */
    class Modelo {
        /**
         * @var mysqli La conexi�n a la base de datos.
         */
        public $Conexion;
        /**
         * M�todo de conexi�n con la base de datos.
         */
        function conectar(){
            $this->Conexion=new Mysqli(HOST,USER,PSW,BDD);
            $this->Conexion->set_charset("utf8");
        }
        /**
         * M�todo para insertar en la base de datos la categor�a y el tablero.
         *
         * @param string $nomC Nombre de la categor�a.
         * @param string $nomT Nombre del tablero.
         * @param string $fondo Imagen de fondo del tablero.
         * @return int C�digo de resultado (0 para �xito, 2 para clave secundaria duplicada en Categoria, 3 para clave secundaria duplicada en Tablero, 4 para otros errores).
         */
        function insertarCategoria($nomC, $nomT, $fondo){
            //Intenta la consulta de creaci�n de categor�a.
            try {
                $this->conectar();
                $sqlCategoria="INSERT INTO categoria(nombre) VALUES('".$nomC."');";
                $Resultado = $this->Conexion->query($sqlCategoria);
                $idCategoria = $this->Conexion->insert_id;
                $this->Conexion->close();
                //Intenta la consulta de creaci�n de tablero de la categoria.
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
         * M�todo para sacar todas las filas de la tabla categor�a.
         *
         * @return array Un array bidimensional con las filas de la tabla categor�a.
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
         * M�todo que devuelve una categor�a.
         * 
         * @param string $id Id de la categor�a.
         * @return array Un array de una fila de la tabla categor�a.
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
         * M�todo que devuelve el tablero de una categor�a.
         * 
         * @param string $id Id de la categor�a.
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
         * M�todo que devuelve todas las preguntas de una categor�a.
         * 
         * @param string $id Id de la categor�a.
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
         * M�todo que devuleve todos los objetos de una categor�a con consulta preparada.
         * 
         * @param string $id Id de la categor�a.
         * @return array Un array bidimensional con las filas de la tabla objeto.
         */
        function verObjetos($id){
            $tabla=array();
            $this->conectar();
            $sqlObjeto="SELECT * FROM objeto WHERE idCategoria=? ;";
            $stmt = $this->Conexion->prepare($sqlObjeto);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $Resultado=$stmt->get_result();
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $stmt->close();
            $this->Conexion->close();

            return $tabla;
        }
        /**
         * M�todo que borra una categoria. (Se debe modificar este m�todo para que los objetos que tengan categor�a pasen a tener idCategoria=NULL)
         * 
         * @param string $id Id de la categor�a.
         */
        function borrarCategoria($id){
            $this->conectar();
            $sqlCategoria="DELETE FROM categoria WHERE idCategoria = ".$id.";";
            $Resultado = $this->Conexion->query($sqlCategoria);
            $this->Conexion->close();
        }
        /**
         * M�todo que modifica un tablero de una categor�a.
         * 
         * @param string $idCategoria Id de la categor�a.
         * @param string $nombre Nombre del tablero.
         * @param string $fondo Imagen de fondo del tablero.
         * @return int C�digo de resultado (0 para �xito, 2 para clave secundaria duplicada en Categoria, 3 para otros errores).
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
         * M�todo que devuelve las filas en la tabla objetos que no tienen categor�a.
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
        /**
         * M�todo que devuelve las 10 primeras filas con la puntaci�n m�s alta de las partidas.
         * 
         * @return array Un array bidimensional con las 10 primeras filas con la puntaci�n m�s alta.
         */
        function rankingTabla(){
            $this->conectar();
            $sql = "SELECT nombre,localidad,puntuacion FROM partida ORDER BY puntuacion DESC LIMIT 10;";
            $Resultado = $this->Conexion->query($sql);
            $tabla = array();
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $this->Conexion->close();
            return $tabla;
        }
        /**
         * M�todo que devuelve la configuraci�n del juego.$Conexion
         * 
         * @return array Un array con la configuraci�n.
         */
        function configuracion(){
            $this->conectar();
            $sql = "SELECT * FROM config";
            $Resultado = $this->Conexion->query($sql);
            return $Resultado->fetch_assoc();
        }

        function randomTablero(){
            $this->conectar();
            $sql="SELECT * FROM tablero ORDER BY RAND() LIMIT 1;";
            $Resultado = $this->Conexion->query($sql);
            $fila = $Resultado->fetch_assoc();
            $this->Conexion->close();
            return $fila;
        }
    }