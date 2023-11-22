import { Vista } from "./vista.js";
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
    }

    /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
    crearInterfaz() {
        // Crear botón para volver a la pantalla de inicio
        this.irIndex = document.createElement("button");
        this.irIndex.textContent = "Volver a pantalla de inicio";
        this.base.appendChild(this.irIndex);

        // Asignar evento al botón para volver a la vista de inicio
        this.irIndex.onclick = () => {

            this.controlador.verVista(Vista.VISTA1);
        };
    }
}
