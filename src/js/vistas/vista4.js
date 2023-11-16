import {Vista} from "./vista.js"
export class Vista4 extends Vista{

    constructor(controlador,base){
        super(controlador,base)
        this.crearInterfaz()
		this.validacionFormulario()
    }

    crearInterfaz() {
		// Crear el objeto formulario
		this.formulario = document.createElement("form");
	
		// Crear un elemento <p> que explique al usuario la forma de introducir su nombre
		this.explicacionRegex = document.createElement("p");
		this.explicacionRegex.textContent = "El nombre de usuario debe contener las dos primeras iniciales de la provincia elegida. Por ejemplo, si seleccionas Badajoz, tu nombre sería BAvi123.";
	
		// Crear un párrafo donde se muestran los puntos obtenidos en total
		this.puntos = document.createElement("h2");
		this.puntos.textContent = "¡Has obtenido (cantidad de puntos) en tu partida!";
	
		// Crear botón para enviar el formulario
		this.irInicio = document.createElement("button");
		this.irInicio.textContent = "Enviar formulario";
	
		// Crear el objeto label de título
		this.titulo = document.createElement("label");
	
		// Crear el objeto caja de texto Nombres
		this.cajaTextNombres = document.createElement("input");
	
		// Crear el objeto botón
		this.boton = document.createElement("input");
	
		// Asignar atributos al objeto formulario
		this.formulario.setAttribute('method', "post");
		this.formulario.setAttribute('action', "");
		this.formulario.setAttribute('style', "width:300px;margin: 0px auto");
	
		// Asignar atributos al objeto caja de texto de Nombres
		this.cajaTextNombres.setAttribute('type', "text");
		this.cajaTextNombres.setAttribute('placeholder', "Nickname");
		this.cajaTextNombres.setAttribute('style', "width:100%;margin: 10px 0px;padding: 5px");
	
		// Asignar atributos al objeto botón
		this.boton.setAttribute('type', "button");
		this.boton.setAttribute('value', "Enviar");
		this.boton.setAttribute('style', "width:100px;margin: 10px 0px;padding: 10px;background:#F05133;color:#fff;border:solid 1px #000;");
		this.boton.setAttribute('onclick', "alert('Se envió el mensaje')");
	
		this.titulo.innerHTML = '<h2>Registra tu puntuación</h2>';
		this.formulario.appendChild(this.titulo);
		this.formulario.appendChild(this.cajaTextNombres);
		this.formulario.appendChild(this.boton);
	
		// Obtener el elemento con ID "registro" para agregar el formulario
		document.getElementById("registro").appendChild(this.formulario);
	
		// Agregar elementos al contenedor base
		this.base.appendChild(this.titulo);
		this.base.appendChild(this.puntos);
		this.base.appendChild(this.explicacionRegex);
		this.base.appendChild(this.irInicio);
	
		// Al hacer clic en el botón, mostrar la vista correspondiente
		this.irInicio.onclick = () => {
			this.controlador.verVista(Vista.VISTA5);
		};
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