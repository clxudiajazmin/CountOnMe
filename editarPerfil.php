<?php
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Editar Perfil</title>

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/norm.css">
</head>
<body>
    <?php
        if(isset($_SESSION['usuario'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_SESSION['id']."'");
            $row = $solicitar->fetch_assoc();
        }
    ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- HEADER-->
    <div id ="flipkart-navbar">
      <div class="container">
        <div class="row row1">
          <div class="row row2">
            <div class="col-sm-2">
              <h1 style="margin:0px;"><span class="largenav"><a style="color:#FFFFFF; text-decoration: none;" href = "index.php">Count on Me</a></span></h1>
            </div>
            </div>
        </div>
      </div>
    </div>

    <br>
    <div class="container bootstrap snippet">
      <form action="" method="post" enctype="multipart/form-data" id="registrationForm">
      <div class="row">
        <div class="col-sm-3"><!--left col-->
          <div class="text-center">
            <img src = "<?php echo $row['avatar']; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
            <h6>Sube una nueva foto de perfil</h6>
            <input type="file" name="avatar" value ="<?php echo $row['avatar'];?>" class="text-center center-block file-upload fotomaxwidth" style="display:"Examinar";">


          </div>
        </div><!--/col-3-->
        	<div class="col-sm-9">
              <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="nombre"><h4>Nombre</h4></label>
                                  <input type="text" class="form-control" id="nombre" placeholder="Nombre" title="Introduce tu nombre." name="nombre" value ="<?php echo $row['nombre'];?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-6">
                                <label for="username"><h4>Usuario</h4></label>
                                  <input type="text" class="form-control" id="username" placeholder="Username" title="Introuduce tu nombre de usuario." name="usuario" value ="<?php echo $row['usuario'];?>">
                              </div>
                          </div>


                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="email"><h4>Email</h4></label>
                                  <input type="email" class="form-control" id="email" placeholder="you@email.com" title="Introduce tu email." name="email" value ="<?php echo $row['email'];?>">
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="fechanacimiento"><h4>Fecha de Nacimiento</h4></label>
                                  <input type="date" class="form-control" id="fechanacimiento" placeholder="Fecha de Nacimiento" title="Introduce tu fecha de nacimiento" name="nacimiento" value="<?php echo $row['nacimiento'];?>">
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-6">
                                <label for="text"><h4>Sexo</h4></label>
                                    <select class="form-control" name = "sexo">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="No binario">No binario</option>
                                        <option value="Prefiero no identificar">Prefiero no identificar</option>
                                    </select>
                            </div>
                        </div>

                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="descripcion"><h4>Descripcion</h4></label>
                                  <textarea class="form-control" rows="5" cols="5" name ="descripcion" placeholder="Describe para que los demás conozcan un poco sobre ti."><?php echo $row['descripcion'];?></textarea><br>
                            <hr>
                          </div>
                        </div>
                        
                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="password"><h4>Contraseña</h4></label>
                                  <input type="password" class="form-control" name="contrasena" id="password" placeholder="Contraseña" title="Introduce tu contraseña.">
                              </div>
                          </div>
                          <div class="form-group">

                              <div class="col-xs-6">
                                <label for="password2"><h4>Verifica tu contraseña</h4></label>
                                  <input type="password" class="form-control" name="repcontrasena" id="password2" placeholder="Contraseña" title="Introduce tu contraseña.">
                              </div>
                          </div>
                          <div class="form-group">
                               <div class="col-xs-12">
                                    <br>
                                  	<button class="btn btn-lg btn-success" type="submit" name = "act"> Guardar</button>
                                   	<button class="btn btn-lg" type="reset"><a href='index.php'> Regresar </a></button>
                                </div>
                          </div>
                  	</form>

                  <hr>

                 </div><!--/tab-pane-->
                 <!--/tab-pane-->


                  </div><!--/tab-pane-->
              </div><!--/tab-content-->

            </div><!--/col-9-->
      </div><!--/row-->

<br>
<br>
<br>

    <?php
        if(isset($_POST['act'])){
            $carpeta = "fotos_perfil/";
            $fichero = $carpeta.basename($_FILES['avatar']['name']);
            $ruta = $carpeta."id_".$_SESSION['id']."_fotoperfil.jpg";
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $sexo = $_POST['sexo'];
            $usuario = $_POST['usuario'];
            $nacimiento = $_POST['nacimiento'];
            $descripcion = $_POST['descripcion'];
            $contrasena = $_POST['contrasena'];
            $repcontrasena = $_POST['repcontrasena'];
            $contrasenaantigua = $row['contrasena'];

            if(empty($contrasena) and empty($repcontrasena)){
              echo "Sin contraseña";
              if(move_uploaded_file($_FILES['avatar']['tmp_name'], $carpeta."id_".$_SESSION['id']."_fotoperfil.jpg")){
                $insertar = $connect->query("UPDATE usuarios SET nombre ='$nombre', avatar = '$ruta', email = '$email', usuario = '$usuario', sexo = '$sexo', descripcion = '$descripcion', nacimiento = '$nacimiento' WHERE id = '".$_SESSION['id']."'");
                header("Refresh: 0.1; url = editarPerfil.php");

              }else{
                $insertar = $connect->query("UPDATE usuarios SET nombre ='$nombre', email = '$email', usuario = '$usuario', sexo = '$sexo', contrasena = '$contrasenaantigua', descripcion = '$descripcion', nacimiento = '$nacimiento' WHERE id = '".$_SESSION['id']."'");
                header("Refresh: 0.1; url = editarPerfil.php");

              }
          }else{
              $encriptada = md5($contrasena);
              if(move_uploaded_file($_FILES['avatar']['tmp_name'], $carpeta."id_".$_SESSION['id']."_fotoperfil.jpg") and $contrasena == $repcontrasena){
                $insertar = $connect->query("UPDATE usuarios SET nombre ='$nombre', avatar = '$ruta', contrasena = '$encriptada', email = '$email', usuario = '$usuario', sexo = '$sexo', descripcion = '$descripcion', nacimiento = '$nacimiento' WHERE id = '".$_SESSION['id']."'");
                                header("Refresh: 0.1; url = editarPerfil.php");

              }else{
                if($contrasena != $repcontrasena){
                  echo "Las contraseñas no coinciden. Vuelva a intentarlo.<br>";
                }else{
                  $insertar = $connect->query("UPDATE usuarios SET nombre ='$nombre', email = '$email', contrasena = '$encriptada', usuario = '$usuario', sexo = '$sexo', descripcion = '$descripcion', nacimiento = '$nacimiento' WHERE id = '".$_SESSION['id']."'");
                           header("Refresh: 0.1; url = editarPerfil.php");

                }
              }
            }
          
        }
    ?>

    </div>
       <!--FOOTER-->
   <section id = "footer">
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
