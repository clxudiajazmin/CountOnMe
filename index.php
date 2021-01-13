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
            <li class="upper-links" <a class="links" href=""><?php echo strtoupper($row['nombre']) ?></a></li>
            <li class="upper-links"><a class="links" href="logout.php">SALIR</a></li>

          </ul>
          <div class="row row2">
            <div class="col-sm-2">
              <h1 style="margin:0px;"><span class="largenav">Count on Me</span></h1>
            </div>
            <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
              <div class="row">
                <input class="flipkart-navbar-input col-xs-11" type="text" id="buscador" placeholder="Busca tu evento" >
                <button class="flipkart-navbar-button col-xs-1" id = "boton">
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
            <?$eventos = $connect->query("SELECT * FROM eventos ORDER BY usuario_org");
            echo"filtar($eventos)"?>
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


        <div>
        <h1> Eventos</h1>
        <!--Parte de eventos-->
            <?php
            $eventos = $connect->query("SELECT * FROM eventos ORDER BY usuario_org");
            while($row1 = $eventos->fetch_assoc()){
                $usuario_org = $row1['usuario_org'];
                $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '$usuario_org'");
                $row2 = $solicitar->fetch_assoc();
                echo "Nombre del evento:";
                echo "<a href='verEvento.php?id=".$row1['id']."'>".$row1['nombre']."</a><br>";
                echo "Fecha:";
                echo $row1['fecha']."<br>";
                echo "Aforo:";
                echo $row1['aforo']."<br>";
                echo "Evento creado por:";
                if($usuario_org == $_SESSION['id']){
                    echo $row2['usuario']."</a><br><br><br>";
                }else{
                    echo "<a href='amigo.php?id=".$row2['id']."'>".$row2['usuario']."</a><br><br><br>";
                }
            }
            ?>
        </div>
      </div>
    </div>
  </div>

    <div>
      <!--Barra lateral de perfil .-->
      <!--Imagen de perfil.-->
      <img src = "<?php echo $row['avatar']; ?>" width="100">
      <br>
      <!--Usuario.-->
      <?php echo $row['usuario'];?>
      <br>
      <!--Fecha de Nacimiento.-->
      <?php echo $row['nacimiento'];?>
      <br>
      <!--Sexo.-->
      <?php echo $row['sexo'];?>
      <br>
      <!--Descripción.-->
      <?php echo $row['descripcion'];?>
      <br>
      <!--Fecha de registro.-->
      <?php echo $row['fecha_reg'];?>
      <br>
      <a href='editarPerfil.php'> Editar Perfil</a>

    </div>
    <div>
      <!--Parte de eventos-->
      <?php
      $eventos = $connect->query("SELECT * FROM eventos ORDER BY usuario_org");
      while($row1 = $eventos->fetch_assoc()){
        $usuario_org = $row1['usuario_org'];
        $solicitar = $connect->query("SELECT  * FROM usuarios WHERE id = '$usuario_org'");
        $row2 = $solicitar->fetch_assoc();
        echo "Evento creado por:";
        echo $row2['usuario']."<br>";
        echo "Nombre del evento:";
        echo $row1['nombre']."<br>";
        echo "Fecha:";
        echo $row1['fecha']."<br>";
        echo "Aforo:";
        echo $row1['aforo']."<br>";
        echo "Descripción:";
        echo $row1['descripcion']."<br>";
        echo "Categoría:";
        echo $row1['categoria']."<br>";
        echo "Ubicación:";
        echo $row1['ubicacion']."<br>";
      }
      ?>
    </div>
  <?php }else{
    echo "<a href='login.php'> Debes loguearte </a> o <a href='registro.php'> Registrarte </a>";
  }

  ?>

</body>
</html>
