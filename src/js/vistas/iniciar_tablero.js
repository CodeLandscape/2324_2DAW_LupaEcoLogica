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
  constructor (controlador, base,puntuacion) {
    super(controlador, base,puntuacion)
    this.llamarAJAXTablero()
    this.objetosPulsados = false // Contador para rastrear objetos pulsados
    this.crearInterfaz()
    this.objetosBuenos = []
    this.objetosMalos = []
    this.puntuacion = 0
    this.objetosAcertados = 0
  }

  /**
     * Crea la interfaz de la vista.
     * Crea elementos HTML, agrega eventos y define acciones.
     */
  crearInterfaz () {
    // Crear elementos HTML y configurar atributos
    this.tableroInicio = document.getElementById('tableroInicio');
    this.tablero = document.getElementById('tablero')

    this.botonCrono = document.createElement('button')
    this.botonCrono.textContent = '¡Comenzar partida!'
    this.botonCrono.setAttribute('id', 'botonCrono')
    this.botonCrono.setAttribute('class', 'submit')
    this.tableroInicio.appendChild(this.botonCrono)

    this.tiempoRestante = document.createElement('p') // Elemento para mostrar el tiempo restante
    this.base.appendChild(this.tiempoRestante) // Agregar elemento del tiempo restante

    // Agregar eventos a los botones
    this.botonCrono.onclick = () => {
      this.footer = document.getElementById('pie')
      this.footer.textContent = Vista.nomTablero // Se cogerá de la base de datos el nombre del tablero, footer temporal!!!
      this.tableroInicio.style.display = 'none';
      this.tablero.style.filter = 'none';

      this.capturarObjetos()
      this.iniciarCuentaRegresiva()
      this.iniciarPuntuacion()
    }
  }

  iniciarPuntuacion() {
    this.verPuntuacion = document.createElement('p');
    this.verPuntuacion.setAttribute('id','puntuacion');
    this.verPuntuacion.setAttribute('class','tamFuenteMediana');
    this.base.appendChild(this.verPuntuacion);

    this.actualizarPuntuacion();
  }

  actualizarPuntuacion () {
    if (this.puntuacion < 0) {
      this.puntuacion = 0; // Asegurar que la puntuación no sea menor que 0
    }
    this.verPuntuacion.textContent = `Puntuación: ${this.puntuacion}`
    
  }

  iniciarCuentaRegresiva() {
    const tiempoLimite = Vista.config.tiempoCrono; // 5 segundos de cuenta regresiva
    let tiempoRestante = tiempoLimite;
    let cuentaRegresivaEnPausa = false;
    let cuentaRegresiva; // Declarar la variable del intervalo aquí
    
    
    this.tiempoRestante.setAttribute('id', 'tiempo');
    this.tiempoRestante.setAttribute('class', 'tamFuenteMediana');

    const actualizarTiempo = () => {
      this.tiempoRestante.textContent = `Tiempo restante: ${tiempoRestante} segundos`;
  
      if (tiempoRestante === 0 ||this.objetosPulsados) {
        clearInterval(cuentaRegresiva);
        
        this.iniciarCuentaRegresiva = null;
        this.actualizarTiempo = null;
        this.controlador.verVista(Vista.VISTA3,Vista.puntuacion);
      }
  

      if (tiempoRestante != 0 && !cuentaRegresivaEnPausa)
      {
        tiempoRestante--;
        this.verificarObjetosPulsados()
      }
    };
  
   
  
    // Mostrar inicialmente el tiempo restante y actualizar cada segundo
    actualizarTiempo();
    cuentaRegresiva = setInterval(actualizarTiempo, 1000);
  
  }
  
  
  /**
     * Captura los eventos de clic en objetos y actualiza el contador de objetos pulsados.
     */
  capturarObjetos () {
    this.objetomalo1 = document.getElementById('objetoMalo1')

    this.objetomalo1.onclick = () => {
      // Verificar si el juego no está en pausa antes de procesar el clic
        console.log('Objeto malo 1 capturado')
        console.log(this.objetosMalos[0].puntuacion)
        this.puntuacion += this.objetosMalos[0].puntuacion;
        this.objetosAcertados =  this.objetosAcertados + 1
        console.log (this.puntuacion)
        this.añadirObjetoAside(this.objetomalo1)
        this.actualizarPuntuacion();
        this.verificarObjetosPulsados()
      
    }
    this.objetomalo2 = document.getElementById('objetoMalo2')
    
    this.objetomalo2.onclick = () => {
        console.log('Objeto malo 2 capturado')
        this.puntuacion += this.objetosMalos[1].puntuacion
        this.objetosAcertados =  this.objetosAcertados + 1
        console.log(this.puntuacion);
        this.añadirObjetoAside(this.objetomalo2)
        this.actualizarPuntuacion();
        this.verificarObjetosPulsados()
      
    }
    this.objetomalo3 = document.getElementById('objetoMalo3')

    this.objetomalo3.onclick = () => {
        console.log('Objeto malo 3 capturado')
        this.puntuacion += this.objetosMalos[2].puntuacion;
        this.objetosAcertados =  this.objetosAcertados + 1
        console.log(this.puntuacion);
        this.añadirObjetoAside(this.objetomalo3)
        this.actualizarPuntuacion();
        
    }
    this.objetoBueno1 = document.getElementById('objetoBueno1')

    this.objetoBueno1.onclick = () => {
        console.log('Objeto bueno 1 capturado')
        this.puntuacion -= this.objetosBuenos[0].puntuacion
        console.log(this.puntuacion);
        this.añadirObjetoAside(this.objetoBueno1)
        this.actualizarPuntuacion();
        this.verificarObjetosPulsados()
    }
    this.objetoBueno2 = document.getElementById('objetoBueno2')

    this.objetoBueno2.onclick = () => {
        console.log('Objeto bueno 2 capturado')
        this.puntuacion -= this.objetosBuenos[1].puntuacion
        console.log(this.puntuacion);
        this.añadirObjetoAside(this.objetoBueno2)
        this.actualizarPuntuacion();
        this.verificarObjetosPulsados()
    }
    this.objetoBueno3 = document.getElementById('objetoBueno3')

    this.objetoBueno3.onclick = () => {
        console.log('Objeto bueno 3 capturado')
        this.puntuacion -= this.objetosBuenos[2].puntuacion
        console.log(this.puntuacion);
        this.añadirObjetoAside(this.objetoBueno3)
        this.actualizarPuntuacion();
        this.verificarObjetosPulsados()
    }
  }

  /**
     * Añade un objeto a la lista de objetos encontrados y verifica si todos los objetos han sido pulsados.
     * @param {HTMLElement} objeto - El objeto que se ha pulsado.
     */
  añadirObjetoAside (objeto) {
    this.objeto = objeto
    this.objeto.style.display = 'none'
    Vista.puntuacion = this.puntuacion
    Vista.objetosAcertados = this.objetosAcertados
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
      let imagen = 'data:image/png;base64,' + objeto.imagen;
      fondo.src = imagen
      fondo.alt = Vista.nomTablero
      
      this.fondoPregunta = document.getElementById('imagenFondoPregunta');
      this.fondoPregunta.src = imagen;
  
      this.fondoReflexion = document.getElementById('imagenFondoReflexion');
      this.fondoReflexion.src = imagen;
  
      this.fondoRegistro = document.getElementById('imagenFondoRegistro');
      this.fondoRegistro.src = imagen;

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
    // const objetosBuenos = []
    // const objetosMalos = []

    tablaObjeto.forEach(objeto => {
      if (objeto.valoracion == '0' && this.objetosBuenos.length < nObjetosBuenos) {
        this.objetosBuenos.push(objeto)
      } else {
        this.objetosMalos.push(objeto)
      }
    })
    this.visualizarObjetos(this.objetosBuenos, this.objetosMalos)
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
    console.log(buenos[2])
    imgB3.src = 'data:image/png;base64,' + buenos[2].imagen
    imgB3.alt = buenos[2].descripcion
    this.objetoBueno3.appendChild(imgB3)
  }

  verificarObjetosPulsados() {
    // Obtener el estilo de visualización actual de los objetos malos
    const estiloMalo1 = window.getComputedStyle(this.objetomalo1).getPropertyValue('display')
    const estiloMalo2 = window.getComputedStyle(this.objetomalo2).getPropertyValue('display')
    const estiloMalo3 = window.getComputedStyle(this.objetomalo3).getPropertyValue('display')
  
    // Verificar si los tres objetos malos han sido capturados (display: none)
    if (estiloMalo1 === 'none' && estiloMalo2 === 'none' && estiloMalo3 === 'none') {
      this.objetosPulsados = true
      // clearInterval(cuentaRegresiva)
      // this.iniciarCuentaRegresiva = null;
      
      // this.controlador.verVista(Vista.VISTA3)
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
    const contenedorReflexiones = document.getElementById('reflexionjuego')
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

      let divReflexion = document.createElement('div')
      divReflexion.setAttribute('id','reflexion'+i)
      divReflexion.setAttribute('class','reflexion')
      divReflexion.style.display = 'none'

      let p1 = document.createElement('p')
      p1.setAttribute('id','acierto'+i)
      p1.textContent = Pregunta[i].reflexionAcierto
      p1.style.display = 'none'

      divReflexion.appendChild(p1)

      let p2 = document.createElement('p')
      p2.setAttribute('id','fallo'+i)
      p2.textContent = Pregunta[i].reflexionFallo
      p2.style.display = 'none'
      divReflexion.appendChild(p2)

      let imgAcierto = document.createElement('img')
      imgAcierto.setAttribute('id','imagenCorrecto'+i)
      imgAcierto.src = "img/IonCheckmarkCircled.png"
      imgAcierto.style.display ='none'
      divReflexion.appendChild(imgAcierto)
      

      let imgFallo = document.createElement('img')
      imgFallo.setAttribute('id','imagenFallo'+i)
      imgFallo.src = "img/IonCloseCircle.png"
      imgFallo.style.display ='block'
      divReflexion.appendChild(imgFallo)


      contenedorReflexiones.appendChild(divReflexion)
    }
  }
}