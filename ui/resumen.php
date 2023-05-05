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
    <title>Resumen</title>
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
                  $_SESSION['user_image'];
                  echo "<a class='navbar-text text-danger' href='logout.php'><i class='bi bi-arrow-bar-right'><img src='" . $_SESSION['user_image'] . "' class='img-fluid rounded-circle mb-3' style='width:50px;height:50px' />  Cerrar Sesión</i></a>";
                }
            ?>
              
            </div>
        </nav>
    </header>
    <section>
            <div class="container py-5 text-center">
                <div class="jumbotron">
                <h2 class="mb-4">Resumen por días de los casos de Covid en Castilla y León</h2>
                <p class="lead mb-5">Es importante mantenerse informado sobre la evolución de la pandemia. Aquí puedes encontrar los últimos datos actualizados sobre los casos de Covid en la región de Castilla y León.</p>
                </div>
                <div id="resumenes"></div>
            </div>
    </section>

    <script>
            const url = "http://localhost:8080/resumen"
            fetch(url)
                .then(response => response.json())
                .then(resumenes => {
                const resumenesDiv = document.getElementById("resumenes");
                resumenes.forEach(resumen => {
                    const card = document.createElement("div");
                    card.className = "card my-4 bg-muted";
                    card.innerHTML = `
                    <div class="card-body">
                        <h2 class="card-title text-left" style="font-size: 1.5rem;">${resumen.fecha}</h2>
                        <p class="card-text text-muted" style="font-size: 1.2rem;">${resumen.resumen}</p>
                    </div>`;
                    resumenesDiv.appendChild(card);
                });
                });
    </script>
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



