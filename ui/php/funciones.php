<?php
define('HOST', '172.20.10.2');
define('USER', 'root');
define('PASS', '');
define('BD', 'situacion_covid');

function comprobarUsuario($usuario){
    $comprobarUsuario=false;
    try{
        $con = new mysqli(HOST, USER, PASS, BD);
        $sql="SELECT * FROM usuarios WHERE user='$usuario'";
        $result= $con->query($sql);
        $con->close();
        if($result && $result->num_rows>0){
            $comprobarUsuario=true;
        }
        return $comprobarUsuario;
    }catch(mysqli_sql_exception $e){
        echo "<p>{$e->getMessage()}</p>";
    }
}

function registrarUsuario($usuario,$contraseña){
    $registrarUsuario=false;
    try{
        $con = new mysqli(HOST, USER, PASS, BD);
        $contraseñaHash=hash('sha512', $contraseña);
        $sql="INSERT INTO usuarios(user, pass) VALUES ('$usuario', '$contraseñaHash')";
        $result= $con->query($sql);
        $con->close();
        if($result){
            $registrarUsuario=true;
        }
        return $registrarUsuario;
    }catch(mysqli_sql_exception $e){
        echo "<p>{$e->getMessage()}</p>";
    }
}

function iniciarSesion($usuario,$contraseñaHash){
    $inicio=false;
    try{
        $con = new mysqli(HOST, USER, PASS, BD);
        $sql="SELECT * FROM usuarios WHERE user='$usuario' and pass='$contraseñaHash'";
        $result= $con->query($sql);
        $con->close();
       if($result && $result->num_rows>0){
            $inicio=true;
       }

        return $inicio;
    }catch(mysqli_sql_exception $e){
        echo "<p>{$e->getMessage()}</p>";
    }
}
?>