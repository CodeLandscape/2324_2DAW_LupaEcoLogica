import { Vista } from "./vistas/vista.js";
import { Vista1 } from "./vistas/vista1.js";
import { Vista2 } from "./vistas/vista2.js";
import { Vista3 } from "./vistas/vista3.js";
import { Vista4 } from "./vistas/vista4.js";
import { Vista5 } from "./vistas/vista5.js";
import { Modelo } from "./modelos/modelo.js";

/**
 * Controlador principal que gestiona las diferentes vistas y la interacción entre ellas.
 */
class Controlador {
    /**
     * Crea una instancia del Controlador.
     */
    constructor() {
        this.vistas = new Map();
        this.modelo = new Modelo();

        // Obtener los contenedores de las vistas
        const divVista1 = document.getElementById("menuInicio");
        const divVista2 = document.getElementById("busquedaObjetos");
        const divVista3 = document.getElementById("rondaPreguntas");
        const divVista4 = document.getElementById("registro");
        const divVista5 = document.getElementById("ranking");

        // Crear instancias de las vistas y asignarlas a los contenedores correspondientes
        this.vistas.set(Vista.VISTA1, new Vista1(this, divVista1));
        this.vistas.set(Vista.VISTA2, new Vista2(this, divVista2));
        this.vistas.set(Vista.VISTA3, new Vista3(this, divVista3));
        this.vistas.set(Vista.VISTA4, new Vista4(this, divVista4));
        this.vistas.set(Vista.VISTA5, new Vista5(this, divVista5));

        // Mostrar la primera vista al cargar la página
        this.verVista(Vista.VISTA1);
    }

    /**
     * Muestra una vista específica.
     * @param {Symbol} vista - El símbolo que identifica a la vista a mostrar.
     */
    verVista(vista) {
        this.ocultarVistas();
        this.vistas.get(vista).mostrar(true);
    }

    /**
     * Oculta todas las vistas.
     */
    ocultarVistas() {
        for (let vista of this.vistas.values()) {
            vista.mostrar(false);
        }
    }
}

// Inicializar el controlador al cargar la página
window.onload = () => {
    new Controlador();
};
