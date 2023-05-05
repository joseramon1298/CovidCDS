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
    <title>Inicio</title>
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
        <div class="container mt-5">
            <div class="jumbotron">
              <h1 class="display-4">Bienvenido al proyecto COVID-19 en Castilla y León</h1>
              <p class="lead">Aquí encontrarás información actualizada sobre los casos de COVID-19 en la provincia de Castilla y León por día.</p>
              <hr class="my-4">
              <p>Este proyecto es realizado por Jose Ramón, un alumno de la empresa HPE CDS.</p>
            </div>
            <div class="row">
              <div class="col-md-6">
                <h2>Sobre el proyecto</h2>
                <p>El proyecto COVID-19 en Castilla y León es una iniciativa para proporcionar información actualizada y precisa sobre los casos de COVID-19 en la provincia de Castilla y León por día. La información es recopilada por nuestro equipo de especialistas en salud y se actualiza regularmente para proporcionar datos precisos y útiles.</p>
                <p>Nuestra misión es ayudar a la comunidad a estar informada sobre la situación del COVID-19 en la provincia de Castilla y León y tomar las medidas necesarias para mantenerse seguros y saludables. Estamos comprometidos a proporcionar información actualizada y precisa para apoyar a nuestra comunidad en estos tiempos difíciles.</p>
              </div>
              <div class="col-md-6">
                <h2>Sobre el COVID-19</h2>
                <p>El COVID-19 es una enfermedad infecciosa causada por el virus SARS-CoV-2. Se identificó por primera vez en la ciudad de Wuhan, China, en diciembre de 2019 y desde entonces se ha extendido por todo el mundo.</p>
                <p>Los síntomas pueden variar desde leves hasta graves y pueden incluir fiebre, tos, dificultad para respirar, fatiga y dolores musculares. La enfermedad se propaga principalmente a través de gotículas respiratorias producidas cuando una persona infectada tose o estornuda.</p>
                <p>Es importante tomar medidas preventivas para reducir la propagación del COVID-19, como el distanciamiento social, el lavado frecuente de manos y el uso de mascarillas.</p>
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


