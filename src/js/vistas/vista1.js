export class Vista1 {
    constructor(juego) {
        this.intro = "Estás en el menú de inicio";
        this.juego = juego;
    }

    iniciar() {
        let encabezado = document.createElement("h1");
        encabezado.textContent = this.intro;

        this.juego.divJuego.appendChild(encabezado);

        // Botón para navegar entre vistas
        const botonVista2 = document.createElement("button");
        botonVista2.textContent = "Mover a vista 2";
        botonVista2.onclick = () => {
            this.juego.mostrarVista2();
        };
        this.juego.divJuego.appendChild(botonVista2);
    }
    ocultar() {
        this.juego.style.display = "none";
    }
}
