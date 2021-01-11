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
        <input type="file" name="avatar">
        <input type="text" placeholder="Nombre Completo" name="nombre" value ="<?php echo $row['nombre'];?>" required>
        <input type="email" placeholder="Email" name="email" value ="<?php echo $row['email'];?>" required>
        <input type="text" placeholder="Usuario" name="usuario" value ="<?php echo $row['usuario'];?>" required>
        <input type="text" placeholder="Sexo" name="sexo" value ="<?php echo $row['sexo'];?>" required>
        <textarea rows="10" cols="50" placeholder="Describe para que los demás conozcan un poco sobre ti."></textarea>
        <input type="submit" name="reg" value="Actualizar Perfil">
    </form>
    <br>
    <a href='index.php'> Regresar </a>    

</body>
</html>