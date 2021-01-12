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
        if(isset($_GET['id'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_GET['id']."'");
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
            <?php echo "Es parte de Count On Me desde: ";?>
            <?php echo $row['fecha_reg'];?>
            <br><br>
            
        </div>
        <div>  
        <h1> Sus Eventos</h1>
        <!--Parte de eventos--> 
            <?php
                $eventos = $connect->query("SELECT * FROM eventos WHERE usuario_org = '".$_GET['id']."'");
                while($row1 = $eventos->fetch_assoc()){
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
                }
            ?>
        </div>
    <?php }else{
            echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
        }

    ?>

</body>
</html>