<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="Nombre Completo" name="nombre" required>
        <input type="email" placeholder="Email" name="email" required>
        <input type="text" placeholder="Usuario" name="usuario" required>
        <input type="password"  placeholder="Contraseña" name="contrasena" required>
        <input type="password"  placeholder="Repita Contraseña" name="repcontrasena" required>
        <input type="submit" name="reg" value="Registrar">
    </form>

    <?php
        if(isset($_POST['reg'])){

            require("config.php");

            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $usuario = $_POST['usuario'];
            $contrasena = md5($_POST['contrasena']);
            $repcontrasena = md5($_POST['repcontrasena']);
            

            $consulta = $connect->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
            $contarusuario = $consulta->num_rows;

            $consulta = $connect->query("SELECT * FROM usuarios WHERE email = '$email'");
            $contaremail = $consulta->num_rows;

            if($contarusuario == 0 && $contaremail == 0 && $contrasena == $repcontrasena){
                $insertar = $connect->query("INSERT INTO usuarios (nombre, usuario, contrasena, email, fecha_reg) VALUES ('$nombre','$usuario','$contrasena','$email',now())");
                if ($insertar) {
                    echo "Te has registrado correctamente";
                }
            }else{
                if($contarusuario > 0){
                    echo "El usuario ya existe<br>.<a href='login.php'> Inicie Sesión </a><br>";
                }
                if($contaremail >0){
                    echo "El email ya está en uso. <a href='login.php'> Inicie Sesión </a><br>";
                }
                if($contrasena != $repcontrasena) {
                    echo "Las contraseñas no coinciden. Vuelva a intentarlo.<br>";
                }
            }
        } 
    ?>
</body>
</html>