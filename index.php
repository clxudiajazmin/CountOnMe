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
        if(isset($_GET['apuntarse'])){
          require ("config.php");

          if($_GET['aforo'] >= $_GET['asistentes'] + 1){
            $apuntado = $connect->query("INSERT INTO asistencia (usuario, evento) 
                                        VALUES ('".$_SESSION['id']."','".$_GET['id']."')");
            $asistentes = $_GET['asistentes'] + 1;
            $sumar = $connect->query("UPDATE eventos SET asistentes = '".$asistentes."' WHERE id = '".$_GET['id']."'");
            if($sumar){
              header("Refresh: 0.1; url = index.php");
            }
          }else{
            echo "Aforo superado";
          }
          
        }
    ?>

    <?php
        if(isset($_GET['desapuntarse'])){
          require ("config.php");
          if($_GET['asistentes'] -1 >= 0){
            $apuntado = $connect->query("DELETE FROM asistencia WHERE usuario = '".$_SESSION['id']."' AND evento = '".$_GET['id']."'");
            $asistentes = $_GET['asistentes'] - 1;
            $restar = $connect->query("UPDATE eventos SET asistentes = '".$asistentes."' WHERE id = '".$_GET['id']."'");
            if($restar){
              header("Refresh: 0.1; url = index.php");
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
              <h1 style="margin:0px;"><span class="largenav">Count on Me</span></h1>
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
              $eventos = $connect->query("SELECT * FROM eventos ORDER BY usuario_org");

              while($row1 = $eventos->fetch_assoc()){
                  $usuario_org = $row1['usuario_org'];
                  $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '$usuario_org'");
                  $row2 = $solicitar->fetch_assoc();
                  $evento = $row1['id'];
                  $aforo = $row1['aforo'] - $row1['asistentes'];
                if($_SESSION['id'] != $usuario_org){
                  if($cuantos > 0){
                      $consulta = $connect->query("SELECT  * FROM asistencia WHERE evento = '$evento' AND usuario = '".$_SESSION['id']."'");
                      $listaapuntados= $consulta->fetch_assoc();
                      
                      if($consulta && isset($listaapuntados['evento'])){
                        echo "
                        <div class=\"col-md-4 evs mh-100\">
                          <div class=\"card bordeado\">
                              <div class=\"card-body\">
                                <h3 class=\"card-title\">
                                  <p class=\"text-dark\">".$row1['nombre']."</p>
                                  <a href='amigo.php?id=".$row2['id']."' class=\"text-dark\">".$row2['usuario']."</a>
                                </h3>
                                <p class=\"text-dark\">".$row1['descripcion']." </p>
                              </div>
                              <div class=\"card-footer\">
                                <div class=\"badge badge-danger float-right\">Aforo: ".$aforo."</div>
                                  <div class=\"float-left\">
                                    <p class=\"text-danger\">".$row1['categoria']."</p>
                                    <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                                  </div>
                                  <a href='?desapuntarse=desapuntarse&id=".$row1['id']."&aforo=".$row1['aforo']."&asistentes=".$row1['asistentes']."'> Desapuntarse </a>
                                </div>
                          </div>
                        </div>
                        ";
                        }else{
                          echo "
                          <div class=\"col-md-4 evs \">
                            <div class=\"card bordeado\">
                                <div class=\"card-body\">
                                  <h3 class=\"card-title\">
                                    <p class=\"text-dark\">".$row1['nombre']."</p>
                                    <a href='amigo.php?id=".$row2['id']."' class=\"text-dark\">".$row2['usuario']."</a>
                                  </h3>
                                  <p class=\"text-dark\">".$row1['descripcion']." </p>
                                </div>
                                <div class=\"card-footer\">
                                  <div class=\"badge badge-danger float-right\">Aforo: ".$aforo."</div>
                                    <div class=\"float-left\">
                                      <p class=\"text-danger\">".$row1['categoria']."</p>
                                      <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                                    </div>
                                    <a href='?apuntarse=apuntarse&id=".$row1['id']."&aforo=".$row1['aforo']."&asistentes=".$row1['asistentes']."'> Apuntarse </a>
                                  </div>
                            </div>
                          </div>
                          ";
                      }
            }else{
              echo "
                    <div class=\"col-md-4 evs \">
                      <div class=\"card bordeado\">
                          <div class=\"card-body\">
                            <h3 class=\"card-title\">
                              <p class=\"text-dark\">".$row1['nombre']."</p>
                              <a href='amigo.php?id=".$row2['id']."' class=\"text-dark\">".$row2['usuario']."</a>
                            </h3>
                            <p class=\"text-dark\">".$row1['descripcion']." </p>
                          </div>
                          <div class=\"card-footer\">
                            <div class=\"badge badge-danger float-right\">Aforo: ".$aforo."</div>
                              <div class=\"float-left\">
                                <p class=\"text-danger\">".$row1['categoria']."</p>
                                <p class=\"text-danger\"> En ".$row1['ubicacion']." el ".$row1['fecha']."</p>
                              </div>
                              <a href='?apuntarse=apuntarse&id=".$row1['id']."&aforo=".$row1['aforo']."&asistentes=".$row1['asistentes']."'> Apuntarse </a>
                            </div>
                      </div>
                    </div>
                    ";
            }
          }
        }
            ?>
          </div>
        </div>
      </div>
    </section>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src = "js/main.js"></script>

  <?php }else{
    header("Location: login.php");
    exit;
  }
  ?>

<?php
/*
  function filtrar (){
    require ("config.php");
    if(isset($_POST['buscar'])){
      $eventos = $connect->query("SELECT * FROM eventos ORDER BY usuario_org");
      $buscar = $_POST['textobusc'];
      while($row1 = $eventos->fetch_assoc()){
        if(strrpos($row1['nombre'], strtolower($buscar)) === true || strrpos($row1['ubicacion'], strtolower($buscar))=== true){
          echo "
          <div class=\"col-md-4 evs \">
            <div class=\"card bordeado\">

                <div class=\"card-body\">
                  <h3 class=\"card-title\">
                    <a href=\"\" class=\"text-dark\">".$row1['nombre']."</a>
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
    }
    
}
*/

?>
    <!--FOOTER-->
    <section id = "footer" >
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

