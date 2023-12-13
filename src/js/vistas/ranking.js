/* eslint-disable no-tabs */
import { Vista } from './vista.js'
import { Rest } from '../servicios/rest.js'
/**
 * Clase que representa una vista específica, extendiendo la clase base Vista.
 * @extends Vista
 */
export class Ranking extends Vista {
  /**
     * Crea una instancia de Ranking.
     * @param {any} controlador - El controlador asociado a la vista.
     * @param {HTMLElement} base - El elemento base de la vista.
     */
  constructor (controlador, base) {
    super(controlador, base)
    this.crearInterfaz()
    this.llamarAJAX()
  }

  /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
  crearInterfaz () {
    // Crear botón para volver a la pantalla de inicio
    this.irIndex = document.createElement('button')
    this.irIndex.textContent = 'Inicio'
    this.irIndex.setAttribute('id','inicioRanking')
    this.irIndex.setAttribute('class','submit');
    this.base.appendChild(this.irIndex)
    
    // Asignar evento al botón para volver a la vista de inicio
    this.irIndex.onclick = () => {
      this.controlador.verVista(Vista.VISTA1)
    }
  }

  /**
	 * LLamada a AJAX por get para recoger los datos de las partidas.
     * Recoge los datos en un object y llama a verResultadoAJAX();
	 */
  llamarAJAX = () => {
    // Recojo los valores... validaciones... si todo está bien
    const params = {}

    // Rest.getJSON('php/ajax1.php', params, this.verResultadoAJAX)
    Rest.getJSON('php/controladores/ajax/ajaxRanking.php', params, this.verResultadoAJAX)
  }

  /**
	 * Recogida de los datos de las partidas.
     * Creación de la tabla de ranking.
     * @param {object} objeto - Objeto generado al recibir el JSON.
	 */
  verResultadoAJAX = (objeto) => {
    console.log(objeto)

    const contenedorTabla = document.getElementById('containerTabla')

    // Crear la tabla
    const tabla = document.createElement('table')
    tabla.setAttribute('id', 'tablaRanking')

    // Crear la fila de encabezado
    const encabezado = tabla.createTHead()
    encabezado.setAttribute('id', 'azul')
    const filaEncabezado = encabezado.insertRow()

    // Crear las celdas de encabezado usando las claves de los datos
    for (const clave in objeto[0]) {
      const th = document.createElement('th')
      th.textContent = clave
      filaEncabezado.appendChild(th)
    }

    // Crear el cuerpo de la tabla (tbody)
    const cuerpoTabla = tabla.createTBody()

    // Crear las filas de datos
    for (let i = 0; i < objeto.length; i++) {
      const filaDatos = cuerpoTabla.insertRow()

      for (const clave in objeto[i]) {
        const celda = filaDatos.insertCell()
        celda.textContent = objeto[i][clave]
      }
    }

    // Agregar la tabla al contenedor
    contenedorTabla.appendChild(tabla)
  }
}
