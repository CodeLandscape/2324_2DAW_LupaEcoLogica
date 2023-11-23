import { Vista } from "./vista.js";
import { Rest } from "../servicios/rest.js"
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
    constructor(controlador, base) {
        super(controlador, base);
        this.crearInterfaz();
        this.llamarAJAX();
    }

    /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
    crearInterfaz() {
        // Crear botón para volver a la pantalla de inicio
        this.irIndex = document.createElement("button");
        this.irIndex.textContent = "Inicio";
        this.base.appendChild(this.irIndex);
       
        // Asignar evento al botón para volver a la vista de inicio
        this.irIndex.onclick = () => {

            this.controlador.verVista(Vista.VISTA1);
        };
    }
    /**
	 * 
	 */
	llamarAJAX = () => {
		//Recojo los valores... validaciones... si todo está bien
		const params ={};
		
		//Rest.getJSON('php/ajax1.php', params, this.verResultadoAJAX)
		Rest.getJSON('php/controladores/ajax3.php', params, this.verResultadoAJAX);
	}
	/**
	 * 
	 */
	verResultadoAJAX = (objeto) => {
        console.log(objeto);
    
        let contenedorTabla = document.getElementById("containerTabla");
    
        // Crear la tabla
        let tabla = document.createElement('table');
        tabla.setAttribute("id", "tablaRanking");
    
        // Crear la fila de encabezado
        let encabezado = tabla.createTHead();
        encabezado.setAttribute("id", "azul");
        let filaEncabezado = encabezado.insertRow();
    
        // Crear las celdas de encabezado usando las claves de los datos
        for (let clave in objeto[0]) {
            let th = document.createElement('th');
            th.textContent = clave;
            filaEncabezado.appendChild(th);
        }
    
        // Crear el cuerpo de la tabla (tbody)
        let cuerpoTabla = tabla.createTBody();
    
        // Crear las filas de datos
        for (let i = 0; i < objeto.length; i++) {
            let filaDatos = cuerpoTabla.insertRow();
    
            for (let clave in objeto[i]) {
                let celda = filaDatos.insertCell();
                celda.textContent = objeto[i][clave];
            }
        }
    
        // Agregar la tabla al contenedor
        contenedorTabla.appendChild(tabla);
    }
    
}
