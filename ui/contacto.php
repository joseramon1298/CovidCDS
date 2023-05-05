<?php
session_start();
if(isset($_SESSION['user_first_name'])){
	$usuario=$_SESSION['user_first_name'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
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
        <div class="container py-3">
            <div class="row mt-2">
                <div class="col-8 text-center text-footer">
                    <br />
                    <br />
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2936.945605333738!2d-5.574459485862296!3d42.59889757917149!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd379a9a78ab4c81%3A0x4860f72329f4ddf9!2sAv%20del%20Padre%20Isla%2C%206%2C%2024002%20Le%C3%B3n!5e0!3m2!1ses!2ses!4v1674733260229!5m2!1ses!2ses"
                        width="650"
                        height="700"
                        style="border: 0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
        
                    <br />
                    <br />
                </div>
                <div class="col-3 text-start text-footer">
                    <br />
                    <br />
                    <hr />
                    <h2>Contacto</h2>
                    <br />
                    <p>Email: joseramonguijo7@gmail.com</p>
                    <p>Teléfono: 651 417 926</p>
                    <p>Dirección: Avenida Padre Isla, 6, León</p>
                </div>
            </div>
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



