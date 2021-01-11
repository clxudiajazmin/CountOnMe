<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="Usuario" name="usuario" pattern="[A-Za-z_-0-9]{1,20}">
        <input type="password"  placeholder="Contraseña" name="contrasena" pattern="[A-Za-z_-0-9]{1,20}">
        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
    <a href='registro.php'> Quiero registrarme </a>

    <?php
        if(isset($_POST['login'])){
            require ("config.php");
            $usuario = $_POST['usuario'];
            $contrasena = md5($_POST['contrasena']);

            $validar = $connect->query("SELECT  * FROM usuarios WHERE usuario = '$usuario' AND  contrasena ='$contrasena'");
            $contar = $validar->num_rows;
            $dato = $validar->fetch_assoc();

            if ($contar == 1){
                $_SESSION['usuario'] = $usuario;
                $_SESSION['id'] = $dato['id'];
                header("Location: index.php");
            }
        }

    ?>
</body>
</html>