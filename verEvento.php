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
        if(isset($_GET['id']) && isset($_SESSION['usuario'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_SESSION['id']."'");
            $row = $solicitar->fetch_assoc();
            $eventos = $connect->query("SELECT  * FROM eventos WHERE id = '".$_GET['id']."'");
            $row1 = $eventos->fetch_assoc();
    ?>
        <div>
            <!--Esta es la barra superior, donde va el logo y el nombre y logout.-->
            <a href='INDEX.php'> Inicio </a><br>
            <a href='crearEvento.php'> Crear evento </a><br>
            <a href='misAmigos.php'> Mis Amigos </a><br>
            <a href='logout.php'> Salir </a><br>
            <br><br><br>
            <a href='misEventos.php'> Atrás </a><br>
            
        </div>

        <div>
            <!--Barra lateral de perfil .-->
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
            <br><br>
            <a href='editarPerfil.php'> Editar Perfil</a>
            <br><br>
            
        </div>
        <div>  
        <!--Parte de eventos--> 
            <?php
                echo "Nombre del evento:";
                echo $row1['nombre']."<br>";
                echo "Fecha:";
                echo $row1['fecha']."<br>";
                echo "Aforo:";
                echo $row1['aforo']."<br>";
                echo "Descripción:";
                echo $row1['descripcion']."<br>";
                echo "Categoría:";
                echo $row1['categoria']."<br>";
                echo "Ubicación:";
                echo $row1['ubicacion']."<br><br><br>";
            ?>
        </div>
    <?php }else{
            echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
        }

    ?>

</body>
</html>