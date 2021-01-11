<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    
    <?php
        if(isset($_SESSION['usuario'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_SESSION['id']."'");
            $row = $solicitar->fetch_assoc();
    ?>
        <div>
            <!--Esta es la barra superior, donde va el logo y el nombre y logout.-->
            <?php 
                echo "Bienvenid@,  ". $row['nombre']. "<br>" ;
            ?>
            <a href='logout.php'> Salir </a>
            
        </div>

        <div>
            <!--Barra lateral de perfil .-->
            <!--Imagen de perfil.-->
            <img src = "<?php echo $row['avatar']; ?>" width="100">
            <br>
            <!--Usuario.-->
            <?php echo $row['usuario'];?>
            <br>
            <!--Fecha de Nacimiento.-->
            <?php echo $row['nacimiento'];?>
            <br>
            <!--Sexo.-->
            <?php echo $row['sexo'];?>
            <br>
            <!--Descripción.-->
            <?php echo $row['descripcion'];?>
            <br>
            <!--Fecha de registro.-->
            <?php echo $row['fecha_reg'];?>
            <br>
            <a href='editarPerfil.php'> Editar Perfil</a>
            
        </div>
    <?php }else{
            echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
        }

    ?>

</body>
</html>