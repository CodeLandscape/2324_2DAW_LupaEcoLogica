import { Vista } from './vista.js'
import { Rest } from '../servicios/rest.js'
/**
 * Clase que representa una vista específica, extendiendo la clase base Vista.
 * @extends Vista
 */
export class Inicio extends Vista {
  /**
     * Crea una instancia de Inicio.
     * @param {any} controlador - El controlador asociado a la vista.
     * @param {HTMLElement} base - El elemento base de la vista.
     */
  constructor (controlador, base) {
    super(controlador, base)
    this.llamarAJAXConfig()

    // Crea los botones y configura sus atributos
    this.enlace1 = document.createElement('button')
    this.enlace1.textContent = 'Jugar partida'
    this.enlace1.setAttribute('id', 'botonJuego')
    this.enlace1.setAttribute('class','submit');
    this.enlace2 = document.createElement('button')
    this.enlace2.textContent = 'Ranking'
    this.enlace2.setAttribute('id', 'botonRanking')
    this.enlace2.setAttribute('class','submit');
    this.footer = document.getElementById('pie')
    this.footer.textContent = 'Escuela Virgen de Guadalupe 2023'
    // Agrega los botones al elemento base y asocia eventos
    this.base.appendChild(this.enlace1)
    this.base.appendChild(this.enlace2)
    this.enlace1.onclick = this.pulsarEnlace1.bind(this)
    this.enlace2.onclick = this.pulsarEnlace2.bind(this)
  }

  /**
     * Acción al hacer clic en el enlace1.
     * Cambia la vista al Vista.VISTA2.
     */
  pulsarEnlace1 () {
    this.controlador.verVista(Vista.VISTA2)
  }

  /**
     * Acción al hacer clic en el enlace2.
     * Cambia la vista al Vista.VISTA5.
     */
  pulsarEnlace2 () {
    this.controlador.verVista(Vista.VISTA5)
  }

  /**
     * Llamada a AJAX por get para recoger la configuración del juego.
     * Guarda la configuración en un object y llama a verResultadoAJAXConfig();
     */
  llamarAJAXConfig = () => {
    // Recojo los valores... validaciones... si todo está bien
    const params = {}

    // Rest.getJSON('php/ajax1.php', params, this.verResultadoAJAX)
    Rest.getJSON('php/controladores/ajax/ajaxConfig.php', params, this.verResultadoAJAXConfig)
  }

  /**
     * Recogida de datos de la configuración
     * Guarda los datos obtenidos en un objeto global.
     *
     * @param {object} objeto - Objeto obtenido al recibir el JSON
     */
  verResultadoAJAXConfig = (objeto) => {
    Vista.config = objeto
    console.log(Vista.config.nPregunta)

    console.log(objeto);
    // console.log(this.nPregunta);
  }
}
