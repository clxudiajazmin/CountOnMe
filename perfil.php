<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento</title>
</head>
<body>
    <?php
        if(isset($_SESSION['usuario'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_SESSION['id']."'");
            $row = $solicitar->fetch_assoc();
    ?>
        <div>
            <h1> <?php echo $row['nombre']?></h1>
            <!--Esta es la barra superior, donde va el logo y el nombre y logout.-->
            <a href='index.php'> Inicio </a><br>
            <a href='crearEvento.php'> Crear evento </a><br>
            <a href='misEventos.php'> Mis Eventos </a><br>
            <a href='logout.php'> Salir </a><br>
            <br><br><br>
            
        </div>

        <div>
            <!--Imagen de perfil.-->
            <img src = "<?php echo $row['avatar']; ?>" width="100">
            <br><br>
            <!--Usuario.-->
            <?php echo "Usuario: ";?>
            <?php echo $row['usuario'];?>
            <br><br>
            <!--Fecha de Nacimiento.-->
            <?php echo "Fecha de Nacimiento: ";?>
            <?php echo $row['nacimiento'];?>
            <br><br>
            <!--Sexo.-->
            <?php echo "Sexo: ";?>
            <?php echo $row['sexo'];?>
            <br><br>
            <!--Descripción.-->
            <?php echo "Descripción: ";?>
            <?php echo $row['descripcion'];?>
            <br><br>
            <!--Fecha de registro.-->
            <?php echo "Eres parte de Count On Me desde: ";?>
            <?php echo $row['fecha_reg'];?>
            <br><br><br>
            <a href='editarPerfil.php'> Editar Perfil </a><br>
        </div>
    <?php }else{
            echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
        }

    ?>

</body>
</html>