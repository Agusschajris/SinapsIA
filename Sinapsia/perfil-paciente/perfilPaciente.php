<?php
require_once("../configuracion/dbconfig.php");
require_once("../configuracion/functions.php");
session_start();

if($_SESSION['loggedin']==false || !isset($_SESSION['loggedin'])){
    header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php");
}
if(isset($_GET['id_paciente'])){
    $_SESSION['paciente_seleccionado'] = $_GET['id_paciente'];

}

    $sql = "SELECT nombre,apellido,mail,dni FROM paciente WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i",$_SESSION['paciente_seleccionado']);
   
    if($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $dni = $row['dni'];
        $mail = $row['mail'];
    }
    else{
        echo "Error: ".mysqli_error($mysqli);
    }
$errores = [];
$query = "SELECT * FROM problemasprevios WHERE id_paciente = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i",$_SESSION['paciente_seleccionado']);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if($row){
                header("Location: ../respuesta/Respuesta.php");
                
            }
        }
        else{
            echo "Error: ".mysqli_error($mysqli);
        }
    if(post_request()){
        // ... (código anterior)

        // ... (código anterior)

$opcionesmadur = isset($_POST['opcionesmadur']) ? ($_POST['opcionesmadur'] == 'SI' ? 'SI' : 'NO') : '';
$opcionesprevia = isset($_POST['opcionesprevia']) ? ($_POST['opcionesprevia'] == 'SI' ? 'SI' : 'NO') : '';
$opcionespato = isset($_POST['opcionespato']) ? ($_POST['opcionespato'] == 'SI' ? 'SI' : 'NO') : '';
$opcionesmedic = isset($_POST['opcionesmedic']) ? ($_POST['opcionesmedic'] == 'SI' ? 'SI' : 'NO') : '';
$opcionesfami = isset($_POST['opcionesfami']) ? ($_POST['opcionesfami'] == 'SI' ? 'SI' : 'NO') : '';

$query = "INSERT INTO problemasprevios (descripcionsintomas,manifiesto,descripcionmadur,descripcionprevia,descripcionpatologia,descripcionmedicaciones,descripcionfami,conciencia,parto,antecedentemadur,enfermedadprevia,patologia,medicaciones,antecedentesfami,id_paciente) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssssssssssssssi", $_POST['sintomas'], $_POST['momentomanifiesto'], $_POST['antecedente'], $_POST['detalleenfermedad'], $_POST['detallepatologia'], $_POST['medicaciones'], $_POST['familiares'], $_POST['estadoconciencia'], $_POST['parto'], $opcionesmadur, $opcionesprevia, $opcionespato, $opcionesmedic, $opcionesfami, $_SESSION['paciente_seleccionado']);

                if($stmt->execute()){
                    header("Location:http://localhost/Proyecto-4to-SinapsIA/Sinapsia/perfil-paciente/perfilPaciente.php");
                }
                else{
                    echo "Error: ".mysqli_error($mysqli);
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
    <link rel="stylesheet" href="perfilPaciente.css">
</head>
<body>
    <div class="contenedor">

        <a href="#"><img src="../logos/back.png" alt="Inicio" class="back" onclick="window.location.href = '../home/index.php'">
        </a> 
        
        <div class="divIzquierda">

        <div class="perfil">

            <div class="applyColumn">

            <div class="pacienteyfoto">

           <div class="pac"> PACIENTE </div>
            <img src="../logos/foto2.png" class="foto">

           </div> 

        <div class="nombreApellido">

            <p class="f1">NOMBRE</p>
            <p class="f2"><?php echo $nombre; ?></p>
            <p class="f3">APELLIDO</p>
            <p class="f4"><?php echo $apellido; ?></p>

        </div>

         </div class=dniCorreo>

         <p class="f5">DNI</p>
         <p class="f6"><?php echo $dni; ?></p>
         <p class="f7">CORREO</p>
         <p class="f8"><?php echo $mail; ?></p>

        </div>

        <button class="botonArchivos"> 

            <div class="texto">
                INGRESA TUS 
                ARCHIVOS 
                EEG AQUI
            </div>
            
            <img src="../logos/doc.png" class="doc">
            </a> 
        
        </button>
        </div>
        <div class="divDerecha">
             

            <form class="datosDelPaciente" method="POST"><p class="datosTitle">DATOS DEL PACIENTE</p> Haga una descripción de los síntomas que presenta el paciente
                <input type="text" name="sintomas" id="sintomas" >

                ¿En qué momentos se manifiestan estos síntomas y cómo ceden? (si es que lo hacen)
                <input type="text" name="momentomanifiesto" id="momentomanifesto">
                
                ¿El paciente padece algún antecedente madurativo?
                <input type="radio" name="opcionesmadur" id="opcion1madur" value="SI" class="excluir"> <label for="opcionesmadur" class="excluir">SÍ</label> <input type="radio" name="opcionesmadur" id="opcionmadur2" value="NO" class="excluir"> <label for="opcionesmadur2" class="excluir">NO</label>

                De haber sido así, proporcione cualquier detalle necesario acerca de este antecedente
                <input type="text" name="antecedente" id="antecedente">

                ¿El paciente ha padecido alguna enfermedad previamente?
                <input type="radio" name="opcionesprevia" id="opcionprevia1" value="SI" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionesprevia" id="opcionprevia2" value="NO" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione cualquier detalle necesario acerca de esta enfermedad
                <input type="text" name="detalleenfermedad" id="detalleenfermedad">

                ¿El paciente padece alguna patología o existe la posibilidad que la padezca?
                <input type="radio" name="opcionespato" id="opcionpato1" value="SI" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionespato" id="opcionpato2" value="NO" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione cualquier detalle necesario acerca de la misma
                <input type="text" id="detallepatologia" name="detallepatologia">

                ¿El paciente está tomando medicaciones actualmente?
                <input type="radio" name="opcionesmedic" id="opcionmedic1" value="SI" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionesmedic" id="opcionmedic2" value="NO" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione los nombres de las mismas
                <input type="text" name="medicaciones" id="medicaciones">

                ¿Existen antecedentes familiares con respecto a la epilepsia?
                <input type="radio" name="opcionesfami" id="opcionfami1" value="SI" class="excluir"> <label for="opcion1" class="excluir">SÍ</label> <input type="radio" name="opcionesfami" id="opcionfami2" value="NO" class="excluir"> <label for="opcion2" class="excluir">NO</label>

                De ser así, proporcione detalles acerca de este
                <input type="text" name="familiares" id="familiares">

                ¿Cuál era el estado de conciencia del paciente a la hora de realizar el estudio?
                <input type="text" name="estadoconciencia" id="estadoconciencia">

                Proporcione detalles acerca del parto del paciente (El tipo de parto, complicaciones que podrían haber sucedido y si hubo intervención médica)
                <input type="text" name="parto" id="parto">

                <div class="guardar-button-container">
                <input type="submit"  value="GUARDAR" class="guardar-button">
                </div>
            </form>

        </div>
       
    </div>
</body>

</html>