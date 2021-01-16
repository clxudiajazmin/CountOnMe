<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Count on Me</title>

    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/norm.css">
</head>
<body>
    <?php
        if(isset($_GET['id'])){
            require ("config.php");
            $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '".$_GET['id']."'");
            $row = $solicitar->fetch_assoc();
            $seguido = $connect->query("SELECT  * FROM amistades WHERE solicitante = '".$_SESSION['id']."' AND solicitado = '".$_GET['id']."'");
            $cuantos = $seguido->num_rows;
    ?>
    <?php
        if(isset($_GET['seguir'])){
          require ("config.php");
          if($cuantos > 0){
            header("Refresh: 1; url = amigo.php?id=".$_GET['id']);
          }
        }
    ?>
    
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

    <br>
    <div class="container bootstrap snippet">
      <div class="row">
        <div class="col-sm-3"><!--left col-->
          <div class="text-center">
            <img src = "<?php echo $row['avatar']; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
          </div>
        </div><!--/col-3-->
        	<div class="col-sm-9">
              <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="nombre"><h4>Nombre: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['nombre'];?></h4></label>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-6">
                                <label for="username"><h4>Usuario: </h4></label>
                                <label for="nombre"><h4><?php echo $row['usuario'];?></h4></label>
                              </div>
                          </div>


                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="email"><h4>Email: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['email'];?></h4></label>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-xs-6">
                                  <label for="fechanacimiento"><h4>Fecha de Nacimiento: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['nacimiento'];?></h4></label>
                              </div>
                          </div>

                          <div class="form-group">
                            <div class="col-xs-6">
                                <label for="text"><h4>Sexo: </h4></label>
                                <label for="nombre"><h4><?php echo $row['sexo'];?></h4></label>
                            </div>
                        </div>

                          <div class="form-group">

                              <div class="col-xs-6">
                                  <label for="descripcion"><h4>Descripcion: </h4></label>
                                  <label for="nombre"><h4><?php echo $row['descripcion'];?></h4></label>

                          </div>
                          <div class="form-group">
                               <div class="col-xs-12">
                                    <br>
                                    <?php
                                        if($cuantos > 0){
                                    ?>
                                    <a href="?seguir=seguir&id=<?php echo $_GET['id'];?>"><button class="btn btn-lg btn-success" type="submit">Seguido</button></a>
                                    <?php
                                        $seguir = $connect->query("INSERT INTO amistades (solicitante, solicitado, aceptado) 
                                        VALUES ('".$_SESSION['id']."','".$_GET['id']."', '1')");
                                        }else{
                                    ?>
                                    <a href="?seguir=seguir&id=<?php echo $_GET['id'];?>"><button class="btn btn-lg btn-success" type="submit">Seguir</button></a>
                                    <?php
                                        $seguir = $connect->query("INSERT INTO amistades (solicitante, solicitado, aceptado) 
                                        VALUES ('".$_SESSION['id']."','".$_GET['id']."', '1')");
                                        }
                                    ?>
                                   	<button class="btn btn-lg" type="reset"><a href='index.php'> Regresar </a></button>
                                </div>
                          </div>

                  <hr>

                 </div><!--/tab-pane-->
                 <!--/tab-pane-->


                  </div><!--/tab-pane-->
              </div><!--/tab-content-->

            </div><!--/col-9-->
      </div><!--/row-->

      <section class="sections random-product ">
      <div class="container-fluid">
        <div class="container">
          <div class="row" id = "resultado">
            <?php
              $eventos = $connect->query("SELECT * FROM eventos WHERE usuario_org = '".$_GET['id']."'");
              while($row1 = $eventos->fetch_assoc()){
                  echo "
                  <div class=\"col-md-4 evs \">
                    <div class=\"card bordeado\">
                        <div class=\"card-body\">
                          <h3 class=\"card-title\">
                            <a href='verEvento.php?id=".$row1['id']."' class=\"text-dark\">".$row1['nombre']."</a><br>
                          </h3>
                        </div>
                        <div class=\"card-footer\">
                          <div class=\"badge badge-danger float-right\">Aforo: ".$row1['aforo']."</div>
                            <div class=\"float-left\">
                              <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                            </div>
                          </div>
                    </div>
                  </div>
                  ";
              }
            ?>
          </div>
        </div>
      </div>
    </section>

<br>
<br>
<br>
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
       
    <?php }else{
            echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
        }

    ?>

</body>
</html>