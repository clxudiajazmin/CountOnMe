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
              $eventos = $connect->query("SELECT * FROM eventos ORDER BY usuario_org");
              while($row1 = $eventos->fetch_assoc()){
                  $usuario_org = $row1['usuario_org'];
                  $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '$usuario_org'");
                  $row2 = $solicitar->fetch_assoc();
                  if($row2['id'] == $_SESSION['id']){
                    echo "
                  <div class=\"col-md-4 evs \">
                    <div class=\"card bordeado\">
                        <div class=\"card-body\">
                          <h3 class=\"card-title\">
                            <a href='verEvento.php?id=".$row1['id']."' class=\"text-dark\">".$row1['nombre']."</a><br>
                            ".$row2['usuario']."
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
                  }else{
                    echo "
                    <div class=\"col-md-4 evs \">
                      <div class=\"card bordeado\">
                          <div class=\"card-body\">
                            <h3 class=\"card-title\">
                              <a href='verEvento.php?id=".$row1['id']."' class=\"text-dark\">".$row1['nombre']."</a><br>
                              <a href='amigo.php?id=".$row2['id']."' class=\"text-dark\">".$row2['usuario']."</a>
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
            ?>
          </div>
        </div>
      </div>
    </section>

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
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src = "js/main.js"></script>

  <?php }else{
    echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
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
</body>
</html>
