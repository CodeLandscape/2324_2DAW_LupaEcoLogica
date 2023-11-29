<?php
    /* Aarón Izquierdo Cordero */
    require_once '../php/config/configBD.php';

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
            
            // Preparar la consulta
            $sql = "SELECT * FROM categoria";
            $stmt = $this->Conexion->prepare($sql);
        
            // Ejecutar la consulta
            $stmt->execute();
        
            // Obtener los resultados
            $resultado = $stmt->get_result();
            
            $tabla = array();
            
            // Obtener los datos de la consulta preparada
            while($fila = $resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
        
            // Cerrar la conexión y devuelve los resultados
            $stmt->close();
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

            //preparacion de la consulta
            $sqlCategoria= "SELECT * FROM categoria WHERE idCategoria = ?";
             
            $stmt = $this->Conexion->prepare($sqlCategoria);

            $stmt->bind_param("i",$id);

            $stmt->execute();

            $resultado = $stmt->get_result();

            $fila = $resultado->fetch_assoc();

            $stmt->close();
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
            $sqlTablero="SELECT * FROM tablero WHERE idCategoria = ?";
            $stmt = $this->Conexion->prepare($sqlTablero);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $fila = $resultado->fetch_assoc();
            $stmt->close();
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
            $sqlPregunta="SELECT * FROM pregunta WHERE idCategoria = ?";
            $stmt = $this->Conexion->prepare($sqlPregunta);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $Resultado = $stmt->get_result();
            while ($fila = $Resultado->fetch_assoc()) {
                array_push($tabla, $fila);
            }
            $stmt->close();
            $this->Conexion->close();
        
            return $tabla;
        }
        function verPregunta($id){
            $this->conectar();
            $sqlPregunta = "SELECT * FROM pregunta WHERE idPregunta = ?";
            $stmt = $this->Conexion->prepare($sqlPregunta);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $objeto = $resultado->fetch_assoc();
            $stmt->close();
            $this->Conexion->close();
        
            return $objeto;
        }
        
        /**
         * Método que devuleve todos los objetos de una categoría con consulta preparada.
         * 
         * @param string $id Id de la categoría.
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
        function verObjeto($id){
            $this->conectar();
            $sqlObjeto="SELECT * FROM objeto WHERE idObjeto=? ;";
            $stmt = $this->Conexion->prepare($sqlObjeto);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $resultado=$stmt->get_result();
            $objeto = $resultado->fetch_assoc();
            $stmt->close();
            $this->Conexion->close();

            return $objeto;
        }
        /**
         * Método que borra una categoria. (Se debe modificar este método para que los objetos que tengan categoría pasen a tener idCategoria=NULL)
         * 
         * @param string $id Id de la categoría.
         */
        function borrarCategoria($id){
            $this->conectar();
            $sqlCategoria = "DELETE FROM categoria WHERE idCategoria = ?";
            $stmt = $this->Conexion->prepare($sqlCategoria);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $this->Conexion->close();
        }

        function borrarObjeto($id){
            $this->conectar();
            $sqlCategoria = "DELETE FROM objeto WHERE idObjeto = ?";
            $stmt = $this->Conexion->prepare($sqlCategoria);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $this->Conexion->close();
        }

        function borrarPregunta($id)
        {
            $this->conectar();
            $sqlCategoria = "DELETE FROM pregunta WHERE idPregunta = ?";
            $stmt = $this->Conexion->prepare($sqlCategoria);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
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
                $errorCode = $e->getCode();
                if ($c == 1062) {
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

            $sqlObjeto= "SELECT * FROM objeto WHERE idCategoria IS NULL";
            $stmt = $this->Conexion->prepare($sqlObjeto);

            $stmt->execute();

            $resultado = $stmt->get_result();

            while($fila = $resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }

            $stmt->close();
            $this->Conexion->close();

            return $tabla;
        }
        /**
         * Método que devuelve las 10 primeras filas con la puntación más alta de las partidas.
         * 
         * @return array Un array bidimensional con las 10 primeras filas con la puntación más alta.
         */
        function rankingTabla(){
            $this->conectar();

            $sql = "SELECT nombre,localidad,puntuacion FROM partida ORDER BY puntuacion DESC LIMIT 10;";
            $stmt = $this->Conexion->prepare($sql);

            $stmt->execute();

            $resultado = $stmt->get_result();
            $tabla = array();

            while($fila = $resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $stmt->close();
            $this->Conexion->close();
            return $tabla;
        }
        /**
         * Método que devuelve la configuración del juego.
         * 
         * @return array Un array con la configuración.
         */
        function configuracion(){
            $this->conectar();
            $sql = "SELECT * FROM config";
            $stmt = $this->Conexion->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $configuracion = $resultado->fetch_assoc();
            $stmt->close();
            $this->Conexion->close();
            return $configuracion;
        }
        /**
         * Método que selecciona un tablero al azar.
         * 
         * @return array Un array con la fila de la tabla Tablero seleccionada aleatoriamente.
         */
        function randomTablero(){
            $this->conectar();
            $sql="SELECT * FROM tablero ORDER BY RAND() LIMIT 1;";
            $Resultado = $this->Conexion->query($sql);
            $fila = $Resultado->fetch_assoc();
            $this->Conexion->close();
            return $fila;
        }
        /**
         * Método que agrega una pregunta a la base de datos.
         *
         * @param string $texto Pregunta.
         * @param string $reflexionAcierto Reflexión positiva.
         * @param string $reflexionFallo Reflexión negativa.
         * @param int $respuesta Respuesta (0 o 1).
         * @param int $idCategoria ID de la categoría a la que pertenece la pregunta.
         */
        public function agregarPregunta($texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria)
        {
            $this->conectar();

            // Asegurarse de que $respuesta sea 0 o 1
            $respuesta = ($respuesta == '1') ? 1 : 0;



            // Realizar la inserción en la tabla pregunta
            $sql = "INSERT INTO pregunta (texto, reflexionAcierto, reflexionFallo, respuesta, idCategoria) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->Conexion->prepare($sql);
            $stmt->bind_param("sssii", $texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria);
            $stmt->execute();
            $stmt->close();
            $this->Conexion->close();
        }
        public function agregarObjeto($nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria)
        {
            $this->conectar();

            // Realizar la inserción en la tabla objeto
            $sql = "INSERT INTO objeto (nombre, descripcion, imagen, puntuacion, valoracion, idCategoria) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->Conexion->prepare($sql);
            $stmt->bind_param("sssiii", $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria);
            $stmt->execute();
            $stmt->close();
            $this->Conexion->close();
        }

        public function modificarPregunta($id, $texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria)
        {
            $this->conectar();

            // Asegurarse de que $respuesta sea 0 o 1
            $respuesta = ($respuesta == '1') ? 1 : 0;

            // Realizar la actualización en la tabla pregunta
            $sql = "UPDATE pregunta SET texto = ?, reflexionAcierto = ?, reflexionFallo = ?, respuesta = ?, idCategoria = ? WHERE idPregunta = ?";
            $stmt = $this->Conexion->prepare($sql);

            // Ajustar los tipos de datos en bind_param, considerando el booleano como un entero
            $stmt->bind_param("sssiii", $texto, $reflexionAcierto, $reflexionFallo, $respuesta, $idCategoria, $id);
            $stmt->execute();
            $stmt->close();
            $this->Conexion->close();
        }



        
        function actualizarConfiguracion($tiempoCrono, $nPregunta, $nObjetosBuenos)
        {
            $this->conectar();

            // Realizar la actualización en la tabla config
            $sql = "UPDATE config SET tiempoCrono = ?, nPregunta = ?, nObjetosBuenos = ?";
            $stmt = $this->Conexion->prepare($sql);
            $stmt->bind_param("iii", $tiempoCrono, $nPregunta, $nObjetosBuenos);
            $stmt->execute();
            $stmt->close();
            $this->Conexion->close();
        }


    public function actualizarObjeto($id, $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria)
    {
        $this->conectar();

        // Convertir el booleano a un entero (0 o 1)
        $esBueno = $esBueno ? 1 : 0;

        // Realizar la actualización en la tabla objeto
        $sql = "UPDATE objeto SET nombre = ?, descripcion = ?, imagen = ?, puntuacion = ?, valoracion = ?, idCategoria = ? WHERE idObjeto = ?";
        $stmt = $this->Conexion->prepare($sql);

        // Ajustar los tipos de datos en bind_param, considerando el booleano como un entero
        $stmt->bind_param("sssiiii", $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria, $id);

        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }


    public function actualizarTablero($id, $nombre, $imagen)
    {
        $this->conectar();

      
        // Realizar la actualización en la tabla tablero
        $sql = "UPDATE tablero SET nombre = ?, imagenFondo = ? WHERE idTablero = ? ";
        $stmt = $this->Conexion->prepare($sql);

        // Ajustar los tipos de datos en bind_param, considerando el booleano como un entero
        $stmt->bind_param("ssi", $nombre, $imagen, $id);

        $stmt->execute();
        $stmt->close();
        $this->Conexion->close();
    }



}
?>
