export class Vista{
    static{
        Vista.VISTA1 = Symbol("Inicio")
        Vista.VISTA2 = Symbol("BusquedaObjetos")
        Vista.VISTA3 = Symbol("Preguntas")
        Vista.VISTA4 = Symbol("Registro")
        Vista.VISTA5 = Symbol("Ranking")

    } 
    constructor(controlador,base){
        this.controlador=controlador
        this.base = base
    }

    mostrar(ver)
    {
        if(ver)
        
            this.base.style.display="block"
        
        else
            this.base.style.display="none"
        
    }
        
}

