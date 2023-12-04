import { Vista } from "./vista.js";

/**
 * Clase que representa una vista específica, extendiendo la clase base Vista.
 * @extends Vista
 */
export class Vista3 extends Vista {
    /**
     * Crea una instancia de Vista3.
     * @param {any} controlador - El controlador asociado a la vista.
     * @param {HTMLElement} base - El elemento base de la vista.
     */
    constructor(controlador, base) {
        super(controlador, base);
        this.crearInterfaz();
        this.previsionTiempo();
    }

    /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
    crearInterfaz() {
        // Crear botones y párrafo de pregunta
        this.respuestaSi = document.createElement("button");
        this.respuestaNo = document.createElement("button");
        this.registro = document.createElement("button");
        this.pregunta = document.createElement("p");
        this.pregunta.textContent = "Pregunta generada en base a la categoría del tablero";

        // Configurar texto para los botones
        this.respuestaSi.textContent = "SI";
        this.respuestaNo.textContent = "NO";
        this.registro.textContent = "Ir al registro";

        // Agregar elementos al elemento base
        this.base.appendChild(this.pregunta);
        this.base.appendChild(this.respuestaSi);
        this.base.appendChild(this.respuestaNo);
        this.base.appendChild(this.registro);

        // Asignar evento al botón de registro
        this.registro.onclick = () => {
            this.controlador.verVista(Vista.VISTA4);
        };
    }

    /**
     * Realiza una solicitud a una API de pronóstico del tiempo.
     * Muestra el resultado en un mensaje de alerta.
     */
    previsionTiempo() {
        // URL y token de acceso a la API de AEMET
        this.aemetAPIUrl = 'https://opendata.aemet.es/opendata/api/prediccion/ccaa/manana/ext';
        this.apiToken = 'eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJsdGFiYXJlc2xvemFuby5ndWFkYWx1cGVAYWx1bW5hZG8uZnVuZGFjaW9ubG95b2xhLm5ldCIsImp0aSI6IjQ5NzViMWYwLTY1ODItNDVhYi1iZWM0LTg2MWViODgyMWM2NCIsImlzcyI6IkFFTUVUIiwiaWF0IjoxNzAwMTU5NjQ4LCJ1c2VySWQiOiI0OTc1YjFmMC02NTgyLTQ1YWItYmVjNC04NjFlYjg4MjFjNjQiLCJyb2xlIjoiIn0.OllY8QryZO9Dk2_1JuXcVnzSLn4IWETtfcKaD_Qc7LQ'; //token de acceso a la api de aemet

        // Construir la URL final incluyendo el token de acceso
        this.url = `${this.aemetAPIUrl}?api_key=${this.apiToken}`;

        // Realizar la solicitud utilizando fetch
        fetch(this.url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('ERROR DE NETWORK');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                alert("Si miras este enlace verás el tiempo de mañana, de nada " + data.datos);
            })
            .catch(error => {
                console.error('ERROR WEB LA PETICION:', error);
            });
    }
}
