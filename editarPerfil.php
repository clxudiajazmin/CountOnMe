<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>
<body>
    <?php
        if(isset($_SESSION['usuario'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_SESSION['id']."'");
            $row = $solicitar->fetch_assoc();
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" value ="<?php echo $row['avatar'];?>"><br>
        <input type="text" placeholder="Nombre Completo" name="nombre" value ="<?php echo $row['nombre'];?>" required><br>
        <input type="email" placeholder="Email" name="email" value ="<?php echo $row['email'];?>" required><br>
        <input type="text" placeholder="Usuario" name="usuario" value ="<?php echo $row['usuario'];?>" required><br>
        <input type="text" placeholder="Sexo" name="sexo" value ="<?php echo $row['sexo'];?>" required><br>
        <input type="date" placeholder="Fecha de Nacimiento" name="nacimiento" value="<?php echo $row['nacimiento'];?>" required><br>
        <textarea rows="10" cols="50" name ="descripcion" placeholder="Describe para que los demás conozcan un poco sobre ti."><?php echo $row['descripcion'];?></textarea><br>
        <input type="submit" name="act" value="Actualizar Perfil"><br>
    </form>
    <br>
    <?php
        if(isset($_POST['act'])){
            $carpeta = "fotos_perfil/";
            $fichero = $carpeta.basename($_FILES['avatar']['name']);
            $ruta = $carpeta."id_".$_SESSION['id']."_fotoperfil.jpg";
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $usuario = $_POST['usuario'];
            $sexo = $_POST['sexo'];
            $nacimiento = $_POST['nacimiento'];
            $descripcion = $_POST['descripcion'];

            if(move_uploaded_file($_FILES['avatar']['tmp_name'], $carpeta."id_".$_SESSION['id']."_fotoperfil.jpg")){

                $insertar = $connect->query("UPDATE usuarios SET nombre ='$nombre', avatar = '$ruta', email = '$email', usuario = '$usuario', sexo = '$sexo', descripcion = '$descripcion', nacimiento = '$nacimiento' WHERE id = '".$_SESSION['id']."'");
                echo "Datos actualizados correctamente.";
                header("Refresh: 2; url = index.php");
            }else{
                $insertar = $connect->query("UPDATE usuarios SET nombre ='$nombre', email = '$email', usuario = '$usuario', sexo = '$sexo', descripcion = '$descripcion', nacimiento = '$nacimiento' WHERE id = '".$_SESSION['id']."'");
                echo "Datos actualizados correctamente.";
                header("Refresh: 1; url = index.php");
            }

        }
    ?>
    <br>
    <a href='index.php'> Regresar </a>    

</body>
</html>