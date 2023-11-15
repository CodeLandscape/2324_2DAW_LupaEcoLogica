
import {Vista} from "./vistas/vista.js"
import {Vista1} from "./vistas/vista1.js"
import {Vista2} from "./vistas/vista2.js"
import {Vista3} from "./vistas/vista3.js"
import {Vista4} from "./vistas/vista4.js"
import {Vista5} from "./vistas/vista5.js"
import {Modelo} from "./modelos/modelo.js"

class Controlador{


    vistas = new Map()

    constructor(){
        this.modelo = new Modelo()
        const divVista1= document.getElementById("menuInicio")
        const divVista2= document.getElementById("busquedaObjetos")
        const divVista3= document.getElementById("rondaPreguntas")
        const divVista4 = document.getElementById("registro")
        const divVista5= document.getElementById("ranking")

        //creo las vistas

        this.vistas.set(Vista.VISTA1,new Vista1(this,divVista1))
        this.vistas.set(Vista.VISTA2,new Vista2(this,divVista2))
        this.vistas.set(Vista.VISTA3,new Vista3(this,divVista3))
        this.vistas.set(Vista.VISTA4,new Vista4(this,divVista4))
        this.vistas.set(Vista.VISTA5,new Vista5(this,divVista5))

        

        this.verVista(Vista.VISTA1)
    }

    //muestra una vista y el param Symbol que identifica a la vista 
    verVista(vista)
    {
        this.ocultarVistas()
        this.vistas.get(vista).mostrar(true)
    }
  
    ocultarVistas()
    {
       for(let vista of this.vistas.values())
       {
        vista.mostrar(false)
       }
    }
  
}

window.onload = () => {new Controlador()}