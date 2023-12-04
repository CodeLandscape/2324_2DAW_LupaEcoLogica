/* eslint-disable eqeqeq */
import { Vista } from './vista.js'
import { Rest } from '../servicios/rest.js'

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
  constructor (controlador, base) {
    super(controlador, base)
    this.llamarAJAXTablero()
    this.objetosPulsados = 0 // Contador para rastrear objetos pulsados
    this.crearInterfaz()
  }

  /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
  crearInterfaz () {
    // Crear elementos HTML y configurar atributos
    this.botonCrono = document.createElement('button')
    this.botonCrono.textContent = '¡Comenzar partida!'
    this.botonCrono.setAttribute('id', 'botonCrono')
    this.base.appendChild(this.botonCrono)

    this.explicacionJuego = document.createElement('p')
    this.tiempoRestante = document.createElement('p') // Elemento para mostrar el tiempo restante
    this.explicacionJuego.textContent = 'En esta primera fase tu misión consiste en encontrar todos los objetos maliciosos del entorno. ¡Mucho ánimo con tu búsqueda!'
    this.base.appendChild(this.explicacionJuego)
    this.base.appendChild(this.tiempoRestante) // Agregar elemento del tiempo restante

    // Agregar eventos a los botones
    this.botonCrono.onclick = () => {
      this.footer = document.getElementById('pie')
      this.footer.textContent = Vista.nomTablero // Se cogerá de la base de datos el nombre del tablero, footer temporal!!!
      this.botonCrono.style.display = 'none'

      this.capturarObjetos()
      this.iniciarCuentaRegresiva()
    }
  }

  /**
     * Inicia una cuenta regresiva y cambia a la vista 3 cuando el tiempo llega a cero.
     */
  iniciarCuentaRegresiva() {
    const tiempoLimite = Vista.config.tiempoCrono; // 5 segundos de cuenta regresiva
    let tiempoRestante = tiempoLimite;
    let cuentaRegresivaEnPausa = false;
    let tiempoPausado = 0;
  
    this.tiempoRestante.setAttribute('id', 'tiempo');
  
    const actualizarTiempo = () => {
      this.tiempoRestante.textContent = `Tiempo restante: ${tiempoRestante} segundos`;
  
      if (tiempoRestante === 0) {
        clearInterval(cuentaRegresiva);
        this.controlador.verVista(Vista.VISTA3);
      }
  
      if (!cuentaRegresivaEnPausa) {
        tiempoRestante--;
      }
    };
  
    // Mostrar inicialmente el tiempo restante y actualizar cada segundo
    actualizarTiempo();
    let cuentaRegresiva = setInterval(actualizarTiempo, 1000);
  
    // Crear y configurar el botón de pausa
    const botonPausa = document.createElement('button')
    botonPausa.textContent = 'Pausar'
    botonPausa.id = 'botonPausa'

    // Agregar un evento de clic al botón de pausa para manejar la pausa/reanudación
    botonPausa.addEventListener('click', () => {
      if (!cuentaRegresivaEnPausa) {
        // Pausar la cuenta regresiva
        clearInterval(cuentaRegresiva)
        cuentaRegresivaEnPausa = true
        tiempoPausado = Date.now()
        botonPausa.textContent = 'Reanudar'
        this.pausa = true
      }
      else {
        // Reanudar la cuenta regresiva
        cuentaRegresivaEnPausa = false
        const tiempoPausaActual = Date.now()
        const tiempoPausadoMilisegundos = tiempoPausaActual - tiempoPausado
        tiempoPausado = 0
    
        tiempoRestante -= Math.floor(tiempoPausadoMilisegundos / 1000)
        
        // Reiniciar la cuenta regresiva con el nuevo tiempo restante
        cuentaRegresiva = setInterval(actualizarTiempo, 1000)
        botonPausa.textContent = 'Pausar'
        this.pausa = false
      }
    })

    // Agregar el botón de pausa al cuerpo del documento HTML
    document.body.appendChild(botonPausa);
  }
  
  /**
     * Captura los eventos de clic en objetos y actualiza el contador de objetos pulsados.
     */
  capturarObjetos () {
    this.objetomalo1 = document.getElementById('objetoMalo1')

    this.objetomalo1.onclick = () => {
      // Verificar si el juego no está en pausa antes de procesar el clic
      if (!this.pausa){
        console.log('Objeto malo 1 capturado')
        this.añadirObjetoAside(this.objetomalo1)
        this.verificarObjetosPulsados()
      }
    }
    this.objetomalo2 = document.getElementById('objetoMalo2')

    this.objetomalo2.onclick = () => {
      if (!this.pausa){
        console.log('Objeto malo 2 capturado')
        this.añadirObjetoAside(this.objetomalo2)
        this.verificarObjetosPulsados()
      }
    }
    this.objetomalo3 = document.getElementById('objetoMalo3')

    this.objetomalo3.onclick = () => {
      if (!this.pausa){
        console.log('Objeto malo 3 capturado')
        this.añadirObjetoAside(this.objetomalo3)
        this.verificarObjetosPulsados()
      }
    }
    this.objetoBueno1 = document.getElementById('objetoBueno1')

    this.objetoBueno1.onclick = () => {
      if (!this.pausa){
        console.log('Objeto bueno 1 capturado')
        this.añadirObjetoAside(this.objetoBueno1)
        this.verificarObjetosPulsados()
      }
    }
    this.objetoBueno2 = document.getElementById('objetoBueno2')

    this.objetoBueno2.onclick = () => {
      if (!this.pausa){
        console.log('Objeto bueno 2 capturado')
        this.añadirObjetoAside(this.objetoBueno2)
        this.verificarObjetosPulsados()
      }
    }
    this.objetoBueno3 = document.getElementById('objetoBueno3')

    this.objetoBueno3.onclick = () => {
      if (!this.pausa){
        console.log('Objeto bueno 3 capturado')
        this.añadirObjetoAside(this.objetoBueno3)
        this.verificarObjetosPulsados()
      }
    }
  }

  /**
     * Añade un objeto a la lista de objetos encontrados y verifica si todos los objetos han sido pulsados.
     * @param {HTMLElement} objeto - El objeto que se ha pulsado.
     */
  añadirObjetoAside (objeto) {
    this.objeto = objeto
    this.objeto.style.display = 'none'

    this.aside = document.getElementById('objetosEncontrados')
    this.nuevoContenido = this.objeto.cloneNode(true)
    this.nuevoContenido.style.display = 'block'
    this.nuevoContenido.id = 'objeto1'
    this.aside.appendChild(this.nuevoContenido)

  }

  /**
     * Realiza una llamada AJAX para obtener datos del tablero.
     */
  llamarAJAXTablero = () => {
    const params = {}
    Rest.getJSON('php/controladores/ajax/ajaxCateg.php', params, this.verResultadoAJAXTablero)
  }

  /**
     * Maneja los resultados de la llamada AJAX al tablero.
     * @param {object} objeto - Los datos obtenidos del tablero.
     */
  verResultadoAJAXTablero = (objeto) => {
    Vista.idCategoria = objeto.idCategoria
    Vista.nomTablero = objeto.nombre
    this.llamarAJAXFondo()
    this.llamarAJAXPregunta()
  }

  /**
     * Realiza una llamada AJAX para obtener datos del fondo del tablero.
     */
  llamarAJAXFondo = () => {
    const params = {
      id: Vista.idCategoria
    }

    Rest.post('php/controladores/ajax/ajaxFondo.php', params, this.verResultadoAJAXFondo)
  }

  /**
     * Maneja los resultados de la llamada AJAX al fondo del tablero.
     * @param {object} objeto - Los datos obtenidos del fondo.
     */
  verResultadoAJAXFondo = (objeto) => {
    if (objeto) {
      const fondo = document.getElementById('fondo')
      fondo.src = 'data:image/png;base64,' + objeto.imagen
      fondo.alt = Vista.nomTablero
      this.llamarAJAXObjeto()
    } else {
      console.error('La respuesta del servidor no contiene datos de imagen.')
    }
  }

  /**
     * Realiza una llamada AJAX para obtener datos de los objetos del tablero.
     */
  llamarAJAXObjeto = () => {
    const params = {
      id: Vista.idCategoria
    }

    Rest.post('php/controladores/ajax/ajaxObjeto.php', params, this.verResultadoAJAXObjeto)
  }

  /**
     * Maneja los resultados de la llamada AJAX a los objetos del tablero.
     * @param {Array} objeto - Los datos obtenidos de los objetos.
     */
  verResultadoAJAXObjeto = (objeto) => {
    this.crearObjetos(objeto)
  }

  /**
     * Crea objetos HTML a partir de los datos de los objetos y los visualiza en la interfaz.
     * @param {Array} tablaObjeto - Los datos de los objetos obtenidos.
     */
  crearObjetos (tablaObjeto) {
    const nObjetosBuenos = Vista.config.nObjetosBuenos
    const objetosBuenos = []
    const objetosMalos = []

    tablaObjeto.forEach(objeto => {
      if (objeto.valoracion == '0' && objetosBuenos.length < nObjetosBuenos) {
        objetosBuenos.push(objeto)
      } else {
        objetosMalos.push(objeto)
      }
    })
    this.visualizarObjetos(objetosBuenos, objetosMalos)
  }

  /**
     * Visualiza objetos en la interfaz a partir de los datos de los objetos.
     * @param {Array} buenos - Datos de objetos buenos.
     * @param {Array} malos - Datos de objetos malos.
     */
  visualizarObjetos (buenos, malos) {
    this.objetomalo1 = document.getElementById('objetoMalo1')
    const imgM1 = document.createElement('img')
    imgM1.src = 'data:image/png;base64,' + malos[0].imagen
    imgM1.alt = malos[0].descripcion
    this.objetomalo1.appendChild(imgM1)

    this.objetomalo2 = document.getElementById('objetoMalo2')
    const imgM2 = document.createElement('img')
    imgM2.src = 'data:image/png;base64,' + malos[1].imagen
    imgM2.alt = malos[1].descripcion
    this.objetomalo2.appendChild(imgM2)

    this.objetomalo3 = document.getElementById('objetoMalo3')
    const imgM3 = document.createElement('img')
    imgM3.src = 'data:image/png;base64,' + malos[2].imagen
    imgM3.alt = malos[2].descripcion
    this.objetomalo3.appendChild(imgM3)

    this.objetoBueno1 = document.getElementById('objetoBueno1')
    const imgB1 = document.createElement('img')
    imgB1.src = 'data:image/png;base64,' + buenos[0].imagen
    imgB1.alt = buenos[0].descripcion
    this.objetoBueno1.appendChild(imgB1)

    this.objetoBueno2 = document.getElementById('objetoBueno2')
    const imgB2 = document.createElement('img')
    imgB2.src = 'data:image/png;base64,' + buenos[1].imagen
    imgB2.alt = buenos[1].descripcion
    this.objetoBueno2.appendChild(imgB2)

    this.objetoBueno3 = document.getElementById('objetoBueno3')
    const imgB3 = document.createElement('img')
    imgB3.src = 'data:image/png;base64,' + buenos[2].imagen
    imgB3.alt = buenos[2].descripcion
    this.objetoBueno3.appendChild(imgB3)
  }

  verificarObjetosPulsados() {
    this.objetosPulsados++
  
    // Obtener el estilo de visualización actual de los objetos malos
    const estiloMalo1 = window.getComputedStyle(this.objetomalo1).getPropertyValue('display')
    const estiloMalo2 = window.getComputedStyle(this.objetomalo2).getPropertyValue('display')
    const estiloMalo3 = window.getComputedStyle(this.objetomalo3).getPropertyValue('display')
  
    // Verificar si los tres objetos malos han sido capturados (display: none)
    if (estiloMalo1 === 'none' && estiloMalo2 === 'none' && estiloMalo3 === 'none') {
      // Los tres objetos malos han sido capturados
      this.ocultarBotonPausa()
      this.controlador.verVista(Vista.VISTA3)
    }
  }
  /**
   * Método que oculta el botón pausar/reanudar al cambiar de vista o si se acaba el tiempo.
   */
  ocultarBotonPausa() {
    // Obtener el elemento del botón de pausa por su ID
    const botonPausa = document.getElementById('botonPausa')
    // Verificar si el botón de pausa existe
    if (botonPausa) {
      botonPausa.style.display = 'none' // Ocultar el botón de pausa estableciendo el estilo de visualización a 'none'
    }
  }

  /**
     * Parámetros para la solicitud AJAX, en este caso, el ID de la categoría.
     * @constant {Object} params
  */
  llamarAJAXPregunta = () => {
    const params = {
      id: Vista.idCategoria
    }
    // Realizar la solicitud POST a través de AJAX utilizando la clase Rest
    Rest.post('php/controladores/ajax/ajaxPregunta.php', params, this.verResultadoAJAXPregunta)
  }

  /**
    * Muestra las preguntas obtenidas en la interfaz del juego después de una solicitud AJAX exitosa.
    * @param {Array} Pregunta - Array de objetos que representan preguntas obtenidas de la solicitud AJAX.
  */
  verResultadoAJAXPregunta = (Pregunta) => {
    Vista.pregunta = Pregunta
    console.log(Pregunta)

    const contenedorPregunta = document.getElementById('rondaPreguntas')
    
    // Número de preguntas a mostrar según la configuración.
    let nPregunta = Vista.config.nPregunta
    // Bucle de las preguntas
    for(let i=0;i<nPregunta;i++){
      //* Crea un div para cada pregunta con un ID único y establece el estilo inicial en 'none'.
      let divPregunta = document.createElement('div')
      divPregunta.setAttribute('id', 'preguntaJuego'+i)
      divPregunta.setAttribute('class', 'preguntaJuego')
      divPregunta.style.display = 'none'

      let p = document.createElement('p')
      p.textContent = Pregunta[i].texto
      divPregunta.appendChild(p)

      contenedorPregunta.appendChild(divPregunta)
    }
  }
}