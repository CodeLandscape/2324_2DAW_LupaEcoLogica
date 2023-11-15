import {Vista} from "./vista.js"
export class Vista3 extends Vista{

    constructor(controlador,base){
        super(controlador,base)
        this.crearInterfaz()
    }

    crearInterfaz()
    {
        //crear boton
        this.respuestaSi =document.createElement("button")
        this.respuestaNo =document.createElement("button")
        this.registro =document.createElement("button")
        this.pregunta = document.createElement("p")
        this.pregunta.textContent="Pregunta generada en base a la categoria del tablero"

        this.respuestaSi.textContent= "SI"
        this.respuestaNo.textContent= "NO"
        this.registro.textContent="Ir al registro"
        this.base.appendChild(this.pregunta)
        this.base.appendChild(this.respuestaSi)
        this.base.appendChild(this.respuestaNo)
        this.base.appendChild(this.registro)


        //IMPLEMENTAR QUE CADA PREGUNTA SEA UNA VISTA, PUDIENDO ASI CREAR LA PREGUNTA RANDOM

        this.registro.onclick= () => {
            this.controlador.verVista(Vista.VISTA4)
        }
       
       
    }
    
}