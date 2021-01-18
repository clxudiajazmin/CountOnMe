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

    <!-- HEADER-->
    <div id ="flipkart-navbar">
      <div class="container">
        <div class="row row1">
          <div class="row row2">
            <div class="col-sm-2">
              <h1 style="margin:0px;"><span class="largenav">Count on Me</span></h1>
            </div>
            </div>
        </div>
      </div>
    </div>

    <!--CUERPO-->
    <center>
      <div class="container">
        <div class="row">
          <div class="card">
            <article class="card-body">
              <h4 class="card-title text-center mb-4 mt-1">Regístrate aquí</h4>
              <hr>
              <form action="" method="post">

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-user"></i> Nombre </span>
                    </div>
                    <input name="nombre" class="form-control" placeholder="Nombre" type="text">
                  </div> <!-- input-group.// -->
                </div> <!-- form-group// -->

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-user"></i> Username </span>
                    </div>
                    <input name="usuario" class="form-control" placeholder="Username" type="text">
                  </div> <!-- input-group.// -->
                </div> <!-- form-group// -->

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-user"></i> Email </span>
                    </div>
                    <input name="email" class="form-control" placeholder="Email" type="email">
                  </div> <!-- input-group.// -->
                </div> <!-- form-group// -->

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-lock"></i> Contraseña </span>
                    </div>
                    <input name = "contrasena" class="form-control" placeholder="******" type="password">
                  </div> <!-- input-group.// -->
                </div> <!-- form-group// -->

                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"> <i class="fa fa-lock"></i> Repite la Contraseña</span>
                    </div>
                    <input name = "repcontrasena"  class="form-control" placeholder="******" type="password">
                  </div> <!-- input-group.// -->
                </div> <!-- form-group// -->

                <div class="form-group">
                  <button type="submit" name = "reg" class="btn btn-primary btn-block"> Registrarme  </button>
                </div> <!-- form-group// -->
                </form>
            </article>
          </div>
        </div>
      </div>
    </center>


    <?php
        if(isset($_POST['reg'])){
            //Necesito la base de datos
            require("config.php");
            //Recolecto datos de registro
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $usuario = $_POST['usuario'];
            $contrasena = md5($_POST['contrasena']);
            $repcontrasena = md5($_POST['repcontrasena']);
            
            //Consultar existencia de usuario
            $consulta = $connect->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");
            $contarusuario = $consulta->num_rows;
            //Consultar existencia de email
            $consulta = $connect->query("SELECT * FROM usuarios WHERE email = '$email'");
            $contaremail = $consulta->num_rows;
            //Si no existe se ingresan los datos en la BD
            if($contarusuario == 0 and $contaremail == 0 and $contrasena == $repcontrasena){
                //Ingreso de datos
                $insertar = $connect->query("INSERT INTO usuarios (nombre, usuario, contrasena, email, fecha_reg) VALUES ('$nombre','$usuario','$contrasena','$email',now())");
                //Inserción correcta
                if ($insertar) {
                    echo "Te has registrado correctamente";
                    header("Refresh: 2; url = login.php");
                }else{
                    echo "Error en ingresar datos";
                }
            }else{
                if($contarusuario > 0){
                    echo "El usuario ya existe. Prefieres <a href='login.php'> Iniciar Sesión </a><br>";
                }else{
                    if($contaremail >0){
                        echo "El email ya está en uso. Prefieres <a href='login.php'> Iniciar Sesión </a><br>";
                    }else{
                        if($contrasena != $repcontrasena) {
                            echo "Las contraseñas no coinciden. Vuelva a intentarlo.<br>";
                        }
                    }
                    
                }
            }
        } 
    ?>
        <!--FOOTER-->
      <section id = "footer" class="absolute">
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