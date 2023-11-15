import {Vista} from "./vista.js"

export class Vista1 extends Vista{

    constructor(controlador,base)
    {
        super(controlador,base)
        //coger referencia del interfaz
        this.enlace1 = document.createElement("button")
        this.enlace1.textContent= "Jugar partida"
        this.enlace2= document.createElement("button")
        this.enlace2.textContent="Ver ranking de jugadores registrados"
        this.titulo= document.createElement("h1")
        this.titulo.textContent= "Bienvenido a Lupa Eco-Logica"
       
        //aspciar ebventos
        this.base.appendChild(this.titulo)
        this.base.appendChild(this.enlace1)
        this.base.appendChild(this.enlace2)
        this.enlace1.onclick = this.pulsarEnlace1.bind(this)
        this.enlace2.onclick = this.pulsarEnlace2.bind(this)
    }

    pulsarEnlace1()
    {
        this.controlador.verVista(Vista.VISTA2)
    }

    pulsarEnlace2()
    {
        this.controlador.verVista(Vista.VISTA5)
    }
}