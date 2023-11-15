import {Vista} from "./vista.js"
export class Vista4 extends Vista{

    constructor(controlador,base){
        super(controlador,base)
        this.crearInterfaz()
		this.validacionFormulario()
    }

    crearInterfaz()
    {
        ////Crear el objeto formulario
		this.formulario=document.createElement("form");


		////CREA UN P QUE EXPLIQUE AL USUARIO LA FORMA PARA INTRODUCIR SU NOMBRE, EN BASE A LA COMUNIDAD ELEGIDA
		this.explicacionRegex=document.createElement("p")
		this.explicacionRegex.textContent="El nombre de usuario debe contener las dos primer iniciales de la provincia elegida. Por ejemplo si seleccionas Badajoz quedarías así tu nombre BAvi123"
 
		//crea un parrafo donde mostramos los puntos obtenidos en total
		this.puntos=document.createElement("h2")
		this.puntos.textContent="¡Has obtenido (cantidad de puntos) en tu partida!"

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
			this.base.appendChild(this.puntos)
        	document.getElementById("registro").appendChild(this.formulario);//Agregar el formulario a la etiquete con el ID

            this.base.appendChild(this.explicacionRegex)
            this.formulario.appendChild(this.irInicio)	

        //IMPLEMENTAR QUE CADA PREGUNTA SEA UNA VISTA, PUDIENDO ASI CREAR LA PREGUNTA RANDOM

        this.irInicio.onclick= () => {
            this.controlador.verVista(Vista.VISTA5)
        }
       
       
    }

	validacionFormulario()
	{
		this.nickUsu=document.querySelector("input")
		this.provincia =document.querySelector("select")

		this.nickUsu.style.backgroundColor="yellow"
		// this.nickUsu.onblur=() =>{
		// 	console.log("estoy en el formulario")
		// 	this.texto = this.nickUsu.value
			
		// 	// if(!this.texto.match(/^[A-Za-z]{2}[0-9]{3}$/))
		// 	// {
		// 	// 	window.alert("No es valido el nombre introducido")
		// 	// 	this.nickUsu.style.borderColor="red"
		// 	// }else{
		// 	// 	window.alert("El nombre de usuario esta disponible para el registro")
		// 	// 	this.nickUsu.style.borderColor="green"
		// 	// }
		// }

		this.provincia.onchange = () => {
			const texto = this.nickUsu.value;
		
			switch (this.provincia.value) {
			  case "Caceres":
				console.log("Caceres");
				if (!texto.match(/^(CA|ca)[A-Za-z]{2}[0-9]{3}$/)) {
				  window.alert("No es válido el nombre introducido para Caceres");
				  this.nickUsu.style.borderColor = "red";
				} else {
				  window.alert("El nombre de usuario es válido para Caceres");
				  this.nickUsu.style.borderColor = "green";
				}
				break;
				case "Badajoz":
					if (!texto.match(/^(BA|ba)[A-Za-z]{2}[0-9]{3}$/)) {
						window.alert("No es válido el nombre introducido para Badajoz");
						this.nickUsu.style.borderColor = "red";
					  } else {
						window.alert("El nombre de usuario es válido para Badajoz");
						this.nickUsu.style.borderColor = "green";
					  }
				break;
					case "Merida":
						if (!texto.match(/^(ME|me)[A-Za-z]{2}[0-9]{3}$/)) {
							window.alert("No es válido el nombre introducido para Merida");
							this.nickUsu.style.borderColor = "red";
						  } else {
							window.alert("El nombre de usuario es válido para Merida");
							this.nickUsu.style.borderColor = "green";
						  }
			  default:
				// Si no se selecciona una provincia específica, se puede restablecer el estilo del campo de entrada
				this.nickUsu.style.borderColor = "";
				break;
			}
		  };
	
	}
    
}