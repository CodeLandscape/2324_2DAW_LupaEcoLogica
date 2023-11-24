import { Vista } from './vista.js'

export class Registro extends Vista {
  constructor (controlador, base) {
    super(controlador, base)
    this.crearInterfaz()
    this.validacionFormulario()
  }

  /**
     * Crea la interfaz del formulario para guardar la partida.
     * Genera las acciones del formulario.
     */
  crearInterfaz () {
    // Obtener los elementos HTML existentes
    this.formulario = document.getElementById('miFormulario')
    this.explicacionRegex = document.createElement('p')
    this.explicacionRegex.className = 'tamFuenteGrande'
    this.explicacionRegex.textContent = 'El nombre de usuario debe contener las dos primeras iniciales de la provincia elegida. Por ejemplo, si seleccionas Badajoz, tu nombre sería BAvi123.'

    this.puntos = document.createElement('h2')
    this.puntos.textContent = '¡Has obtenido (cantidad de puntos) en tu partida!'

    this.irInicio = document.createElement('button')
    this.irInicio.textContent = 'Volver al Inicio'

    this.nickUsu = document.getElementById('nombre')
    this.provincia = document.getElementById('localidad')

    this.nickUsu.style.backgroundColor = 'yellow'

    // Agregar elementos al contenedor base
    this.base.appendChild(this.puntos)
    this.formulario.appendChild(this.explicacionRegex)
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
    this.nickUsu.style.backgroundColor = 'yellow'

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
        case 'Cáceres':
          console.log('Cáceres')
          validarNombreUsuario(
            texto,
            /^(CA|ca)[A-Za-z]{2}[0-9]{3}$/,
            'El nombre de usuario es válido para Cáceres',
            'No es válido el nombre introducido para Cáceres'
          )
          break
        case 'Badajoz':
          validarNombreUsuario(
            texto,
            /^(BA|ba)[A-Za-z]{2}[0-9]{3}$/,
            'El nombre de usuario es válido para Badajoz',
            'No es válido el nombre introducido para Badajoz'
          )
          break
        case 'Mérida':
          validarNombreUsuario(
            texto,
            /^(ME|me)[A-Za-z]{2}[0-9]{3}$/,
            'El nombre de usuario es válido para Mérida',
            'No es válido el nombre introducido para Mérida'
          )
          break
        default:
          // Si no se selecciona una provincia específica, se puede restablecer el estilo del campo de entrada
          this.nickUsu.style.borderColor = ''
          break
      }
    }
  }
}
