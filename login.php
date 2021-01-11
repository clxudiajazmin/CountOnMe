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
    <!--Bloque de Login Mantener los name-->
    <form action="" method="post">
        <input type="text" placeholder="Usuario" name="usuario" required>
        <input type="password"  placeholder="Contraseña" name="contrasena" required>
        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
    <!--Botón de Registro-->
    <a href='registro.php'> Quiero registrarme </a>

    <?php
        if(isset($_POST['login'])){
            //Necesito la conexión a la base de datos
            require ("config.php");
            //Recolecto datos de login
            $usuario = $_POST['usuario'];
            $contrasena = md5($_POST['contrasena']);
            //Hago consultas
            $validar = $connect->query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND  contrasena ='$contrasena'");
            $contar = $validar->num_rows;
            //Asocio datos a consulta
            $dato = $validar->fetch_assoc();
            //Si existe el usuario y contraseña
            if ($contar == 1){
                //Creo sesiones
                $_SESSION['usuario'] = $usuario;
                $_SESSION['id'] = $dato['id'];
                //Redirigo a index 
                header("Location: index.php");
            }
        }
    ?>
</body>
</html>