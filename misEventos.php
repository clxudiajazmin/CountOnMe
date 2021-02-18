<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

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

            $apuntados = $connect->query("SELECT  * FROM asistencia WHERE usuario = '".$_SESSION['id']."'");
            $cuantos = $apuntados->num_rows;
    ?>

    <?php
        if(isset($_GET['desapuntarse'])){
          require ("config.php");
          if($_GET['asistentes'] -1 >= 0){
            $apuntado = $connect->query("DELETE FROM asistencia WHERE usuario = '".$_SESSION['id']."' AND evento = '".$_GET['id']."'");
            $asistentes = $_GET['asistentes'] - 1;
            $restar = $connect->query("UPDATE eventos SET asistentes = '".$asistentes."' WHERE id = '".$_GET['id']."'");
            if($restar){
              header("Refresh: 0.1; url = misEventos.php");
            }
          }
        }
    ?>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<!-- HEADER-->
    <div id ="flipkart-navbar">
    <div class="container">
        <div class="row row1">
        <ul class= "largenav pull-right">
            <li class="upper-links"><a class="links" href="misAmigos.php">AMIGOS</a></li>
            <li class="upper-links"><a class="links" href="misEventos.php">MIS EVENTOS</a></li>
            <li class="upper-links"><a class="links" href="crearEvento.php">CREAR EVENTO</a></li>
            <li class="upper-links"><a class="links" href="editarPerfil.php"><?php echo strtoupper($row['nombre']) ?></a></li>
            <li class="upper-links"><a class="links" href="logout.php">SALIR</a></li>

        </ul>
        <div class="row row2">
            <div class="col-sm-2">
              <h1 style="margin:0px;"><span class="largenav"><a style="color:#FFFFFF; text-decoration: none;" href = "index.php">Count on Me</a></span></h1>
            </div>
            <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
            <div class="row">
                <input class="flipkart-navbar-input col-xs-11" type="text" id="buscador" placeholder="Busca tu evento" name = "textobusc">
                <button class="flipkart-navbar-button col-xs-1" id = "boton" name="buscar">
                    <svg width="15px" height="15px">
                        <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                    </svg>
                </button>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!--CUERPO-->
    <section class="sections random-product ">
      <div class="container-fluid">
        <div class="container">
          <div class="row" id = "resultado">
            <?php
              $eventos = $connect->query("SELECT * FROM eventos WHERE usuario_org = '".$_SESSION['id']."'");
              $eventosap = $connect->query("SELECT * FROM eventos");
              while($row1 = $eventos->fetch_assoc()){
                    echo "
                  <div class=\"col-md-4 evs \">
                    <div class=\"card bordeado\">
                        <div class=\"card-body\">
                          <h3 class=\"card-title\">
                            <p class=\"text-dark\">".$row1['nombre']."</p>
                          </h3>
                          <p class=\"text-dark\">".$row1['descripcion']." </p>
                        </div>
                        <div class=\"card-footer\">
                          <div class=\"badge badge-danger float-right\">Aforo: ".$row1['aforo']."</div>
                            <div class=\"float-left\">
                              <p class=\"text-danger\">".$row1['categoria']."</p>
                              <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                            </div>
                            <a href='editarEvento.php?id=".$row1['id']."'> Editar </a>
                          </div>
                    </div>
                  </div>
                  ";
              }
              while($row2 = $eventosap->fetch_assoc()){
                  $evento = $row2['id'];
                  if($cuantos > 0){
                    $consulta = $connect->query("SELECT  * FROM asistencia WHERE evento = '$evento' AND usuario = '".$_SESSION['id']."'");
                    $listaapuntados= $consulta->fetch_assoc();
                    if($consulta && isset($listaapuntados['evento'])){
                      echo "
                        <div class=\"col-md-4 evs \">
                          <div class=\"card bordeado\">
                              <div class=\"card-body\">
                                <h3 class=\"card-title\">
                                  <p class=\"text-dark\">".$row2['nombre']."</p>
                                </h3>
                                <p class=\"text-dark\">".$row2['descripcion']." </p>
                              </div>
                              <div class=\"card-footer\">
                                <div class=\"badge badge-danger float-right\">Aforo: ".$row2['aforo']."</div>
                                  <div class=\"float-left\">
                                    <p class=\"text-danger\">".$row2['categoria']."</p>
                                    <p class=\"text-danger\"> En ".$row2['ubicacion']." el ".$row2['fecha']."</p>
                                  </div>
                                  <a href='?desapuntarse=desapuntarse&id=".$row2['id']."&aforo=".$row2['aforo']."&asistentes=".$row2['asistentes']."'> Desapuntarse </a>
                                </div>
                          </div>
                        </div>
                        ";
                    }
                    
                  }
              }
              
            ?>
          </div>
          <div class="form-group">
        <div class="col-xs-12">
          <br>
          <button class="btn btn-lg" type="reset"><a href='index.php'> Regresar </a></button>
        </div>
        </div>
        </div>
      </div>
    </section>
        <!--FOOTER-->
    <section id = "footer" class = "fixed">
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

    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src = "js/main.js"></script>
    <?php }else{
            echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
        }

    ?>

</body>
</html>