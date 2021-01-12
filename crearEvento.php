<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento</title>
</head>
<body>
    <?php
        if(isset($_SESSION['usuario'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_SESSION['id']."'");
            $row = $solicitar->fetch_assoc();
        }
    ?>
    <h1>Crear Evento</h1> 
    <form action="" method="post">
        <input type="text" placeholder="Nombre de Evento" name="nombre" required><br><br>
        <input type="date" placeholder="Fecha de Evento" name="fecha" required><br><br>
        <input type="number" placeholder="Aforo de Evento" name="aforo" required><br><br>
        <textarea rows="10" cols="50" name ="descripcion" placeholder="Describe para que los demás sepan un poco más sobre el evento."></textarea><br><br>
        <input type="text" placeholder="Categoría de Evento" name="categoria"><br><br>
        <input type="text" placeholder="Ubicación de Evento" name="ubicacion"><br><br>
        <input type="submit" name="event" value="Crear Evento">
    </form>

    <?php
        if(isset($_POST['event'])){
            require("config.php");

            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $aforo = $_POST['aforo'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $ubicacion = $_POST['ubicacion'];
            

            $insertar = $connect->query("INSERT INTO eventos (nombre, fecha, usuario_org, aforo, descripcion, categoria, ubicacion) 
                                        VALUES ('$nombre','$fecha','".$_SESSION['id']."', '$aforo', '$descripcion', '$categoria', '$ubicacion')");
            if ($insertar) {
                echo "Evento creado correctamente.";
                header("Refresh: 2; url = index.php");
            }
        } 
    ?>
    <br><br>
    <a href='index.php'> Regresar </a>    
</body>
</html>