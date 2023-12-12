import { Vista } from './vista.js'

export class Registro extends Vista {
  constructor (controlador, base) {
    super(controlador, base)
    this.crearInterfaz()
    this.validacionFormulario()
  }

  mostrar(ver){
    this.actualizarPuntuacion(Vista.puntuacion);
    super.mostrar(ver); 
  }

  /**
     * Crea la interfaz del formulario para guardar la partida.
     * Genera las acciones del formulario.
     */
  crearInterfaz () {
    // Obtener los elementos HTML existentes
    this.formulario = document.getElementById('miFormulario')

    this.irInicio = document.createElement('button')
    this.irInicio.textContent = 'Volver al Inicio'

    this.nickUsu = document.getElementById('nombre')
    this.provincia = document.getElementById('localidad')

    // Agregar elementos al contenedor base
    this.base.appendChild(this.irInicio)

    // Al hacer clic en el botón, mostrar la vista correspondiente
    this.irInicio.onclick = () => {
      this.footer = document.getElementById('pie')
      this.footer.textContent = 'Escuela Virgen de Guadalupe 2023'
      this.controlador.verVista(Vista.VISTA5)
    }
  }

  /**
     * Validación del formulario al escribir el nombre.
     */
  validacionFormulario () {
    let regexCaceres = /^(CA|ca)[A-Za-z]{2}[0-9]{3}$/;
    let regexBadajoz = /^(BA|ba)[A-Za-z]{2}[0-9]{3}$/;
    let regexMerida = /^(ME|me)[A-Za-z]{2}[0-9]{3}$/;

    const validarNombreUsuario = (texto, regex, mensajeValido, mensajeInvalido) => {
      if (!texto.match(regex)) {
        window.alert(mensajeInvalido)
        this.nickUsu.style.borderColor = 'red'
      } else {
        window.alert(mensajeValido)
        this.nickUsu.style.borderColor = 'green'
      }
    }

    this.formulario.onsubmit = (event) => {
      event.preventDefault() // Evitar el envío del formulario

      const texto = this.nickUsu.value

      switch (this.provincia.value) {
        case 'Caceres':
          validarNombreUsuario(
            texto,
            regexCaceres,
            'El nombre de usuario es válido para Cáceres',
            'No es válido el nombre introducido para Cáceres'
          )
          break
        case 'Badajoz':
          validarNombreUsuario(
            texto,
            regexBadajoz,
            'El nombre de usuario es válido para Badajoz',
            'No es válido el nombre introducido para Badajoz'
          )
          break
        case 'Merida':
          validarNombreUsuario(
            texto,
            regexMerida,
            'El nombre de usuario es válido para Mérida',
            'No es válido el nombre introducido para Mérida'
          )
          break
        default:
          // Si no se selecciona una provincia específica, se puede restablecer el estilo del campo de entrada
          this.nickUsu.style.borderColor = ''
      }
    }
    //Cambia el valor del placeholder del input del nombre de usuario.
    this.provincia.onchange = (event) => {
      event.preventDefault()

      switch (this.provincia.value) {
        case 'Caceres':
          this.nickUsu.setAttribute('placeholder',"CA + 2 letras + 3 números");
          break
        case 'Badajoz':
          this.nickUsu.setAttribute('placeholder',"BA + 2 letras + 3 números");
          break
        case 'Merida':
          this.nickUsu.setAttribute('placeholder',"ME + 2 letras + 3 números");
          break
        default:
          this.nickUsu.setAttribute('placeholder',"Elija una localidad");
      }
    }
  }
  actualizarPuntuacion(puntuacion){
    this.puntos = document.getElementById('puntos')
    this.puntos.textContent = `${Vista.puntuacion} puntos`
  }
}
