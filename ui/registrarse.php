<?php
include_once('php/funciones.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="imagenes/logo.png"/>  
</head>
<body class="bg-light text-dark">
        <br><br><p></p>
        <div class="container">
            <div class="row">
              <div class="col-md-6 mx-auto">
                <div class="card card-body">
                  <h3 class="text-center mb-4">Registrarse</h3>
                  <form action="registrarse.php" method="post">
                    <div class="form-group">
                      <label for="username">Nombre de usuario</label>
                      <input type="text" id="username" name="username" class="form-control" required="" placeholder="Ingresa un nombre de usuario">
                    </div>
                    <div class="form-group">
                      <label for="password">Contraseña</label>
                      <input type="password" id="password" name="password" class="form-control" required="" placeholder="Ingresa una contraseña">
                    </div>
                    <button type="submit" class="btn btn-success btn-block" name="Registrarse">Registrarse</button>
                  </form>
                  <div class="text-center mt-3">
                    <p>Ya tienes una cuenta? <a href="inicia.php" class="text-primary">Inicia Sesión</a></p>
                  </div>
                  <div class="text-center mt-3">
                    <p><a href="index.php" class="text-primary">Volver a Inicio</a></p>
                  </div>
                </div>
            </div>
            </div>
        </div>
        <?php
            if(isset($_REQUEST['Registrarse'])){
                $usuario=$_REQUEST['username'];
                $contraseña=$_REQUEST['password'];
                if(comprobarUsuario($usuario)==false){
                    if(registrarUsuario($usuario, $contraseña)==true){
                        echo "<h4 style='text-align: center; color:green'>{$usuario} registrado correctamente</h4>";
                    }else{
                        echo "<h4 style='text-align:center;color:red'>No se ha podido registrar correctamente al usuario</h4>";
                    }
                }else{
                    echo "<h4 style='text-align:center; color:red'>{$usuario} ya está en la base de datos, prueba con otro nombre.</h4>";
                }	
            }
        ?>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</html>
