<?php
require_once("config/conexion.php");
if (isset($_POST["enviar"]) and $_POST["enviar"] == "si") {
  require_once("models/Usuario.php");
  $usuario = new Usuario();
  $usuario->login();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Twitter -->
  <meta name="twitter:site" content="@themepixels">
  <meta name="twitter:creator" content="@themepixels">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Bracket">
  <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

  <!-- Facebook -->
  <meta property="og:url" content="http://themepixels.me/bracket">
  <meta property="og:title" content="Bracket">
  <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

  <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="600">

  <!-- Meta -->
  <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
  <meta name="author" content="ThemePixels">

  <title>EMPRESA::Acceso</title>

  <!-- vendor css -->
  <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

  <!-- Bracket CSS -->
  <link rel="stylesheet" href="public/css/bracket.css">
</head>

<body>
  <div style="background-color: red;">
    <div class="bg-br-primary">
      <!-- //background-color:#F0770C;  -->
      <div class="d-flex align-items-center justify-content-center" style="height: 15vh;width: 100vw;">
        <h1 class="tx-30 text-white">INSTITUTO NACIONAL DE DEFENSA CIVIL</h1>

      </div>
      <div class=" d-flex align-items-center justify-content-center" style="height: 85vh;width: 100vw;">

        <div style="margin-right: 10%;">

          <p class="tx-34 font-weight-bold">GITSEN</p>

        </div>

        <div>

          <ul class="list-unstyled ">
            <li><a href="/Defensa_Civil/view/RequisitosITSEN/" class="btn btn-primary btn-block tx-18 mb-4">Requisitos ITSE</a></li>
            <li><a href="/Defensa_Civil/view/UsuLogin/" class="btn btn-primary btn-block tx-18 mb-4">Trabajadores</a></li>
            <!-- <li><a href="#" class="btn btn-primary btn-block tx-18 mb-4">Inspector</a></li>
            <li><a href="#" class="btn btn-primary btn-block tx-18 mb-4">Usuario</a></li>
           -->
          
          </ul>

        </div>


      </div>
    </div>


  </div>




  <!-- <menu>
        <li><button onclick="copy()">Copiar</button></li>
        <li><button onclick="cut()">Cortar</button></li>
        <li><button onclick="paste()">Pegar</button></li>
      </menu> -->


  <script src="public/lib/jquery/jquery.js"></script>
  <script src="public/lib/popper.js/popper.js"></script>
  <script src="public/lib/bootstrap/bootstrap.js"></script>

</body>

</html>