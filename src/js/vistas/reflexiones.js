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

  mostrar(ver){
    this.actualizarPuntuacion(Vista.puntuacion);
    super.mostrar(ver); 
  }

  /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
  crearInterfaz () {
    this.botonContinuar = document.createElement('button');

    this.botonContinuar.textContent = 'Continuar'
    this.botonContinuar.setAttribute('id','botonContinuar')
    this.botonContinuar.setAttribute('class','submit');
    this.base.appendChild(this.botonContinuar)

    this.iniciarPuntuacion()

    // Selecciona el botón por su ID
    // const botonContinuar = document.getElementById('botonContinuar');

    // Agrega un evento de clic al botón
    this.botonContinuar.addEventListener('click', () => {
        // Cambia a la vista deseada (VISTA3 en este caso)
        this.controlador.verVista(Vista.VISTA3);
    })
  }

  iniciarPuntuacion() {
    this.contenedorPuntuacion = document.createElement('header');
    this.h1Puntuacion = document.createElement('h1');

    this.actualizarPuntuacion(Vista.puntuacion);
    this.base.appendChild(this.contenedorPuntuacion)
    this.contenedorPuntuacion.appendChild(this.h1Puntuacion);
  }

  actualizarPuntuacion(puntuacion) {
    // Verificar si la puntuación es undefined y establecerla en 0 si es el caso
    if (puntuacion === undefined) {
      Vista.puntuacion = 0;
  }
this.h1Puntuacion.textContent = `${Vista.puntuacion} puntos`;
}
}
