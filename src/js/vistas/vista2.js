import { Vista } from "./vista.js";

export class Vista2 extends Vista {
    constructor(controlador, base) {
        super(controlador, base);
        this.crearInterfaz();
        this.iniciarCuentaRegresiva()
    }

    crearInterfaz() {
        // Crear elementos HTML
        this.botonvista3 = document.createElement("button");
        this.explicacionJuego = document.createElement("p");
        this.tiempoRestante = document.createElement("p"); // Elemento para mostrar el tiempo restante
        this.explicacionJuego.textContent = "En esta primera fase tu misión consiste en encontrar todos los objetos maliciosos del entorno. ¡Mucho ánimo con tu búsqueda!";
        this.base.appendChild(this.explicacionJuego);
        this.base.appendChild(this.tiempoRestante); // Agregar elemento del tiempo restante
        this.base.appendChild(this.botonvista3);
        this.botonvista3.textContent = "Ir a las preguntas";
        this.botonvista3.onclick = () => {
            this.controlador.verVista(Vista.VISTA3);
        };
    }

    iniciarCuentaRegresiva() {
        const tiempoLimite = 90; // 1 minuto y medio en segundos
        let tiempoRestante = tiempoLimite;
        this.tiempoRestante.setAttribute("id","cuentaAtras")

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
      // Método para mostrar la vista y comenzar la cuenta regresiva
      mostrarVista() {
        this.iniciarCuentaRegresiva(); // Iniciar la cuenta regresiva cuando se muestra la vista
    }
   
}
