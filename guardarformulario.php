<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Estilos, css, bootstrap -->
  <link Type="text/css" rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/estilos.css">
  <link rel="icon" href="favicon.ico">
  <!-- Titulo de la pagina -->
  <title>Class-lilac - Guardado</title>
</head>
<body style="text-align:center; font-size: 40px;">
    <br><br>
    <br><br>
    <!-- Implementacion de php para guardar los datos y la imagen -->
    <?php
    include "conexion.php";
        // Si el archivo es subido
        $status = $statusMsg = ''; 
        if(isset($_POST["submit"])){ 
            $status = 'error'; 
            if(!empty($_FILES["imagen"]["name"])) { 
                // Conseguir informacion del archivo 
                $fileName = basename($_FILES["imagen"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                
                // Permitir ciertos formato 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes)){ 
                    $image = $_FILES['imagen']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    $fecha_ingreso = date("Y/m/d", strtotime($_POST['fechaIngreso']) );
                    $sql = "INSERT INTO basededatoslab4.producto (id, nombre, imagen, precio, categoria, temporada, fechaIngreso, descripcion)
                    VALUES ( '', '$_POST[nombre]', '$imgContent', '$_POST[precio]', '$_POST[categoria]', '$_POST[temporada]', '$fecha_ingreso' , '$_POST[descripcion]' ) ";
                  
                }else{ 
                    $statusMsg = 'Lo siento, solo archivos JPG, JPEG, PNG, & GIF son permitidas para agregar al registro.'; 
                } 
            }else{ 
                $fecha_ingreso = date("Y/m/d", strtotime($_POST['fechaIngreso']) );
                $sql = "INSERT INTO basededatoslab4.producto (id, nombre, imagen, precio, categoria, temporada, fechaIngreso, descripcion)
                VALUES ( '', '$_POST[nombre]', 'NULL', '$_POST[precio]', '$_POST[categoria]', '$_POST[temporada]', '$fecha_ingreso' , '$_POST[descripcion]' ) ";

            } 
            
            if ($conn->query($sql) === TRUE){
                echo '<br><div class= center-h1> <h1 class="color-h1"> Registro agregado satisfactoriamente </h1> </div> <br> ';
            }else{
                echo "Error: ". $sql . "<br>" . $conn->error;
            }
            $conn->close();
        } 
        // Mensaje
        echo $statusMsg; 
    ?>
    <br><br>
    <br><br>
    <a href="index.php"><button class=" btn btn-primary col-12">Ir al inicio</button> </a>
</body>