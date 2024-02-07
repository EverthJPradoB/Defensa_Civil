<?php

require_once("../../config/conexion.php");


if (isset($_SESSION["usuario_id"])) {
    // if (true) {

    # code...
?>


    <!DOCTYPE html>
    <html lang="es">

    <head>

        <?php
        require_once("../html/MainHead.php");
        ?>

        <title>Empresa::Home</title>
    </head>

    <body>

        <style>
            .overflow-column {
                max-width: 300px;
                /* Ajusta este valor según tus necesidades */
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }

            .ancho {
                background-color: red;

            }

            .multiline-cell {
                white-space: normal !important;
                word-wrap: break-word;
                text-align: justify;

            }

            form {
                color: black;

            }

            .border-top {
                border-top: 2px solid #000000;
            }

            .border-left {
                border-left: 2px solid #000000;
            }

            .border-right {
                border-right: 2px solid #000000;
            }

            .border-bottom {
                border-bottom: 2px solid #000000;
            }

            .border-bottom-left-right {
                border-bottom: 2px solid #000000;
                border-left: 2px solid #000000;
                border-right: 2px solid #000000;
            }

            .border-left-right {
                border-left: 2px solid #000000;
                border-right: 2px solid #000000;
            }

            .border-top-left-right {
                border-top: 2px solid #ff0000;
                border-left: 2px solid #ff0000;
                border-right: 2px solid #ff0000;
            }

            .border-total {
                border: 2px solid #000000;
            }


            /* Ajustes específicos para tu aplicación */
        </style>
        <?php
        require_once("../html/MainMenu.php");
        ?>
        <?php
        require_once("../html/MainHeader.php");
        ?>

        <div class="br-mainpanel pb-5">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="#">Inicio</a>

                </nav>
            </div>
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Inicio</h4>
                <p class="mg-b-0">Solicitud ITSEN</p>
            </div>

            <!-- Contenido del Proyecto   solicitud_form  -->
            <div class="br-pagebody mg-t-5 pd-x-30 table-responsive">
                <div class="card pd-0 bd-0 shadow-base">

                    <?php
                    if (

                        (!isset($_SESSION["opcionAnexo_1_idesx"])) && (!isset($_SESSION["opcionAnexo_2_idesx"]))
                        &&    (!isset($_SESSION["opcionAnexo_3_idesx"]))

                    ) { ?>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0 text-center" style="color: black;">ANEXO 1 SOLICITUD DE INSPECCIÓN TÉCNICA DE SEGURIDAD EN EDIFICACIONES - ITSE Y DE
                                    EVALUACIÓN DE CONDICIONES DE SEGURIDAD EN ESPECTÁCULOS PÚBLICOS DEPORTIVOS Y NO
                                    DEPORTIVOS - ECSE</h6>
                            </div>
                            <div class="card-body ">

                                <ul class="nav nav-pills nav-fill mb-3">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="step1-tab" data-toggle="pill" href="#step1" onclick="changeStep(1)">I.- INFORMACION GENERAL</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="step2-tab" data-toggle="pill" href="#step2" onclick="changeStep(2)">II. DATOS DEL SOLICITANTE</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="step3-tab" data-toggle="pill" href="#step3" onclick="changeStep(3)">III.- DATOS DEL OBJETO DE INSPECCIÓN:</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="step4-tab" data-toggle="pill" href="#step4" onclick="changeStep(4)">IV.- DOCUMENTOS PRESENTADOS</a>
                                    </li>
                                </ul>

                                <form id="solicitud_form" method="post" >

                                    <div id="form-wizard">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="step1">
                                                <div class="form-group">
                                                    <?php
                                                    require_once("../html/solicitud/Anexos/Anexo01/infoGeneral.php");
                                                    informe();

                                                    ?>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="step2">
                                                <div class="form-group">

                                                    <?php
                                                    require_once("../html/solicitud/Anexos/Anexo01/datosSolicitante.php");
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="step3">
                                                <div class="form-group">

                                                    <?php
                                                    require_once("../html/solicitud/Anexos/Anexo01/datosInspeccion.php");
                                                    ?>

                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="step4">
                                                <div class="form-group">
                                                    <?php
                                                    require_once("../html/solicitud/Detalles/detalleAnexo1/index.php");
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group d-flex justify-content-between">
                                            <div>
                                                <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(currentStep - 1)">Previous</button>
                                                <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(currentStep + 1)">Next</button>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">Enviar</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    <?php  } else {   ?>

                        <!-- si se ingresa el anexo 1 , peor ya se registra el anexo 2 -->

                        <div class="alert alert-success" role="alert">
                            <h5 class="alert-heading">¡Proceso completado!</h5>
                            <p>Ya a sido Ingreado el Anexo 1 Correctamente</p>
                        </div>

                    <?php      }  ?>

                </div>
            </div>

        </div>



        <?php
        require_once("../html/MainJs.php");
        ?>

        <script type="text/javascript" src="UsuSolicitudTecnica.js"></script>


        <script type="text/javascript" src="UsuSolicitudDetalle_1.js"></script>


        <script>
            var currentStep = 1;

            function changeStep(step) {
                if (step >= 1 && step <= 4) {
                    currentStep = step;
                    showStep(currentStep);
                }
            }

            function showStep(step) {
                $(".nav-link").removeClass("active");
                $("#step" + step + "-tab").addClass("active");

                $(".tab-pane").removeClass("show active");
                $("#step" + step).addClass("show active");

                // Mostrar u ocultar el botón de Submit según el paso actual
                if (currentStep === 4) {
                    $("#submitBtn").show();
                } else {
                    $("#submitBtn").hide();
                }
            }
        </script>


    </body>

    </html>
<?php
} else {

    header("Location:" . Conectar::ruta() . "view/404/");
}


?>