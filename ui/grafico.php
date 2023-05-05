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
    <title>Gráfico</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="imagenes/logo.png"/>  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            fetch('http://localhost:8080/datos')
                .then(response => response.json())
                .then(datos => {
                    const data = new google.visualization.DataTable();
                    data.addColumn('string', 'Provincia');
                    data.addColumn('number', 'Casos confirmados');
                    data.addColumn('number', 'Fallecimientos');
                    for (const dato of datos) {
                        data.addRow([dato.provincia, dato.casos_confirmados, dato.fallecimientos]);
                    }

                    const options = {
                        title: 'Casos confirmados y fallecimientos por provincia a día de hoy',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                    };

                    const chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                });
        }
</script>
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
                  $_SESSION['user_image'];
                  echo "<a class='navbar-text text-danger' href='logout.php'><i class='bi bi-arrow-bar-right'><img src='" . $_SESSION['user_image'] . "' class='img-fluid rounded-circle mb-3' style='width:50px;height:50px' />  Cerrar Sesión</i></a>";
                }
            ?>
              
            </div>
        </nav>
    </header>
    <section>
    <div class="container mt-5">
            <div class="jumbotron">
              <h1 class="display-4">Gráfico COVID-19 en Castilla y León</h1>
              <p class="lead">Aquí encontrarás un gráfico actualizado sobre los casos de COVID-19 en la provincia de Castilla y León por provincias.</p>
              <hr class="my-4">
              <p>Este proyecto es realizado por Jose Ramón, un alumno de la empresa HPE CDS.</p>
            </div>
            <div id="chart_div" style="width: 1110px; height: 500px;"></div><br><br>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>



