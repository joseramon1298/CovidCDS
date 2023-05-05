<?php
session_start();
if(isset($_SESSION['user_first_name'])){
	$usuario=$_SESSION['user_first_name'];
}else{
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Casos</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="imagenes/logo.png"/>  
</head>
<body class="bg-light text-dark">
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark navbar-height">
            <a class="navbar-brand text-white" href="index.php"><img src="imagenes/logo.png" alt="Logo CDS"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link text-white" href="index.php">Inicio</a>
                </li>
                <?php
                if(isset($_SESSION['user_first_name'])){
                  ?>
                   <li class="nav-item">
                    <a class="nav-link text-white" href="consultar.php">Consultar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="resumen.php">Resumen</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="grafico.php">Gráfico</a>
                  </li>
                  <?php
                }
                ?>
                <li class="nav-item">
                <a class="nav-link text-white" href="contacto.php">Contacto</a>
                </li>
            </ul>
            <?php
                if(!isset($_SESSION['user_first_name'])){
                  echo "<a class='navbar-text text-white' href='inicia.php'><i class='bi bi-arrow-bar-right'>Iniciar Sesión</i></a>";
                } else {
                  echo "<a class='navbar-text text-danger' href='logout.php'><i class='bi bi-arrow-bar-right'><img src='" . $_SESSION['user_image'] . "' class='img-fluid rounded-circle mb-3' style='width:50px;height:50px' />  Cerrar Sesión</i></a>";
                }
            ?>
              
            </div>
        </nav>
    </header>
    <section>
      <div class="container py-5 text-center">
      <div class="jumbotron">
          <h2 class="mb-4">Casos de Covid en Castilla y León</h2>
          <p class="lead mb-5">Es importante mantenerse informado sobre la evolución de la pandemia. Aquí puedes encontrar los últimos datos actualizados sobre los casos de Covid en la región de Castilla y León.</p>
      </div>
        <div id="tabla_casos" class="table-responsive">
          <table id="casos-table" class="table table-striped table-hover"></table>
        </div>
        <div id="mensaje_error" class="mt-3 alert alert-warning d-none"></div>
      </div>
    </section>
    <footer class="bg-dark text-white">
        <div class="container py-3">
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <h4>COVIDCDS</h4>
              <p>¡Encuentra toda la información que necesitas sobre el COVID-19 aquí!</p>
            </div>
            <div class="col-lg-4 col-md-6">
              <h4>Enlaces útiles</h4>
              <ul class="list-unstyled">
                <li><a href="index.php" class="text-white">Inicio</a></li>
                <li><a href="contacto.php" class="text-white">Contacto</a></li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-12">
              <h4>Iniciar sesión</h4>
              <p>¡Inicia sesión para acceder a toda la información sobre el COVID-19!</p>
            </div>
          </div>
        </div>
      </footer>  
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    let url = "http://localhost:8080/casos";
    let tablaCasos = document.getElementById("casos-table");

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

    // Obtener los participantes iniciales
    obtenerCasos();

    // Actualizar los participantes cada 5 segundos
    setInterval(obtenerCasos, 5000);
});

</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>


