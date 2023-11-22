import { Vista } from "./vista.js";

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
        const tiempoLimite = 30; // 5 segundos de cuenta regresiva
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
} 
