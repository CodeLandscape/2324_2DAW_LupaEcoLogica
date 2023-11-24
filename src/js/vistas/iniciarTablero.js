import { Vista } from "./vista.js";
import { Rest } from "../servicios/rest.js";
/**
 * Clase que representa una vista específica, extendiendo la clase base Vista.
 * @extends Vista
 */
export class IniciarTablero extends Vista {
    /**
     * Crea una instancia de IniciarTablero.
     * @param {any} controlador - El controlador asociado a la vista.
     * @param {HTMLElement} base - El elemento base de la vista.
     */
    constructor(controlador, base) {
        super(controlador, base);
        this.llamarAJAXTablero();
        //this.llamarAJAXFondo(); //Agregar la imagen de la id sacada.
        this.crearInterfaz();
    }

    /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
    crearInterfaz() {
        // Crear elementos HTML y configurar atributos
        this.botonvista3 = document.createElement("button");
        this.botonCrono = document.createElement("button");
        this.botonCrono.textContent = "¡Comenzar partida!";
        this.botonCrono.setAttribute("id", "botonCrono");
        this.botonvista3.setAttribute("id", "botonvista3");
        this.base.appendChild(this.botonCrono);

        this.explicacionJuego = document.createElement("p");
        this.tiempoRestante = document.createElement("p"); // Elemento para mostrar el tiempo restante
        this.explicacionJuego.textContent = "En esta primera fase tu misión consiste en encontrar todos los objetos maliciosos del entorno. ¡Mucho ánimo con tu búsqueda!";
        this.base.appendChild(this.explicacionJuego);
        this.base.appendChild(this.tiempoRestante); // Agregar elemento del tiempo restante
        this.base.appendChild(this.botonvista3);
        this.botonvista3.textContent = "Ir a las preguntas";



        // Agregar eventos a los botones
        this.botonCrono.onclick = () => {
            this.footer = document.getElementById("pie");
            this.footer.textContent = "Tablero"; //Se cogerá de la base de datos el nombre del tablero, footer temporal!!!
            this.botonCrono.style.display = "none";

            this.capturarObjetos();
            this.iniciarCuentaRegresiva();
        };
        


        this.botonvista3.onclick = () => {
            this.controlador.verVista(Vista.VISTA3);
        };
    }

    /**
     * Inicia una cuenta regresiva y cambia a la vista 3 cuando el tiempo llega a cero.
     */
    iniciarCuentaRegresiva() {
        console.log(Vista.config.tiempoCrono);
        const tiempoLimite = Vista.config.tiempoCrono; // 5 segundos de cuenta regresiva
        let tiempoRestante = tiempoLimite;
        this.tiempoRestante.setAttribute("id", "tiempo");

        const actualizarTiempo = () => {
            this.tiempoRestante.textContent = `Tiempo restante: ${tiempoRestante} segundos`;

            if (tiempoRestante === 0) {
                clearInterval(cuentaRegresiva);
                // Cuando la cuenta regresiva llega a cero, pasar a la vista 3
                this.controlador.verVista(Vista.VISTA3);
            }

            tiempoRestante--;
        };

        // Mostrar inicialmente el tiempo restante y actualizar cada segundo
        actualizarTiempo();
        const cuentaRegresiva = setInterval(actualizarTiempo, 1000);
    }

    capturarObjetos(){
        this.objetomalo1 = document.getElementById("objetoMalo1");

        this.objetomalo1.onclick = () => {
            console.log("Objeto malo 1 capturado");
            this.añadirObjetoAside(this.objetomalo1);
        }
        this.objetomalo2 = document.getElementById("objetoMalo2");

        this.objetomalo2.onclick = () => {
            console.log("Objeto malo 2 capturado");
            this.añadirObjetoAside(this.objetomalo2);

        }
        this.objetomalo3 = document.getElementById("objetoMalo3");

        this.objetomalo3.onclick = () => {
            console.log("Objeto malo 3 capturado");
            this.añadirObjetoAside(this.objetomalo3);
        }
        this.objetoBueno1 = document.getElementById("objetoBueno1");

        this.objetoBueno1.onclick = () => {
            console.log("Objeto bueno 1 capturado");
            this.añadirObjetoAside(this.objetoBueno1);
        }
        this.objetoBueno2 = document.getElementById("objetoBueno2");

        this.objetoBueno2.onclick = () => {
            console.log("Objeto bueno 2 capturado");
            this.añadirObjetoAside(this.objetoBueno2);
        }
        this.objetoBueno3 = document.getElementById("objetoBueno3");

        this.objetoBueno3.onclick = () => {
            console.log("Objeto bueno 3 capturado");
            this.añadirObjetoAside(this.objetoBueno3);
        }
    }

    añadirObjetoAside(objeto){
        this.objeto = objeto;
        this.objeto.style.display = "none";
        this.aside = document.getElementById("objetosEncontrados");
        this.nuevoContenido = this.objeto.cloneNode(true);
        this.nuevoContenido.style.display = "block";
        this.nuevoContenido.id = "objeto1";
        this.aside.appendChild(this.nuevoContenido);

    }

    llamarAJAXTablero = () => {
		//Recojo los valores... validaciones... si todo está bien

		//Rest.getJSON('php/ajax1.php', params, this.verResultadoAJAX)
		Rest.getJSON('php/controladores/ajaxCateg.php', {'id': Vista.idCategoria}, this.verResultadoAJAXTablero);
    }

    verResultadoAJAXTablero = (objeto) => {
        Vista.idCategoria = objeto.idCategoria;
        Vista.nomTablero = objeto.nombre;
        console.log(Vista.idCategoria);
        console.log(Vista.idCategoria,Vista.nomTablero);
        this.llamarAJAXFondo();
    }

    llamarAJAXFondo = () => {
        console.log(Vista.idCategoria);
        // Recojo los valores... validaciones... si todo está bien
        const params = {
            'id': Vista.idCategoria
        };
    
        // Rest.getJSON('php/ajax1.php', params, this.verResultadoAJAX)
        Rest.post('php/controladores/ajaxFondo.php', params, this.verResultadoAJAXFondo);
    }
    
    verResultadoAJAXFondo = (objeto) => {
        console.log('Resultado POST:', objeto);
		if (objeto) {
			const fondo=document.getElementById("fondo");
			//Establece el contenido del párrafo con los datos de la fila
			fondo.src = "data:image/png;base64," + objeto.imagen;
			fondo.alt = Vista.nomTablero;
            this.llamarAJAXObjeto();
		} else {
			console.error('La respuesta del servidor no contiene datos de imagen.');
		}
    }

    llamarAJAXObjeto = () => {
        console.log(Vista.idCategoria);
        // Recojo los valores... validaciones... si todo está bien
        const params = {
            'id': Vista.idCategoria
        };
    
        // Rest.getJSON('php/ajax1.php', params, this.verResultadoAJAX)
        Rest.post('php/controladores/ajaxObjeto.php', params, this.verResultadoAJAXObjeto);
    }
    
    verResultadoAJAXObjeto = (objeto) => {
        console.log('Resultado POST:', objeto);
       // console.log(objeto[0].idObjeto);
        // const fondo=document.createElement('img');
		// 	//Establece el contenido del párrafo con los datos de la fila
		// 	fondo.src = "data:image/png;base64," + objeto[0].imagen;
		// 	fondo.alt = Vista.nomTablero;
        // document.body.appendChild(fondo);  
		this.crearObjetos(objeto);
    }

    crearObjetos(tablaObjeto){
        let nObjetosBuenos = Vista.config.nObjetosBuenos;
        const objetosBuenos = [];
        const objetosMalos = [];

        tablaObjeto.forEach(objeto => {
            if (objeto.valoracion === '0' && objetosBuenos.length < nObjetosBuenos) {
                objetosBuenos.push(objeto);
            } else {
                objetosMalos.push(objeto);
                console.log(objetosMalos);
            }
        });
        this.visualizarObjetos(objetosBuenos, objetosMalos);

    }

    visualizarObjetos(buenos,malos){
        this.objetomalo1 = document.getElementById("objetoMalo1");
        this.objetomalo1.src=malos[0].imagen;
        this.objetomalo1.alt=malos[0].nombre;

        this.objetomalo2 = document.getElementById("objetoMalo2");
        this.objetomalo2.src=malos[1].imagen;
        this.objetomalo2.alt=malos[1].nombre;

        this.objetomalo3 = document.getElementById("objetoMalo3");
        this.objetomalo3.src=malos[2].imagen;
        this.objetomalo3.alt=malos[2].nombre;

        this.objetoBueno1 = document.getElementById("objetoBueno1");
        this.objetoBueno1.src=buenos[0].imagen;
        this.objetoBueno1.alt=buenos[0].nombre;

        this.objetoBueno2 = document.getElementById("objetoBueno2");
        this.objetoBueno2.src=buenos[1].imagen;
        this.objetoBueno2.alt=buenos[1].nombre;

        this.objetoBueno3 = document.getElementById("objetoBueno3");
        this.objetoBueno3.src=buenos[2].imagen;
        this.objetoBueno3.alt=buenos[2].nombre;

    }
} 