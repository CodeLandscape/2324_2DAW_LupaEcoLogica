/* eslint-disable no-tabs */
import { Vista } from './vista.js';
// eslint-disable-next-line no-unused-vars
import { Rest } from '../servicios/rest.js';

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
  constructor(controlador, base, config) {
    super(controlador, base, config);
    this.crearInterfaz();
  }

  /**
   * Crea la interfaz de la vista.
   * Crea elementos HTML, agrega eventos y define acciones.
   */
  crearInterfaz() {
    // Crear botones y párrafo de pregunta
    this.respuestaSi = document.createElement('button');
    this.respuestaNo = document.createElement('button');
    this.registro = document.createElement('button');

    // Configurar texto para los botones
    this.respuestaSi.id = 'botonSiPregunta';
    this.respuestaNo.id = 'botonNoPregunta';
    this.respuestaSi.textContent = 'SI';
    this.respuestaNo.textContent = 'NO';
    this.registro.textContent = 'Ir al registro';

    // Agregar elementos al elemento base
    this.base.appendChild(this.respuestaSi);
    this.base.appendChild(this.respuestaNo);
    this.base.appendChild(this.registro);

    this.respuestaSi.onclick = () => {
      this.procesarRespuesta(1);
    };

    this.respuestaNo.onclick = () => {
      this.procesarRespuesta(0);
    };

    // Asignar evento al botón de registro
    this.registro.onclick = () => {
      this.controlador.verVista(Vista.VISTA4);
    };
  }

  /**
   * Procesa la respuesta según el valor proporcionado.
   * @param {number} respuesta - El valor de la respuesta (1 o 0).
   */
  procesarRespuesta(respuesta) {
    let nPregunta = Vista.config.nPregunta;

    // Desactivar eventos antes de procesar la respuesta
    this.desactivarEventos();

    for (let i = 0; i < nPregunta; i++) {
      this.reflexionPositiva = document.getElementById('acierto' + i);
      this.reflexionNegativa = document.getElementById('fallo' + i);

      if (Vista.pregunta[i].respuesta === respuesta) {
        Vista.puntuacion += Vista.pregunta[i].puntuacion;
        console.log(Vista.puntuacion);
        this.reflexionPositiva.style.display = 'block';
        this.reflexionNegativa.style.display = 'none';
      } else {
        this.reflexionNegativa.style.display = 'block';
        this.reflexionPositiva.style.display = 'none';
      }
    }

    this.controlador.verVista(Vista.VISTA3_1);

    // Activar eventos después de cambiar de pregunta
    this.activarEventos();
  }

  /**
   * Desactiva los eventos de los botones de respuesta.
   */
  desactivarEventos() {
    this.respuestaSi.disabled = true;
    this.respuestaNo.disabled = true;
  }

  /**
   * Activa los eventos de los botones de respuesta.
   */
  activarEventos() {
    this.respuestaSi.disabled = false;
    this.respuestaNo.disabled = false;
  }
}
