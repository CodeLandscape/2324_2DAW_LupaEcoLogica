/*
 * Clase de Servicio para llamadas AJAX
 */

export class Rest {
  static get (url, params, callback) {
    let paramsGET = '?'
    for (const param in params) {
      paramsGET += param + '='
      paramsGET += params[param] + '&'
    }
    fetch(encodeURI(url + paramsGET.substring(0, paramsGET.length - 1)))
      .then(respuesta => respuesta.text())
      .then(texto => {
        if (callback) { callback(texto) }
      })
  }

  static getJSON (url, params, callback) {
    let paramsGET = '?'
    for (const param in params) {
      paramsGET += param + '='
      paramsGET += params[param] + '&'
    }
    fetch(encodeURI(url + paramsGET.substring(0, paramsGET.length - 1)))
      .then(respuesta => respuesta.json())
      .then(objeto => {
        if (callback) { callback(objeto) }
      })
  }

  static post (url, params, callback) {
    const parametros = new FormData()
    for (const param in params) {
      parametros.append(param, params[param])
    }
    const opciones = {
      method: 'POST',
      body: parametros
    }
    fetch(url, opciones)
      .then(respuesta => respuesta.json())
      .then(json => {
        if (callback) { callback(json) }
      })
  }

  // static consultarAEMET () {
  //   const url = 'https://opendata.aemet.es/opendata/api/valores/climatologicos/diarios/datos/fechaini/2021-12-24T00:00:00UTC/fechafin/2021-12-24T23:59:59UTC/estacion/4452/?api_key=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJtamFxdWVAbWlndWVsamFxdWUuY29tIiwianRpIjoiMzI1NjVlZTYtNzEyZS00ZGY1LWI1Y2MtODk0NDUxMTNlNzU3IiwiaXNzIjoiQUVNRVQiLCJpYXQiOjE2NDA2Nzc3NDUsInVzZXJJZCI6IjMyNTY1ZWU2LTcxMmUtNGRmNS1iNWNjLTg5NDQ1MTEzZTc1NyIsInJvbGUiOiIifQ.naOtp0KsRSMKt-dvbI5EURhbhMV4NbppqdiqM0i5mEY'
  // }
}
