<?php
//index.php

//Include Configuration File
include('config.php');

$login_button = '';

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }
        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }
        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }
        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }
        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

if (!isset($_SESSION['access_token'])) {
  $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="btn btn-primary" style="font-size: 1.2em;">Inicia Sesión con Google <img src="imagenes/google.png" alt="Logo Google" style="width: 20px; height: 20px;"></a>';
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inicia Sesión</title>
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
        <?php
          if (!isset($_SESSION['user_first_name'])) {
              echo '<div class="jumbotron">';
              echo '<h2 class="mb-4 text-center">Inicia Sesión en COVIDCDS</h2>';
              echo '<p class="lead mb-5">Para disfrutar el máximo de esta página, Inicia sesión y así podrás ver los casos de Covid-19 en Castilla y León.</p>';
              echo '</div><br><br>';
              echo '<div class="text-center">' . $login_button . '</div><br><br>';
          } else {
              echo '<div class="text-center">';
              echo '<h4>Sesión iniciada como ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h4>';
              echo '<p class="email"><b>Email:</b> ' . $_SESSION['user_email_address'] . '</p>';
              echo '<a href="logout.php" class="btn btn-danger btn-block">Cerrar Sesion</a>';
              echo '</div><br><br>';
          }
        ?>
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





