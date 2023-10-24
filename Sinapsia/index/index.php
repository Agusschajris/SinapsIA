<?php
include("../functions.php");
require_once("../dbconfig.php");
session_start();
if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
    header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
}
else{
    echo "bienvenido ".$_SESSION['nombre'];
}
$mail = $_SESSION['mail'];





/*if(isset($_POST['nombre'],$_POST['apellido'],$_POST['institucion'],$_POST['telefono'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $institucion = $_POST['institucion'];
    $telefono = $_POST['telefono'];
    $query = "UPDATE medico SET nombre = ?, apellido = ?, hospital = ?, telefono = ? WHERE mail = ?";
    $stmt = mysqli_prepare($mysqli,$query);
    $stmt->bind_param("sssss",$nombre,$apellido,$institucion,$telefono,$_SESSION['mail']);
    if($stmt->execute()){
        echo "Datos actualizados";
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
}
else{
    echo "Completa el formulario";
}
*/

if(isset($_POST['nombre'],$_POST['apellido'],$_POST['genero'],$_POST['peso'],$_POST['altura'],$_POST['fecha-nacimiento'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $genero = $_POST['genero'];
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $fecha_nacimiento = $_POST['fecha-nacimiento'];
    $query = "INSERT INTO paciente (nombre, apellido, genero, peso, altura, fecha_nacimiento, mail_medico) VALUES (?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($mysqli,$query);
    $stmt->bind_param("sssssss",$nombre,$apellido,$genero,$peso,$altura,$fecha_nacimiento,$_SESSION['mail']);
    if($stmt->execute()){
        echo "Datos subidos";
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
}
else{
    echo "Completa el formulario";
}

$sql = "SELECT id, nombre, apellido FROM paciente WHERE mail_medico = ?";
    $stmt = mysqli_prepare($mysqli,$sql);
    $stmt->bind_param("s",$mail);
    if($stmt->execute()){
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
            $_SESSION['pacientes'] = $row['id'];
            echo "<a href = '../paciente/paciente.php'>".$row['nombre']." ".$row['apellido']."</a><br>";
        }
        
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Formulario de Paciente</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label>Género:</label>
        <input type="radio" id="genero-masculino" name="genero" value="Masculino">
        <label for="genero-masculino">Masculino</label>
        <input type="radio" id="genero-femenino" name="genero" value="Femenino">
        <label for="genero-femenino">Femenino</label>
        <input type="radio" id="genero-otro" name="genero" value="Otro">
        <label for="genero-otro">Otro</label><br><br>

        <label for="peso">Peso (kg):</label>
        <input type="number" id="peso" name="peso" step="0.01" required><br><br>

        <label for="altura">Altura (cm):</label>
        <input type="number" id="altura" name="altura" step="0.01" required><br><br>

        <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" required><br><br>

        <input type="submit" value="Guardar">
</form>


</html>