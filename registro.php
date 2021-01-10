<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<title>Registro</title>
</head>
<body>

<?php
require('config.php');
if (isset($_REQUEST['username'])){
    $nombre = stripslashes($_REQUEST['nombre']);
    $nombre = mysqli_real_escape_string($con,$nombre); 
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con,$email);
    $usuario = stripslashes($_REQUEST['usuario']);
    $usuario = mysqli_real_escape_string($con,$usuario);
    $contrasena = stripslashes($_REQUEST['contrasena']);
    $contrasena = mysqli_real_escape_string($con,$contrasena);
    $repcontrasena = stripslashes($_REQUEST['repcontrasena']);
    $repcontrasena = mysqli_real_escape_string($con,$repcontrasena);

    $query = "SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
    $comprobarusuario = mysqli_query($con,$query) or die(mysqli_error());

    $query = "SELECT email FROM usuarios WHERE email = '$email'";
    $comprobaremail = mysqli_query($con,$query) or die(mysqli_error());

   
    $query = "INSERT INTO usuarios (nombre,email,usuario,contrasena,fecha_reg) values ('$nombre','$email','$usuario','".md5($contrasena)."',now())";
    $result = mysqli_query($con,$query);
            
    if($result){
        echo "<div class='form'>
        <h3>Te has registrado correctamente.</h3>
        <br/>Haz clickpara Ingresar <a href='login.php'>Login</a></div>";
    }
    }else{
?>

<div class="form">
<h1>Registro</h1>
    <form action="" method="post">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" required>
        <input type="email" name="email" class="form-control" placeholder="Email" required>  
        <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
        <input type="password" name="repcontrasena" class="form-control" placeholder="Repita la contraseña" required>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1" required>
            <label class="custom-control-label" for="customCheck1">Acepto los términos y condiciones</label>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
        <input type="submit" name="submit" value="Register" />
    </form>
</div>
<?php }?>
</body>
</html>