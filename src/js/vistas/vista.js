/**
 * Clase que representa una vista en la aplicación.
 */
export class Vista {
  /**
     * Enumeración de vistas disponibles.
     * @type {Object}
     * @readonly
     */
  static {
    Vista.VISTA1 = Symbol('Inicio')
    Vista.VISTA2 = Symbol('BusquedaObjetos')
    Vista.VISTA3 = Symbol('Preguntas')
    Vista.VISTA3_1 = Symbol('Reflexion')
    Vista.VISTA4 = Symbol('Registro')
    Vista.VISTA5 = Symbol('Ranking') // Símbolo para la vista de ranking
  };

  /**
     * Crea una instancia de Vista.
     * @param {any} controlador - El controlador asociado a la vista.
     * @param {HTMLElement} base - El elemento base de la vista.
     */
  constructor (controlador, base, config, idCategoria, nomTablero, puntuacion,pregunta,preguntasAcertadas,objetosCapturados) {
    this.controlador = controlador // Asigna el controlador a la instancia de Vista
    this.base = base // Asigna el elemento base a la instancia de Vista
    this.config = config
    this.idCategoria = idCategoria
    this.nomTablero = nomTablero
    this.puntuacion = puntuacion
    this.pregunta = pregunta
    this.preguntasAcertadas = preguntasAcertadas
    this.objetosCapturados = objetosCapturados

  }

  /**
     * Muestra u oculta la vista según el valor de 'ver'.
     * @param {boolean} ver - Valor booleano para mostrar u ocultar la vista.
     */
  mostrar (ver) {
    if (ver) {
      // Si 'ver' es verdadero, muestra el elemento
      this.base.style.display = 'block'
    } else {
      // Si 'ver' es falso, oculta el elemento
      this.base.style.display = 'none'
    }
  }
}
