import { Vista } from './vista.js'

/**
 * Clase que representa una vista específica, extendiendo la clase base Vista.
 * @extends Vista
 */
export class Reflexiones extends Vista {
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
    this.botonContinuar = document.createElement('button');

    this.irIndex = document.createElement('button')
    this.irIndex.textContent = 'Registro'
    this.botonContinuar.textContent = 'Continuar'
    this.botonContinuar.setAttribute('id','botonContinuar')
    this.base.appendChild(this.botonContinuar)
    this.base.appendChild(this.irIndex)

    // Asignar evento al botón para volver a la vista de inicio
    this.irIndex.onclick = () => {
      this.controlador.verVista(Vista.VISTA4)
    }

    // Selecciona el botón por su ID
    // const botonContinuar = document.getElementById('botonContinuar');

    // Agrega un evento de clic al botón
    this.botonContinuar.addEventListener('click', () => {
        // Cambia a la vista deseada (VISTA3 en este caso)
        this.controlador.verVista(Vista.VISTA3);
    })
  }
}
