import {Vista} from "./vista.js"

export class Vista2 extends Vista{
    constructor(controlador,base){
        super(controlador,base)
        this.crearInterfaz()
    }

    crearInterfaz()
    {
        //crear boton
        this.botonvista3 =document.createElement("button")
        this.explicacionJuego = document.createElement("p")
        this.explicacionJuego.textContent= "En esta primera fase tu mision consiste en encontrar todos los objetos maliciosos del entorno. ¡Mucho animo con tu busqueda!"
        this.base.appendChild(this.explicacionJuego)
        this.base.appendChild(this.botonvista3)
        this.botonvista3.textContent= "Ir a las preguntas"
        this.botonvista3.onclick= () => {
            this.controlador.verVista(Vista.VISTA3)
        }
       
       
    }

  
}