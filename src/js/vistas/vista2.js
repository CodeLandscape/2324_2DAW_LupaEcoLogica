export class Vista2 {
    constructor(juego) {
        this.intro = "Estás en el tablero de juego";
        this.juego = juego;
    }

    iniciar() {
        let encabezado = document.createElement("h1");
        encabezado.textContent = this.intro;

        this.juego.divJuego.appendChild(encabezado);
    }

    ocultar() {
        this.juego.style.display = "none";
    }
}