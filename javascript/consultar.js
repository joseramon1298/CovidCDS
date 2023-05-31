let url = "http://localhost:8080/casos";
let tablaCasos;

function obtenerCasos() {
  fetch(url)
    .then(response => response.json())
    .then(casos => {
      tablaCasos.innerHTML = "";

      if (casos.length > 0) {
        let encabezado = tablaCasos.insertRow();
        encabezado.id = "encabezado-tabla";
        let celdaFecha = encabezado.insertCell();
        celdaFecha.innerText = "Fecha";
        let celdaProvincia = encabezado.insertCell();
        celdaProvincia.innerText = "Provincia";
        let celdaConfirmados = encabezado.insertCell();
        celdaConfirmados.innerText = "Casos Confirmados";
        let celdaPositivos = encabezado.insertCell();
        celdaPositivos.innerText = "Nuevos Positivos";
        let celdaAltas = encabezado.insertCell();
        celdaAltas.innerText = "Altas";
        let celdaFallecimientos = encabezado.insertCell();
        celdaFallecimientos.innerText = "Fallecimientos";

        for (let caso of casos) {
          let fila = tablaCasos.insertRow();
          let celdaFecha = fila.insertCell();
          celdaFecha.innerText = caso.fecha;
          let celdaProvincia = fila.insertCell();
          celdaProvincia.innerText = caso.provincia;
          let celdaConfirmados = fila.insertCell();
          celdaConfirmados.innerText = caso.casos_confirmados;
          let celdaPositivos = fila.insertCell();
          celdaPositivos.innerText = caso.nuevos_positivos;
          let celdaAltas = fila.insertCell();
          celdaAltas.innerText = caso.altas;
          let celdaFallecimientos = fila.insertCell();
          celdaFallecimientos.innerText = caso.fallecimientos;
        }
      } else {
        tablaCasos.innerHTML = "<p>No hay casos de covid disponibles</p>";
      }
    })
    .catch(error => {
      tablaCasos.innerHTML = "<p>Error al obtener los casos de covid</p>";
      console.error(error);
    });
}

function inicializar() {
  tablaCasos = document.getElementById("casos-table");

  // Obtener los participantes iniciales
  obtenerCasos();

  // Actualizar los participantes cada 5 segundos
  setInterval(obtenerCasos, 5000);
}

export { obtenerCasos, inicializar };
