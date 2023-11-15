import {Vista} from "./vista.js"
export class Vista5 extends Vista{

    constructor(controlador,base){
        super(controlador,base)
        this.crearInterfaz()
    }

    crearInterfaz()
    {
        //crear boton
       
        this.irIndex =document.createElement("button")
        

       
        this.irIndex.textContent="Volver a pantalla de inicio"
     
        this.base.appendChild(this.irIndex)


        //IMPLEMENTAR QUE CADA PREGUNTA SEA UNA VISTA, PUDIENDO ASI CREAR LA PREGUNTA RANDOM

        this.irIndex.onclick= () => {
            this.controlador.verVista(Vista.VISTA1)
        }
       
       
    }
    
}