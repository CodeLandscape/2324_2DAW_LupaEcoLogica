import { Vista1 } from "./vistas/vista1.js";
import { Vista2 } from "./vistas/vista2.js";

class Juego {
    constructor(divJuego) {
        this.divJuego = divJuego;
        this.inicio = this.divJuego.querySelector('#menuInicio');
        this.vista1 = new Vista1(this.divJuego, this);
        this.vistaActual = null;
    }

    mostrarVista2() {
        if (this.vistaActual) {
            this.vistaActual.ocultar();
        }

        const vista2 = new Vista2(this.divJuego, this); // Cambiado de 'this' a 'this.divJuego'
        vista2.iniciar();

        this.vistaActual = vista2;
    }
}

window.onload = () => {
    const div = document.getElementById('juego');
    const juego = new Juego(div);
    juego.vista1.iniciar();
};
