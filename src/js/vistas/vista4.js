import {Vista} from "./vista.js"
export class Vista4 extends Vista{

    constructor(controlador,base){
        super(controlador,base)
        this.crearInterfaz()
    }

    crearInterfaz()
    {
        ////Crear el objeto formulario
		this.formulario=document.createElement("form");
 
        //crear boton para ir al ranking
        this.irInicio=document.createElement("button")
        this.irInicio.textContent="Enviar formulario"

		////Crear el objeto label de titulo
		this.titulo=document.createElement("label");
 
		////Crear el objeto caja de texto Nombres
		 this.cajaTextNombres=document.createElement("input");
 
		////Crear el objeto boton
		this.boton=document.createElement("input");
 
		////Asignar atributos al objeto formulario
        	this.formulario.setAttribute('method', "post");//Asignar el atributo method
        	this.formulario.setAttribute('action', "");//Asignar el atributo action
        	this.formulario.setAttribute('style', "width:300px;margin: 0px auto");//Asignar el atributo style
 
        	////Asignar atributos al objeto caja de texto de Nombres
        	this.cajaTextNombres.setAttribute('type', "text");//Asignar el atributo type
        	this.cajaTextNombres.setAttribute('placeholder', "Nickname");//Asignar el atributo placeholder
        	this.cajaTextNombres.setAttribute('style', "width:100%;margin: 10px 0px;padding: 5px");//Asignar el atributo style
 
        	
 
		////Asignar atributos al objeto boton
		this.boton.setAttribute('type', "button");//Asignar el atributo type	
        	this.boton.setAttribute('value', "Enviar");//Asignar el atributo value
        	this.boton.setAttribute('style', "width:100px;margin: 10px 0px;padding: 10px;background:#F05133;color:#fff;border:solid 1px #000;");//Asignar el atributo style
        	this.boton.setAttribute('onclick', "alert('Se envio el mensaje')");//Asignar el metodo onclick
        	this.titulo.innerHTML='<h2>Registra tu puntuacion</h>';//Asignar el texto de titulo en el objeto titulo
        	this.formulario.appendChild(this.titulo);//Agregar el objeto titulo al objeto formulario
        	this.formulario.appendChild(this.cajaTextNombres);//Agregar el objeto caja de texto Nombres al objeto formulario
   
        	this.formulario.appendChild(this.boton);//Agregar el objeto boton al objeto formulario

            this.base.appendChild(this.titulo)
        	document.getElementById("registro").appendChild(this.formulario);//Agregar el formulario a la etiquete con el ID

            
            this.formulario.appendChild(this.irInicio)	

        //IMPLEMENTAR QUE CADA PREGUNTA SEA UNA VISTA, PUDIENDO ASI CREAR LA PREGUNTA RANDOM

        this.irInicio.onclick= () => {
            this.controlador.verVista(Vista.VISTA5)
        }
       
       
    }
    
}