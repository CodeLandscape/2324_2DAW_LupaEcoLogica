export class Vista2 {
    constructor(juego) {
        this.intro = "Estás en el tablero de juego";
        this.juego = juego;
        this.tablero = new Image();
    }

    iniciar() {
        let encabezado = document.createElement("h1");
        encabezado.textContent = this.intro;

        this.juego.appendChild(encabezado);
    }

    ocultar() {
        this.juego.style.display = "none";
    }
}
