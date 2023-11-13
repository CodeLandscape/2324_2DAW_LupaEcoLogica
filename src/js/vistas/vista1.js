// vista1.js

export class Vista1 {
    constructor(juego) {
        this.intro = "Estás en el menu de inicio";
        this.juego = juego; // Ahora 'juego' es un nodo DOM, no el objeto Juego completo
        this.tablero = new Image();
    }

    iniciar() {
        let encabezado = document.createElement("h1");
        encabezado.textContent = this.intro;

        this.juego.appendChild(encabezado);

        // Botón para navegar entre vistas
        const botonVista2 = document.createElement("button");
        botonVista2.textContent = "Mover a vista 2";
        botonVista2.onclick = () => {
            this.irAvista2();
        };
        this.juego.appendChild(botonVista2);
    }

    irAvista2 = () => {
        console.log(this.juego);
        this.juego.mostrarVista2();
    }

    ocultar() {
        this.juego.style.display = "none";
    }
}
