<?php
class Ajax{
    /**
     * Método que devuelve la imagen de fondo del tablero de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return string La ruta de la imagen de fondo del tablero.
     */
    public function fondoTablero($idCategoria)
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->verTablero($idCategoria);
        return $fila['imagenFondo'];
    }
    /**
     * Método que devuelve la configuración del juego.
     * 
     * @return array Un array con la configuración.
     */
    public function configuracion()
    {
        $Modelo = new Modelo();
        $fila = $Modelo->configuracion();
        return $fila;
    }
    /**
     * Método que devuelve un tablero seleccionado aleatoriamente.
     * 
     * @return array Un array con la fila de la tabla Tablero seleccionada aleatoriamente.
     */
    public function randomTablero()
    {
        $Modelo = new CategoriaModelo();
        $fila = $Modelo->randomTablero();
        return $fila;
    }
    /**
     * Método que devuelve las 10 filas con mayor puntuación de la tabla de partidas.
     * 
     * @return array Un array bidimensional con las filas de las partidas.
     */
    public function rankingTabla()
    {
        $Modelo = new Modelo();
        $tabla = $Modelo->rankingTabla();
        return $tabla;
    }
    /**
     * Método que devuelve las filas de las preguntas de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return array Un array bidimensional con las filas de la tabla pregunta.
     */
    public function tablaPregunta($idCategoria)
    {
        $Modelo = new PreguntaModelo();
        $tabla = $Modelo->verPreguntas($idCategoria);
        return $tabla;
    }
    /**
     * Método que devuelve las filas de los objetos de una categoría.
     *
     * @param int $idCategoria El ID de la categoría.
     * @return array Un array bidimensional con las filas de la tabla objeto.
     */
    public function tablaObjeto($idCategoria)
    {
        $Modelo = new ObjetoModelo();
        $tabla = $Modelo->verObjetos($idCategoria);
        return $tabla;
    }
}