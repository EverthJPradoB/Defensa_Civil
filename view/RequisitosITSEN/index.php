<?php
require_once("../../config/conexion.php");
if (isset($_POST["enviar"]) and $_POST["enviar"] == "si") {
    require_once("../../models/Usuario.php");
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

    <title>Requisitos ITSEN</title>

    <!-- vendor css -->
    <link href="public/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="public/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../../public/css/bracket.css">

</head>

<body>

    <style>
        li p {

            font-size: 18px;
        }

        .card-header{

            font-size: 20px;
            font-weight: bold;
        }
    </style>

    <!-- style="height: 100vh;width: 100vw; -->

    <div class="d-flex  justify-content-around bg-br-primary " style="height: 100%;width: 100%;">
        <div class="card bg-light mb-3" style="max-width: 19rem;">
            <div class="card-header">Medio</div>
            <div class="card-body">

                <ul>
                    <h5>
                        <li type="square">Anexo 1 <a href="">Descargar</a></li>
                    </h5>
                    <h5>
                        <li type="square">Anexo 2 <a href="">Descargar</a></li>
                    </h5>
                    <h5>
                        <li type="square">Anexo 3 <a href="">Descargar</a></li>
                    </h5>
                    <h5>
                        <li type="square">Anexo 4 <a href="">Descargar</a></li>
                    </h5>

                    <h5>
                        <li class="text-dark"type="square">
                            <p>Certificado vigente de medicion y resistencia de puesto a tierra</p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Plan de seguridad del establecimiento objeto de inspeccion (Debe contener plan de evacuacion y plano de señalizacion) </p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Memoria o protocolos de pruebas de operatividad de los equipos de seguridad y proteccion contra incendios</p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Pago derecho de tramite SATCH 211.70 soles</p>
                        </li>
                    </h5>



                </ul>

            </div>
        </div>

        <!-- CARDDDDDd 222222222222222222222222 -->

        <div class="card bg-light mb-3" style="max-width: 19rem;">
            <div class="card-header">Alto</div>
            <div class="card-body">

                <ul>
                    <h5>
                        <li type="square">Anexo 1 <a href="">Descargar</a></li>
                    </h5>
                    <h5>
                        <li type="square">Anexo 2 <a href="">Descargar</a></li>
                    </h5>
                    <h5>
                        <li type="square">Anexo 3 <a href="">Descargar</a></li>
                    </h5>

                    <h5>
                    <li class="text-dark"type="square">
                            <p>Certificado vigente de medicion y resistencia de puesto a tierra</p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Plan de seguridad del establecimiento objeto de inspeccion (Debe contener plan de evacuacion y plano de señalizacion) </p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Memoria o protocolos de pruebas de operatividad de los equipos de seguridad y proteccion contra incendios</p>
                        </li>
                    </h5>

                    <h5>
                    <li class="text-dark"type="square">
                            <p>Plano de arquitectura de la distribucion existente y detalle de calculo de oforo</p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Plano de distribucion de tableros electricos, diagrama unifiliares cuadro de cargas</p>
                        </li>
                    </h5>


                    <h5>
                    <li class="text-dark"type="square">
                            <p>Pago derecho de tramite SATCH 557.50 soles</p>
                        </li>
                    </h5>



                </ul>

            </div>
        </div>

        <!-- CARDDDDDd 3333333333333333 -->
        <div class="card bg-light mb-3" style="max-width: 19rem;">
            <div class="card-header">Muy Alto</div>
            <div class="card-body">

                <ul>
                    <h5>
                        <li type="square">Anexo 1 <a href="">Descargar</a></li>
                    </h5>
                    <h5>
                        <li type="square">Anexo 2 <a href="">Descargar</a></li>
                    </h5>
                    <h5>
                        <li type="square">Anexo 3 <a href="">Descargar</a></li>
                    </h5>

                    <h5>
                    <li class="text-dark"type="square">
                            <p>Certificado vigente de medicion y resistencia de puesto a tierra</p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Plan de seguridad del establecimiento objeto de inspeccion (Debe contener plan de evacuacion y plano de señalizacion) </p>
                        </li>
                    </h5>
                    <h5>
                    <li class="text-dark"type="square">
                            <p>Memoria o protocolos de pruebas de operatividad de los equipos de seguridad y proteccion contra incendios</p>
                        </li>
                    </h5>

                    <h5>
                    <li class="text-dark"type="square">
                            <p>Plano de arquitectura de la distribucion existente y detalle de calculo de aforo</p>
                        </li>
                    </h5>

                    <h5>
                    <li class="text-dark"type="square">
                            <p>Plano de distribucion de tableros electricos, diagrama unifiliares cuadro de cargas</p>
                        </li>
                    </h5>

                    <h5>
                    <li class="text-dark"type="square">
                            <p>Croquis de ubicacion</p>
                        </li>
                    </h5>


                    <h5>
                    <li class="text-dark"type="square">
                            <p>Pago derecho de tramite SATCH 1106.00 soles</p>
                        </li>
                    </h5>



                </ul>

            </div>
        </div>

    </div>

    <script src="public/lib/jquery/jquery.js"></script>
    <script src="public/lib/popper.js/popper.js"></script>
    <script src="public/lib/bootstrap/bootstrap.js"></script>

</body>

</html>