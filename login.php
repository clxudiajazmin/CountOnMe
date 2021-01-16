<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Count on Me</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/norm.css">
  </head>
  <body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <center>
      <div class="container">
        <div class="row">
          <div class="card">
            <article class="card-body">
              <h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
              <hr>
              <p class="text-success text-center">Bienvenido a Count on Me</p>
              <form action="" method="post">
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input type="text" placeholder="Usuario" name="usuario" class="form-control" required>
                  </div> <!-- input-group.// -->
                </div> <!-- form-group// -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input type="password"  placeholder="Contraseña" name="contrasena" class="form-control" required>
                  </div> <!-- input-group.// -->
                </div> <!-- form-group// -->
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block" name="login"> Login  </button>
                </div> <!-- form-group// -->
                <div class="form-group">
                  <h3>¿No tienes cuenta aún?</h3>
                  <button type="submit" class="btn btn-primary btn-block"><a href='registro.php'>Registrate aquí</a></button>
                </div> <!-- form-group// -->
                <p class="text-center"><a href="#" class="btn">Forgot password?</a></p>
              </form>
            </article>

          </div>

        </div>
      </div>
    </center>

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

    <!--FOOTER-->
    <section id = "footer" class = "absolute">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center">
                    <p><i>Count on Me</i> es un proyecto desarrollado por Sofía Martínez Parada y Claudia Jazmín Soria Saavedra para la asignatura de Desarrollo Web y de Apps</p>
                    <p class="h6">© All rights reserved.</p>
                </div>
                <hr>
            </div>
        </div>
    </section>
</body>
</html>
