/* eslint-disable no-new */
import { Vista } from './vistas/vista.js'
import { Inicio } from './vistas/inicio.js'
import { IniciarTablero } from './vistas/iniciar_tablero.js'
import { Preguntas } from './vistas/preguntas.js'
import { Registro } from './vistas/registro.js'
import { Reflexiones } from './vistas/reflexiones.js'
import { Ranking } from './vistas/ranking.js'
import { Modelo } from './modelos/modelo.js'

/**
 * Controlador principal que gestiona las diferentes vistas y la interacción entre ellas.
 */
class Controlador {
  /**
     * Crea una instancia del Controlador.
     */
  constructor () {
    this.vistas = new Map()
    this.modelo = new Modelo()
    this.contador = false

    // Obtener los contenedores de las vistas
    const divVista1 = document.getElementById('menuInicio')
    const divVista2 = document.getElementById('busquedaObjetos')
    const divVista3 = document.getElementById('rondaPreguntas')
    // eslint-disable-next-line camelcase
    const divVista3_1 = document.getElementById('reflexionjuego')
    const divVista4 = document.getElementById('registro')
    const divVista5 = document.getElementById('ranking')

    // Crear instancias de las vistas y asignarlas a los contenedores correspondientes
    this.vistas.set(Vista.VISTA1, new Inicio(this, divVista1))
    this.vistas.set(Vista.VISTA2, new IniciarTablero(this, divVista2))
    this.vistas.set(Vista.VISTA3, new Preguntas(this, divVista3))
    this.vistas.set(Vista.VISTA4, new Registro(this, divVista4))
    this.vistas.set(Vista.VISTA5, new Ranking(this, divVista5))
    this.vistas.set(Vista.VISTA3_1, new Reflexiones(this, divVista3_1))

    // Mostrar la primera vista al cargar la página
    this.verVista(Vista.VISTA1)
  }

  /**
     * Muestra una vista específica.
     * @param {Symbol} vista - El símbolo que identifica a la vista a mostrar.
     */
    verVista(vista) {
    this.ocultarVistas()
  
    if (vista === Vista.VISTA3) {
      
      if (this.contador === false) {
        this.contador = 0;
      } 
      else {
        this.contador++;
      }
      if(this.contador != Vista.config.nPregunta){
        this.ocultarPreguntasReflexiones();
        this.pregunta = document.getElementById('preguntaJuego'+this.contador);
        this.pregunta.style.display= 'block';
        this.reflexion = document.getElementById('reflexion'+this.contador);
        this.reflexion.style.display='block';
        this.reflexion.setAttribute('class','preguntaJuego');
      }
      if (this.contador == Vista.config.nPregunta)
        vista = Vista.VISTA4
    }
    this.vistas.get(vista).mostrar(true)
  }

  /**
     * Oculta todas las vistas.
     */
  ocultarVistas () {
    for (const vista of this.vistas.values()) {
      vista.mostrar(false)
    }
  }
  ocultarPreguntasReflexiones(){
    this.pregunta1=document.getElementById('preguntaJuego0')
    this.pregunta1.style.display = 'none';
    this.pregunta2=document.getElementById('preguntaJuego1')
    this.pregunta2.style.display = 'none';
    this.pregunta3=document.getElementById('preguntaJuego2')
    this.pregunta3.style.display = 'none';
    this.reflexion1=document.getElementById('reflexion0')
    this.reflexion1.style.display = 'none'
    this.reflexion2=document.getElementById('reflexion1')
    this.reflexion2.style.display = 'none'
    this.reflexion3=document.getElementById('reflexion2')
    this.reflexion3.style.display = 'none'
  }
  
}

// Inicializar el controlador al cargar la página
window.onload = () => {
  new Controlador()
}