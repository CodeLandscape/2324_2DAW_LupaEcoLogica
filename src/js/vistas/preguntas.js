/* eslint-disable no-tabs */
import { Vista } from './vista.js';
// eslint-disable-next-line no-unused-vars

/**
 * Clase que representa una vista específica, extendiendo la clase base Vista.
 * @extends Vista
 */
export class Preguntas extends Vista {
  constructor(controlador, base, config,puntuacion) {
    super(controlador, base, config,puntuacion);
    this.crearInterfaz();
    this.i = 0;
  }

  mostrar(ver){
    this.actualizarPuntuacion(Vista.puntuacion);
    super.mostrar(ver); 
  }

  iniciarPuntuacion() {
    this.contenedorPuntuacion = document.createElement('div');
    this.actualizarPuntuacion(Vista.puntuacion);
    this.base.appendChild(this.contenedorPuntuacion)
  }
  
  crearInterfaz() {
    this.respuestaSi = document.createElement('button');
    this.respuestaNo = document.createElement('button');
    this.registro = document.createElement('button');
 
    this.respuestaSi.id = 'botonSiPregunta';
    this.respuestaNo.id = 'botonNoPregunta';
    this.respuestaSi.textContent = 'SI';
    this.respuestaNo.textContent = 'NO';
    this.registro.textContent = 'Ir al registro';

    this.base.appendChild(this.respuestaSi);
    this.base.appendChild(this.respuestaNo);
    this.base.appendChild(this.registro);


    ///mostrar la puntuacion
    // this.contenedorPuntuacion.textContent = `Puntuación:`;
    // document.addEventListener('DOMContentLoaded', () => {
    //   console.log(Vista.puntuacion)
    //   this.puntuacionActual = Vista.puntuacion;
    //   this.actualizarPuntuacion(this.puntuacionActual);
    // });
    
    // this.base.appendChild(this.contenedorPuntuacion);
    this.iniciarPuntuacion();

    this.registro.onclick = () => {
      this.controlador.verVista(Vista.VISTA4);
    };

    this.respuestaSi.onclick = () => this.procesarRespuestaSi();
    this.respuestaNo.onclick = () => this.procesarRespuestaNo();
  }

  procesarRespuestaSi() {
    this.desactivarEventos();
    this.procesarRespuesta(1);
  }

  procesarRespuestaNo() {
    this.desactivarEventos();
    this.procesarRespuesta(0);
  }

  procesarRespuesta(respuesta) {
    this.desactivarEventos();

  
    console.log('Entrando en procesarRespuesta');
    console.log('Dentro del bucle. Iteración:', this.i);
      this.imagenCorrecto = document.getElementById('imagenCorrecto'+this.i)
      this.imagenFallo = document.getElementById('imagenFallo'+this.i)
      this.reflexionPositiva = document.getElementById('acierto' + this.i);
      this.reflexionNegativa = document.getElementById('fallo' + this.i);
  
      console.log("Respuesta esperada:", Vista.pregunta[this.i].respuesta);
      console.log("Respuesta proporcionada:", respuesta);
  
      if (Number(Vista.pregunta[this.i].respuesta) === Number(respuesta)) {
        Vista.puntuacion += Vista.pregunta[this.i].puntuacion;
        this.actualizarPuntuacion(Vista.puntuacion);
        console.log("Puntuación actualizada:", Vista.puntuacion);
        this.reflexionPositiva.style.display = 'block';
        this.imagenCorrecto.style.display = 'block'
        this.reflexionNegativa.style.display = 'none';
        this.imagenFallo.style.display = 'none'
      } else {
        console.log("Respuesta incorrecta.");
        this.reflexionNegativa.style.display = 'block';
        this.imagenFallo.style.display = 'block'
        this.reflexionPositiva.style.display = 'none';
        this.imagenCorrecto.style.display = 'none'
      }
      this.i= this.i + 1;
    
  
    console.log('Saliendo de procesarRespuesta');
  
    this.controlador.verVista(Vista.VISTA3_1);
    this.activarEventos();
  }

  actualizarPuntuacion(puntuacion) {
    this.contenedorPuntuacion.textContent = `Puntuación: ${puntuacion}`;
  }
  

  desactivarEventos() {
    this.respuestaSi.disabled = true;
    this.respuestaNo.disabled = true;
  }

  activarEventos() {
    this.respuestaSi.disabled = false;
    this.respuestaNo.disabled = false;
  }
}

