<?php
include("../functions.php");
require_once("../dbconfig.php");
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header("Location: http://localhost/Proyecto-4to-SinapsIA/Sinapsia/index/index.php");
  exit;
}
if(post_request()){
if(!isset($_POST['mail'],$_POST['contrasenia'])){
echo "Ingresar el usuario y la contraseña";
}
$mail = $_POST['mail'];
$contraseña = $_POST['contrasenia'];

$query = "SELECT mail,nombre,contrasenia FROM medico WHERE mail = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s",$mail);
if($stmt->execute()){
    $stmt->store_result();
$stmt->bind_result($mail,$nombre,$contrasenia);
$stmt->fetch();
}
else{
  echo "No se pudo ejecutar";
}

if($stmt->num_rows > 0 && password_verify($contraseña,$contrasenia)){
  echo "Iniciaste sesión";
  $_SESSION['mail'] = $mail;
  $_SESSION['contrasenia'] = $contraseña;
  $_SESSION['nombre'] = $nombre;
  $_SESSION['loggedin'] = true;  
  header("Location: http://localhost/Proyecto-4to-SinapsIA/Sinapsia/index/index.php");


}
else {
echo "El usuario o la contraseña es incorrecta";
}
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" type="text/css" href="./Login-estilo.css">
    <title>Document</title>  

</head>
<body>
    <div class="contenedor">
        <div class="marco-azul">
            <H1>
                LOG IN
                <br>
            </H1>
            <form class="formulario" method="POST">
                MAIL
                <br>
                <input type="email" id="nombre" name="nombre">
            
                <br><br>
                CONTRASEÑA
                <br>
                <input type="password" id="contraseña" name="contrasenia">
                
            </form>

            <br><br>


            <input type="submit" value="INGRESAR" class="ingresar">

            <br><br>
        
            <p class="no-tenes-una-cuenta" class="cuenta">
                ¿NO TENÉS UNA CUENTA?
            </p>
            <button class="crea-una" 
            onclick="window.location.href = '/Proyecto-4to-SinapsIA/Sinapsia/signup/register.php'">
                ¡CREÁ UNA!
            </button>
    </div>
    </div>
</body>
</html>