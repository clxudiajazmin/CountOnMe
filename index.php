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
            <h1>Bienvenid@ <?php echo $row['nombre']?></h1>
            <!--Esta es la barra superior, donde va el logo y el nombre y logout.-->
            <a href='crearEvento.php'> Crear evento </a><br>
            <a href='misEventos.php'> Mis Eventos </a><br>
            <a href='misAmigos.php'> Mis Amigos </a><br>
            <a href='logout.php'> Salir </a><br>
            
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
        <h1> Eventos</h1>
        <!--Parte de eventos--> 
            <?php
            $eventos = $connect->query("SELECT * FROM eventos ORDER BY usuario_org");
            while($row1 = $eventos->fetch_assoc()){
                $usuario_org = $row1['usuario_org'];
                $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '$usuario_org'");
                $row2 = $solicitar->fetch_assoc();
                echo "Nombre del evento:";
                echo "<a href='verEvento.php?id=".$row1['id']."'>".$row1['nombre']."</a><br>";
                echo "Fecha:";
                echo $row1['fecha']."<br>";
                echo "Aforo:";
                echo $row1['aforo']."<br>";
                echo "Evento creado por:";
                if($usuario_org == $_SESSION['id']){
                    echo $row2['usuario']."</a><br><br><br>";
                }else{
                    echo "<a href='amigo.php?id=".$row2['id']."'>".$row2['usuario']."</a><br><br><br>";
                }
            }
            ?>
        </div>
    <?php }else{
            echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
        }

    ?>

</body>
</html>