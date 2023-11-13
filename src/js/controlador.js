//////imports de las vistas
import {Vista1} from "./vistas/vista1.js"


class Juego
{
    constructor(divJuego)
    {
        this.divJuego = divJuego
        this.inicio = this.divJuego.querySelectorAll('div')[0]
        this.vista1 = new Vista1(this,this.inicio)
    }
}


window.onload = () => {
	// resizeTo(1900, 1000)	//200px para inventario
	const div = document.getElementById('juego')
	new Juego(div)
}