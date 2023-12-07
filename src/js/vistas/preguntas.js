/* eslint-disable no-tabs */
import { Vista } from './vista.js'
// eslint-disable-next-line no-unused-vars
import { Rest } from '../servicios/rest.js'

/**
 * Clase que representa una vista específica, extendiendo la clase base Vista.
 * @extends Vista
 */
export class Preguntas extends Vista {
  /**
     * Crea una instancia de Preguntas.
     * @param {any} controlador - El controlador asociado a la vista.
     * @param {HTMLElement} base - El elemento base de la vista.
     */
  constructor (controlador, base, config) {
    super(controlador, base, config)
    this.crearInterfaz()
  }

  /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
  crearInterfaz () {
    // Crear botones y párrafo de pregunta
    this.respuestaSi = document.createElement('button')
    this.respuestaNo = document.createElement('button')
    this.registro = document.createElement('button')

    // Configurar texto para los botones
    this.respuestaSi.id = 'botonSiPregunta'
    this.respuestaNo.id = 'botonNoPregunta'
    this.respuestaSi.textContent = 'SI'
    this.respuestaNo.textContent = 'NO'
    this.registro.textContent = 'Ir al registro'

    // Agregar elementos al elemento base
    this.base.appendChild(this.respuestaSi)
    this.base.appendChild(this.respuestaNo)
    this.base.appendChild(this.registro)

    this.respuestaSi.onclick = () => {
      console.log(Vista.puntuacion)
      let nPregunta = Vista.config.nPregunta
      // Bucle de las preguntas
      for(let i=0;i<nPregunta;i++){
        if (Vista.pregunta[i].respuesta == 0){
          this.reflexionPositiva = document.getElementById('acierto'+i);
        this.reflexionPositiva.style.display = 'block'
        }else{
        this.reflexionNegativa = document.getElementById('fallo'+i);
        this.reflexionNegativa.style.display = 'block'
      }
      this.controlador.verVista(Vista.VISTA3_1)
    }

    this.respuestaNo.onclick = () => {
      this.controlador.verVista(Vista.VISTA3_1)
    }
    // Asignar evento al botón de registro
    this.registro.onclick = () => {
      this.controlador.verVista(Vista.VISTA4)
    }
  }
}
}
