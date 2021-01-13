<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
</head>
<body>
    <?php
        if(isset($_GET['id'])){
            require ("config.php");
            $eventos = $connect->query("SELECT  * FROM eventos WHERE id = '".$_GET['id']."'");
            $row = $eventos->fetch_assoc();
        }
    ?>
    <h1>Editar Evento</h1> 
    <form action="" method="post">
        <input type="text" placeholder="Nombre de Evento" name="nombre" required value ="<?php echo $row['nombre'];?>"><br><br>
        <input type="date" placeholder="Fecha de Evento" name="fecha" required value ="<?php echo $row['fecha'];?>"><br><br>
        <input type="number" placeholder="Aforo de Evento" name="aforo" required value ="<?php echo $row['aforo'];?>"><br><br>
        <textarea rows="10" cols="50" name ="descripcion" placeholder="Describe para que los demás sepan un poco más sobre el evento." ><?php echo $row['descripcion'];?></textarea><br><br>
        <input type="text" placeholder="Categoría de Evento" name="categoria" value ="<?php echo $row['categoria'];?>"><br><br>
        <input type="text" placeholder="Ubicación de Evento" name="ubicacion" value ="<?php echo $row['ubicacion'];?>"><br><br>
        <input type="submit" name="event" value="Crear Evento">
    </form>
    <br>
    <?php
        if(isset($_POST['event'])){
            $nombre = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $aforo = $_POST['aforo'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $ubicacion = $_POST['ubicacion'];

            $insertar = $connect->query("UPDATE eventos SET nombre = '$nombre', fecha = '$fecha', aforo = '$aforo', descripcion = '$descripcion', categoria = '$categoria', ubicacion = '$ubicacion' WHERE id = '".$_GET['id']."'");
            if ($insertar) {
                echo "Evento actualizado correctamente.";
                header("Refresh: 2; url = misEventos.php");
            }

        }
    ?>
    <br>
    <a href='misEventos.php'> Regresar </a>    

</body>
</html>