<?php
    require_once 'conexion.php';
class ObjetoModelo extends Conexion{
        /**
         * Método que devuleve todos los objetos de una categoría con consulta preparada.
         * 
         * @param string $id Id de la categoría.
         * @return array Un array bidimensional con las filas de la tabla objeto.
         */
        function verObjetos($id){
            $tabla=array();
            $sqlObjeto="SELECT * FROM objeto WHERE idCategoria=? ;";
            $stmt = $this->conexion->prepare($sqlObjeto);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $Resultado=$stmt->get_result();
            while($fila = $Resultado->fetch_assoc()){
                array_push($tabla,$fila);
            }
            $stmt->close();
            $this->conexion->close();

            return $tabla;
        }
        function verObjeto($id){
            $sqlObjeto="SELECT * FROM objeto WHERE idObjeto=? ;";
            $stmt = $this->conexion->prepare($sqlObjeto);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $resultado=$stmt->get_result();
            $objeto = $resultado->fetch_assoc();
            $stmt->close();
            $this->conexion->close();

            return $objeto;
        }
        
        function borrarObjeto($id){
            $sqlCategoria = "DELETE FROM objeto WHERE idObjeto = ?";
            $stmt = $this->conexion->prepare($sqlCategoria);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $this->conexion->close();
        }

        public function agregarObjeto($nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria){
            

            // Realizar la inserción en la tabla objeto
            $sql = "INSERT INTO objeto (nombre, descripcion, imagen, puntuacion, valoracion, idCategoria) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("sssiii", $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria);
            $stmt->execute();
            $stmt->close();
            $this->conexion->close();
        }

        public function actualizarObjeto($id, $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria) {
        // Convertir el booleano a un entero (0 o 1)
        $esBueno = $esBueno ? 1 : 0;

        // Realizar la actualización en la tabla objeto
        $sql = "UPDATE objeto SET nombre = ?, descripcion = ?, imagen = ?, puntuacion = ?, valoracion = ?, idCategoria = ? WHERE idObjeto = ?";
        $stmt = $this->conexion->prepare($sql);

        // Ajustar los tipos de datos en bind_param, considerando el booleano como un entero
        $stmt->bind_param("sssiiii", $nombre, $descripcion, $imagen, $puntuacion, $esBueno, $idCategoria, $id);

        $stmt->execute();
        $stmt->close();
        $this->conexion->close();
        }
}